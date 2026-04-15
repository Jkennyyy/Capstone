<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Classrooms – SmartDoor</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* ── RESET & BASE ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --yellow:        #f5c518;
  --yellow-bg:     #fff8e1;
  --navy:          #0b1640;
  --navy-mid:      #1a2f80;
  --white:         #ffffff;
  --bg:            #f4f6f9;
  --border:        #e8ecf3;
  --text:          #111827;
  --text-secondary:#6b7280;
  --text-light:    #9ca3af;
  --green:         #16a34a;
  --green-bg:      #dcfce7;
  --green-border:  #86efac;
  --blue-bg:       #dbeafe;
  --blue-border:   #93c5fd;
  --blue-text:     #1d4ed8;
  --orange-bg:     #ffedd5;
  --orange-border: #fdba74;
  --orange-text:   #c2410c;
  --red:           #dc2626;
  --red-bg:        #fee2e2;
  --red-border:    #fca5a5;
  --shadow:        0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
  --shadow-card:   0 2px 8px rgba(0,0,0,0.06);
  --radius:        14px;
  --radius-sm:     10px;
  --sidebar-w:     240px;
}

body {
  font-family: 'Inter', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  display: flex;
}

/* ══════════════════════════════════════════════
   SIDEBAR — EXACT COPY FROM DASHBOARD
══════════════════════════════════════════════ */
.sidebar {
  position: fixed; left: 0; top: 0;
  width: var(--sidebar-w); height: 100vh;
  background: var(--navy);
  display: flex; flex-direction: column;
  padding: 0; overflow: hidden; z-index: 100;
}
.sidebar::before {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(160deg, rgba(245,197,24,0.06) 0%, transparent 55%);
  pointer-events: none;
}
.sidebar::after {
  content: ''; position: absolute;
  bottom: -60px; right: -60px;
  width: 180px; height: 180px; border-radius: 50%;
  border: 1px solid rgba(245,197,24,0.08); pointer-events: none;
}
.sidebar-logo {
  display: flex; align-items: center; gap: 12px;
  padding: 28px 20px 24px 24px;
  text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,0.06);
  margin-bottom: 8px;
}
.logo-mark {
  width: 40px; height: 40px; background: var(--yellow);
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem; color: var(--navy); flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(245,197,24,0.4);
}
.logo-text { line-height: 1; }
.logo-text .brand-psu {
  font-size: 0.6rem; font-weight: 600; letter-spacing: 0.18em;
  color: rgba(255,255,255,0.45); text-transform: uppercase;
  display: block; margin-bottom: 3px;
}
.logo-text .brand-main {
  font-size: 1.05rem; font-weight: 700; color: #fff; letter-spacing: -0.01em;
}
.logo-text .brand-main span { color: var(--yellow); }

.nav-section-label {
  font-size: 0.68rem; font-weight: 700; letter-spacing: 0.12em;
  text-transform: uppercase; color: rgba(255,255,255,0.25);
  padding: 16px 24px 6px;
}
.sidebar-nav { list-style: none; overflow-y: auto; padding: 0 12px; }
.sidebar-nav::-webkit-scrollbar { width: 0; }
.sidebar-nav li { margin-bottom: 2px; }
.sidebar-nav a {
  display: flex; align-items: center; gap: 11px;
  padding: 11px 12px; text-decoration: none;
  color: rgba(255,255,255,0.6); font-size: 0.88rem; font-weight: 500;
  border-radius: var(--radius-sm);
  transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
  position: relative; overflow: hidden;
}
.sidebar-nav a .nav-icon {
  width: 32px; height: 32px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.85rem; background: rgba(255,255,255,0.05);
  flex-shrink: 0; transition: all 0.22s;
}
.sidebar-nav a:hover { color: rgba(255,255,255,0.9); background: rgba(255,255,255,0.06); }
.sidebar-nav a:hover .nav-icon { background: rgba(255,255,255,0.1); }
.sidebar-nav a.active { background: rgba(245,197,24,0.14); color: var(--yellow); }
.sidebar-nav a.active .nav-icon { background: rgba(245,197,24,0.2); color: var(--yellow); }
.sidebar-nav a.active::before {
  content: ''; position: absolute;
  left: 0; top: 20%; bottom: 20%;
  width: 3px; background: var(--yellow);
  border-radius: 0 2px 2px 0;
}
.sidebar-footer {
  margin-top: auto; padding: 16px 12px 24px;
  border-top: 1px solid rgba(255,255,255,0.06);
}
.user-widget {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 12px; border-radius: var(--radius-sm);
  background: rgba(255,255,255,0.05); margin-bottom: 8px;
}
.user-widget img {
  width: 34px; height: 34px; border-radius: 50%; object-fit: cover;
  border: 2px solid rgba(245,197,24,0.4);
}
.user-widget-info { flex: 1; min-width: 0; }
.user-widget-name {
  font-size: 0.83rem; font-weight: 600; color: #fff;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.user-widget-role { font-size: 0.73rem; color: rgba(255,255,255,0.4); }
.sidebar-logout-btn {
  display: flex; align-items: center; gap: 10px;
  padding: 9px 12px; color: rgba(255,255,255,0.4);
  font-size: 0.84rem; font-weight: 500; border-radius: var(--radius-sm);
  transition: all 0.22s; width: 100%;
  background: none; border: none; cursor: pointer; font-family: inherit;
  text-decoration: none;
}
.sidebar-logout-btn:hover { color: #f87171; background: rgba(244,63,94,0.08); }

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
.topbar-search i { color: var(--text-light); font-size: 0.9rem; }
.topbar-search input { border: none; outline: none; background: transparent; font-size: 0.9rem; font-family: 'Inter', sans-serif; color: var(--text); width: 100%; }
.topbar-search input::placeholder { color: var(--text-light); }
.topbar-right { display: flex; align-items: center; gap: 20px; }
.notif-btn { position: relative; background: none; border: none; cursor: pointer; color: var(--text-secondary); font-size: 1.2rem; padding: 6px; border-radius: 8px; transition: background 0.2s; }
.notif-btn:hover { background: var(--bg); }
.notif-badge { position: absolute; top: 4px; right: 4px; width: 8px; height: 8px; background: var(--red); border-radius: 50%; border: 1.5px solid var(--white); }
.topbar-profile { display: flex; align-items: center; gap: 12px; cursor: pointer; }
.topbar-profile-info { text-align: right; }
.topbar-profile-name { font-size: 0.88rem; font-weight: 700; color: var(--text); line-height: 1.2; }
.topbar-profile-role { font-size: 0.78rem; color: var(--text-secondary); }
.topbar-profile img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border); box-shadow: var(--shadow); }

/* ── PAGE CONTENT ── */
.content { padding: 32px 36px 48px; display: flex; flex-direction: column; gap: 24px; }

/* ── PAGE HEADER ── */
.page-header {
  display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;
  animation: fadeSlideUp 0.4s both 0.04s;
}
.page-header-left h1 { font-size: 1.55rem; font-weight: 800; color: var(--text); letter-spacing: -0.02em; margin-bottom: 4px; }
.page-header-left p { font-size: 0.92rem; color: var(--text-secondary); }

/* ── STATS STRIP ── */
.stats-strip {
  display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;
  animation: fadeSlideUp 0.4s both 0.1s;
}
.manage-box {
  background: var(--white); border: 1.5px solid var(--border); border-radius: var(--radius);
  box-shadow: var(--shadow-card); overflow: hidden; animation: fadeSlideUp 0.4s both 0.13s;
}
.manage-head {
  padding: 14px 18px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;
}
.manage-title { font-size: 0.92rem; font-weight: 700; color: var(--text); }
.manage-table { width: 100%; border-collapse: collapse; }
.manage-table th, .manage-table td { padding: 10px 14px; font-size: 0.8rem; text-align: left; border-bottom: 1px solid var(--border); }
.manage-table th { color: var(--text-secondary); font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; }
.manage-table tr:last-child td { border-bottom: none; }
.manage-link { color: #1d4ed8; font-weight: 700; text-decoration: none; }
.manage-link:hover { text-decoration: underline; }
.stat-mini {
  background: var(--white); border-radius: var(--radius); border: 1.5px solid var(--border);
  padding: 18px 20px; box-shadow: var(--shadow-card);
  display: flex; align-items: center; gap: 14px;
  transition: transform 0.2s, box-shadow 0.2s;
}
.stat-mini:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
.stat-mini-icon {
  width: 42px; height: 42px; border-radius: 11px;
  display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;
}
.stat-mini-val { font-size: 1.6rem; font-weight: 800; color: var(--text); letter-spacing: -0.03em; line-height: 1; }
.stat-mini-label { font-size: 0.78rem; color: var(--text-secondary); font-weight: 500; margin-top: 3px; }
.icon-yellow { background: var(--yellow-bg); color: #b45309; }
.icon-blue   { background: var(--blue-bg);   color: var(--blue-text); }
.icon-green  { background: var(--green-bg);  color: var(--green); }
.icon-red    { background: var(--red-bg);    color: var(--red); }

/* ── FILTER BAR ── */
.filter-bar {
  display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
  animation: fadeSlideUp 0.4s both 0.16s;
}
.filter-left { display: flex; align-items: center; gap: 10px; }
.filter-tabs {
  display: flex; gap: 4px;
  background: var(--white); border: 1.5px solid var(--border);
  border-radius: 12px; padding: 4px;
  box-shadow: var(--shadow);
}
.filter-tab {
  padding: 7px 18px; border-radius: 9px; font-size: 0.84rem;
  font-weight: 600; color: var(--text-secondary); text-decoration: none;
  transition: all 0.2s; white-space: nowrap; border: none; background: none; cursor: pointer;
}
.filter-tab:hover { color: var(--text); background: var(--bg); }
.filter-tab.active { background: var(--navy); color: var(--white); box-shadow: 0 2px 8px rgba(11,22,64,0.18); }

.search-box {
  display: flex; align-items: center; gap: 8px;
  background: var(--white); border: 1.5px solid var(--border);
  border-radius: 24px; padding: 8px 16px;
  box-shadow: var(--shadow); transition: border-color 0.2s;
}
.search-box:focus-within { border-color: #93c5fd; }
.search-box i { color: var(--text-light); font-size: 0.85rem; }
.search-box input { border: none; outline: none; background: transparent; font-size: 0.86rem; font-family: 'Inter', sans-serif; color: var(--text); width: 200px; }
.search-box input::placeholder { color: var(--text-light); }

.view-toggle { display: flex; gap: 4px; background: var(--white); border: 1.5px solid var(--border); border-radius: 10px; padding: 4px; box-shadow: var(--shadow); }
.view-btn { width: 32px; height: 32px; border-radius: 7px; border: none; background: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); transition: all 0.2s; }
.view-btn.active { background: var(--navy); color: var(--white); }
.view-btn:hover:not(.active) { background: var(--bg); }

/* ── ROOM GRID ── */
.room-grid {
  display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 18px;
  animation: fadeSlideUp 0.4s both 0.22s;
}

.room-card {
  background: var(--white); border-radius: var(--radius);
  border: 1.5px solid var(--border);
  box-shadow: var(--shadow-card); overflow: hidden;
  transition: transform 0.25s cubic-bezier(0.16,1,0.3,1), box-shadow 0.25s, border-color 0.25s;
  display: flex; flex-direction: column;
}
.room-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); border-color: #d1d9f0; }

/* card top color strip based on status */
.room-card::before { content: ''; height: 4px; display: block; }
.room-card.status-available::before  { background: linear-gradient(90deg, #16a34a, #4ade80); }
.room-card.status-occupied::before   { background: linear-gradient(90deg, #1d4ed8, #60a5fa); }
.room-card.status-reserved::before   { background: linear-gradient(90deg, #d97706, #fbbf24); }
.room-card.status-maintenance::before { background: linear-gradient(90deg, #dc2626, #f87171); }

.card-top { padding: 18px 20px 14px; display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; }
.card-room-name { font-size: 1rem; font-weight: 700; color: var(--text); letter-spacing: -0.01em; margin-bottom: 3px; }
.card-room-location { font-size: 0.78rem; color: var(--text-secondary); display: flex; align-items: center; gap: 5px; }
.card-room-location i { font-size: 0.72rem; }

.status-badge {
  font-size: 0.7rem; font-weight: 700; padding: 4px 10px; border-radius: 8px;
  letter-spacing: 0.04em; white-space: nowrap; flex-shrink: 0;
  display: flex; align-items: center; gap: 5px;
}
.status-badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
.status-available  { background: var(--green-bg);  color: var(--green);      border: 1px solid var(--green-border); }
.status-available::before  { background: var(--green); box-shadow: 0 0 5px rgba(22,163,74,0.5); }
.status-occupied   { background: var(--blue-bg);   color: var(--blue-text);  border: 1px solid var(--blue-border); }
.status-occupied::before   { background: var(--blue-text); animation: blink 1.5s infinite; }
.status-reserved   { background: var(--orange-bg); color: var(--orange-text); border: 1px solid var(--orange-border); }
.status-reserved::before   { background: var(--orange-text); }
.status-maintenance { background: var(--red-bg);   color: var(--red);        border: 1px solid var(--red-border); }
.status-maintenance::before { background: var(--red); }
@keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0.4;} }

/* card body */
.card-body { padding: 0 20px 16px; flex: 1; display: flex; flex-direction: column; gap: 12px; }

.capacity-row {
  display: flex; align-items: center; gap: 6px;
  font-size: 0.82rem; color: var(--text-secondary); font-weight: 500;
}
.capacity-row svg { width: 14px; height: 14px; stroke: var(--text-light); flex-shrink: 0; }

/* occupancy bar */
.occupancy-row { display: flex; flex-direction: column; gap: 5px; }
.occupancy-label { display: flex; justify-content: space-between; font-size: 0.76rem; color: var(--text-secondary); }
.occupancy-bar { height: 5px; background: var(--border); border-radius: 99px; overflow: hidden; }
.occupancy-fill { height: 100%; border-radius: 99px; transition: width 0.6s ease; }
.fill-green  { background: linear-gradient(90deg, #16a34a, #4ade80); }
.fill-yellow { background: linear-gradient(90deg, #d97706, #fbbf24); }
.fill-red    { background: linear-gradient(90deg, #dc2626, #f87171); }

/* class info box */
.class-box {
  border-radius: 10px; padding: 11px 14px;
  flex: 1;
}
.class-box.current  { background: #eff6ff; border: 1px solid #bfdbfe; }
.class-box.upcoming { background: var(--bg); border: 1px solid var(--border); }
.class-box.empty    { background: var(--bg); border: 1px dashed var(--border); }
.class-label { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 5px; }
.class-box.current .class-label  { color: var(--blue-text); }
.class-box.upcoming .class-label { color: var(--text-secondary); }
.class-box.empty .class-label    { color: var(--text-light); }
.class-name { font-size: 0.9rem; font-weight: 700; color: var(--text); margin-bottom: 2px; }
.class-box.empty .class-name { color: var(--text-light); }
.class-meta { font-size: 0.76rem; color: var(--text-secondary); display: flex; align-items: center; gap: 5px; }
.class-meta i { font-size: 0.7rem; }

/* card footer */
.card-footer {
  border-top: 1px solid var(--border); padding: 11px 20px;
  display: flex; align-items: center; justify-content: space-between;
}
.updated-time { font-size: 0.76rem; color: var(--text-light); display: flex; align-items: center; gap: 5px; }
.updated-time svg { width: 12px; height: 12px; stroke: var(--text-light); }
.card-actions { display: flex; align-items: center; gap: 6px; }
.card-action-btn {
  width: 28px; height: 28px; border-radius: 7px; border: 1px solid var(--border);
  background: var(--white); cursor: pointer; display: flex; align-items: center; justify-content: center;
  color: var(--text-secondary); transition: all 0.18s; font-size: 0.75rem;
}
.card-action-btn:hover { background: var(--navy); color: var(--white); border-color: var(--navy); }
.card-action-btn svg { width: 13px; height: 13px; }

/* ── EMPTY STATE ── */
.empty-state { grid-column: 1/-1; text-align: center; padding: 80px 0; }
.empty-state-icon { font-size: 3rem; color: var(--border); margin-bottom: 16px; }
.empty-state h3 { font-size: 1.1rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 6px; }
.empty-state p { font-size: 0.88rem; color: var(--text-light); }

/* ── ANIMATIONS ── */
@keyframes fadeSlideUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
.room-card { animation: fadeSlideUp 0.35s both; }
.room-card:nth-child(1)  { animation-delay: 0.05s; }
.room-card:nth-child(2)  { animation-delay: 0.10s; }
.room-card:nth-child(3)  { animation-delay: 0.15s; }
.room-card:nth-child(4)  { animation-delay: 0.20s; }
.room-card:nth-child(5)  { animation-delay: 0.25s; }
.room-card:nth-child(6)  { animation-delay: 0.30s; }
.room-card:nth-child(7)  { animation-delay: 0.35s; }
.room-card:nth-child(8)  { animation-delay: 0.40s; }
.room-card:nth-child(9)  { animation-delay: 0.45s; }

/* ── RESPONSIVE ── */
@media (max-width: 1200px) { .stats-strip { grid-template-columns: repeat(2,1fr); } .content { padding: 24px 20px 40px; } .topbar { padding: 0 20px; } }
@media (max-width: 768px) { :root { --sidebar-w: 0px; } .sidebar { display: none; } .topbar-search { width: 200px; } .stats-strip { grid-template-columns: 1fr 1fr; gap: 12px; } .room-grid { grid-template-columns: 1fr; } }
</style>
@include('frontend.admin.partials.minimal-ui-overrides')
</head>
<body>

<!-- ════════════════════════════════════════════
     SIDEBAR — EXACT COPY FROM DASHBOARD
════════════════════════════════════════════ -->
<div class="sidebar">
  <a href="#" class="sidebar-logo">
    <div class="logo-mark"><i class="fas fa-door-open"></i></div>
    <div class="logo-text">
      <span class="brand-psu" style="font-size:0.6rem;font-weight:700;letter-spacing:0.18em;color:rgba(255,255,255,0.45);display:block;margin-bottom:3px;text-transform:uppercase;">PSU</span>
      <span class="brand-main">Smart<span>Room</span></span>
    </div>
  </a>

  <span class="nav-section-label">Main Menu</span>
  <ul class="sidebar-nav">
    <li>
      <a href="{{ route('admin.classrooms') }}" class="active">
        <span class="nav-icon"><i class="fas fa-school"></i></span>
        Room Management
      </a>
    </li>
    <li>
      <a href="{{ url('/admin/schedule') }}">
        <span class="nav-icon"><i class="fas fa-calendar-days"></i></span>
        Schedule
      </a>
    </li>
    <li>
      <a href="{{ url('/admin/users') }}">
        <span class="nav-icon"><i class="fas fa-users-cog"></i></span>
        User Management
      </a>
    </li>
    <li>
      <a href="{{ url('/smartlocking') }}">
        <span class="nav-icon"><i class="fas fa-lock"></i></span>
        SmartLocking
      </a>
    </li>
  </ul>

  <div class="sidebar-footer">
    <div class="user-widget">
      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Prof. Elena Santos">
      <div class="user-widget-info">
        <div class="user-widget-name">Prof. Elena Santos</div>
        <div class="user-widget-role">Admin</div>
      </div>
    </div>
    <form method="POST" action="{{ url('/logout') }}">
      @csrf
      <button type="submit" class="sidebar-logout-btn">
        <i class="fas fa-arrow-right-from-bracket"></i>
        Sign Out
      </button>
    </form>
  </div>
</div>

<!-- ════════════════════════════════════════════
     MAIN
════════════════════════════════════════════ -->
<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div style="font-size:0.84rem;color:var(--text-secondary);display:flex;align-items:center;gap:7px;">
      <i class="fas fa-clock" style="font-size:0.78rem;color:var(--text-light);"></i>
      <span>{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</span>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- Page Header -->
    <div class="page-header">
      <div class="page-header-left">
        <h1>Classroom Directory</h1>
        <p>Real-time availability and status of all campus rooms.</p>
      </div>
      <button id="addRoomBtn" style="display:flex;align-items:center;gap:8px;padding:10px 20px;background:var(--navy);color:#fff;border:none;border-radius:10px;font-size:0.88rem;font-weight:600;cursor:pointer;font-family:'Inter',sans-serif;box-shadow:0 2px 8px rgba(11,22,64,0.18);transition:all 0.2s;" onmouseover="this.style.background='#1a2f80'" onmouseout="this.style.background='var(--navy)'">
        <i class="fas fa-plus" style="font-size:0.8rem;"></i>
        Add Room
      </button>
    </div>

    <!-- Stats Strip -->
    <div class="stats-strip">
      <div class="stat-mini">
        <div class="stat-mini-icon icon-yellow"><i class="fas fa-door-open"></i></div>
        <div class="stat-mini-body">
          <div class="stat-mini-val">24</div>
          <div class="stat-mini-label">Total Rooms</div>
        </div>
      </div>
      <div class="stat-mini">
        <div class="stat-mini-icon icon-green"><i class="fas fa-circle-check"></i></div>
        <div class="stat-mini-body">
          <div class="stat-mini-val">9</div>
          <div class="stat-mini-label">Available</div>
        </div>
      </div>
      <div class="stat-mini">
        <div class="stat-mini-icon icon-blue"><i class="fas fa-user-group"></i></div>
        <div class="stat-mini-body">
          <div class="stat-mini-val">12</div>
          <div class="stat-mini-label">Occupied</div>
        </div>
      </div>
      <div class="stat-mini">
        <div class="stat-mini-icon icon-red"><i class="fas fa-triangle-exclamation"></i></div>
        <div class="stat-mini-body">
          <div class="stat-mini-val">3</div>
          <div class="stat-mini-label">Reserved / Maintenance</div>
        </div>
      </div>
    </div>

    <div class="manage-box">
      <div class="manage-head">
        <div class="manage-title">Room Management</div>
        <div style="font-size:0.78rem;color:var(--text-secondary);">Open a room to set unavailable issue details</div>
      </div>
      <table class="manage-table">
        <thead>
          <tr>
            <th>Room</th>
            <th>Location</th>
            <th>Status</th>
            <th>Issue</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @forelse($classrooms as $classroom)
            <tr>
              <td>{{ $classroom->name }}</td>
              <td>{{ $classroom->building }}{{ $classroom->floor ? ' · '.$classroom->floor : '' }}</td>
              <td>{{ ucfirst($classroom->status) }}</td>
              <td>{{ $classroom->unavailable_reason ?? '-' }}</td>
              <td><a class="manage-link" href="{{ route('admin.classrooms.show', $classroom->id) }}">Manage</a></td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="color:var(--text-secondary);">No rooms yet. Click "Add Room" to create one.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
      <div class="filter-left">
        <div class="filter-tabs">
          <a href="#" class="filter-tab active">All <span style="opacity:0.5;font-weight:400;margin-left:3px;">24</span></a>
          <a href="#" class="filter-tab">Available <span style="opacity:0.5;font-weight:400;margin-left:3px;">9</span></a>
          <a href="#" class="filter-tab">Occupied <span style="opacity:0.5;font-weight:400;margin-left:3px;">12</span></a>
          <a href="#" class="filter-tab">Reserved <span style="opacity:0.5;font-weight:400;margin-left:3px;">3</span></a>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:10px;">
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Search rooms...">
        </div>
        <div class="view-toggle">
          <button class="view-btn active" title="Grid view"><i class="fas fa-grip"></i></button>
          <button class="view-btn" title="List view"><i class="fas fa-list"></i></button>
        </div>
      </div>
    </div>

    <!-- Room Grid -->
    <div class="room-grid">

      <!-- OCCUPIED ROOM -->
      <div class="room-card status-occupied" data-room-id="1">
        <div class="card-top">
          <div>
            <div class="card-room-name">Room 101 – CIT Laboratory</div>
            <div class="card-room-location"><i class="fas fa-location-dot"></i> Main Building · Ground Floor</div>
          </div>
          <span class="status-badge status-occupied">OCCUPIED</span>
        </div>
        <div class="card-body">
          <div class="capacity-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Capacity: 40 Students
          </div>
          <div class="occupancy-row">
            <div class="occupancy-label"><span>Occupancy</span><span>35/40</span></div>
            <div class="occupancy-bar"><div class="occupancy-fill fill-yellow" style="width:87%"></div></div>
          </div>
          <div class="class-box current">
            <div class="class-label"><i class="fas fa-circle" style="font-size:0.5rem;animation:blink 1.5s infinite;margin-right:4px;"></i>Current Class</div>
            <div class="class-name">IT 301 – Data Structures</div>
            <div class="class-meta"><i class="fas fa-user"></i> Prof. Santos &nbsp;·&nbsp; <i class="fas fa-clock"></i> 7:30–9:00 AM</div>
          </div>
        </div>
        <div class="card-footer">
          <div class="updated-time">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Updated just now
          </div>
          <div class="card-actions">
            <button class="card-action-btn js-view-room" title="View Details" data-room-id="1"><i class="fas fa-eye"></i></button>
            <button class="card-action-btn" title="QR Code">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="3" height="3" rx="0.5"/><rect x="19" y="14" width="2" height="2" rx="0.5"/><rect x="14" y="19" width="2" height="2" rx="0.5"/><rect x="18" y="18" width="3" height="3" rx="0.5"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- AVAILABLE ROOM -->
      <div class="room-card status-available" data-room-id="2">
        <div class="card-top">
          <div>
            <div class="card-room-name">Room 102 – Lecture Hall A</div>
            <div class="card-room-location"><i class="fas fa-location-dot"></i> Main Building · Ground Floor</div>
          </div>
          <span class="status-badge status-available">AVAILABLE</span>
        </div>
        <div class="card-body">
          <div class="capacity-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Capacity: 60 Students
          </div>
          <div class="occupancy-row">
            <div class="occupancy-label"><span>Occupancy</span><span>0/60</span></div>
            <div class="occupancy-bar"><div class="occupancy-fill fill-green" style="width:0%"></div></div>
          </div>
          <div class="class-box upcoming">
            <div class="class-label">Upcoming</div>
            <div class="class-name">BSED 201 – Literature</div>
            <div class="class-meta"><i class="fas fa-clock"></i> Prof. Reyes &nbsp;·&nbsp; 10:00–11:30 AM</div>
          </div>
        </div>
        <div class="card-footer">
          <div class="updated-time">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            2 mins ago
          </div>
          <div class="card-actions">
            <button class="card-action-btn js-view-room" title="View Details" data-room-id="2"><i class="fas fa-eye"></i></button>
            <button class="card-action-btn" title="QR Code">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="3" height="3" rx="0.5"/><rect x="19" y="14" width="2" height="2" rx="0.5"/><rect x="14" y="19" width="2" height="2" rx="0.5"/><rect x="18" y="18" width="3" height="3" rx="0.5"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- OCCUPIED ROOM 2 -->
      <div class="room-card status-occupied" data-room-id="3">
        <div class="card-top">
          <div>
            <div class="card-room-name">Room 201 – Lecture Hall B</div>
            <div class="card-room-location"><i class="fas fa-location-dot"></i> Main Building · 2nd Floor</div>
          </div>
          <span class="status-badge status-occupied">OCCUPIED</span>
        </div>
        <div class="card-body">
          <div class="capacity-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Capacity: 50 Students
          </div>
          <div class="occupancy-row">
            <div class="occupancy-label"><span>Occupancy</span><span>48/50</span></div>
            <div class="occupancy-bar"><div class="occupancy-fill fill-red" style="width:96%"></div></div>
          </div>
          <div class="class-box current">
            <div class="class-label"><i class="fas fa-circle" style="font-size:0.5rem;animation:blink 1.5s infinite;margin-right:4px;"></i>Current Class</div>
            <div class="class-name">BSED 301 – Philippine Lit.</div>
            <div class="class-meta"><i class="fas fa-user"></i> Prof. Cruz &nbsp;·&nbsp; <i class="fas fa-clock"></i> 8:00–9:30 AM</div>
          </div>
        </div>
        <div class="card-footer">
          <div class="updated-time">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Updated just now
          </div>
          <div class="card-actions">
            <button class="card-action-btn js-view-room" title="View Details" data-room-id="3"><i class="fas fa-eye"></i></button>
            <button class="card-action-btn" title="QR Code">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="3" height="3" rx="0.5"/><rect x="19" y="14" width="2" height="2" rx="0.5"/><rect x="14" y="19" width="2" height="2" rx="0.5"/><rect x="18" y="18" width="3" height="3" rx="0.5"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- RESERVED ROOM -->
      <div class="room-card status-reserved" data-room-id="4">
        <div class="card-top">
          <div>
            <div class="card-room-name">Room 203 – Science Lab</div>
            <div class="card-room-location"><i class="fas fa-location-dot"></i> Main Building · 2nd Floor</div>
          </div>
          <span class="status-badge status-reserved">RESERVED</span>
        </div>
        <div class="card-body">
          <div class="capacity-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Capacity: 35 Students
          </div>
          <div class="occupancy-row">
            <div class="occupancy-label"><span>Occupancy</span><span>0/35</span></div>
            <div class="occupancy-bar"><div class="occupancy-fill fill-green" style="width:0%"></div></div>
          </div>
          <div class="class-box upcoming">
            <div class="class-label"><i class="fas fa-calendar-check" style="margin-right:4px;"></i>Reserved</div>
            <div class="class-name">BSIT 401 – Research Methods</div>
            <div class="class-meta"><i class="fas fa-clock"></i> Prof. Lim &nbsp;·&nbsp; 1:00–2:30 PM</div>
          </div>
        </div>
        <div class="card-footer">
          <div class="updated-time">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            5 mins ago
          </div>
          <div class="card-actions">
            <button class="card-action-btn js-view-room" title="View Details" data-room-id="4"><i class="fas fa-eye"></i></button>
            <button class="card-action-btn" title="QR Code">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="3" height="3" rx="0.5"/><rect x="19" y="14" width="2" height="2" rx="0.5"/><rect x="14" y="19" width="2" height="2" rx="0.5"/><rect x="18" y="18" width="3" height="3" rx="0.5"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- AVAILABLE ROOM 2 -->
      <div class="room-card status-available" data-room-id="5">
        <div class="card-top">
          <div>
            <div class="card-room-name">Room 301 – Computer Lab</div>
            <div class="card-room-location"><i class="fas fa-location-dot"></i> Tech Building · 3rd Floor</div>
          </div>
          <span class="status-badge status-available">AVAILABLE</span>
        </div>
        <div class="card-body">
          <div class="capacity-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Capacity: 45 Students
          </div>
          <div class="occupancy-row">
            <div class="occupancy-label"><span>Occupancy</span><span>0/45</span></div>
            <div class="occupancy-bar"><div class="occupancy-fill fill-green" style="width:0%"></div></div>
          </div>
          <div class="class-box empty">
            <div class="class-label">No Upcoming Class</div>
            <div class="class-name">— Free all afternoon</div>
            <div class="class-meta" style="color:var(--text-light);">Room is unlocked</div>
          </div>
        </div>
        <div class="card-footer">
          <div class="updated-time">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            1 min ago
          </div>
          <div class="card-actions">
            <button class="card-action-btn js-view-room" title="View Details" data-room-id="5"><i class="fas fa-eye"></i></button>
            <button class="card-action-btn" title="QR Code">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="3" height="3" rx="0.5"/><rect x="19" y="14" width="2" height="2" rx="0.5"/><rect x="14" y="19" width="2" height="2" rx="0.5"/><rect x="18" y="18" width="3" height="3" rx="0.5"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- MAINTENANCE ROOM -->
      <div class="room-card status-maintenance" data-room-id="6">
        <div class="card-top">
          <div>
            <div class="card-room-name">Room 302 – AVR Hall</div>
            <div class="card-room-location"><i class="fas fa-location-dot"></i> Tech Building · 3rd Floor</div>
          </div>
          <span class="status-badge status-maintenance">MAINTENANCE</span>
        </div>
        <div class="card-body">
          <div class="capacity-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Capacity: 80 Students
          </div>
          <div class="occupancy-row">
            <div class="occupancy-label"><span>Occupancy</span><span>—</span></div>
            <div class="occupancy-bar"><div class="occupancy-fill" style="width:0%;background:#f87171;"></div></div>
          </div>
          <div class="class-box" style="background:#fff5f5;border:1px solid #fecaca;">
            <div class="class-label" style="color:var(--red);"><i class="fas fa-wrench" style="margin-right:4px;"></i>Under Maintenance</div>
            <div class="class-name">Electrical repair in progress</div>
            <div class="class-meta" style="color:var(--text-secondary);"><i class="fas fa-clock"></i> Estimated: 3:00 PM today</div>
          </div>
        </div>
        <div class="card-footer">
          <div class="updated-time">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            1 hour ago
          </div>
          <div class="card-actions">
            <button class="card-action-btn js-view-room" title="View Details" data-room-id="6"><i class="fas fa-eye"></i></button>
            <button class="card-action-btn" title="QR Code">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="3" height="3" rx="0.5"/><rect x="19" y="14" width="2" height="2" rx="0.5"/><rect x="14" y="19" width="2" height="2" rx="0.5"/><rect x="18" y="18" width="3" height="3" rx="0.5"/></svg>
            </button>
          </div>
        </div>
      </div>

    </div><!-- /room-grid -->

  </div><!-- /content -->
</div><!-- /main -->

    <div class="room-modal-overlay" id="addRoomModal" aria-hidden="true">
      <div class="room-modal" role="dialog" aria-modal="true" aria-labelledby="addRoomModalTitle">
        <div class="room-modal-head">
          <div>
            <div class="room-modal-title" id="addRoomModalTitle">Add Room</div>
            <div class="room-modal-sub">Create a new classroom in the system.</div>
          </div>
          <button type="button" class="room-modal-close" id="addRoomModalCloseBtn" aria-label="Close add room dialog">
            <i class="fas fa-xmark"></i>
          </button>
        </div>

        <form id="addRoomForm" class="room-modal-body">
          <label class="room-field">
            <span class="room-label">Room Name</span>
            <input id="roomName" class="room-input" type="text" placeholder="e.g., Room 401" required>
          </label>

          <label class="room-field">
            <span class="room-label">Building</span>
            <input id="roomBuilding" class="room-input" type="text" placeholder="e.g., Main Building" required>
          </label>

          <div class="room-grid-2">
            <label class="room-field">
              <span class="room-label">Floor</span>
              <input id="roomFloor" class="room-input" type="text" placeholder="e.g., 1st Floor">
            </label>
            <label class="room-field">
              <span class="room-label">Capacity</span>
              <input id="roomCapacity" class="room-input" type="number" min="0" placeholder="40" required>
            </label>
          </div>

          <label class="room-field">
            <span class="room-label">Status</span>
            <select id="roomStatus" class="room-input" required>
              <option value="available" selected>Available</option>
              <option value="occupied">Occupied</option>
              <option value="reserved">Reserved</option>
              <option value="maintenance">Maintenance</option>
              <option value="unavailable">Unavailable</option>
            </select>
          </label>

          <label class="room-field" id="issueReasonWrap" style="display:none;">
            <span class="room-label">Issue Note</span>
            <textarea id="roomIssueReason" class="room-input room-textarea" placeholder="e.g., AC repair ongoing"></textarea>
          </label>

          <div class="room-modal-actions">
            <button type="button" class="room-btn room-btn-cancel" id="addRoomModalCancelBtn">Cancel</button>
            <button type="submit" class="room-btn room-btn-submit" id="addRoomSubmitBtn">Save Room</button>
          </div>
        </form>
      </div>
    </div>

  <style>
    .room-modal-overlay{position:fixed;inset:0;background:rgba(11,22,64,.42);backdrop-filter:blur(2px);display:none;align-items:center;justify-content:center;padding:16px;z-index:2100}
    .room-modal-overlay.is-open{display:flex}
    .room-modal{width:min(520px,100%);background:var(--white);border:1.5px solid var(--border);border-radius:14px;box-shadow:0 22px 50px rgba(11,22,64,.26);overflow:hidden}
    .room-modal-head{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;padding:16px 18px;border-bottom:1px solid var(--border);background:#fafbff}
    .room-modal-title{font-size:1rem;font-weight:800;color:var(--text)}
    .room-modal-sub{font-size:.78rem;color:var(--text-secondary);margin-top:2px}
    .room-modal-close{width:30px;height:30px;border-radius:8px;border:1px solid var(--border);background:#fff;color:var(--text-secondary);cursor:pointer;display:flex;align-items:center;justify-content:center}
    .room-modal-close:hover{background:var(--bg);color:var(--text)}
    .room-modal-body{padding:16px 18px 18px;display:flex;flex-direction:column;gap:12px}
    .room-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .room-field{display:flex;flex-direction:column;gap:6px}
    .room-label{font-size:.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--text-secondary)}
    .room-input{width:100%;padding:10px 12px;border-radius:10px;border:1.5px solid var(--border);background:#fff;font-family:'Inter',sans-serif;font-size:.86rem;color:var(--text);outline:none}
    .room-input:focus{border-color:#93c5fd;box-shadow:0 0 0 3px rgba(59,130,246,.08)}
    .room-textarea{min-height:74px;resize:vertical}
    .room-modal-actions{display:flex;justify-content:flex-end;gap:8px;margin-top:4px}
    .room-btn{padding:9px 14px;border-radius:10px;font-size:.82rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;border:1px solid transparent}
    .room-btn-cancel{background:#fff;color:var(--text-secondary);border-color:var(--border)}
    .room-btn-cancel:hover{background:var(--bg);color:var(--text)}
    .room-btn-submit{background:var(--navy);color:#fff}
    .room-btn-submit:hover{background:#0a1235}
    @media (max-width: 560px){.room-grid-2{grid-template-columns:1fr}}
  .toast-wrap{position:fixed;right:18px;bottom:18px;display:flex;flex-direction:column;gap:8px;z-index:2200;pointer-events:none}
  .toast{min-width:240px;max-width:360px;padding:10px 12px;border-radius:10px;border:1px solid #e5e7eb;box-shadow:0 10px 28px rgba(11,22,64,.2);font-size:.8rem;font-weight:600;opacity:0;transform:translateY(10px);transition:opacity .2s,transform .2s;background:#fff;color:#1f2937}
  .toast.is-visible{opacity:1;transform:translateY(0)}
  .toast.toast-success{background:#ecfdf5;border-color:#86efac;color:#166534}
  .toast.toast-error{background:#fef2f2;border-color:#fecaca;color:#991b1b}
  .toast.toast-info{background:#eff6ff;border-color:#bfdbfe;color:#1d4ed8}
  </style>
  <div class="toast-wrap" id="toastWrap" aria-live="polite" aria-atomic="true"></div>

<script>
  const addRoomModal = document.getElementById('addRoomModal');
  const addRoomForm = document.getElementById('addRoomForm');
  const roomStatus = document.getElementById('roomStatus');
  const issueReasonWrap = document.getElementById('issueReasonWrap');
  const roomIssueReason = document.getElementById('roomIssueReason');
  const addRoomSubmitBtn = document.getElementById('addRoomSubmitBtn');
  const toastWrap = document.getElementById('toastWrap');

  function showToast(message, type = 'info') {
    if (!toastWrap || !message) return;

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    toastWrap.appendChild(toast);

    requestAnimationFrame(() => toast.classList.add('is-visible'));

    setTimeout(() => {
      toast.classList.remove('is-visible');
      setTimeout(() => toast.remove(), 220);
    }, 2600);
  }

  function toggleIssueReasonField() {
    const selected = String(roomStatus?.value || 'available').toLowerCase();
    const needsReason = selected === 'maintenance' || selected === 'unavailable';
    issueReasonWrap.style.display = needsReason ? '' : 'none';
    roomIssueReason.required = needsReason;
    if (!needsReason) {
      roomIssueReason.value = '';
    }
  }

  function openAddRoomModal() {
    if (!addRoomModal || !addRoomForm) return;
    addRoomForm.reset();
    toggleIssueReasonField();
    addRoomModal.classList.add('is-open');
    addRoomModal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    document.getElementById('roomName')?.focus();
  }

  function closeAddRoomModal() {
    if (!addRoomModal) return;
    addRoomModal.classList.remove('is-open');
    addRoomModal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  document.getElementById('addRoomBtn')?.addEventListener('click', openAddRoomModal);
  document.getElementById('addRoomModalCloseBtn')?.addEventListener('click', closeAddRoomModal);
  document.getElementById('addRoomModalCancelBtn')?.addEventListener('click', closeAddRoomModal);
  roomStatus?.addEventListener('change', toggleIssueReasonField);

  addRoomModal?.addEventListener('click', (event) => {
    if (event.target === addRoomModal) {
      closeAddRoomModal();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && addRoomModal?.classList.contains('is-open')) {
      closeAddRoomModal();
    }
  });

  addRoomForm?.addEventListener('submit', async (event) => {
    event.preventDefault();

    const name = String(document.getElementById('roomName')?.value || '').trim();
    const building = String(document.getElementById('roomBuilding')?.value || '').trim();
    const floor = String(document.getElementById('roomFloor')?.value || '').trim();
    const capacity = Number.parseInt(String(document.getElementById('roomCapacity')?.value || '0'), 10);
    const status = String(roomStatus?.value || 'available').toLowerCase();
    const unavailableReason = String(roomIssueReason?.value || '').trim();

    if (!name || !building) {
      showToast('Room name and building are required.', 'error');
      return;
    }

    if (Number.isNaN(capacity) || capacity < 0) {
      showToast('Capacity must be a valid non-negative number.', 'error');
      return;
    }

    if ((status === 'maintenance' || status === 'unavailable') && !unavailableReason) {
      showToast('Issue note is required for unavailable rooms.', 'error');
      return;
    }

    addRoomSubmitBtn.disabled = true;

    try {
      const response = await fetch("{{ route('admin.classrooms.store') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
        body: JSON.stringify({
          name,
          building,
          floor: floor || null,
          capacity,
          status,
          unavailable_reason: unavailableReason || null,
          current_occupancy: 0,
        }),
      });

      if (!response.ok) {
        const errorBody = await response.json().catch(() => ({}));
        showToast(errorBody?.message || 'Failed to create room. Please check your inputs.', 'error');
        return;
      }

      closeAddRoomModal();
      window.location.reload();
    } finally {
      addRoomSubmitBtn.disabled = false;
    }
  });

document.querySelectorAll('.js-view-room').forEach((button) => {
  button.addEventListener('click', (event) => {
    event.preventDefault();
    const roomId = button.getAttribute('data-room-id');
    if (!roomId) return;
    window.location.href = `/admin/classrooms/${roomId}`;
  });
});
</script>

</body>
</html>