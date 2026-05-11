@php
$studentName = optional($student)->name ?? 'Student';
$studentId = optional($student)->student_id ?? 'N/A';
$firstName = explode(' ', $studentName)[0];
$initials = collect(explode(' ', $studentName))->map(fn($word) => strtoupper($word[0]))->join('');
$nav = [
    ['icon' => 'bi-house', 'label' => 'Home', 'active' => false, 'route' => 'student.home'],
    ['icon' => 'bi-building', 'label' => 'Rooms', 'active' => false, 'route' => 'student.checkingRoom'],
    ['icon' => 'bi-calendar3', 'label' => 'Schedule', 'active' => true, 'route' => 'student.studentSchedule'],
    ['icon' => 'bi-clipboard-check', 'label' => 'Attendance', 'active' => false, 'route' => 'student.attendance'],
    ['icon' => 'bi-person', 'label' => 'Profile', 'active' => false, 'route' => 'student.profile'],
];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Schedule – Student Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    :root { --gold: #F5A800; --navy: #1B2A5E; }
    body { background: #F4F6FA; font-family: 'Segoe UI', sans-serif; }

    #sidebar { width: 230px; min-height: 100vh; background: #fff; border-right: 1px solid #e8eaf0; }
    .brand-icon { background: var(--gold); border-radius: 10px; width: 42px; height: 42px; display:grid; place-items:center; }
    .nav-link { color: #555; border-radius: 8px; padding: .55rem 1rem; font-weight: 500; }
    .nav-link:hover, .nav-link.active { background: #F0F4FF; color: var(--navy); }
    .nav-link.active::after { content:''; display:inline-block; width:7px; height:7px; background:var(--navy); border-radius:50%; margin-left:auto; }
    .avatar { width:38px; height:38px; background:var(--navy); border-radius:50%; display:grid; place-items:center; color:#fff; font-weight:700; font-size:.85rem; }
    
    .schedule-card { border-radius: 10px; border: 1px solid #e8eaf0; background: #fff; }
    .schedule-row { padding: 1rem; border-bottom: 1px solid #e8eaf0; transition: background 0.15s; }
    .schedule-row:last-child { border-bottom: none; }
    .schedule-row:hover { background: #F0F4FF; }
    .time-badge { background: #F0F4FF; border-radius: 8px; font-size: .75rem; font-weight: 700; color: var(--navy); width: 60px; text-align: center; padding: 4px 0; }
  </style>
</head>
<body>
<div class="d-flex">

  <!-- Sidebar -->
  <nav id="sidebar" class="d-flex flex-column p-3 gap-1">
    <div class="d-flex align-items-center gap-2 mb-4 px-1">
      <div class="brand-icon"><i class="bi bi-building text-white fs-5"></i></div>
      <div><div class="fw-bold text-dark" style="color:var(--navy)!important">SmartDoor</div><small class="text-muted">Student Portal</small></div>
    </div>

    @foreach ($nav as $item)
      <a href="{{ route($item['route']) }}" class="nav-link d-flex align-items-center gap-2 {{ $item['active'] ? 'active' : '' }}">
        <i class="bi {{ $item['icon'] }}"></i> {{ $item['label'] }}
      </a>
    @endforeach

    <div class="mt-auto pt-3 border-top">
      <div class="d-flex align-items-center gap-2 px-1">
        <div class="avatar">{{ $initials }}</div>
        <div><div class="fw-semibold small">{{ $studentName }}</div><div class="text-muted" style="font-size:.75rem">{{ $studentId }}</div></div>
      </div>
      <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="nav-link text-danger mt-2 w-100 border-0 bg-transparent text-start"><i class="bi bi-box-arrow-right"></i> Logout</button>
      </form>
    </div>
  </nav>

  <!-- Main -->
  <main class="flex-grow-1 p-4">

    <!-- Topbar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div><h5 class="fw-bold mb-0">My Schedule</h5><small class="text-muted">{{ now()->format('l, F j, Y') }}</small></div>
      <a href="{{ route('student.home') }}" class="btn btn-warning fw-semibold"><i class="bi bi-house me-1"></i> Back to Home</a>
    </div>

    <!-- Schedule Card -->
    <div class="schedule-card">
      @forelse ($schedules as $s)
        <div class="schedule-row d-flex align-items-center gap-3">
          <div class="time-badge">
            {{ $s->start_at ? \Carbon\Carbon::parse($s->start_at)->format('H:i') : 'N/A' }}
          </div>
          <div class="flex-grow-1">
            <div class="fw-semibold small">
              {{ $s->course_code ?? 'Course' }}
              <span class="badge bg-light text-secondary ms-1">{{ $s->block_section ?? 'N/A' }}</span>
            </div>
            <div class="text-muted" style="font-size:.75rem">
              <i class="bi bi-person me-1"></i>{{ $s->faculty_name ?? 'Faculty' }}
              <i class="bi bi-geo-alt ms-2 me-1"></i>{{ $s->classroom_name ?? 'Room TBA' }}
            </div>
          </div>
        </div>
      @empty
        <div class="p-4 text-center text-muted">
          <i class="bi bi-calendar-x fs-1"></i>
          <p class="mt-2">No scheduled classes at this time.</p>
        </div>
      @endforelse
    </div>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
