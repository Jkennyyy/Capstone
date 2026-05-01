<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreReservationRequest;
use App\Http\Requests\Api\UpdateReservationRequest;
use App\Models\Reservation;
use App\Services\RoomAvailabilityService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request, RoomAvailabilityService $availabilityService): JsonResponse
    {
        $this->authorize('create', Reservation::class);

        $payload = $request->validated();
        $startAt = Carbon::parse($payload['start_at']);
        $endAt = Carbon::parse($payload['end_at']);

        $reservation = DB::transaction(function () use ($request, $payload, $startAt, $endAt, $availabilityService): Reservation {
            $scheduleConflict = $availabilityService->checkOfficialScheduleConflict(
                (int) $payload['classroom_id'],
                $startAt,
                $endAt,
                null,
                true
            );

            if ($scheduleConflict['has_conflict']) {
                throw new HttpResponseException(response()->json([
                    'message' => 'Room is occupied by official schedule at selected time.',
                    'errors' => [
                        'classroom_id' => ['Room is occupied by official schedule at selected time.'],
                    ],
                    'conflicts' => $scheduleConflict['conflicts'],
                ], 422));
            }

            $reservation->load(['classroom', 'user']);

            $notif = Notification::create([
                'type' => 'reservation',
                'title' => 'Reservation created',
                'body' => sprintf("%s reserved %s from %s to %s", $request->user()->name, $reservation->classroom->name, $reservation->start_at->toDateTimeString(), $reservation->end_at->toDateTimeString()),
                'data' => [
                    'reservation_id' => $reservation->id,
                    'classroom_id' => $reservation->classroom_id,
                    'user_id' => $reservation->user_id,
                    'start_at' => $reservation->start_at->toDateTimeString(),
                    'end_at' => $reservation->end_at->toDateTimeString(),
                ],
                'user_id' => $reservation->user_id,
            ]);

            try {
                event(new \App\Events\NewNotification($notif));
            } catch (\Throwable $e) {
                // non-fatal
            }

            return response()->json([
                'message' => 'Reservation created successfully.',
                'data' => $reservation->fresh(['classroom', 'user']),
            ], 201);
                true
            );

            if ($reservationConflict['has_conflict']) {
                throw new HttpResponseException(response()->json([
                    'message' => 'Room is already reserved at selected time.',
                    'errors' => [
                        'classroom_id' => ['Room is already reserved at selected time.'],
                    ],
                    'conflicts' => $reservationConflict['conflicts'],
                ], 422));
            }

            return Reservation::create([
                'classroom_id' => $payload['classroom_id'],
                'user_id' => $request->user()->id,
                'start_at' => $startAt,
                'end_at' => $endAt,
                'status' => 'reserved',
                'notes' => $payload['notes'] ?? null,
            ]);
        });

        return response()->json([
            'message' => 'Reservation created successfully.',
            'data' => $reservation->fresh(['classroom', 'user']),
        ], 201);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation, RoomAvailabilityService $availabilityService): JsonResponse
    {
        $this->authorize('update', $reservation);

        $payload = $request->validated();

        $startAt = isset($payload['start_at']) ? Carbon::parse($payload['start_at']) : $reservation->start_at;
        $endAt = isset($payload['end_at']) ? Carbon::parse($payload['end_at']) : $reservation->end_at;

        $oldStatus = $reservation->status;

        DB::transaction(function () use ($reservation, $payload, $startAt, $endAt, $availabilityService): void {
            $nextStatus = $payload['status'] ?? $reservation->status;

            if ($nextStatus !== 'cancelled') {
                $scheduleConflict = $availabilityService->checkOfficialScheduleConflict(
                    (int) $reservation->classroom_id,
                    $startAt,
                    $endAt,
                    null,
                    true
                );

                if ($scheduleConflict['has_conflict']) {
                    throw new HttpResponseException(response()->json([
                        'message' => 'Room is occupied by official schedule at selected time.',
                        'errors' => [
                            'classroom_id' => ['Room is occupied by official schedule at selected time.'],
                        ],
                        'conflicts' => $scheduleConflict['conflicts'],
                    ], 422));
                }

                $reservationConflict = $availabilityService->checkReservationConflict(
                    (int) $reservation->classroom_id,
                    $startAt,
                    $endAt,
                    (int) $reservation->id,
                    true
                );

                if ($reservationConflict['has_conflict']) {
                    throw new HttpResponseException(response()->json([
                        'message' => 'Room is already reserved at selected time.',
                        'errors' => [
                            'classroom_id' => ['Room is already reserved at selected time.'],
                        ],
                        'conflicts' => $reservationConflict['conflicts'],
                    ], 422));
                }
            }

            $reservation->update([
                'start_at' => $startAt,
                'end_at' => $endAt,
                'status' => $nextStatus,
                'notes' => $payload['notes'] ?? $reservation->notes,
                'cancelled_at' => $nextStatus === 'cancelled' ? now() : null,
            ]);
        });

        $reservation->refresh();
        $reservation->load(['classroom', 'user']);

        if ($oldStatus !== $reservation->status) {
            $title = 'Reservation updated';
            $body = sprintf("%s updated reservation for %s (status: %s)", $reservation->user->name, $reservation->classroom->name, $reservation->status);

            $notif = Notification::create([
                'type' => 'reservation_status',
                'title' => $title,
                'body' => $body,
                'data' => [
                    'reservation_id' => $reservation->id,
                    'old_status' => $oldStatus,
                    'new_status' => $reservation->status,
                ],
                'user_id' => $reservation->user_id,
            ]);

            try {
                event(new \App\Events\NewNotification($notif));
            } catch (\Throwable $e) {
                // non-fatal
            }
        }

        return response()->json([
            'message' => 'Reservation updated successfully.',
            'data' => $reservation->fresh(['classroom', 'user']),
        ]);
    }

    public function destroy(Reservation $reservation): JsonResponse
    {
        $this->authorize('delete', $reservation);

        DB::transaction(function () use ($reservation): void {
            $reservation->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);
        });

        $reservation->refresh();
        $reservation->load(['classroom', 'user']);

        $notif = Notification::create([
            'type' => 'reservation',
            'title' => 'Reservation cancelled',
            'body' => sprintf("%s cancelled reservation for %s scheduled %s to %s", $reservation->user->name, $reservation->classroom->name, $reservation->start_at->toDateTimeString(), $reservation->end_at->toDateTimeString()),
            'data' => [
                'reservation_id' => $reservation->id,
                'classroom_id' => $reservation->classroom_id,
                'user_id' => $reservation->user_id,
            ],
            'user_id' => $reservation->user_id,
        ]);

        try {
            event(new \App\Events\NewNotification($notif));
        } catch (\Throwable $e) {
            // non-fatal
        }

        return response()->json([
            'message' => 'Reservation cancelled successfully.',
            'data' => $reservation->fresh(['classroom', 'user']),
        ]);
    }
}
