@php
$studentName = optional($student)->name ?? 'Student';
$studentId = optional($student)->student_id ?? 'N/A';
$firstName = explode(' ', $studentName)[0];
$initials = collect(explode(' ', $studentName))->map(fn($word) => strtoupper($word[0]))->join('');
$stats = [
    ['icon' => 'bi-book', 'value' => $todayClassesCount ?? 0, 'label' => "Today's Classes", 'color' => 'text-warning'],
    ['icon' => 'bi-clock', 'value' => $nextClassTime ?? 'N/A', 'label' => 'Next Class', 'color' => 'text-secondary'],
    ['icon' => 'bi-building', 'value' => $availableRoomsCount ?? 0, 'label' => 'Available Rooms', 'color' => 'text-success'],
];
$nav = [
    ['icon' => 'bi-house', 'label' => 'Home', 'active' => true, 'route' => 'student.home'],
    ['icon' => 'bi-building', 'label' => 'Rooms', 'active' => false, 'route' => 'student.checkingRoom'],
    ['icon' => 'bi-calendar3', 'label' => 'Schedule', 'active' => false, 'route' => 'student.studentSchedule'],
    ['icon' => 'bi-clipboard-check', 'label' => 'Attendance', 'active' => false, 'route' => 'student.attendance'],
    ['icon' => 'bi-person', 'label' => 'Profile', 'active' => false, 'route' => 'student.profile'],
];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SmartDoor – Student Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    :root { --gold: #F5A800; --navy: #1B2A5E; }
    body { background: #F4F6FA; font-family: 'Segoe UI', sans-serif; }

    /* Sidebar */
    #sidebar { width: 230px; min-height: 100vh; background: #fff; border-right: 1px solid #e8eaf0; }
    .brand-icon { background: var(--gold); border-radius: 10px; width: 42px; height: 42px; display:grid; place-items:center; }
    .nav-link { color: #555; border-radius: 8px; padding: .55rem 1rem; font-weight: 500; }
    .nav-link:hover, .nav-link.active { background: #F0F4FF; color: var(--navy); }
    .nav-link.active::after { content:''; display:inline-block; width:7px; height:7px; background:var(--navy); border-radius:50%; margin-left:auto; }
    .avatar { width:38px; height:38px; background:var(--navy); border-radius:50%; display:grid; place-items:center; color:#fff; font-weight:700; font-size:.85rem; }

    /* Stat cards */
    .stat-card { border-radius: 14px; border: 1px solid #e8eaf0; background: #fff; }

    /* Next class banner */
    .next-banner { background: var(--gold); border-radius: 16px; }
    .next-banner .btn-view { background: var(--navy); color: #fff; border-radius: 10px; flex:1; }
    .next-banner .btn-nav  { background: rgba(255,255,255,.25); color: var(--navy); border-radius: 10px; font-weight:600; }

    /* Schedule rows */
    .schedule-row { border-radius: 10px; transition: background .15s; }
    .schedule-row:hover { background: #F0F4FF; }
    .time-badge { background: #F0F4FF; border-radius: 8px; font-size: .7rem; font-weight: 700; color: var(--navy); line-height:1.1; width: 52px; text-align:center; padding: 4px 0; }
    .time-badge.pm { color: #E07B00; background: #FFF3DC; }

    /* Quick actions */
    .qa-card { border-radius: 14px; border: 1px solid #e8eaf0; background: #fff; cursor:pointer; transition: box-shadow .15s; }
    .qa-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.08); }
    .qa-icon { width:42px; height:42px; border-radius:10px; display:grid; place-items:center; font-size:1.2rem; }
    .notice-card { background: #fff; border-radius: 14px; border: 1px solid #e8eaf0; }
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
      <div><h5 class="fw-bold mb-0">Home</h5><small class="text-muted">{{ now()->format('l, F j, Y') }}</small></div>
      <a href="{{ route('student.home') }}" class="btn btn-warning fw-semibold"><i class="bi bi-house me-1"></i> Back to Home</a>
    </div>

    <!-- Greeting -->
    <h3 class="fw-bold mb-0">Good morning, {{ $firstName }}! 👋</h3>
    <p class="text-muted mb-4">Here's your schedule for today</p>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
      @foreach ($stats as $s)
        <div class="col-md-4">
          <div class="stat-card p-4">
            <i class="bi {{ $s['icon'] }} fs-4 {{ $s['color'] }}"></i>
            <div class="fs-2 fw-bold mt-2">{{ $s['value'] }}</div>
            <div class="text-muted small">{{ $s['label'] }}</div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Next Class Banner -->
    @if (!empty($todaySchedules) && $todaySchedules->count() > 0)
      @php
        $nextClass = $todaySchedules->first(fn($s) => \Carbon\Carbon::parse($s->start_at)->greaterThan(now()));
      @endphp
      @if ($nextClass)
        <div class="next-banner p-4 mb-4">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <span class="fw-bold small" style="color:var(--navy);letter-spacing:.05em">NEXT CLASS</span>
            <span class="badge rounded-pill" style="background:var(--navy);padding:.5rem .9rem">Starts in {{ now()->diffInMinutes(\Carbon\Carbon::parse($nextClass->start_at)) }} min</span>
          </div>
          <h3 class="fw-bold mb-1" style="color:var(--navy)">{{ $nextClass->course_code ?? 'Course' }}</h3>
          <p class="mb-3" style="color:var(--navy);opacity:.75">{{ $nextClass->block_section ?? 'N/A' }} • {{ $nextClass->faculty_name ?? 'Faculty' }}</p>
          <div class="d-flex gap-3 mb-3 small" style="color:var(--navy)">
            <span><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($nextClass->start_at)->format('H:i A') }} – {{ \Carbon\Carbon::parse($nextClass->end_at ?? $nextClass->start_at)->format('H:i A') }}</span>
            <span><i class="bi bi-geo-alt me-1"></i>{{ $nextClass->classroom_name ?? 'Room TBA' }}</span>
          </div>
          <div class="d-flex gap-2">
            <button class="btn btn-view py-2 px-4">View Room Details</button>
            <button class="btn btn-nav py-2 px-4">Navigate</button>
          </div>
        </div>
      @endif
    @endif

    <!-- Schedule + Quick Actions -->
    <div class="row g-4">

      <!-- Today's Schedule -->
      <div class="col-lg-7">
        <div class="bg-white rounded-4 p-4 border">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Today's Schedule</h6>
            <a href="{{ route('student.studentSchedule') }}" class="small text-primary text-decoration-none">View Full Week</a>
          </div>
          @php($todayRows = collect($todaySchedules ?? []))
          @forelse ($todayRows as $row)
            <div class="schedule-row d-flex align-items-center gap-3 p-2 mb-2">
              <div class="time-badge {{ \Carbon\Carbon::parse($row->start_at)->greaterThan(now()) ? 'am' : 'pm' }}">
                {{ \Carbon\Carbon::parse($row->start_at)->format('H:i') }}<br>{{ \Carbon\Carbon::parse($row->start_at)->format('A') }}
              </div>
              <div class="flex-grow-1">
                <div class="fw-semibold small">
                  {{ $row->course_code ?? 'Course' }}
                  <span class="badge bg-light text-secondary ms-1">{{ $row->block_section ?? 'N/A' }}</span>
                  @if (\Carbon\Carbon::parse($row->start_at)->greaterThan(now()))
                    <span class="badge bg-warning text-dark ms-1">SOON</span>
                  @endif
                </div>
                <div class="text-muted" style="font-size:.75rem">
                  <i class="bi bi-person me-1"></i>{{ $row->faculty_name ?? 'Faculty' }}
                  <i class="bi bi-geo-alt ms-2 me-1"></i>{{ $row->classroom_name ?? 'Room TBA' }}
                </div>
              </div>
              <i class="bi bi-chevron-right text-muted"></i>
            </div>
          @empty
            <div class="p-3 text-center text-muted">
              <p>No classes scheduled for today</p>
            </div>
          @endforelse
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="col-lg-5">
        <h6 class="fw-bold mb-3">Quick Actions</h6>

        <a href="{{ route('student.checkingRoom') }}" class="qa-card p-3 mb-3 d-flex align-items-center gap-3" style="text-decoration: none; color: inherit;">
          <div class="qa-icon bg-light" style="color:var(--navy)"><i class="bi bi-building"></i></div>
          <div><div class="fw-semibold small">Find Available Rooms</div><div class="text-muted" style="font-size:.75rem">Search for vacant classrooms</div></div>
        </a>

        <a href="{{ route('student.studentSchedule') }}" class="qa-card p-3 mb-3 d-flex align-items-center gap-3" style="text-decoration: none; color: inherit;">
          <div class="qa-icon" style="background:#FFF3DC;color:var(--gold)"><i class="bi bi-calendar3"></i></div>
          <div><div class="fw-semibold small">Full Schedule</div><div class="text-muted" style="font-size:.75rem">View your weekly calendar</div></div>
        </a>

        <!-- Notice Card -->
        <div class="notice-card p-3">
          <div class="d-flex gap-2 align-items-start">
            <div class="qa-icon bg-light text-primary flex-shrink-0"><i class="bi bi-info-circle"></i></div>
            <div>
              <div class="fw-semibold small">Room Change Notice</div>
              <p class="text-muted mb-2" style="font-size:.78rem">Your Database Systems class has been moved from Lab 105 to Lab 203 due to maintenance. The schedule remains the same.</p>
              <a href="#" class="fw-semibold small text-dark text-decoration-none">View Details</a>
            </div>
          </div>
        </div>

      </div>
    </div><!-- /row -->
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>