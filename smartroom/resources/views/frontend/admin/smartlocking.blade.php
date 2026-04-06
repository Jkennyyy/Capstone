<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SmartLocking – SmartDoor</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
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
  --blue-bg:       #dbeafe;
  --blue-border:   #93c5fd;
  --blue-text:     #1d4ed8;
  --red:           #dc2626;
  --red-bg:        #fee2e2;
  --shadow:        0 1px 3px rgba(0,0,0,0.06);
  --shadow-card:   0 2px 8px rgba(0,0,0,0.07);
  --radius:        14px;
  --radius-sm:     10px;
  --sidebar-w:     240px;
}

body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; }

/* ══════════════════════════════════════════════
   SIDEBAR — EXACT COPY FROM CLASSROOMS
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
  padding: 28px 20px 24px 24px; text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,0.06); margin-bottom: 8px;
}
.logo-mark {
  width: 40px; height: 40px; background: var(--yellow); border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem; color: var(--navy); flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(245,197,24,0.4);
}
.logo-text { line-height: 1; }
.logo-text .brand-psu {
  font-size: 0.6rem; font-weight: 600; letter-spacing: 0.18em;
  color: rgba(255,255,255,0.45); text-transform: uppercase; display: block; margin-bottom: 3px;
}
.logo-text .brand-main { font-size: 1.05rem; font-weight: 700; color: #fff; letter-spacing: -0.01em; }
.logo-text .brand-main span { color: var(--yellow); }
.nav-section-label {
  font-size: 0.68rem; font-weight: 700; letter-spacing: 0.12em;
  text-transform: uppercase; color: rgba(255,255,255,0.25); padding: 16px 24px 6px;
}
.sidebar-nav { list-style: none; overflow-y: auto; padding: 0 12px; }
.sidebar-nav::-webkit-scrollbar { width: 0; }
.sidebar-nav li { margin-bottom: 2px; }
.sidebar-nav a {
  display: flex; align-items: center; gap: 11px; padding: 11px 12px; text-decoration: none;
  color: rgba(255,255,255,0.6); font-size: 0.88rem; font-weight: 500;
  border-radius: var(--radius-sm); transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
  position: relative; overflow: hidden;
}
.sidebar-nav a .nav-icon {
  width: 32px; height: 32px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.85rem; background: rgba(255,255,255,0.05); flex-shrink: 0; transition: all 0.22s;
}
.sidebar-nav a:hover { color: rgba(255,255,255,0.9); background: rgba(255,255,255,0.06); }
.sidebar-nav a:hover .nav-icon { background: rgba(255,255,255,0.1); }
.sidebar-nav a.active { background: rgba(245,197,24,0.14); color: var(--yellow); }
.sidebar-nav a.active .nav-icon { background: rgba(245,197,24,0.2); color: var(--yellow); }
.sidebar-nav a.active::before {
  content: ''; position: absolute; left: 0; top: 20%; bottom: 20%;
  width: 3px; background: var(--yellow); border-radius: 0 2px 2px 0;
}
.sidebar-footer { margin-top: auto; padding: 16px 12px 24px; border-top: 1px solid rgba(255,255,255,0.06); }
.user-widget {
  display: flex; align-items: center; gap: 10px; padding: 10px 12px;
  border-radius: var(--radius-sm); background: rgba(255,255,255,0.05); margin-bottom: 8px;
}
.user-widget img { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(245,197,24,0.4); }
.user-widget-info { flex: 1; min-width: 0; }
.user-widget-name { font-size: 0.83rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.user-widget-role { font-size: 0.73rem; color: rgba(255,255,255,0.4); }
.sidebar-logout-btn {
  display: flex; align-items: center; gap: 10px; padding: 9px 12px;
  color: rgba(255,255,255,0.4); font-size: 0.84rem; font-weight: 500;
  border-radius: var(--radius-sm); transition: all 0.22s; width: 100%;
  background: none; border: none; cursor: pointer; font-family: inherit; text-decoration: none;
}
.sidebar-logout-btn:hover { color: #f87171; background: rgba(244,63,94,0.08); }

/* ══════════════════════════════════════════════
   MAIN LAYOUT
══════════════════════════════════════════════ */
.main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

/* TOPBAR */
.topbar {
  background: var(--white); border-bottom: 1px solid var(--border);
  padding: 0 36px; height: 64px;
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  position: sticky; top: 0; z-index: 50;
}
.topbar-search {
  display: flex; align-items: center; gap: 10px;
  background: var(--bg); border: 1.5px solid var(--border);
  border-radius: 24px; padding: 8px 18px; width: 340px;
  transition: border-color 0.2s;
}
.topbar-search:focus-within { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(59,130,246,0.08); }
.topbar-search i { color: var(--text-light); font-size: 0.88rem; }
.topbar-search input { border: none; outline: none; background: transparent; font-size: 0.9rem; font-family: 'Inter', sans-serif; color: var(--text); width: 100%; }
.topbar-search input::placeholder { color: var(--text-light); }
.topbar-right { display: flex; align-items: center; gap: 18px; }
.notif-btn { position: relative; background: none; border: none; cursor: pointer; color: var(--text-secondary); font-size: 1.15rem; padding: 7px; border-radius: 9px; transition: background 0.2s; }
.notif-btn:hover { background: var(--bg); }
.notif-badge { position: absolute; top: 5px; right: 5px; width: 7px; height: 7px; background: var(--red); border-radius: 50%; border: 1.5px solid var(--white); }
.topbar-profile { display: flex; align-items: center; gap: 10px; cursor: pointer; }
.topbar-profile-info { text-align: right; }
.topbar-profile-name { font-size: 0.88rem; font-weight: 700; color: var(--text); line-height: 1.2; }
.topbar-profile-role { font-size: 0.76rem; color: var(--text-secondary); }
.topbar-profile img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border); }

/* CONTENT */
.content { padding: 32px 36px 48px; display: flex; flex-direction: column; gap: 24px; }

/* ══════════════════════════════════════════════
   PAGE HEADER
══════════════════════════════════════════════ */
.page-header { display: flex; align-items: center; gap: 16px; animation: fadeIn 0.35s both; }
.page-header-icon {
  width: 48px; height: 48px; border-radius: 14px;
  background: linear-gradient(135deg, #3b5bdb, #4c6ef5);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.25rem; color: #fff; flex-shrink: 0;
  box-shadow: 0 4px 14px rgba(59,91,219,0.3);
}
.page-header h1 { font-size: 1.55rem; font-weight: 800; color: var(--text); letter-spacing: -0.02em; margin-bottom: 2px; }
.page-header p { font-size: 0.86rem; color: var(--text-secondary); }

/* TABS */
.tab-bar {
  display: flex; gap: 2px; background: var(--white);
  border: 1.5px solid var(--border); border-radius: 12px; padding: 5px;
  box-shadow: var(--shadow); width: fit-content;
  animation: fadeIn 0.35s both 0.06s;
}
.tab-btn {
  display: flex; align-items: center; gap: 8px;
  padding: 9px 20px; border-radius: 9px; border: none;
  font-size: 0.86rem; font-weight: 600; font-family: 'Inter', sans-serif;
  cursor: pointer; transition: all 0.2s; color: var(--text-secondary); background: none;
}
.tab-btn i { font-size: 0.82rem; }
.tab-btn:hover { color: var(--text); background: var(--bg); }
.tab-btn.active { background: #3b5bdb; color: #fff; box-shadow: 0 2px 8px rgba(59,91,219,0.25); }

/* SECTION HEADER */
.section-header {
  display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
  animation: fadeIn 0.35s both 0.1s;
}
.section-header-left h2 { font-size: 1.2rem; font-weight: 800; color: var(--text); letter-spacing: -0.01em; margin-bottom: 3px; }
.section-header-left p { font-size: 0.84rem; color: var(--text-secondary); }
.search-inline {
  display: flex; align-items: center; gap: 8px;
  background: var(--white); border: 1.5px solid var(--border);
  border-radius: 24px; padding: 9px 18px; width: 280px; box-shadow: var(--shadow);
  transition: border-color 0.2s;
}
.search-inline:focus-within { border-color: #93c5fd; }
.search-inline i { color: var(--text-light); font-size: 0.82rem; }
.search-inline input { border: none; outline: none; background: transparent; font-size: 0.86rem; font-family: 'Inter', sans-serif; color: var(--text); width: 100%; }
.search-inline input::placeholder { color: var(--text-light); }

/* STAT CARDS ROW */
.stat-row {
  display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px;
  animation: fadeIn 0.35s both 0.14s;
}
.stat-tile {
  border-radius: 14px; padding: 22px 24px;
  position: relative; overflow: hidden;
  display: flex; flex-direction: column; justify-content: space-between;
  min-height: 110px; cursor: default;
}
.stat-tile-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px; }
.stat-tile-icon-wrap { width: 42px; height: 42px; border-radius: 11px; background: rgba(255,255,255,0.18); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #fff; flex-shrink: 0; }
.stat-tile-label { font-size: 0.76rem; font-weight: 600; color: rgba(255,255,255,0.8); margin-bottom: 6px; letter-spacing: 0.02em; }
.stat-tile-val { font-size: 2.4rem; font-weight: 800; line-height: 1; color: #fff; letter-spacing: -0.03em; }
.tile-blue   { background: linear-gradient(135deg, #3b5bdb 0%, #4c6ef5 100%); }
.tile-green  { background: linear-gradient(135deg, #2f9e44 0%, #40c057 100%); }
.tile-purple { background: linear-gradient(135deg, #7048e8 0%, #9775fa 100%); }
.tile-orange { background: linear-gradient(135deg, #e67700 0%, #fd7e14 100%); }

/* CARDS GRID */
.cards-grid {
  display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
  animation: fadeIn 0.35s both 0.18s;
}

/* INSTRUCTOR CARD */
.instructor-card {
  background: var(--white); border-radius: 16px;
  border: 1.5px solid var(--border); box-shadow: var(--shadow-card);
  overflow: hidden;
  transition: transform 0.22s, box-shadow 0.22s;
}
.instructor-card:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.09); }

.ic-header { padding: 18px 20px 14px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid var(--border); }
.ic-avatar { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border); flex-shrink: 0; }
.ic-name { font-size: 0.95rem; font-weight: 700; color: var(--text); margin-bottom: 1px; }
.ic-dept { font-size: 0.76rem; color: var(--text-secondary); }
.ic-email { font-size: 0.72rem; color: #3b5bdb; }

/* RFID CARD VISUAL */
.rfid-card {
  margin: 16px 20px;
  background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 55%, #3b82f6 100%);
  border-radius: 14px; padding: 18px 20px 16px;
  position: relative; overflow: hidden;
  box-shadow: 0 8px 24px rgba(37,99,235,0.35);
}
.rfid-card::before {
  content: ''; position: absolute;
  top: -40px; right: -40px; width: 150px; height: 150px;
  border-radius: 50%; background: rgba(255,255,255,0.06);
  pointer-events: none;
}
.rfid-card::after {
  content: ''; position: absolute;
  bottom: -50px; left: 20px; width: 130px; height: 130px;
  border-radius: 50%; background: rgba(255,255,255,0.04);
  pointer-events: none;
}

/* Row 1: institution + badge */
.rfid-row1 { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 14px; position: relative; z-index: 1; }
.rfid-institution { font-size: 0.82rem; font-weight: 700; color: rgba(255,255,255,0.9); letter-spacing: 0.02em; }
.rfid-system { font-size: 0.68rem; color: rgba(255,255,255,0.5); margin-top: 2px; }

/* Row 2: chip + wifi */
.rfid-row2 { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; position: relative; z-index: 1; }
.rfid-chip {
  width: 36px; height: 28px; border-radius: 5px;
  background: linear-gradient(135deg, #f5c518 0%, #e8a000 100%);
  display: flex; align-items: center; justify-content: center; position: relative;
}
.rfid-chip::before { content: ''; position: absolute; inset: 4px; border-radius: 2px; border: 1px solid rgba(0,0,0,0.2); }
.rfid-chip-dot { width: 6px; height: 6px; background: rgba(0,0,0,0.25); border-radius: 50%; position: relative; z-index: 1; }
.rfid-wifi { color: rgba(255,255,255,0.45); font-size: 1rem; }

.rfid-status-badge {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 3px 10px; border-radius: 100px;
  font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em;
  flex-shrink: 0;
}
.rfid-status-badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: rgba(255,255,255,0.7); flex-shrink: 0; }
.badge-active  { background: #22c55e; color: #fff; }
.badge-pending { background: #f97316; color: #fff; }

.rfid-number-label { font-size: 0.58rem; font-weight: 600; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 3px; position: relative; z-index: 1; }
.rfid-number { font-size: 1.2rem; font-weight: 700; color: #fff; letter-spacing: 0.16em; margin-bottom: 16px; font-family: 'Courier New', monospace; position: relative; z-index: 1; }

.rfid-footer { display: flex; align-items: flex-end; justify-content: space-between; position: relative; z-index: 1; }
.rfid-instructor-label { font-size: 0.58rem; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 2px; }
.rfid-instructor-name { font-size: 0.86rem; font-weight: 700; color: #fff; margin-bottom: 1px; }
.rfid-instructor-dept { font-size: 0.68rem; color: var(--yellow); }
.rfid-expires-label { font-size: 0.58rem; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 2px; text-align: right; }
.rfid-expires-val { font-size: 0.92rem; font-weight: 700; color: #fff; text-align: right; }

.rfid-tag { margin-top: 12px; font-size: 0.63rem; color: rgba(255,255,255,0.35); font-family: 'Courier New', monospace; display: flex; align-items: center; gap: 6px; position: relative; z-index: 1; }
.rfid-tag i { font-size: 0.7rem; color: rgba(255,255,255,0.3); }

/* CARD ACTIONS */
.ic-actions { display: flex; gap: 8px; padding: 14px 20px; border-top: 1px solid var(--border); }
.btn-reissue {
  flex: 1; display: flex; align-items: center; justify-content: center; gap: 7px;
  padding: 9px; border-radius: 9px; border: none; cursor: pointer;
  font-size: 0.82rem; font-weight: 700; font-family: 'Inter', sans-serif;
  background: #3b5bdb; color: #fff; transition: all 0.18s;
  box-shadow: 0 2px 8px rgba(59,91,219,0.22);
}
.btn-reissue:hover { background: #2f4ac9; transform: translateY(-1px); }
.btn-deactivate {
  flex: 1; display: flex; align-items: center; justify-content: center; gap: 7px;
  padding: 9px; border-radius: 9px; cursor: pointer;
  font-size: 0.82rem; font-weight: 700; font-family: 'Inter', sans-serif;
  background: #fff; color: var(--red); border: 1.5px solid #fecaca; transition: all 0.18s;
}
.btn-deactivate:hover { background: var(--red-bg); }

/* ASSIGNED ROOMS */
.ic-rooms { padding: 14px 20px 18px; }
.ic-rooms-title { display: flex; align-items: center; gap: 8px; font-size: 0.78rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 12px; }
.ic-rooms-title i { font-size: 0.72rem; }
.room-name-label { font-size: 0.88rem; font-weight: 700; color: var(--text); margin-bottom: 8px; }
.room-sched-table { width: 100%; border-collapse: collapse; }
.room-sched-table tr { border-bottom: 1px solid #f3f4f6; }
.room-sched-table tr:last-child { border-bottom: none; }
.room-sched-table td { padding: 6px 0; font-size: 0.78rem; }
.room-sched-table .td-day  { color: var(--text-secondary); width: 80px; }
.room-sched-table .td-time { color: var(--text-secondary); width: 100px; }
.room-sched-table .td-subj { color: #3b5bdb; font-weight: 600; text-align: right; }

/* ANIMATIONS */
@keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
.instructor-card:nth-child(1) { animation: fadeIn 0.35s both 0.2s; }
.instructor-card:nth-child(2) { animation: fadeIn 0.35s both 0.28s; }
.instructor-card:nth-child(3) { animation: fadeIn 0.35s both 0.36s; }
.instructor-card:nth-child(4) { animation: fadeIn 0.35s both 0.44s; }

/* RESPONSIVE */
@media (max-width:1100px) { .cards-grid { grid-template-columns: 1fr; } .stat-row { grid-template-columns: repeat(2,1fr); } }
@media (max-width:768px) { :root { --sidebar-w: 0px; } .sidebar { display: none; } .content { padding: 20px 16px 40px; } .topbar { padding: 0 16px; } .topbar-search { width: 200px; } }
</style>
</head>
<body>

<!-- ════════════════════════════════════════════
     SIDEBAR — EXACT COPY FROM CLASSROOMS
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
      <a href="{{ url('/dashboard') }}">
        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
        Dashboard
      </a>
    </li>
    <li>
      <a href="{{ url('/classrooms') }}">
        <span class="nav-icon"><i class="fas fa-school"></i></span>
        Classrooms
      </a>
    </li>
    <li>
      <a href="{{ url('/schedule') }}">
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
      <a href="{{ url('/smartlocking') }}" class="active">
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
      <div class="page-header-icon"><i class="fas fa-shield-halved"></i></div>
      <div>
        <h1>SmartDoor System</h1>
        <p>RFID-based access control with time-validated entry</p>
      </div>
    </div>

    <!-- Tabs -->
    <div class="tab-bar">
      <button class="tab-btn active">
        <i class="fas fa-credit-card"></i> RFID Access Cards
      </button>
      <button class="tab-btn" onclick="window.location.href='/admin/accessLogs';">
        <i class="fas fa-wave-square"></i> Access Logs
      </button>
      <button class="tab-btn">
        <i class="fas fa-gear"></i> Settings
      </button>
    </div>

    <!-- Section Header -->
    <div class="section-header">
      <div class="section-header-left">
        <h2>RFID Access Cards</h2>
        <p>Manage and monitor RFID cards for instructor access</p>
      </div>
      <div class="search-inline">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search instructors, RFID tags, rooms...">
      </div>
    </div>

    <!-- Stat Tiles -->
    <div class="stat-row">
      <div class="stat-tile tile-blue">
        <div class="stat-tile-top">
          <div>
            <div class="stat-tile-label">Active RFID Cards</div>
          </div>
          <div class="stat-tile-icon-wrap"><i class="fas fa-credit-card"></i></div>
        </div>
        <div class="stat-tile-val">3</div>
      </div>
      <div class="stat-tile tile-green">
        <div class="stat-tile-top">
          <div>
            <div class="stat-tile-label">Total Instructors</div>
          </div>
          <div class="stat-tile-icon-wrap"><i class="fas fa-user-group"></i></div>
        </div>
        <div class="stat-tile-val">4</div>
      </div>
      <div class="stat-tile tile-purple">
        <div class="stat-tile-top">
          <div>
            <div class="stat-tile-label">Assigned Rooms</div>
          </div>
          <div class="stat-tile-icon-wrap"><i class="fas fa-school"></i></div>
        </div>
        <div class="stat-tile-val">4</div>
      </div>
      <div class="stat-tile tile-orange">
        <div class="stat-tile-top">
          <div>
            <div class="stat-tile-label">Pending Cards</div>
          </div>
          <div class="stat-tile-icon-wrap"><i class="fas fa-clock"></i></div>
        </div>
        <div class="stat-tile-val">1</div>
      </div>
    </div>

    <!-- Instructor Cards Grid -->
    <div class="cards-grid">

      <!-- ── Card 1: Prof. Maria Santos ── -->
      <div class="instructor-card">
        <div class="ic-header">
          <img class="ic-avatar" src="https://randomuser.me/api/portraits/women/68.jpg" alt="Prof. Maria Santos">
          <div>
            <div class="ic-name">Prof. Maria Santos</div>
            <div class="ic-dept">Computer Science</div>
            <div class="ic-email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0964687b6068277a68677d667a49797a7c276c6d7c277961">[email&#160;protected]</a></div>
          </div>
        </div>

        <!-- RFID Card Visual -->
        <div class="rfid-card">
          <div class="rfid-row1">
            <div>
              <div class="rfid-institution">PSU Assingan Campus</div>
              <div class="rfid-system">SmartDoor System</div>
            </div>
            <span class="rfid-status-badge badge-active">ACTIVE</span>
          </div>
          <div class="rfid-row2">
            <div class="rfid-chip"><div class="rfid-chip-dot"></div></div>
            <i class="fas fa-wifi rfid-wifi"></i>
          </div>
          <div class="rfid-number-label">Card Number</div>
          <div class="rfid-number">0012345678</div>
          <div class="rfid-footer">
            <div>
              <div class="rfid-instructor-label">Instructor</div>
              <div class="rfid-instructor-name">Prof. Maria Santos</div>
              <div class="rfid-instructor-dept">Computer Science</div>
            </div>
            <div>
              <div class="rfid-expires-label">Expires</div>
              <div class="rfid-expires-val">03/26</div>
            </div>
          </div>
          <div class="rfid-tag"><i class="fas fa-barcode"></i> RFID-A1B2C304E5F6</div>
        </div>

        <!-- Actions -->
        <div class="ic-actions">
          <button class="btn-reissue"><i class="fas fa-rotate"></i> Reissue Card</button>
          <button class="btn-deactivate"><i class="fas fa-circle-xmark"></i> Deactivate</button>
        </div>

        <!-- Assigned Rooms -->
        <div class="ic-rooms">
          <div class="ic-rooms-title"><i class="fas fa-door-open"></i> Assigned Rooms &amp; Schedule</div>
          <div class="room-name-label">CS Lab 301</div>
          <table class="room-sched-table">
            <tr>
              <td class="td-day">Monday</td>
              <td class="td-time">08:00 – 10:00</td>
              <td class="td-subj">Data Structures</td>
            </tr>
            <tr>
              <td class="td-day">Wednesday</td>
              <td class="td-time">13:00 – 15:00</td>
              <td class="td-subj">Algorithms</td>
            </tr>
            <tr>
              <td class="td-day">Friday</td>
              <td class="td-time">10:00 – 12:00</td>
              <td class="td-subj">Database Systems</td>
            </tr>
          </table>
        </div>
      </div>

      <!-- ── Card 2: Dr. Roberto Cruz ── -->
      <div class="instructor-card">
        <div class="ic-header">
          <img class="ic-avatar" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Dr. Roberto Cruz">
          <div>
            <div class="ic-name">Dr. Roberto Cruz</div>
            <div class="ic-dept">Engineering</div>
            <div class="ic-email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="9deff2fff8efe9f2b3feefe8e7ddedeee8b3f8f9e8b3edf5">[email&#160;protected]</a></div>
          </div>
        </div>

        <div class="rfid-card">
          <div class="rfid-row1">
            <div>
              <div class="rfid-institution">PSU Assingan Campus</div>
              <div class="rfid-system">SmartRoom System</div>
            </div>
            <span class="rfid-status-badge badge-active">ACTIVE</span>
          </div>
          <div class="rfid-row2">
            <div class="rfid-chip"><div class="rfid-chip-dot"></div></div>
            <i class="fas fa-wifi rfid-wifi"></i>
          </div>
          <div class="rfid-number-label">Card Number</div>
          <div class="rfid-number">0023456789</div>
          <div class="rfid-footer">
            <div>
              <div class="rfid-instructor-label">Instructor</div>
              <div class="rfid-instructor-name">Dr. Roberto Cruz</div>
              <div class="rfid-instructor-dept">Engineering</div>
            </div>
            <div>
              <div class="rfid-expires-label">Expires</div>
              <div class="rfid-expires-val">03/26</div>
            </div>
          </div>
          <div class="rfid-tag"><i class="fas fa-barcode"></i> RFID-B2C304E5F6A1</div>
        </div>

        <div class="ic-actions">
          <button class="btn-reissue"><i class="fas fa-rotate"></i> Reissue Card</button>
          <button class="btn-deactivate"><i class="fas fa-circle-xmark"></i> Deactivate</button>
        </div>

        <div class="ic-rooms">
          <div class="ic-rooms-title"><i class="fas fa-door-open"></i> Assigned Rooms &amp; Schedule</div>
          <div class="room-name-label">Engineering Lab 401</div>
          <table class="room-sched-table">
            <tr>
              <td class="td-day">Tuesday</td>
              <td class="td-time">09:00 – 11:00</td>
              <td class="td-subj">Thermodynamics</td>
            </tr>
            <tr>
              <td class="td-day">Thursday</td>
              <td class="td-time">14:00 – 16:00</td>
              <td class="td-subj">Fluid Mechanics</td>
            </tr>
          </table>
        </div>
      </div>

      <!-- ── Card 3: Prof. Ana Reyes ── -->
      <div class="instructor-card">
        <div class="ic-header">
          <img class="ic-avatar" src="https://randomuser.me/api/portraits/women/12.jpg" alt="Prof. Ana Reyes">
          <div>
            <div class="ic-name">Prof. Ana Reyes</div>
            <div class="ic-dept">Business Administration</div>
            <div class="ic-email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="52333c337c20372b3721122221277c3736277c223a">[email&#160;protected]</a></div>
          </div>
        </div>

        <div class="rfid-card">
          <div class="rfid-row1">
            <div>
              <div class="rfid-institution">PSU Assingan Campus</div>
              <div class="rfid-system">SmartDoor System</div>
            </div>
            <span class="rfid-status-badge badge-active">ACTIVE</span>
          </div>
          <div class="rfid-row2">
            <div class="rfid-chip"><div class="rfid-chip-dot"></div></div>
            <i class="fas fa-wifi rfid-wifi"></i>
          </div>
          <div class="rfid-number-label">Card Number</div>
          <div class="rfid-number">0034567890</div>
          <div class="rfid-footer">
            <div>
              <div class="rfid-instructor-label">Instructor</div>
              <div class="rfid-instructor-name">Prof. Ana Reyes</div>
              <div class="rfid-instructor-dept">Business Administration</div>
            </div>
            <div>
              <div class="rfid-expires-label">Expires</div>
              <div class="rfid-expires-val">03/26</div>
            </div>
          </div>
          <div class="rfid-tag"><i class="fas fa-barcode"></i> RFID-C304E5F6A1B2</div>
        </div>

        <div class="ic-actions">
          <button class="btn-reissue"><i class="fas fa-rotate"></i> Reissue Card</button>
          <button class="btn-deactivate"><i class="fas fa-circle-xmark"></i> Deactivate</button>
        </div>

        <div class="ic-rooms">
          <div class="ic-rooms-title"><i class="fas fa-door-open"></i> Assigned Rooms &amp; Schedule</div>
          <div class="room-name-label">Business Room 203</div>
          <table class="room-sched-table">
            <tr>
              <td class="td-day">Monday</td>
              <td class="td-time">14:00 – 16:00</td>
              <td class="td-subj">Marketing Management</td>
            </tr>
            <tr>
              <td class="td-day">Wednesday</td>
              <td class="td-time">10:00 – 12:00</td>
              <td class="td-subj">Financial Analysis</td>
            </tr>
            <tr>
              <td class="td-day">Friday</td>
              <td class="td-time">13:00 – 15:00</td>
              <td class="td-subj">Business Strategy</td>
            </tr>
          </table>
        </div>
      </div>

      <!-- ── Card 4: Dr. Carlos Mendoza (PENDING) ── -->
      <div class="instructor-card">
        <div class="ic-header">
          <img class="ic-avatar" src="https://randomuser.me/api/portraits/men/54.jpg" alt="Dr. Carlos Mendoza">
          <div>
            <div class="ic-name">Dr. Carlos Mendoza</div>
            <div class="ic-dept">Mathematics</div>
            <div class="ic-email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="2a494b5846455904474f444e45504b6a5a595f044f4e5f045a42">[email&#160;protected]</a></div>
          </div>
        </div>

        <div class="rfid-card" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 55%,#2563eb 100%);">
          <div class="rfid-row1">
            <div>
              <div class="rfid-institution">PSU Assingan Campus</div>
              <div class="rfid-system">SmartDoor System</div>
            </div>
            <span class="rfid-status-badge badge-pending">PENDING</span>
          </div>
          <div class="rfid-row2">
            <div class="rfid-chip"><div class="rfid-chip-dot"></div></div>
            <i class="fas fa-wifi rfid-wifi"></i>
          </div>
          <div class="rfid-number-label">Card Number</div>
          <div class="rfid-number">0045678901</div>
          <div class="rfid-footer">
            <div>
              <div class="rfid-instructor-label">Instructor</div>
              <div class="rfid-instructor-name">Dr. Carlos Mendoza</div>
              <div class="rfid-instructor-dept">Mathematics</div>
            </div>
            <div>
              <div class="rfid-expires-label">Expires</div>
              <div class="rfid-expires-val">03/26</div>
            </div>
          </div>
          <div class="rfid-tag"><i class="fas fa-barcode"></i> RFID-D4E5F6A1B2C3</div>
        </div>

        <div class="ic-actions">
          <button class="btn-reissue"><i class="fas fa-rotate"></i> Reissue Card</button>
          <button class="btn-deactivate"><i class="fas fa-circle-xmark"></i> Deactivate</button>
        </div>

        <div class="ic-rooms">
          <div class="ic-rooms-title"><i class="fas fa-door-open"></i> Assigned Rooms &amp; Schedule</div>
          <div class="room-name-label">Math Room 105</div>
          <table class="room-sched-table">
            <tr>
              <td class="td-day">Tuesday</td>
              <td class="td-time">08:00 – 10:00</td>
              <td class="td-subj">Calculus II</td>
            </t