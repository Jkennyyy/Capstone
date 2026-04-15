<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreScheduleRequest;
use App\Http\Requests\Api\UpdateScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use App\Services\RoomAvailabilityService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::query()
            ->with(['classroom', 'course.instructor'])
            ->whereHas('course.instructor', function ($scope): void {
                $this->applyItDepartmentScope($scope);
            });

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('classroom_id')) {
            $query->where('classroom_id', $request->integer('classroom_id'));
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->integer('course_id'));
        }

        if ($request->filled('start_date')) {
            $query->whereDate('start_at', '>=', $request->date('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('end_at', '<=', $request->date('end_date'));
        }

        $schedules = $query->orderBy('start_at')->paginate($request->integer('per_page', 20));

        return ScheduleResource::collection($schedules);
    }

    public function store(StoreScheduleRequest $request, RoomAvailabilityService $availabilityService): ScheduleResource
    {
        $payload = $request->validated();

        if (isset($payload['start_at'])) {
            $payload['day_of_week'] = Carbon::parse($payload['start_at'])->dayOfWeek;
        }

        $schedule = DB::transaction(function () use ($payload, $availabilityService): Schedule {
            $conflict = $availabilityService->checkOfficialScheduleConflict(
                (int) $payload['classroom_id'],
                Carbon::parse($payload['start_at']),
                Carbon::parse($payload['end_at']),
                null,
                true
            );

            if ($conflict['has_conflict']) {
                throw ValidationException::withMessages([
                    'classroom_id' => ['Official schedule conflict: room is already occupied by another official schedule at selected time.'],
                ]);
            }

            return Schedule::create($payload);
        })->load(['classroom', 'course.instructor']);

        return new ScheduleResource($schedule);
    }

    public function show(Schedule $schedule): ScheduleResource
    {
        $this->ensureItScheduleScope($schedule);

        return new ScheduleResource($schedule->load(['classroom', 'course.instructor']));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule, RoomAvailabilityService $availabilityService): ScheduleResource
    {
        $this->ensureItScheduleScope($schedule);

        $payload = $request->validated();

        $effectiveStartAt = isset($payload['start_at']) ? Carbon::parse($payload['start_at']) : $schedule->start_at;
        $effectiveEndAt = isset($payload['end_at']) ? Carbon::parse($payload['end_at']) : $schedule->end_at;

        if ($effectiveStartAt) {
            $payload['day_of_week'] = $effectiveStartAt->dayOfWeek;
        }

        DB::transaction(function () use ($schedule, $payload, $effectiveStartAt, $effectiveEndAt, $availabilityService): void {
            $conflict = $availabilityService->checkOfficialScheduleConflict(
                (int) ($payload['classroom_id'] ?? $schedule->classroom_id),
                $effectiveStartAt,
                $effectiveEndAt,
                (int) $schedule->id,
                true
            );

            if ($conflict['has_conflict']) {
                throw ValidationException::withMessages([
                    'classroom_id' => ['Official schedule conflict: room is already occupied by another official schedule at selected time.'],
                ]);
            }

            $schedule->update($payload);
        });

        return new ScheduleResource($schedule->fresh()->load(['classroom', 'course.instructor']));
    }

    public function destroy(Schedule $schedule): JsonResponse
    {
        $this->ensureItScheduleScope($schedule);

        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully.']);
    }

    private function ensureItScheduleScope(Schedule $schedule): void
    {
        $schedule->loadMissing('course.instructor');

        if (! app(RoomAvailabilityService::class)->isItUserDepartment($schedule->course?->instructor?->department)) {
            abort(404);
        }
    }

    private function applyItDepartmentScope($query): void
    {
        $query->where(function ($scope): void {
            $scope->whereRaw('LOWER(COALESCE(department, \'\')) LIKE ?', ['%it%'])
                ->orWhereRaw('LOWER(COALESCE(department, \'\')) LIKE ?', ['%cit%'])
                ->orWhereRaw('LOWER(COALESCE(department, \'\')) LIKE ?', ['%cite%'])
                ->orWhereRaw('LOWER(COALESCE(department, \'\')) LIKE ?', ['%information technology%']);
        });
    }
}
