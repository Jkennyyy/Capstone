<?php

namespace App\Http\Requests\Api;

use App\Models\Course;
use App\Services\RoomAvailabilityService;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        if (! $user) {
            return false;
        }

        return strtolower((string) $user->role) === 'admin';
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after:start_at'],
                'repeat_until' => ['nullable', 'date', 'after_or_equal:start_at'],
            'status' => ['nullable', 'string', 'in:scheduled,ongoing,completed,cancelled'],
            'day_of_week' => ['nullable', 'integer', 'between:0,6'],
            'enrolled' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $course = Course::query()->with('instructor')->find((int) $this->input('course_id'));
            if (! $course || ! app(RoomAvailabilityService::class)->isItUserDepartment($course->instructor?->department)) {
                $validator->errors()->add('course_id', 'Course must belong to IT department scope.');

                return;
            }

            $startAt = Carbon::parse((string) $this->input('start_at'));
            $endAt = Carbon::parse((string) $this->input('end_at'));

            $conflict = app(RoomAvailabilityService::class)->checkOfficialScheduleConflict(
                (int) $this->input('classroom_id'),
                $startAt,
                $endAt
            );

            if ($conflict['has_conflict']) {
                $validator->errors()->add('classroom_id', 'Official schedule conflict: room is already occupied by another official schedule at selected time.');
            }
        });
    }
}
