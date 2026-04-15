<?php

namespace Database\Seeders;

use App\Models\AccessCard;
use App\Models\AccessLog;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class SmartRoomSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@smartroom.local'],
            [
                'name' => 'SmartRoom Admin',
                'password' => Hash::make('Admin12345'),
                'role' => 'admin',
                'department' => 'ICT',
            ]
        );

        $facultyOne = User::updateOrCreate(
            ['email' => 'faculty.one@smartroom.local'],
            [
                'name' => 'Faculty One',
                'password' => Hash::make('Faculty12345'),
                'role' => 'faculty',
                'department' => 'Computer Science',
            ]
        );

        $facultyTwo = User::updateOrCreate(
            ['email' => 'faculty.two@smartroom.local'],
            [
                'name' => 'Faculty Two',
                'password' => Hash::make('Faculty12345'),
                'role' => 'faculty',
                'department' => 'Information Technology',
            ]
        );

        $classrooms = collect([
            ['name' => 'Room 15', 'building' => 'Building A', 'floor' => '1st Floor', 'capacity' => 40, 'status' => 'available'],
            ['name' => 'Room 16', 'building' => 'Building A', 'floor' => '3rd Floor', 'capacity' => 30, 'status' => 'occupied'],
            ['name' => 'Room 17', 'building' => 'Building B', 'floor' => '1st Floor', 'capacity' => 25, 'status' => 'available'],
        ])->map(function (array $data) {
            return Classroom::updateOrCreate(
                ['name' => $data['name']],
                [
                    ...$data,
                    'current_occupancy' => 0,
                    'rfid_status' => 'active',
                    'temperature' => 22.0,
                    'last_accessed_at' => now()->subMinutes(rand(5, 180)),
                ]
            );
        });

        $courses = collect([
            ['code' => 'CS101', 'title' => 'Intro to Computing', 'instructor_user_id' => $facultyOne->id, 'capacity' => 40],
            ['code' => 'IT201', 'title' => 'Systems Analysis', 'instructor_user_id' => $facultyTwo->id, 'capacity' => 35],
        ])->map(function (array $data) {
            return Course::updateOrCreate(
                ['code' => $data['code']],
                [
                    ...$data,
                    'description' => $data['title'].' course description',
                ]
            );
        });

        $mondayNineAm = Carbon::now()->startOfWeek()->setHour(9)->setMinute(0)->setSecond(0);

        Schedule::updateOrCreate(
            ['classroom_id' => $classrooms[0]->id, 'course_id' => $courses[0]->id, 'start_at' => $mondayNineAm],
            [
                'end_at' => (clone $mondayNineAm)->addMinutes(90),
                'status' => 'scheduled',
                'day_of_week' => 1,
                'enrolled' => 32,
            ]
        );

        Schedule::updateOrCreate(
            ['classroom_id' => $classrooms[1]->id, 'course_id' => $courses[1]->id, 'start_at' => (clone $mondayNineAm)->addHours(2)],
            [
                'end_at' => (clone $mondayNineAm)->addHours(3)->addMinutes(30),
                'status' => 'ongoing',
                'day_of_week' => 1,
                'enrolled' => 28,
            ]
        );

        $facultyCard = AccessCard::updateOrCreate(
            ['rfid_uid' => 'RFID-A1B2C3D4'],
            [
                'user_id' => $facultyOne->id,
                'classroom_id' => $classrooms[0]->id,
                'card_number' => 'CARD-0001',
                'status' => 'active',
                'expires_at' => now()->addYear()->toDateString(),
                'last_accessed_at' => now()->subMinutes(10),
                'access_count' => 120,
            ]
        );

        AccessLog::updateOrCreate(
            [
                'access_card_id' => $facultyCard->id,
                'classroom_id' => $classrooms[0]->id,
                'accessed_at' => now()->subMinutes(10),
            ],
            [
                'user_id' => $facultyOne->id,
                'direction' => 'entry',
                'result' => 'granted',
                'reason' => null,
                'metadata' => ['source' => 'seed'],
            ]
        );

        // Keep admin linked to all classrooms for quick demo access.
        $admin->authorizedClassrooms()->syncWithoutDetaching($classrooms->pluck('id')->all());
    }
}
