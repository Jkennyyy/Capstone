@php
$studentName = optional($student)->name ?? 'Student';
$studentId = optional($student)->student_id ?? 'N/A';
$firstName = explode(' ', $studentName)[0];
$initials = collect(explode(' ', $studentName))->map(fn($word) => strtoupper($word[0]))->join('');
$nav = [
    ['icon' => 'bi-house', 'label' => 'Home', 'active' => false, 'route' => 'student.home'],
    ['icon' => 'bi-building', 'label' => 'Rooms', 'active' => true, 'route' => 'student.checkingRoom'],
    ['icon' => 'bi-calendar3', 'label' => 'Schedule', 'active' => false, 'route' => 'student.studentSchedule'],
    ['icon' => 'bi-clipboard-check', 'label' => 'Attendance', 'active' => false, 'route' => 'student.attendance'],
    ['icon' => 'bi-person', 'label' => 'Profile', 'active' => false, 'route' => 'student.profile'],
];
$availableRoomsCount = $classrooms->where('status', 'available')->count();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>SmartDoor – Rooms</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    :root{--gold:#F5A800;--navy:#1B2A5E;}
    body{background:#F4F6FA;font-family:'Segoe UI',sans-serif;}

    /* Sidebar */
    #sidebar{width:220px;min-height:100vh;background:#fff;border-right:1px solid #e8eaf0;}
    .brand-icon{background:var(--gold);border-radius:10px;width:40px;height:40px;display:grid;place-items:center;}
    .nav-link{color:#555;border-radius:8px;padding:.5rem 1rem;font-weight:500;}
    .nav-link:hover,.nav-link.active{background:#F0F4FF;color:var(--navy);}
    .nav-link.active::after{content:'';display:inline-block;width:7px;height:7px;background:var(--navy);border-radius:50%;margin-left:auto;}
    .avatar{width:36px;height:36px;background:var(--navy);border-radius:50%;display:grid;place-items:center;color:#fff;font-weight:700;font-size:.8rem;}

    /* Campus status banner */
    .campus-banner{background:linear-gradient(135deg,#1a8a3c,#22a84a);border-radius:16px;color:#fff;}
    .campus-icon{background:rgba(255,255,255,.2);border-radius:14px;width:60px;height:60px;display:grid;place-items:center;font-size:1.8rem;}

    /* Map */
    .map-wrap{background:#e8f5e9;border-radius:14px;border:1px solid #c8e6c9;position:relative;height:340px;overflow:hidden;}
    .map-grid{position:absolute;inset:0;background-image:linear-gradient(#c8e6c9 1px,transparent 1px),linear-gradient(90deg,#c8e6c9 1px,transparent 1px);background-size:60px 60px;}
    .map-circle{position:absolute;border-radius:50%;background:rgba(34,168,74,.15);}
    .building-pin{position:absolute;transform:translate(-50%,-50%);text-align:center;cursor:pointer;}
    .pin-btn{width:54px;height:54px;border-radius:14px;border:none;color:#fff;font-size:1.2rem;position:relative;display:grid;place-items:center;}
    .pin-btn .badge-count{position:absolute;top:-6px;right:-6px;width:20px;height:20px;border-radius:50%;font-size:.65rem;display:grid;place-items:center;font-weight:700;}
    .pin-label{font-size:.7rem;font-weight:600;color:#1B2A5E;margin-top:4px;white-space:nowrap;}
    .compass{position:absolute;top:12px;right:12px;background:#fff;border-radius:50%;width:30px;height:30px;display:grid;place-items:center;font-size:.75rem;font-weight:700;color:var(--navy);box-shadow:0 2px 6px rgba(0,0,0,.1);}
    .legend{position:absolute;bottom:14px;left:14px;background:#fff;border-radius:10px;padding:10px 14px;font-size:.72rem;box-shadow:0 2px 8px rgba(0,0,0,.1);}
    .legend-dot{width:10px;height:10px;border-radius:50%;display:inline-block;margin-right:6px;}

    /* Room cards */
    .room-card{border-radius:14px;border:1px solid #e8eaf0;background:#fff;}
    .amenity-tag{background:#F0F4FF;color:#555;border-radius:6px;font-size:.72rem;padding:3px 8px;}
    .btn-map{background:var(--navy);color:#fff;border-radius:10px;border:none;}
    .btn-map-gray{background:#F0F4FF;color:#aaa;border-radius:10px;border:none;}
  </style>
</head>
<body>
<div class="d-flex">

  <!-- Sidebar -->
  <nav id="sidebar" class="d-flex flex-column p-3 gap-1">
    <div class="d-flex align-items-center gap-2 mb-4 px-1">
      <div class="brand-icon"><i class="bi bi-building text-white fs-5"></i></div>
      <div><div class="fw-bold" style="color:var(--navy)">SmartDoor</div><small class="text-muted">Student Portal</small></div>
    </div>

    @foreach($nav as $n)
      <a href="{{ route($n['route']) }}" class="nav-link d-flex align-items-center gap-2 {{ $n['active'] ? 'active' : '' }}">
        <i class="bi {{ $n['icon'] }}"></i>{{ $n['label'] }}
      </a>
    @endforeach

    <div class="mt-auto pt-3 border-top">
      <div class="d-flex align-items-center gap-2 px-1">
        <div class="avatar">{{ $initials }}</div>
        <div><div class="fw-semibold small">{{ $studentName }}</div><div class="text-muted" style="font-size:.72rem">{{ $studentId }}</div></div>
      </div>
      <a href="#" class="nav-link text-danger mt-2"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </nav>

  <!-- Main -->
  <main class="flex-grow-1 p-4">

    <!-- Topbar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div><h5 class="fw-bold mb-0">Rooms</h5><small class="text-muted">Wednesday, May 6, 2026</small></div>
      <button class="btn btn-warning fw-semibold"><i class="bi bi-house me-1"></i>Back to Home</button>
    </div>

    <!-- Campus Status Banner -->
    <div class="campus-banner p-4 d-flex justify-content-between align-items-center mb-4">
      <div>
        <div class="small fw-bold opacity-75 mb-1" style="letter-spacing:.08em">CAMPUS STATUS</div>
        <h2 class="fw-bold mb-1">{{ $availableRoomsCount }} Rooms Available</h2>
        <div class="opacity-75 small">Out of {{ $classrooms->count() }} total classrooms</div>
      </div>
      <div class="campus-icon"><i class="bi bi-building"></i></div>
    </div>

    <!-- Search & Filters -->
    <div class="input-group mb-3">
      <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
      <input type="text" class="form-control border-start-0" placeholder="Search by room name or building...">
    </div>
    <div class="d-flex align-items-center gap-2 mb-4">
      <span class="text-muted small"><i class="bi bi-funnel me-1"></i>Filters:</span>
      <button class="btn btn-sm rounded-pill fw-semibold" style="background:var(--navy);color:#fff">All</button>
      <button class="btn btn-sm btn-outline-secondary rounded-pill">Available</button>
      <button class="btn btn-sm btn-outline-secondary rounded-pill">Occupied</button>
    </div>

    <!-- Campus Map -->
    <div class="bg-white rounded-4 border p-3 mb-4">
      <div class="d-flex align-items-center gap-2 mb-3">
        <div style="background:var(--navy);border-radius:8px;width:32px;height:32px;display:grid;place-items:center">
          <i class="bi bi-building text-white small"></i>
        </div>
        <div><div class="fw-bold small">Campus Map</div><div class="text-muted" style="font-size:.72rem">PSU Assingan Campus Layout</div></div>
      </div>

      <div class="map-wrap">
        <div class="map-grid"></div>
        <!-- decorative circles -->
        <div class="map-circle" style="width:90px;height:90px;top:5%;left:5%"></div>
        <div class="map-circle" style="width:70px;height:70px;top:15%;right:10%"></div>
        <div class="map-circle" style="width:80px;height:80px;bottom:10%;right:15%"></div>

        @php
          $buildings_list = $classrooms->groupBy('building')->map(function($rooms, $building) {
            return [
              'name' => $building,
              'available' => $rooms->where('status', 'available')->count(),
              'color' => $rooms->where('status', 'available')->count() > 0 ? 'success' : 'danger'
            ];
          })->values();
          
          $positions = [
            ['x' => '28%', 'y' => '22%'],
            ['x' => '58%', 'y' => '37%'],
            ['x' => '22%', 'y' => '57%'],
          ];
        @endphp

        @foreach ($buildings_list as $idx => $b)
          @php $pos = $positions[$idx] ?? ['x' => '50%', 'y' => '50%']; @endphp
          <div class="building-pin" data-left="{{ $pos['x'] }}" data-top="{{ $pos['y'] }}">
            <div class="pin-btn bg-{{ $b['color'] }}">
              <i class="bi bi-building"></i>
              <span class="badge-count bg-white text-{{ $b['color'] }}">{{ $b['available'] }}</span>
            </div>
            <div class="pin-label">{{ $b['name'] }}</div>
          </div>
        @endforeach

        <div class="compass">N</div>

        <!-- Legend -->
        <div class="legend">
          <div class="fw-bold mb-2" style="font-size:.72rem">LEGEND</div>
          <div class="mb-1"><span class="legend-dot bg-success"></span>Has Available Rooms</div>
          <div class="mb-1"><span class="legend-dot bg-danger"></span>All Rooms Occupied</div>
          <div><span class="legend-dot bg-warning"></span>Selected Room</div>
        </div>
      </div>
    </div>

    <!-- Room Cards -->
    <div class="mb-3 fw-semibold small text-muted">{{ $classrooms->count() ?? 0 }} rooms found</div>
    <div class="row g-3">
      @forelse ($classrooms ?? [] as $room)
        <div class="col-md-6">
          <div class="room-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <h6 class="fw-bold mb-0">{{ $room->name ?? 'Room' }}</h6>
              @if ($room->status === 'available')
                <span class="badge text-success" style="background:#e6f9ee;font-size:.72rem"><i class="bi bi-check-circle me-1"></i>AVAILABLE</span>
              @else
                <span class="badge text-danger" style="background:#fdecea;font-size:.72rem"><i class="bi bi-x-circle me-1"></i>OCCUPIED</span>
              @endif
            </div>
            <div class="text-muted small mb-3"><i class="bi bi-geo-alt me-1"></i>{{ $room->building ?? 'Building' }} • {{ $room->floor ?? 'Floor' }}</div>

            <div class="d-flex gap-3 small mb-3">
              <span><i class="bi bi-people me-1 text-muted"></i>{{ $room->capacity ?? 0 }} seats</span>
              <span class="text-muted"><i class="bi bi-info-circle me-1"></i>Details</span>
            </div>

            <div class="text-uppercase fw-semibold mb-2" style="font-size:.65rem;letter-spacing:.08em;color:#aaa">Amenities</div>
            <div class="d-flex flex-wrap gap-1 mb-3">
              <span class="amenity-tag">Standard</span>
              <span class="amenity-tag">WiFi</span>
            </div>

            <button class="btn w-100 py-2 {{ $room->status === 'available' ? 'btn-map' : 'btn-map-gray' }}">
              <i class="bi bi-geo-alt me-1"></i>Show on Map
            </button>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-info">No classrooms available</div>
        </div>
      @endforelse
    </div>

  </main>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.building-pin').forEach(function(pin) {
      var left = pin.dataset.left || '50%';
      var top = pin.dataset.top || '50%';
      pin.style.left = left;
      pin.style.top = top;
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>