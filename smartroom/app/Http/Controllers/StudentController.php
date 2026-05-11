<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\AttendanceRecord;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Show the student home dashboard.
     */
    public function home()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login');
        }

        // Check or create student record
        $student = Student::firstOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'student_id' => 'STU-' . rand(10000, 99999),
                'status' => 'active',
            ]
        );

        // Fetch today's schedules using `start_at` timestamp
        $todaySchedules = Schedule::whereDate('start_at', today())
            ->with(['course', 'classroom'])
            ->orderBy('start_at')
            ->get();

        $todayClassesCount = $todaySchedules->count();

        $nextClass = $todaySchedules->firstWhere(fn($s) => \Carbon\Carbon::parse($s->start_at)->greaterThan(now()));

        $nextClassTime = $nextClass
            ? now()->diffInMinutes(\Carbon\Carbon::parse($nextClass->start_at)) . 'min'
            : 'N/A';

        $availableRoomsCount = Classroom::where('status', 'available')->count();

        // Pass data to view
        return view('frontend.student.home', compact('student', 'todaySchedules', 'todayClassesCount', 'nextClassTime', 'availableRoomsCount'));
    }

    /**
     * Show checking room details.
     */
    public function checkingRoom()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login');
        }

        $student = Student::where('user_id', $user->id)->first();

        $classrooms = Classroom::all();

        return view('frontend.student.checkingRoom', compact('student', 'classrooms'));
    }

    /**
     * Show student schedule.
     */
    public function schedule()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login');
        }

        $student = Student::where('user_id', $user->id)->first();

        // Fetch only schedules for courses the student is enrolled in
        $schedules = optional($student)
            ? Schedule::whereIn('course_id', $student->courses()->pluck('id'))
                ->with(['course', 'classroom'])
                ->orderBy('start_at')
                ->get()
            : collect([]);

        return view('frontend.student.schedule', compact('student', 'schedules'));
    }

    /**
     * Show the studentSchedule view (legacy "studentSchedule" page).
     */
    public function studentSchedule()
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('auth.login');
        }

        $student = Student::where('user_id', $user->id)->first();

        // Fetch only schedules for courses the student is enrolled in
        $schedules = optional($student)
            ? Schedule::whereIn('course_id', $student->courses()->pluck('id'))
                ->with(['course', 'classroom'])
                ->orderBy('start_at')
                ->get()
            : collect([]);

        return view('frontend.student.studentSchedule', compact('student', 'schedules'));
    }

    /**
     * Show attendance page.
     */
    public function attendance()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login');
        }

        $student = Student::where('user_id', $user->id)->first();

                // Fetch attendance records (match by student PK or student id number)
                $attendanceRecords = \App\Models\AttendanceRecord::where(function($q) use ($student) {
                        $q->where('student_id', optional($student)->id)
                            ->orWhere('student_id_number', optional($student)->student_id);
                })->orderBy('created_at', 'desc')->get();
        
        // Calculate stats
        $totalAttended = $attendanceRecords->where('status', 'present')->count();
        $totalAbsent = $attendanceRecords->where('status', 'absent')->count();
        $totalRecords = $attendanceRecords->count();
        $attendanceRate = $totalRecords > 0 ? round(($totalAttended / $totalRecords) * 100, 1) : 0;

        return view('frontend.student.attendance', compact('student', 'attendanceRecords', 'totalAttended', 'totalAbsent', 'attendanceRate'));
    }

    /**
     * Show student profile.
     */
    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login');
        }

        $student = Student::where('user_id', $user->id)->first();

        return view('frontend.student.profile', compact('student'));
    }
}
