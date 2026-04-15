@extends('layouts.app')

@section('title', 'Classroom Detail')

@section('content')
<div class="page-head">
    <h1 class="page-title">{{ $classroom->name }}</h1>
    <a class="btn secondary" href="{{ route('admin.classrooms') }}">Back to Classrooms</a>
</div>

<div class="grid grid-3">
    <div class="card"><div class="muted">Building</div><div class="stat-value">{{ $classroom->building }}</div></div>
    <div class="card"><div class="muted">Floor</div><div class="stat-value">{{ $classroom->floor ?? '-' }}</div></div>
    <div class="card"><div class="muted">Capacity</div><div class="stat-value">{{ $classroom->current_occupancy }}/{{ $classroom->capacity }}</div></div>
</div>

<section class="card">
    <h2>Room Management</h2>
    <form method="POST" action="{{ route('admin.classrooms.update', $classroom->id) }}" style="display:grid;gap:12px;max-width:640px;">
        @csrf
        @method('PATCH')

        <label>
            <div class="muted" style="margin-bottom:6px;">Status</div>
            <select name="status" style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;">
                <option value="available" {{ $classroom->status === 'available' ? 'selected' : '' }}>Available</option>
                <option value="occupied" {{ $classroom->status === 'occupied' ? 'selected' : '' }}>Occupied</option>
                <option value="reserved" {{ $classroom->status === 'reserved' ? 'selected' : '' }}>Reserved</option>
                <option value="maintenance" {{ in_array($classroom->status, ['maintenance', 'unavailable'], true) ? 'selected' : '' }}>Unavailable (Issue/Maintenance)</option>
            </select>
        </label>

        <label>
            <div class="muted" style="margin-bottom:6px;">Issue Notes (required for unavailable)</div>
            <textarea
                name="unavailable_reason"
                rows="3"
                placeholder="e.g., Electrical issue in panel board, AC repair ongoing, projector replacement pending"
                style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;resize:vertical;"
            >{{ old('unavailable_reason', $classroom->unavailable_reason) }}</textarea>
            <div class="muted" style="margin-top:6px;">This note appears in room availability so faculty know why the room is blocked.</div>
        </label>

        <div>
            <button type="submit" class="btn">Save Room Status</button>
        </div>
    </form>
</section>

<section class="card">
    <h2>Schedules</h2>
    <table>
        <thead><tr><th>Start</th><th>End</th><th>Course</th><th>Instructor</th><th>Status</th></tr></thead>
        <tbody>
            @forelse($classroom->schedules as $schedule)
                <tr>
                    <td>{{ optional($schedule->start_at)->format('M d, Y H:i') }}</td>
                    <td>{{ optional($schedule->end_at)->format('M d, Y H:i') }}</td>
                    <td>{{ $schedule->course?->code }} - {{ $schedule->course?->title }}</td>
                    <td>{{ $schedule->course?->instructor?->name }}</td>
                    <td><span class="chip">{{ $schedule->status }}</span></td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">No schedules assigned.</td></tr>
            @endforelse
        </tbody>
    </table>
</section>

<section class="card">
    <h2>Recent Access Logs</h2>
    <table>
        <thead><tr><th>Time</th><th>User</th><th>Card</th><th>Direction</th><th>Result</th></tr></thead>
        <tbody>
            @forelse($classroom->accessLogs as $log)
                <tr>
                    <td>{{ optional($log->accessed_at)->format('M d, Y H:i') }}</td>
                    <td>{{ $log->user?->name ?? 'Unknown' }}</td>
                    <td>{{ $log->accessCard?->card_number ?? '-' }}</td>
                    <td>{{ $log->direction }}</td>
                    <td><span class="chip {{ $log->result === 'granted' ? 'good' : 'bad' }}">{{ $log->result }}</span></td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">No access logs for this classroom.</td></tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection
