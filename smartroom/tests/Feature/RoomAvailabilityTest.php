<?php

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

function createFacultyUser(): User {
    return User::create([
        'name' => 'Faculty Tester',
        'email' => 'faculty.tester@example.com',
        'password' => Hash::make('Password123!'),
        'role' => 'faculty',
        'department' => 'Information Technology',
        'must_change_password' => false,
    ]);
}

it('blocks reservation when room overlaps an existing class schedule', function () {
    Carbon::setTestNow('2026-04-11 08:00:00');

    $faculty = createFacultyUser();

    $classroom = Classroom::create([
        'name' => 'Room 201',
        'building' => 'Building A',
        'floor' => '2nd Floor',
        'capacity' => 40,
    ]);

    $course = Course::create([
        'code' => 'CS999',
        'title' => 'Advanced Testing',
        'description' => 'Test course',
        'instructor_user_id' => $faculty->id,
        'capacity' => 40,
    ]);

    Schedule::create([
        'classroom_id' => $classroom->id,
        'course_id' => $course->id,
        'start_at' => '2026-04-11 09:00:00',
        'end_at' => '2026-04-11 11:00:00',
        'status' => 'scheduled',
        'day_of_week' => 0,
        'enrolled' => 20,
    ]);

    actingAs($faculty);

    $response = postJson('/api/v1/reservations', [
        'classroom_id' => $classroom->id,
        'start_at' => '2026-04-11 10:00:00',
        'end_at' => '2026-04-11 12:00:00',
    ]);

    $response->assertStatus(422)
        ->assertJsonPath('message', 'Room is occupied by official schedule at selected time.');

    expect(Reservation::count())->toBe(0);
});

it('blocks reservation when room overlaps an existing reservation', function () {
    Carbon::setTestNow('2026-04-11 08:00:00');

    $faculty = createFacultyUser();

    $classroom = Classroom::create([
        'name' => 'Room 301',
        'building' => 'Building B',
        'floor' => '3rd Floor',
        'capacity' => 35,
    ]);

    Reservation::create([
        'classroom_id' => $classroom->id,
        'user_id' => $faculty->id,
        'start_at' => '2026-04-11 13:00:00',
        'end_at' => '2026-04-11 15:00:00',
        'status' => 'reserved',
    ]);

    actingAs($faculty);

    $response = postJson('/api/v1/reservations', [
        'classroom_id' => $classroom->id,
        'start_at' => '2026-04-11 14:00:00',
        'end_at' => '2026-04-11 16:00:00',
    ]);

    $response->assertStatus(422)
        ->assertJsonPath('message', 'Room is already reserved at selected time.');

    expect(Reservation::query()->where('status', 'reserved')->count())->toBe(1);
});

it('returns occupied for current class and reserved for future slot', function () {
    Carbon::setTestNow('2026-04-11 10:00:00');

    $faculty = createFacultyUser();

    $occupiedRoom = Classroom::create([
        'name' => 'Room OCC',
        'building' => 'Building C',
        'floor' => '1st Floor',
        'capacity' => 30,
    ]);

    $reservedRoom = Classroom::create([
        'name' => 'Room RES',
        'building' => 'Building C',
        'floor' => '2nd Floor',
        'capacity' => 30,
    ]);

    $course = Course::create([
        'code' => 'IT777',
        'title' => 'Realtime Systems',
        'description' => 'Test course',
        'instructor_user_id' => $faculty->id,
        'capacity' => 30,
    ]);

    Schedule::create([
        'classroom_id' => $occupiedRoom->id,
        'course_id' => $course->id,
        'start_at' => '2026-04-11 09:30:00',
        'end_at' => '2026-04-11 11:00:00',
        'status' => 'ongoing',
        'day_of_week' => 0,
        'enrolled' => 18,
    ]);

    Reservation::create([
        'classroom_id' => $reservedRoom->id,
        'user_id' => $faculty->id,
        'start_at' => '2026-04-11 10:15:00',
        'end_at' => '2026-04-11 10:45:00',
        'status' => 'reserved',
    ]);

    actingAs($faculty);

    $response = getJson('/api/v1/room-statuses?start_at=2026-04-11T10:00:00&end_at=2026-04-11T11:00:00');

    $response->assertOk();

    $statuses = collect($response->json('data'));

    expect($statuses->firstWhere('classroom_id', $occupiedRoom->id)['status'])->toBe('occupied');
    expect($statuses->firstWhere('classroom_id', $reservedRoom->id)['status'])->toBe('reserved');
});
