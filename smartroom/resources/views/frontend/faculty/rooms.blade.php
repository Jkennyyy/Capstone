<?php
// SmartDoor Faculty Portal - Room Availability Page

$rooms = [
    ['id' => 101, 'name' => 'Room 101',  'building' => 'IT Building',          'floor' => '1st Floor', 'seats' => 40, 'status' => 'occupied',  'time_info' => 'Free at 10:30 AM', 'amenities' => ['Projector', 'AC', 'WiFi']],
    ['id' => 205, 'name' => 'Room 205',  'building' => 'IT Building',          'floor' => '2nd Floor', 'seats' => 35, 'status' => 'available', 'time_info' => 'Until 01:00 PM',  'amenities' => ['Projector', 'AC', 'WiFi', 'Whiteboard']],
    ['id' => 105, 'name' => 'Lab 105',   'building' => 'IT Building',          'floor' => '1st Floor', 'seats' => 30, 'status' => 'available', 'time_info' => 'Until 10:30 AM',  'amenities' => ['Computers', 'AC', 'WiFi', 'Projector']],
    ['id' => 302, 'name' => 'Room 302',  'building' => 'Engineering Building', 'floor' => '3rd Floor', 'seats' => 45, 'status' => 'occupied',  'time_info' => 'Free at 12:00 PM', 'amenities' => ['Projector', 'AC', 'Sound System']],
    ['id' => 201, 'name' => 'Room 201',  'building' => 'Admin Building',       'floor' => '2nd Floor', 'seats' => 50, 'status' => 'available', 'time_info' => 'Until 02:00 PM',  'amenities' => ['Projector', 'AC', 'WiFi', 'Sound System']],
    ['id' => 203, 'name' => 'Lab 203',   'building' => 'IT Building',          'floor' => '2nd Floor', 'seats' => 30, 'status' => 'available', 'time_info' => 'Until 03:00 PM',  'amenities' => ['Computers', 'AC', 'WiFi']],
];

$filter = $_GET['filter'] ?? 'all';
$search = $_GET['search'] ?? '';

$filtered_rooms = array_filter($rooms, function($room) use ($filter, $search) {
    $match_filter = $filter === 'all' || $room['status'] === $filter;
    $match_search = empty($search) ||
        stripos($room['name'], $search) !== false ||
        stripos($room['building'], $search) !== false;
    return $match_filter && $match_search;
});

$available_count = count(array_filter($rooms, fn($r) => $r['status'] === 'available'));
$total_count     = count($rooms);

function amenity_icon($amenity) {
    $icons = [
        'Projector'    => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="10" rx="2"/><circle cx="12" cy="12" r="2"/></svg>',
        'AC'           => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20M4.93 4.93l14.14 14.14M19.07 4.93L4.93 19.07"/></svg>',
        'WiFi'         => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg>',
        'Whiteboard'   => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="1"/><path d="M8 21h8M12 17v4"/></svg>',
        'Computers'    => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>',
        'Sound System' => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>',
    ];
    return $icons[$amenity] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Room Availability – SmartDoor</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* ── RESET ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --yellow:       #f5c518;
  --navy:         #0b1640;
  --navy-mid:     #1a2f80;
  --navy-light:   #e8ecfb;
  --white:        #ffffff;
  --bg:           #f0f2f8;
  --border:       #e4e8f0;
  --text:         #0f1729;
  --text-2:       #3d4a5c;
  --text-3:       #7c8a9e;
  --text-4:       #b0bac8;
  --green:        #0f9d58;
  --green-mid:    #12b564;
  --green-bg:     #e6f9f0;
  --green-border: #a7e9c8;
  --green-text:   #0a7a43;
  --blue-bg:      #eaf0fd;
  --blue-border:  #93b8f8;
  --blue-text:    #1740b0;
  --red:          #dc2626;
  --red-bg:       #fef2f2;
  --shadow-xs: 0 1px 2px rgba(15,23,41,.05);
  --shadow-sm: 0 2px 6px rgba(15,23,41,.06),0 1px 2px rgba(15,23,41,.04);
  --shadow-md: 0 4px 16px rgba(15,23,41,.08),0 1px 4px rgba(15,23,41,.04);
  --radius-xs: 6px;
  --radius-sm: 10px;
  --radius:    14px;
  --radius-lg: 18px;
  --sidebar-w: 230px;
  --font-head: 'Plus Jakarta Sans', sans-serif;
  --font-body: 'DM Sans', sans-serif;
}

body {
  font-family: var(--font-body);
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  display: flex;
  -webkit-font-smoothing: antialiased;
}

/* ══════════════════════════════════════════════
   SIDEBAR  (from dashboard.php — unchanged)
══════════════════════════════════════════════ */
.sidebar {
  position: fixed; left: 0; top: 0;
  width: var(--sidebar-w); height: 100vh;
  background: var(--navy);
  display: flex; flex-direction: column;
  overflow: hidden; z-index: 100;
}
.sidebar::before {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(160deg,rgba(245,197,24,.06) 0%,transparent 55%);
  pointer-events: none;
}
.sidebar::after {
  content: ''; position: absolute; bottom: -60px; right: -60px;
  width: 180px; height: 180px; border-radius: 50%;
  border: 1px solid rgba(245,197,24,.08); pointer-events: none;
}
.sidebar-logo {
  display: flex; align-items: center; gap: 12px;
  padding: 28px 20px 24px 24px; text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,.06); margin-bottom: 8px;
}
.logo-mark {
  width: 40px; height: 40px; background: var(--yellow); border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem; color: var(--navy); flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(245,197,24,.4);
}
.logo-text .brand-psu {
  font-size: .6rem; font-weight: 600; letter-spacing: .18em;
  color: rgba(255,255,255,.45); text-transform: uppercase; display: block; margin-bottom: 3px;
}
.logo-text .brand-main { font-size: 1.05rem; font-weight: 700; color: #fff; letter-spacing: -.01em; }
.logo-text .brand-main span { color: var(--yellow); }
.nav-section-label {
  font-size: .68rem; font-weight: 700; letter-spacing: .12em;
  text-transform: uppercase; color: rgba(255,255,255,.25); padding: 16px 24px 6px;
}
.sidebar-nav { list-style: none; overflow-y: auto; padding: 0 12px; }
.sidebar-nav::-webkit-scrollbar { width: 0; }
.sidebar-nav li { margin-bottom: 2px; }
.sidebar-nav a {
  display: flex; align-items: center; gap: 11px; padding: 11px 12px;
  text-decoration: none; color: rgba(255,255,255,.6); font-size: .88rem; font-weight: 500;
  border-radius: var(--radius-sm); transition: all .22s cubic-bezier(.4,0,.2,1);
  position: relative; overflow: hidden;
}
.sidebar-nav a .nav-icon {
  width: 32px; height: 32px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: .85rem; background: rgba(255,255,255,.05); flex-shrink: 0; transition: all .22s;
}
.sidebar-nav a:hover { color: rgba(255,255,255,.9); background: rgba(255,255,255,.06); }
.sidebar-nav a:hover .nav-icon { background: rgba(255,255,255,.1); }
.sidebar-nav a.active { background: rgba(245,197,24,.14); color: var(--yellow); }
.sidebar-nav a.active .nav-icon { background: rgba(245,197,24,.2); color: var(--yellow); }
.sidebar-nav a.active::before {
  content: ''; position: absolute; left: 0; top: 20%; bottom: 20%;
  width: 3px; background: var(--yellow); border-radius: 0 2px 2px 0;
}
.sidebar-footer {
  margin-top: auto; padding: 16px 12px 24px;
  border-top: 1px solid rgba(255,255,255,.06);
}
.user-widget {
  display: flex; align-items: center; gap: 10px; padding: 10px 12px;
  border-radius: var(--radius-sm); background: rgba(255,255,255,.05); margin-bottom: 8px;
}
.user-avatar {
  width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
  background: var(--navy-mid); border: 2px solid rgba(245,197,24,.4);
  display: flex; align-items: center; justify-content: center;
  font-size: .78rem; font-weight: 700; color: var(--yellow);
}
.user-widget-name { font-size: .83rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.user-widget-role { font-size: .73rem; color: rgba(255,255,255,.4); }
.sidebar-logout-btn {
  display: flex; align-items: center; gap: 10px; padding: 9px 12px;
  color: rgba(255,255,255,.4); font-size: .84rem; font-weight: 500;
  border-radius: var(--radius-sm); transition: all .22s; width: 100%;
  background: none; border: none; cursor: pointer; font-family: inherit;
}
.sidebar-logout-btn:hover { color: #f87171; background: rgba(244,63,94,.08); }

/* ══════════════════════════════════════════════
   MAIN LAYOUT
══════════════════════════════════════════════ */
.main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

/* ── TOPBAR ── */
.topbar {
  background: var(--white); border-bottom: 1px solid var(--border);
  padding: 0 36px; height: 64px;
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  position: sticky; top: 0; z-index: 50; box-shadow: 0 1px 0 var(--border);
}
.topbar-search {
  display: flex; align-items: center; gap: 10px;
  background: var(--bg); border: 1.5px solid var(--border);
  border-radius: 24px; padding: 8px 18px; width: 340px;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.topbar-search:focus-within { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
.topbar-search i { color: var(--text-4); font-size: .9rem; }
.topbar-search input {
  border: none; outline: none; background: transparent;
  font-size: .9rem; font-family: var(--font-body); color: var(--text); width: 100%;
}
.topbar-search input::placeholder { color: var(--text-4); }
.topbar-right { display: flex; align-items: center; gap: 20px; }
.notif-btn {
  position: relative; background: none; border: none;
  cursor: pointer; color: var(--text-2); font-size: 1.2rem;
  padding: 6px; border-radius: 8px; transition: background 0.2s;
}
.notif-btn:hover { background: var(--bg); }
.notif-badge {
  position: absolute; top: 4px; right: 4px;
  width: 8px; height: 8px; background: var(--red);
  border-radius: 50%; border: 1.5px solid var(--white);
}
.topbar-profile { display: flex; align-items: center; gap: 12px; cursor: pointer; }
.topbar-profile-info { text-align: right; }
.topbar-profile-name { font-size: .88rem; font-weight: 700; color: var(--text); line-height: 1.2; }
.topbar-profile-role { font-size: .78rem; color: var(--text-3); }
.topbar-profile img {
  width: 40px; height: 40px; border-radius: 50%; object-fit: cover;
  border: 2px solid var(--border); box-shadow: var(--shadow-xs);
}

/* ── CONTENT ── */
.content { padding: 28px 36px 52px; display: flex; flex-direction: column; gap: 22px; }

/* ── STATUS BANNER ── */
.status-banner {
  background: linear-gradient(120deg,#0f9d58 0%,#0a7a43 100%);
  border-radius: var(--radius-lg); padding: 26px 30px;
  display: flex; align-items: center; justify-content: space-between;
  position: relative; overflow: hidden;
  box-shadow: 0 4px 24px rgba(15,157,88,.25);
}
.status-banner::before {
  content: ''; position: absolute; top: -40px; right: 120px;
  width: 200px; height: 200px; border-radius: 50%;
  background: rgba(255,255,255,.07); pointer-events: none;
}
.status-banner::after {
  content: ''; position: absolute; bottom: -50px; right: -20px;
  width: 160px; height: 160px; border-radius: 50%;
  background: rgba(0,0,0,.1); pointer-events: none;
}
.status-label { font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: rgba(255,255,255,.8); margin-bottom: 4px; }
.status-title { font-family: var(--font-head); font-size: 2rem; font-weight: 800; color: #fff; line-height: 1.1; }
.status-sub   { font-size: .86rem; color: rgba(255,255,255,.7); margin-top: 4px; }
.status-icon-wrap {
  width: 60px; height: 60px; border-radius: 16px;
  background: rgba(255,255,255,.2);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.6rem; color: #fff; position: relative; z-index: 1;
}

/* ── SEARCH + FILTER ── */
.search-filter-row { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
.search-wrap { flex: 1; position: relative; min-width: 220px; }
.search-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-3); font-size: .8rem; pointer-events: none; }
.search-wrap input {
  width: 100%; padding: 11px 16px 11px 40px;
  border: 1.5px solid var(--border); border-radius: var(--radius-sm);
  background: var(--white); font-size: .88rem; font-family: var(--font-body);
  color: var(--text); outline: none; transition: border .15s, box-shadow .15s;
}
.search-wrap input:focus { border-color: var(--blue-border); box-shadow: 0 0 0 3px rgba(30,58,138,.08); }
.search-wrap input::placeholder { color: var(--text-4); }
.filter-group {
  display: flex; align-items: center; gap: 6px;
  background: var(--white); border: 1.5px solid var(--border);
  border-radius: var(--radius-sm); padding: 6px 10px;
}
.filter-group-label { font-size: .78rem; color: var(--text-3); font-weight: 600; margin-right: 4px; }
.filter-btn {
  padding: 5px 14px; border-radius: 20px;
  font-size: .78rem; font-weight: 600; font-family: var(--font-body);
  border: none; cursor: pointer; background: transparent;
  color: var(--text-3); text-decoration: none; transition: background .15s, color .15s;
}
.filter-btn:hover { background: var(--bg); color: var(--text); }
.filter-btn.active { background: var(--navy); color: #fff; }

/* ── PANEL (campus map) ── */
.panel { background: var(--white); border: 1.5px solid var(--border); border-radius: var(--radius); box-shadow: var(--shadow-sm); overflow: hidden; }
.panel-header { display: flex; align-items: center; gap: 10px; padding: 18px 22px 14px; border-bottom: 1px solid var(--border); }
.panel-header-icon { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: .8rem; background: var(--navy-light); color: var(--navy-mid); }
.panel-header h2 { font-family: var(--font-head); font-size: .92rem; font-weight: 700; color: var(--text); }
.panel-header p  { font-size: .75rem; color: var(--text-3); margin-top: 1px; }

.map-area {
  display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: 1fr 1fr;
  gap: 2px; background: #d4e6d4; min-height: 260px; position: relative;
}
.map-cell { background: #edf5ed; display: flex; align-items: center; justify-content: center; min-height: 110px; position: relative; }
.building-pin { display: flex; flex-direction: column; align-items: center; gap: 5px; z-index: 2; }
.pin-box {
  width: 54px; height: 54px; border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.3rem; color: #fff; position: relative;
  box-shadow: 0 4px 14px rgba(0,0,0,.18);
}
.pin-box.green { background: var(--green-mid); }
.pin-box.red   { background: var(--red); }
.pin-badge {
  position: absolute; top: -7px; right: -7px;
  width: 20px; height: 20px; background: #fff; border: 2px solid;
  border-radius: 50%; font-size: 9px; font-weight: 800;
  display: flex; align-items: center; justify-content: center;
}
.pin-badge.green { border-color: var(--green-mid); color: var(--green-text); }
.pin-badge.red   { border-color: var(--red); color: var(--red); }
.building-label { font-size: 11px; font-weight: 700; color: var(--text); text-align: center; }
.map-compass {
  position: absolute; top: 12px; right: 12px; width: 28px; height: 28px;
  background: #fff; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 11px; font-weight: 800; color: var(--navy);
  box-shadow: 0 1px 4px rgba(0,0,0,.1); z-index: 5;
}
.map-legend {
  position: absolute; bottom: 12px; left: 12px;
  background: #fff; border-radius: var(--radius-sm); padding: 10px 14px;
  box-shadow: var(--shadow-sm); z-index: 5; font-size: 11px;
}
.legend-item { display: flex; align-items: center; gap: 7px; padding: 2px 0; font-weight: 500; color: var(--text); }
.legend-dot  { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

/* ── ROOM CARDS ── */
.rooms-count { font-size: .82rem; color: var(--text-3); font-weight: 500; }
.rooms-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.room-card {
  background: var(--white); border: 1.5px solid var(--border);
  border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow-sm);
  transition: transform .18s, box-shadow .18s;
}
.room-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
.card-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 5px; }
.room-name { font-family: var(--font-head); font-size: 1rem; font-weight: 800; color: var(--text); }
.status-badge {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: .68rem; font-weight: 700; padding: 3px 10px; border-radius: 20px; white-space: nowrap;
}
.badge-available { background: var(--green-bg);  color: var(--green-text); border: 1px solid var(--green-border); }
.badge-occupied  { background: var(--red-bg);    color: var(--red);        border: 1px solid #fca5a5; }
.room-location { display: flex; align-items: center; gap: 5px; font-size: .75rem; color: var(--text-3); margin-bottom: 12px; }
.room-location i { font-size: .65rem; color: var(--text-4); }
.room-meta { display: flex; align-items: center; gap: 16px; margin-bottom: 14px; }
.meta-item { display: flex; align-items: center; gap: 5px; font-size: .78rem; color: var(--text-3); }
.meta-item i { font-size: .68rem; color: var(--text-4); }
.time-available { color: var(--green-text) !important; font-weight: 600; }
.time-occupied  { color: var(--red) !important; font-weight: 600; }
.amenities-label { font-size: .68rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--text-4); margin-bottom: 6px; }
.amenities-list  { display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 14px; }
.amenity-tag {
  display: inline-flex; align-items: center; gap: 4px;
  background: var(--bg); border: 1px solid var(--border);
  border-radius: var(--radius-xs); padding: 3px 9px;
  font-size: .72rem; color: var(--text-3); font-weight: 500;
}
.btn-show-map {
  width: 100%; padding: 10px; border-radius: var(--radius-sm);
  font-size: .82rem; font-weight: 600; font-family: var(--font-body);
  border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center; gap: 7px;
  transition: background .15s, transform .15s;
}
.btn-show-map.active-map  { background: var(--navy); color: #fff; box-shadow: 0 2px 8px rgba(11,22,64,.25); }
.btn-show-map.active-map:hover { background: var(--navy-mid); transform: translateY(-1px); }
.btn-show-map.disabled-map { background: var(--bg); color: var(--text-4); cursor: default; }

/* ── ANIMATIONS ── */
@keyframes fadeUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
.status-banner     { animation: fadeUp .4s both .04s; }
.search-filter-row { animation: fadeUp .4s both .10s; }
.panel             { animation: fadeUp .4s both .16s; }
.rooms-grid        { animation: fadeUp .4s both .22s; }

/* ── RESPONSIVE ── */
@media (max-width: 1280px) { .rooms-grid { grid-template-columns: 1fr; } .content { padding: 22px 20px 40px; } .topbar { padding: 0 20px; } }
@media (max-width: 768px)  { :root { --sidebar-w: 0px; } .sidebar { display: none; } }
</style>
</head>
<body>

<!-- ═══════════════════════════════════════════
     SIDEBAR — DO NOT CHANGE
═══════════════════════════════════════════ -->
<div class="sidebar">
  <a href="<?= htmlspecialchars(url('/dashboard')) ?>" class="sidebar-logo">
    <div class="logo-mark"><i class="fas fa-door-open"></i></div>
    <div class="logo-text">
      <span class="brand-psu">PSU</span>
      <span class="brand-main">Smart<span>Door</span></span>
    </div>
  </a>

  <span class="nav-section-label">Main Menu</span>
  <ul class="sidebar-nav">
    <li>
      <a href="{{ url('/faculty_dashboard') }}"
         class="{{ Request::is('faculty_dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
        Dashboard
      </a>
    </li>
    <li>
      <a href="{{ url('/rooms') }}"
         class="{{ Request::is('rooms*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-door-open"></i></span>
        Room
      </a>
    </li>
    <li>
      <a href="{{ url('/faculty-schedule') }}"
         class="{{ Request::is('faculty-schedule') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-clock"></i></span>
        Schedule
      </a>
    </li>
    <li>
      <a href="{{ url('/profile') }}"
         class="{{ Request::is('profile*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-user"></i></span>
        Profile
      </a>
    </li>
  </ul>

  <span class="nav-section-label">Tools</span>
  <ul class="sidebar-nav">
    <li>
      <a href="{{ url('/ai-recommendations') }}"
         class="{{ Request::is('ai-recommendations') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-robot"></i></span>
        AI Recommendations
      </a>
    </li>
    <li>
      <a href="#" class="{{ Request::is('reports*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
        Reports
      </a>
    </li>
  </ul>

  <div class="sidebar-footer">
    <div class="user-widget">
      <div class="user-avatar">ES</div>
      <div class="user-widget-info">
        <div class="user-widget-name">Prof. Elena Santos</div>
        <div class="user-widget-role">Faculty of IT</div>
      </div>
    </div>
    <form method="POST" action="<?= htmlspecialchars(url('/logout')) ?>">
      <?php csrf_field(); ?>
      <button type="submit" class="sidebar-logout-btn">
        <i class="fas fa-arrow-right-from-bracket"></i>
        Sign Out
      </button>
    </form>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     MAIN
═══════════════════════════════════════════ -->
<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="topbar-search">
      <i class="fas fa-search"></i>
      <input type="text" placeholder="Search for classrooms, faculty, or subjects...">
    </div>
    <div class="topbar-right">
      <button class="notif-btn" title="Notifications">
        <i class="fas fa-bell"></i>
        <span class="notif-badge"></span>
      </button>
      <div class="topbar-profile">
        <div class="topbar-profile-info">
          <div class="topbar-profile-name">Prof. Elena Santos</div>
          <div class="topbar-profile-role">Faculty of IT</div>
        </div>
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Prof. Elena Santos">
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- Status Banner -->
    <div class="status-banner">
      <div style="position:relative;z-index:1;">
        <div class="status-label">Campus Status</div>
        <div class="status-title"><?= $available_count ?> Rooms Available</div>
        <div class="status-sub">Out of <?= $total_count ?> total classrooms · Updated just now</div>
      </div>
      <div class="status-icon-wrap"><i class="fas fa-door-open"></i></div>
    </div>

    <!-- Search + Filter -->
    <form method="GET" action="">
      <div class="search-filter-row">
        <div class="search-wrap">
          <i class="fas fa-magnifying-glass"></i>
          <input type="text" name="search" placeholder="Search by room name or building…"
                 value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="filter-group">
          <span class="filter-group-label"><i class="fas fa-filter"></i> Filter:</span>
          <a href="?filter=all&search=<?= urlencode($search) ?>"       class="filter-btn <?= $filter==='all'       ? 'active':'' ?>">All</a>
          <a href="?filter=available&search=<?= urlencode($search) ?>" class="filter-btn <?= $filter==='available' ? 'active':'' ?>">Available</a>
          <a href="?filter=occupied&search=<?= urlencode($search) ?>"  class="filter-btn <?= $filter==='occupied'  ? 'active':'' ?>">Occupied</a>
        </div>
      </div>
    </form>

    <!-- Campus Map -->
    <div class="panel">
      <div class="panel-header">
        <div class="panel-header-icon"><i class="fas fa-map"></i></div>
        <div>
          <h2>Campus Map</h2>
          <p>PSU Assingan Campus Layout</p>
        </div>
      </div>
      <div class="map-area">
        <div class="map-cell">
          <div class="building-pin">
            <div class="pin-box green"><i class="fas fa-building"></i><div class="pin-badge green">3</div></div>
            <span class="building-label">IT Building</span>
          </div>
        </div>
        <div class="map-cell">
          <div class="building-pin">
            <div class="pin-box red"><i class="fas fa-building"></i><div class="pin-badge red">0</div></div>
            <span class="building-label">Engineering Building</span>
          </div>
        </div>
        <div class="map-cell">
          <div class="building-pin">
            <div class="pin-box green"><i class="fas fa-building-columns"></i><div class="pin-badge green">1</div></div>
            <span class="building-label">Admin Building</span>
          </div>
        </div>
        <div class="map-cell"></div>
        <div class="map-compass">N</div>
        <div class="map-legend">
          <div class="legend-item"><div class="legend-dot" style="background:#12b564;"></div> Has Available Rooms</div>
          <div class="legend-item"><div class="legend-dot" style="background:#dc2626;"></div> All Rooms Occupied</div>
          <div class="legend-item"><div class="legend-dot" style="background:#f5c518;"></div> Selected Room</div>
        </div>
      </div>
    </div>

    <!-- Rooms count + grid -->
    <div class="rooms-count"><?= count($filtered_rooms) ?> rooms found</div>

    <div class="rooms-grid">
      <?php foreach ($filtered_rooms as $room):
        $isAvail    = $room['status'] === 'available';
        $badgeClass = $isAvail ? 'badge-available' : 'badge-occupied';
        $badgeIcon  = $isAvail ? 'fas fa-circle-check' : 'fas fa-circle-xmark';
        $badgeLabel = $isAvail ? 'Available' : 'Occupied';
        $timeClass  = $isAvail ? 'time-available' : 'time-occupied';
      ?>
      <div class="room-card">
        <div class="card-top">
          <div class="room-name"><?= htmlspecialchars($room['name']) ?></div>
          <span class="status-badge <?= $badgeClass ?>">
            <i class="<?= $badgeIcon ?>"></i> <?= $badgeLabel ?>
          </span>
        </div>
        <div class="room-location">
          <i class="fas fa-location-dot"></i>
          <?= htmlspecialchars($room['building']) ?> &bull; <?= htmlspecialchars($room['floor']) ?>
        </div>
        <div class="room-meta">
          <div class="meta-item"><i class="fas fa-users"></i> <?= $room['seats'] ?> seats</div>
          <div class="meta-item <?= $timeClass ?>"><i class="fas fa-clock"></i> <?= htmlspecialchars($room['time_info']) ?></div>
        </div>
        <div class="amenities-label">Amenities</div>
        <div class="amenities-list">
          <?php foreach ($room['amenities'] as $amenity): ?>
          <span class="amenity-tag"><?= amenity_icon($amenity) ?> <?= htmlspecialchars($amenity) ?></span>
          <?php endforeach; ?>
        </div>
        <button class="btn-show-map <?= $isAvail ? 'active-map' : 'disabled-map' ?>">
          <i class="fas fa-location-dot"></i> Show on Map
        </button>
      </div>
      <?php endforeach; ?>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

</body>
</html>