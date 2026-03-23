<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ClassroomController extends Controller
{
    /**
     * Show the classrooms page with filter options
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        // Mock data - replace with database queries when ready
        $classrooms = collect([
            (object)[
                'id' => 1,
                'name' => 'Room 102',
                'building' => 'Building A',
                'floor' => '1st Floor',
                'capacity' => 40,
                'status' => 'available',
                'currentClass' => null,
                'nextClass' => (object)['subject' => 'Computer Science 101', 'time' => '2:00 PM - 3:30 PM'],
            ],
            (object)[
                'id' => 2,
                'name' => 'Room 302',
                'building' => 'Building A',
                'floor' => '3rd Floor',
                'capacity' => 30,
                'status' => 'occupied',
                'currentClass' => (object)['subject' => 'Mathematics 201', 'instructor' => 'Dr. John Smith'],
                'nextClass' => null,
            ],
            (object)[
                'id' => 3,
                'name' => 'Lab 105',
                'building' => 'Building B',
                'floor' => '1st Floor',
                'capacity' => 25,
                'status' => 'available',
                'currentClass' => null,
                'nextClass' => (object)['subject' => 'Physics Lab', 'time' => '1:00 PM - 2:30 PM'],
            ],
            (object)[
                'id' => 4,
                'name' => 'Room 201',
                'building' => 'Building A',
                'floor' => '2nd Floor',
                'capacity' => 50,
                'status' => 'reserved',
                'currentClass' => null,
                'nextClass' => (object)['subject' => 'Conference Room Reserved', 'time' => '3:00 PM - 5:00 PM'],
            ],
            (object)[
                'id' => 5,
                'name' => 'Room 404',
                'building' => 'Building C',
                'floor' => '4th Floor',
                'capacity' => 35,
                'status' => 'occupied',
                'currentClass' => (object)['subject' => 'English Literature 150', 'instructor' => 'Prof. Sarah Johnson'],
                'nextClass' => null,
            ],
            (object)[
                'id' => 6,
                'name' => 'Auditorium',
                'building' => 'Building D',
                'floor' => 'Ground Floor',
                'capacity' => 200,
                'status' => 'available',
                'currentClass' => null,
                'nextClass' => (object)['subject' => 'Seminar: AI in Education', 'time' => '4:00 PM - 6:00 PM'],
            ],
        ]);

        // Filter classrooms based on status
        if ($filter !== 'all') {
            $classrooms = $classrooms->filter(function ($classroom) use ($filter) {
                return $classroom->status === $filter;
            });
        }

        return view('frontend.admin.classrooms', [
            'classrooms' => $classrooms,
            'filter' => $filter,
        ]);
    }

    /**
     * Show details of a specific classroom
     */
    public function show($id)
    {
        // Mock data - replace with database lookup
        $classroomNames = [
            1 => 'Room 102',
            2 => 'Room 302',
            3 => 'Lab 105',
            4 => 'Room 201',
            5 => 'Room 404',
            6 => 'Auditorium'
        ];

        $statuses = ['available', 'occupied', 'reserved', 'maintenance'];
        $classrooms = collect([
            (object)[
                'id' => 1,
                'name' => 'Room 102',
                'building' => 'Building A',
                'floor' => '1st Floor',
                'capacity' => 40,
                'status' => 'available',
                'currentOccupancy' => 0,
                'RFID Status' => 'Active',
                'rfidStatus' => 'Active',
                'temperature' => 22,
                'lastAccess' => '2 hours ago',
            ],
            (object)[
                'id' => 2,
                'name' => 'Room 302',
                'building' => 'Building A',
                'floor' => '3rd Floor',
                'capacity' => 30,
                'status' => 'occupied',
                'currentOccupancy' => 28,
                'rfidStatus' => 'Active',
                'temperature' => 23,
                'lastAccess' => '5 minutes ago',
            ],
            (object)[
                'id' => 3,
                'name' => 'Lab 105',
                'building' => 'Building B',
                'floor' => '1st Floor',
                'capacity' => 25,
                'status' => 'available',
                'currentOccupancy' => 5,
                'rfidStatus' => 'Active',
                'temperature' => 21,
                'lastAccess' => '30 minutes ago',
            ],
            (object)[
                'id' => 4,
                'name' => 'Room 201',
                'building' => 'Building A',
                'floor' => '2nd Floor',
                'capacity' => 50,
                'status' => 'reserved',
                'currentOccupancy' => 0,
                'rfidStatus' => 'Active',
                'temperature' => 20,
                'lastAccess' => '3 hours ago',
            ],
            (object)[
                'id' => 5,
                'name' => 'Room 404',
                'building' => 'Building C',
                'floor' => '4th Floor',
                'capacity' => 35,
                'status' => 'occupied',
                'currentOccupancy' => 32,
                'rfidStatus' => 'Active',
                'temperature' => 24,
                'lastAccess' => '1 minute ago',
            ],
            (object)[
                'id' => 6,
                'name' => 'Auditorium',
                'building' => 'Building D',
                'floor' => 'Ground Floor',
                'capacity' => 200,
                'status' => 'available',
                'currentOccupancy' => 0,
                'rfidStatus' => 'Active',
                'temperature' => 22,
                'lastAccess' => '4 hours ago',
            ],
        ]);

        // Get the specific classroom or create a default one
        $classroom = $classrooms->firstWhere('id', $id);
        
        if (!$classroom) {
            $classroom = [
                'id' => $id,
                'name' => $classroomNames[$id] ?? 'Room ' . $id,
                'building' => 'Building A',
                'floor' => '1st Floor',
                'capacity' => 40,
                'status' => $statuses[array_rand($statuses)],
                'currentOccupancy' => rand(0, 30),
                'rfidStatus' => 'Active',
                'temperature' => rand(20, 25),
                'lastAccess' => rand(1, 60) . ' minutes ago',
            ];
        }

        $classroom['schedule'] = [
            ['time' => '8:00 AM', 'class' => 'Mathematics 101', 'instructor' => 'Dr. Smith', 'attendance' => '35/40'],
            ['time' => '10:00 AM', 'class' => 'Physics Lab', 'instructor' => 'Prof. Johnson', 'attendance' => '28/30'],
            ['time' => '1:00 PM', 'class' => 'English Lit 150', 'instructor' => 'Dr. Williams', 'attendance' => '32/35'],
        ];

        $classroom['recentActivity'] = [
            ['type' => 'entry', 'name' => 'John Doe', 'cardId' => '0043AF2C', 'time' => '9:45 AM'],
            ['type' => 'entry', 'name' => 'Jane Smith', 'cardId' => '004398F1', 'time' => '9:42 AM'],
            ['type' => 'entry', 'name' => 'Mike Johnson', 'cardId' => '0043B215', 'time' => '9:38 AM'],
            ['type' => 'exit', 'name' => 'Sarah Williams', 'cardId' => '0043C984', 'time' => '9:35 AM'],
            ['type' => 'entry', 'name' => 'Tom Brown', 'cardId' => '0043D741', 'time' => '9:30 AM'],
        ];

        return view('frontend.admin.classroom-detail', [
            'classroom' => $classroom,
        ]);
    }
}
