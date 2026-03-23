<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display all schedules
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $view = $request->query('view', 'week');

        // Mock schedule data
        $schedules = collect([
            (object)[
                'id' => 1,
                'roomId' => 1,
                'roomName' => 'Room 102',
                'building' => 'Building A',
                'course' => 'Mathematics 101',
                'instructor' => 'Dr. John Smith',
                'startTime' => '08:00 AM',
                'endTime' => '09:30 AM',
                'day' => 'Monday',
                'capacity' => 40,
                'enrolled' => 35,
                'status' => 'scheduled',
            ],
            (object)[
                'id' => 2,
                'roomId' => 2,
                'roomName' => 'Room 302',
                'building' => 'Building A',
                'course' => 'Computer Science 201',
                'instructor' => 'Prof. Sarah Johnson',
                'startTime' => '10:00 AM',
                'endTime' => '11:30 AM',
                'day' => 'Monday',
                'capacity' => 30,
                'enrolled' => 28,
                'status' => 'ongoing',
            ],
            (object)[
                'id' => 3,
                'roomId' => 3,
                'roomName' => 'Lab 105',
                'building' => 'Building B',
                'course' => 'Physics Lab',
                'instructor' => 'Dr. Michael Chen',
                'startTime' => '01:00 PM',
                'endTime' => '02:30 PM',
                'day' => 'Monday',
                'capacity' => 25,
                'enrolled' => 22,
                'status' => 'scheduled',
            ],
            (object)[
                'id' => 4,
                'roomId' => 4,
                'roomName' => 'Room 201',
                'building' => 'Building A',
                'course' => 'English Literature',
                'instructor' => 'Prof. Emma Wilson',
                'startTime' => '02:00 PM',
                'endTime' => '03:30 PM',
                'day' => 'Tuesday',
                'capacity' => 35,
                'enrolled' => 30,
                'status' => 'scheduled',
            ],
            (object)[
                'id' => 5,
                'roomId' => 5,
                'roomName' => 'Room 404',
                'building' => 'Building C',
                'course' => 'Chemistry Lecture',
                'instructor' => 'Dr. Robert Williams',
                'startTime' => '03:00 PM',
                'endTime' => '04:30 PM',
                'day' => 'Tuesday',
                'capacity' => 40,
                'enrolled' => 38,
                'status' => 'scheduled',
            ],
            (object)[
                'id' => 6,
                'roomId' => 6,
                'roomName' => 'Auditorium',
                'building' => 'Building D',
                'course' => 'Seminar: AI in Education',
                'instructor' => 'Prof. Laura Martinez',
                'startTime' => '04:00 PM',
                'endTime' => '05:30 PM',
                'day' => 'Wednesday',
                'capacity' => 200,
                'enrolled' => 150,
                'status' => 'scheduled',
            ],
        ]);

        // Filter schedules based on status
        if ($filter !== 'all') {
            $schedules = $schedules->filter(function ($schedule) use ($filter) {
                return $schedule->status === $filter;
            });
        }

        return view('frontend.admin.schedules', [
            'schedules' => $schedules,
            'filter' => $filter,
            'view' => $view,
        ]);
    }

    /**
     * Show schedule details for a specific class
     */
    public function show($id)
    {
        // Mock data for individual schedule
        $schedule = [
            'id' => $id,
            'roomId' => $id,
            'roomName' => 'Room ' . (100 + $id),
            'building' => 'Building A',
            'floor' => '1st Floor',
            'course' => 'Sample Course ' . $id,
            'instructor' => 'Dr. Instructor Name',
            'instructorEmail' => 'instructor@university.edu',
            'instructorPhone' => '+1 (555) 123-4567',
            'startTime' => '09:00 AM',
            'endTime' => '10:30 AM',
            'day' => 'Monday',
            'days' => ['Monday', 'Wednesday', 'Friday'],
            'capacity' => 40,
            'enrolled' => 35,
            'status' => 'scheduled',
            'description' => 'This is a scheduled class session with all necessary details and resources.',
            'materials' => [
                ['name' => 'Lecture slides', 'type' => 'PDF'],
                ['name' => 'Assignment', 'type' => 'Document'],
                ['name' => 'Reading materials', 'type' => 'Link'],
            ],
            'attendees' => [
                ['name' => 'John Doe', 'status' => 'enrolled'],
                ['name' => 'Jane Smith', 'status' => 'enrolled'],
                ['name' => 'Mike Johnson', 'status' => 'enrolled'],
                ['name' => 'Sarah Williams', 'status' => 'enrolled'],
                ['name' => 'Tom Brown', 'status' => 'enrolled'],
            ],
            'upcomingSessions' => [
                ['date' => 'March 17, 2026', 'time' => '09:00 AM - 10:30 AM', 'room' => 'Room 102'],
                ['date' => 'March 19, 2026', 'time' => '09:00 AM - 10:30 AM', 'room' => 'Room 102'],
                ['date' => 'March 24, 2026', 'time' => '09:00 AM - 10:30 AM', 'room' => 'Room 102'],
            ],
        ];

        return view('frontend.admin.schedule-detail', [
            'schedule' => $schedule,
        ]);
    }
}
