<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\AttendanceSession;
use App\Models\AttendanceRecord;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('schedules.classroom')->get();

        $filterCourse = $request->query('course_id');
        $filterStatus = $request->query('status');
        $filterMonth = $request->query('month', now()->format('Y-m'));

        $q = AttendanceSession::query()->where('created_by', Auth::id());
        if ($filterCourse) $q->where('course_id', $filterCourse);
        if ($filterStatus) $q->where('status', $filterStatus);
        if ($filterMonth) {
            [$y, $m] = explode('-', $filterMonth);
            $q->whereYear('date', $y)->whereMonth('date', $m);
        }

        $sessions = $q->orderBy('date', 'desc')->get();

        $total = AttendanceSession::where('created_by', Auth::id())->count();
        $thisMonth = AttendanceSession::where('created_by', Auth::id())->whereYear('date', now()->year)->whereMonth('date', now()->month)->count();

        $overallRate = 0;
        $records = AttendanceRecord::whereHas('session', fn($q) => $q->where('created_by', Auth::id()))->get();
        if ($records->count() > 0) {
            $overallRate = round(100 * ($records->where('present', true)->count() / $records->count()), 1);
        }

        $open = AttendanceSession::where('created_by', Auth::id())->where('status', 'open')->latest()->first();

        $stats = ['total_sessions' => $total, 'this_month' => $thisMonth, 'overall_rate' => $overallRate, 'open_session' => $open];

        return view('frontend.faculty.attendance', compact('courses', 'sessions', 'stats', 'filterCourse', 'filterStatus', 'filterMonth'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
            'session_date' => 'required|date',
        ]);
        $schedule = Schedule::find($request->input('schedule_id'));
        if (!$schedule) {
            return redirect()->route('faculty.attendance')->with('error', 'Schedule not found.');
        }

        $sessionDate = $request->input('session_date');

        $session = AttendanceSession::create([
            'schedule_id' => $schedule->id,
            'course_id' => $schedule->course_id ?? null,
            'room' => $schedule->classroom?->name ?? $request->input('room') ?? null,
            'date' => $sessionDate,
            'started_at' => now()->format('H:i:s'),
            'status' => 'open',
            'remarks' => $request->input('remarks'),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('faculty.attendance.session', $session->id)->with('success', 'Attendance session opened.');
    }

    public function showSession($id)
    {
        $session = AttendanceSession::with('records')->find($id);
        if (!$session) {
            return redirect()->route('faculty.attendance')->with('error', 'Session not found.');
        }

        return view('frontend.faculty.attendance-session', ['session' => $session]);
    }

    public function storeRecord(Request $request, $id)
    {
        $request->validate([
            'student_name' => 'required|string',
            'present' => 'required|in:0,1',
        ]);

        $session = AttendanceSession::find($id);
        if (!$session) return redirect()->back()->with('error', 'Session not found.');

        AttendanceRecord::create([
            'attendance_session_id' => $session->id,
            'student_name' => $request->input('student_name'),
            'student_id' => $request->input('student_id'),
            'present' => $request->input('present') == '1',
            'remarks' => $request->input('remarks'),
        ]);

        return redirect()->route('faculty.attendance.session', $session->id)->with('success', 'Attendance recorded.');
    }

    // Accepts bulk JSON records payload: { records: [ { student_name, student_id_number, status, time_in, remarks }, ... ] }
    public function storeRecordsBulk(Request $request, $id)
    {
        $session = AttendanceSession::find($id);
        if (!$session) {
            return response()->json(['success' => false, 'message' => 'Session not found.'], 404);
        }

        $payload = $request->input('records');
        if (!is_array($payload)) {
            return response()->json(['success' => false, 'message' => 'Invalid payload.'], 400);
        }

        // Replace existing records for the session with provided ones
        \DB::transaction(function () use ($payload, $session) {
            AttendanceRecord::where('attendance_session_id', $session->id)->delete();
            foreach ($payload as $r) {
                $name = trim($r['student_name'] ?? '');
                if ($name === '') continue;
                $status = $r['status'] ?? 'present';
                $present = in_array($status, ['present', 'late']);
                AttendanceRecord::create([
                    'attendance_session_id' => $session->id,
                    'student_name' => $name,
                    'student_id' => $r['student_id_number'] ?? $r['student_id'] ?? null,
                    'student_id_number' => $r['student_id_number'] ?? $r['student_id'] ?? null,
                    'status' => $status,
                    'time_in' => $r['time_in'] ?? null,
                    'present' => $present,
                    'remarks' => $r['remarks'] ?? null,
                ]);
            }
        });

        return response()->json(['success' => true]);
    }

    // Close a session (AJAX)
    public function close(Request $request, $id)
    {
        $session = AttendanceSession::find($id);
        if (!$session) {
            return response()->json(['success' => false, 'message' => 'Session not found.'], 404);
        }
        $session->status = 'closed';
        $session->ended_at = now()->format('H:i:s');
        $session->save();

        return response()->json(['success' => true]);
    }

    public function export($id)
    {
        $session = AttendanceSession::with('records')->find($id);
        if (!$session) {
            return redirect()->route('faculty.attendance')->with('error', 'Session not found.');
        }

        $filename = 'attendance_export_' . $session->id . '.csv';
        $rows = [];
        $rows[] = ['Date', 'Course', 'Room', 'Status', 'Student', 'Student ID', 'Present', 'Remarks'];
        foreach ($session->records as $r) {
            $courseLabel = optional($session->course)->code ?? $session->course_id;
            $roomLabel = $session->room ?? (optional($session->classroom)->name ?? $session->classroom_id ?? '');
            $rows[] = [$session->date, $courseLabel, $roomLabel, $session->status, $r->student_name, $r->student_id, $r->present ? '1' : '0', $r->remarks];
        }

        $handle = fopen('php://temp', 'r+');
        foreach ($rows as $row) { fputcsv($handle, $row); }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
