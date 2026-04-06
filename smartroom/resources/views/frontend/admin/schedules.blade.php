<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Schedule – SmartDoor</title>
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
  --green-border:  #86efac;
  --blue-bg:       #dbeafe;
  --blue-border:   #93c5fd;
  --blue-text:     #1d4ed8;
  --orange-bg:     #fff7ed;
  --orange-border: #fed7aa;
  --orange-text:   #c2410c;
  --red:           #dc2626;
  --red-bg:        #fee2e2;
  --shadow:        0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
  --shadow-card:   0 2px 8px rgba(0,0,0,0.06);
  --radius:        14px;
  --radius-sm:     10px;
  --sidebar-w:     240px;
}

body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; }

/* ══════════════════════════════════════════════
   SIDEBAR — EXACT COPY FROM CLASSROOMS/DASHBOARD
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

/* ══════════════════════════════════════
   MAIN
══════════════════════════════════════ */
.main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

/* TOPBAR */
.topbar {
  background: var(--white); border-bottom: 1px solid var(--border);
  padding: 0 36px; height: 68px;
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  position: sticky; top: 0; z-index: 50;
}
.topbar-search {
  display: flex; align-items: center; gap: 10px;
  background: var(--bg); border: 1.5px solid var(--border);
  border-radius: 24px; padding: 9px 20px; width: 380px;
  transition: border-color 0.2s, box-shadow 0.2s;
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
.topbar-profile img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2.5px solid var(--border); }

/* ══════════════════════════════════════
   CONTENT
══════════════════════════════════════ */
.content { padding: 32px 36px 48px; display: flex; flex-direction: column; gap: 24px; }

/* PAGE HEADER */
.page-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; animation: fadeIn 0.35s both; }
.page-header-left { display: flex; align-items: center; gap: 14px; }
.page-header-icon { width: 44px; height: 44px; border-radius: 12px; background: var(--yellow-bg); border: 1.5px solid rgba(245,197,24,0.3); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: #b45309; }
.page-header-left h1 { font-size: 1.55rem; font-weight: 800; color: var(--text); letter-spacing: -0.02em; margin-bottom: 3px; }
.page-header-left p { font-size: 0.88rem; color: var(--text-secondary); }
.page-header-right { display: flex; align-items: center; gap: 10px; }
.btn-filter {
  display: flex; align-items: center; gap: 7px;
  padding: 10px 18px; border-radius: 10px;
  font-size: 0.86rem; font-weight: 600; font-family: 'Inter', sans-serif;
  background: var(--white); color: var(--text-secondary);
  border: 1.5px solid var(--border); cursor: pointer;
  transition: all 0.18s; box-shadow: var(--shadow);
}
.btn-filter:hover { border-color: #93c5fd; color: var(--text); }
.btn-add {
  display: flex; align-items: center; gap: 8px;
  padding: 10px 22px; border-radius: 10px;
  font-size: 0.88rem; font-weight: 700; font-family: 'Inter', sans-serif;
  background: var(--navy); color: #fff; border: none; cursor: pointer;
  transition: all 0.2s; box-shadow: 0 4px 14px rgba(11,22,64,0.22);
}
.btn-add:hover { background: var(--navy-mid); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(11,22,64,0.3); }

/* CALENDAR NAV */
.calendar-nav {
  background: var(--white); border-radius: var(--radius);
  border: 1.5px solid var(--border); box-shadow: var(--shadow-card);
  padding: 14px 20px;
  display: flex; align-items: center; gap: 12px;
  animation: fadeIn 0.35s both 0.06s;
}
.cal-arrow { width: 32px; height: 32px; border-radius: 8px; border: 1.5px solid var(--border); background: var(--white); cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); font-size: 0.85rem; transition: all 0.18s; }
.cal-arrow:hover { border-color: #93c5fd; color: var(--text); background: var(--bg); }
.cal-month { font-size: 1rem; font-weight: 700; color: var(--text); margin-right: 4px; min-width: 130px; }
.cal-today-btn { padding: 6px 14px; border-radius: 8px; border: 1.5px solid var(--blue-border); background: var(--blue-bg); color: var(--blue-text); font-size: 0.8rem; font-weight: 600; font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.18s; }
.cal-today-btn:hover { background: #bfdbfe; }
.cal-days { display: flex; gap: 4px; margin-left: 4px; }
.cal-day { padding: 7px 16px; border-radius: 9px; font-size: 0.86rem; font-weight: 600; color: var(--text-secondary); cursor: pointer; transition: all 0.18s; border: 1.5px solid transparent; }
.cal-day:hover { background: var(--bg); color: var(--text); }
.cal-day.active { background: var(--navy); color: #fff; border-color: var(--navy); font-weight: 700; }
.cal-day.short { padding: 7px 10px; }
.cal-spacer { flex: 1; }
.cal-icon-btn { width: 34px; height: 34px; border-radius: 8px; border: 1.5px solid var(--border); background: var(--white); cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); font-size: 0.85rem; transition: all 0.18s; }
.cal-icon-btn:hover { border-color: #93c5fd; color: var(--text); }

/* SCHEDULE LIST */
.schedule-section { animation: fadeIn 0.35s both 0.12s; }
.schedule-day-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; }
.schedule-day-label { display: flex; align-items: center; gap: 8px; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-secondary); }
.schedule-day-label::before { content: ''; width: 8px; height: 8px; border-radius: 50%; background: var(--navy-mid); }
.schedule-count { font-size: 0.82rem; color: var(--text-secondary); font-weight: 500; }

.schedule-list { display: flex; flex-direction: column; gap: 12px; }

/* SCHEDULE CARD */
.schedule-card {
  background: var(--white); border-radius: var(--radius);
  border: 1.5px solid var(--border); box-shadow: var(--shadow-card);
  display: flex; align-items: center; gap: 0;
  overflow: hidden;
  transition: transform 0.22s cubic-bezier(0.16,1,0.3,1), box-shadow 0.22s, border-color 0.22s;
  cursor: pointer; text-decoration: none; color: inherit;
}
.schedule-card:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,0.1); border-color: #bfdbfe; }
.schedule-card:active { transform: translateY(0); }

/* left time column */
.sc-time {
  width: 96px; flex-shrink: 0;
  padding: 20px 0 20px 20px;
  display: flex; flex-direction: column; gap: 2px;
}
.sc-time-start { font-size: 0.9rem; font-weight: 700; color: var(--text); }
.sc-time-end   { font-size: 0.78rem; color: var(--text-secondary); }

/* left accent bar */
.sc-bar { width: 4px; background: var(--navy-mid); border-radius: 0; flex-shrink: 0; align-self: stretch; margin-right: 18px; }
.sc-bar.bar-blue   { background: linear-gradient(180deg, #1d4ed8, #60a5fa); }
.sc-bar.bar-green  { background: linear-gradient(180deg, #16a34a, #4ade80); }
.sc-bar.bar-orange { background: linear-gradient(180deg, #d97706, #fbbf24); }
.sc-bar.bar-purple { background: linear-gradient(180deg, #7c3aed, #a78bfa); }

/* room badge */
.sc-room-badge {
  width: 52px; height: 52px; border-radius: 12px;
  background: var(--bg); border: 1.5px solid var(--border);
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem; font-weight: 800; color: var(--navy-mid); flex-shrink: 0;
  margin-right: 16px;
}

/* main info */
.sc-info { flex: 1; padding: 18px 0; }
.sc-title-row { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; }
.sc-subject { font-size: 1rem; font-weight: 700; color: var(--text); }
.sc-code { padding: 2px 9px; border-radius: 6px; background: var(--blue-bg); color: var(--blue-text); font-size: 0.72rem; font-weight: 700; letter-spacing: 0.04em; border: 1px solid var(--blue-border); }
.sc-meta { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
.sc-meta-item { display: flex; align-items: center; gap: 5px; font-size: 0.8rem; color: var(--text-secondary); }
.sc-meta-item i { font-size: 0.72rem; color: var(--text-light); }
.sc-tag { display: inline-flex; align-items: center; gap: 5px; font-size: 0.75rem; font-weight: 600; color: var(--green); margin-top: 6px; }
.sc-tag i { font-size: 0.68rem; }

/* avatars */
.sc-avatars { display: flex; align-items: center; margin-right: 12px; flex-shrink: 0; }
.sc-avatar { width: 30px; height: 30px; border-radius: 50%; border: 2px solid var(--white); object-fit: cover; margin-left: -8px; background: #d1d5db; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700; color: #fff; overflow: hidden; }
.sc-avatar:first-child { margin-left: 0; }
.sc-avatar-more { width: 30px; height: 30px; border-radius: 50%; border: 2px solid var(--white); background: var(--bg); display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700; color: var(--text-secondary); margin-left: -8px; }

/* right actions */
.sc-actions { display: flex; align-items: center; gap: 8px; padding: 0 18px 0 8px; flex-shrink: 0; }
.sc-more-btn { width: 32px; height: 32px; border-radius: 8px; border: 1.5px solid var(--border); background: var(--white); cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); font-size: 0.85rem; transition: all 0.18s; }
.sc-more-btn:hover { border-color: #93c5fd; color: var(--text); }
.sc-edit-btn { padding: 8px 18px; border-radius: 9px; background: var(--navy); color: #fff; font-size: 0.82rem; font-weight: 700; font-family: 'Inter', sans-serif; border: none; cursor: pointer; transition: all 0.18s; }
.sc-edit-btn:hover { background: var(--navy-mid); }

/* AI ADVISOR */
.ai-advisor {
  background: var(--orange-bg); border: 1.5px solid var(--orange-border);
  border-radius: var(--radius); padding: 20px 24px;
  display: flex; gap: 16px; align-items: flex-start;
  animation: fadeIn 0.35s both 0.2s;
}
.ai-icon { width: 42px; height: 42px; border-radius: 11px; background: rgba(245,197,24,0.2); border: 1px solid rgba(245,197,24,0.35); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #b45309; flex-shrink: 0; }
.ai-body {}
.ai-title { font-size: 0.92rem; font-weight: 700; color: var(--orange-text); margin-bottom: 5px; }
.ai-text { font-size: 0.84rem; color: #78350f; line-height: 1.65; margin-bottom: 10px; }
.ai-action { font-size: 0.84rem; font-weight: 700; color: var(--orange-text); text-decoration: none; cursor: pointer; background: none; border: none; font-family: 'Inter', sans-serif; padding: 0; }
.ai-action:hover { text-decoration: underline; }

/* AVATAR COLORS */
.av-1 { background: #1d4ed8; }
.av-2 { background: #7c3aed; }
.av-3 { background: #0f766e; }

/* ANIMATIONS */
@keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

/* RESPONSIVE */
@media (max-width:900px) { :root { --sidebar-w: 0px; } .sidebar { display: none; } .content { padding: 20px 16px 40px; } .topbar { padding: 0 16px; } .topbar-search { width: 220px; } }
</style>
</head>
<body>

<!-- ══════════════════════════ SIDEBAR — EXACT COPY FROM CLASSROOMS ══════════════════════════ -->
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
      <a href="{{ url('/schedule') }}" class="active">
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

<!-- ══════════════════════════ MAIN ══════════════════════════ -->
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
        <div class="page-header-icon"><i class="fas fa-calendar-days"></i></div>
        <div>
          <h1>Class Schedule Management</h1>
          <p>Manage and coordinate classroom schedules across PSU campus.</p>
        </div>
      </div>
      <div class="page-header-right">
        <button class="btn-filter">
          <i class="fas fa-sliders"></i> Filter
        </button>
        <button class="btn-add">
          <i class="fas fa-plus"></i> Add Schedule
        </button>
      </div>
    </div>

    <!-- Calendar Nav -->
    <div class="calendar-nav">
      <button class="cal-arrow"><i class="fas fa-chevron-left"></i></button>
      <span class="cal-month">February 2026</span>
      <button class="cal-arrow"><i class="fas fa-chevron-right"></i></button>

      <button class="cal-today-btn">Today</button>

      <div class="cal-days">
        <span class="cal-day active">Monday</span>
        <span class="cal-day">Tuesday</span>
        <span class="cal-day">Wednesday</span>
        <span class="cal-day short">T</span>
        <span class="cal-day short">F</span>
        <span class="cal-day short">S</span>
      </div>

      <div class="cal-spacer"></div>
      <button class="cal-icon-btn"><i class="fas fa-search"></i></button>
      <button class="cal-icon-btn"><i class="fas fa-calendar"></i></button>
    </div>

    <!-- Schedule List -->
    <div class="schedule-section">
      <div class="schedule-day-header">
        <div class="schedule-day-label">Monday's Classes</div>
        <div class="schedule-count">2 Sessions Scheduled</div>
      </div>

      <div class="schedule-list">

        <!-- Card 1 — Web Development -->
        <a href="schedule-detail.html" class="schedule-card" onclick="goToDetail(event)">
          <div class="sc-time">
            <div class="sc-time-start">08:00 AM</div>
            <div class="sc-time-end">10:00 AM</div>
          </div>
          <div class="sc-bar bar-blue"></div>
          <div class="sc-room-badge">101</div>
          <div class="sc-info">
            <div class="sc-title-row">
              <span class="sc-subject">Web Development</span>
              <span class="sc-code">IT-301</span>
            </div>
            <div class="sc-meta">
              <span class="sc-meta-item"><i class="fas fa-user"></i> Dr. Santos</span>
              <span class="sc-meta-item"><i class="fas fa-location-dot"></i> Room 101, IT Building</span>
            </div>
            <div class="sc-tag">
              <i class="fas fa-circle-check"></i> Laboratory
            </div>
          </div>
          <div class="sc-avatars">
            <div class="sc-avatar av-1">JS</div>
            <div class="sc-avatar av-2">MR</div>
            <div class="sc-avatar av-3">LC</div>
            <div class="sc-avatar-more">+32</div>
          </div>
          <div class="sc-actions">
            <button class="sc-more-btn" onclick="event.stopPropagation()"><i class="fas fa-ellipsis-vertical"></i></button>
            <button class="sc-edit-btn" onclick="event.stopPropagation()">Edit</button>
          </div>
        </a>

        <!-- Card 2 — Database Systems -->
        <a href="schedule-detail.html" class="schedule-card" onclick="goToDetail(event)">
          <div class="sc-time">
            <div class="sc-time-start">10:30 AM</div>
            <div class="sc-time-end">12:30 PM</div>
          </div>
          <div class="sc-bar bar-purple"></div>
          <div class="sc-room-badge">105</div>
          <div class="sc-info">
            <div class="sc-title-row">
              <span class="sc-subject">Database Systems</span>
              <span class="sc-code">IT-302</span>
            </div>
            <div class="sc-meta">
              <span class="sc-meta-item"><i class="fas fa-user"></i> Prof. Cruz</span>
              <span class="sc-meta-item"><i class="fas fa-location-dot"></i> Lab 105, IT Building</span>
            </div>
            <div class="sc-tag">
              <i class="fas fa-circle-check"></i> Laboratory
            </div>
          </div>
          <div class="sc-avatars">
            <div class="sc-avatar av-2">AL</div>
            <div class="sc-avatar av-1">BP</div>
            <div class="sc-avatar av-3">CR</div>
            <div class="sc-avatar-more">+32</div>
          </div>
          <div class="sc-actions">
            <button class="sc-more-btn" onclick="event.stopPropagation()"><i class="fas fa-ellipsis-vertical"></i></button>
            <button class="sc-edit-btn" onclick="event.stopPropagation()">Edit</button>
          </div>
        </a>

        <!-- Card 3 — Data Structures (links to detail) -->
        <a href="schedule-detail.html" class="schedule-card" onclick="goToDetail(event)">
          <div class="sc-time">
            <div class="sc-time-start">01:00 PM</div>
            <div class="sc-time-end">02:30 PM</div>
          </div>
          <div class="sc-bar bar-green"></div>
          <div class="sc-room-badge" style="color:#16a34a;border-color:#86efac;background:#f0fdf4;">DS</div>
          <div class="sc-info">
            <div class="sc-title-row">
              <span class="sc-subject">Data Structures & Algorithms</span>
              <span class="sc-code" style="background:#dcfce7;color:#16a34a;border-color:#86efac;">IT-303</span>
            </div>
            <div class="sc-meta">
              <span class="sc-meta-item"><i class="fas fa-user"></i> Prof. Elena Santos</span>
              <span class="sc-meta-item"><i class="fas fa-location-dot"></i> Room 101, Main Building</span>
            </div>
            <div class="sc-tag">
              <i class="fas fa-circle-check"></i> Lecture
            </div>
          </div>
          <div class="sc-avatars">
            <div class="sc-avatar av-3">JR</div>
            <div class="sc-avatar av-1">ML</div>
            <div class="sc-avatar av-2">RC</div>
            <div class="sc-avatar-more">+35</div>
          </div>
          <div class="sc-actions">
            <button class="sc-more-btn" onclick="event.stopPropagation()"><i class="fas fa-ellipsis-vertical"></i></button>
            <button class="sc-edit-btn" onclick="event.stopPropagation()">Edit</button>
          </div>
        </a>

      </div>
    </div>

    <!-- AI Advisor -->
    <div class="ai-advisor">
      <div class="ai-icon"><i class="fas fa-calendar-days"></i></div>
      <div class="ai-body">
        <div class="ai-title">AI Schedule Advisor</div>
        <div class="ai-text">
          You have a potential conflict on Monday at 10:00 AM. Room 101 has back-to-back classes with only 5 minutes of buffer time. We recommend shifting "Database Systems" to 10:45 AM to allow for sanitization and student transitions.
        </div>
        <button class="ai-action">Optimize Schedule →</button>
      </div>
    </div>

  </div>
</div>

<!-- ══════════════════════════ DETAIL VIEW (hidden by default) ══════════════════════════ -->
<div id="detailView" style="display:none; position:fixed; inset:0; z-index:200; background:var(--bg); overflow-y:auto; margin-left:var(--sidebar-w);">
  <div style="background:var(--white);border-bottom:1px solid var(--border);padding:0 36px;height:64px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:10;">
    <div style="display:flex;align-items:center;gap:14px;">
      <button onclick="closeDetail()" style="display:flex;align-items:center;gap:7px;padding:8px 16px;border-radius:9px;border:1.5px solid var(--border);background:var(--white);font-size:0.84rem;font-weight:600;color:var(--text-secondary);cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.18s;" onmouseover="this.style.borderColor='#93c5fd';this.style.color='var(--text)'" onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-secondary)'">
        <i class="fas fa-arrow-left"></i> Back to Schedule
      </button>
      <div style="font-size:0.85rem;color:var(--text-secondary);display:flex;align-items:center;gap:7px;">
        <a href="#" onclick="closeDetail();return false;" style="color:var(--text-secondary);text-decoration:none;">Schedule</a>
        <span style="color:var(--text-light);">›</span>
        <span style="color:var(--text);font-weight:600;">IT 301 – Data Structures</span>
      </div>
    </div>
    <div></div>
  </div>
  <div id="detailContent" style="padding:32px 36px 64px;"></div>
</div>

<script>
/* ── DAY TAB SWITCHING ── */
document.querySelectorAll('.cal-day').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.cal-day').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
  });
});

/* ── NAVIGATE TO DETAIL VIEW ── */
function goToDetail(e) {
  e.preventDefault();
  document.getElementById('detailView').style.display = 'block';
  document.body.style.overflow = 'hidden';
  renderDetail();
}

function closeDetail() {
  document.getElementById('detailView').style.display = 'none';
  document.body.style.overflow = '';
}

function renderDetail() {
  document.getElementById('detailContent').innerHTML = `
    <!-- HERO HEADER -->
    <div style="background:linear-gradient(135deg,#0b1640 0%,#1a2f80 100%);border-radius:18px;padding:32px 36px;display:flex;align-items:center;justify-content:space-between;gap:24px;position:relative;overflow:hidden;box-shadow:0 8px 32px rgba(11,22,64,0.18);margin-bottom:24px;">
      <div style="position:absolute;top:-60px;right:-60px;width:260px;height:260px;border-radius:50%;border:1px solid rgba(245,197,24,0.1);pointer-events:none;"></div>
      <div style="display:flex;align-items:center;gap:20px;flex:1;position:relative;z-index:1;">
        <div style="width:64px;height:64px;border-radius:16px;background:rgba(245,197,24,0.15);border:1.5px solid rgba(245,197,24,0.3);display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0;">📚</div>
        <div>
          <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:rgba(245,197,24,0.8);margin-bottom:5px;">IT 301 · BSIT 3rd Year</div>
          <div style="font-size:1.55rem;font-weight:800;color:#fff;letter-spacing:-0.02em;line-height:1.2;margin-bottom:6px;">Data Structures & Algorithms</div>
          <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
            <span style="display:flex;align-items:center;gap:6px;font-size:0.82rem;color:rgba(255,255,255,0.55);"><i class="fas fa-location-dot" style="color:rgba(245,197,24,0.6);font-size:0.75rem;"></i> Room 101 – CIT Laboratory</span>
            <span style="display:flex;align-items:center;gap:6px;font-size:0.82rem;color:rgba(255,255,255,0.55);"><i class="fas fa-clock" style="color:rgba(245,197,24,0.6);font-size:0.75rem;"></i> MWF · 7:30–9:00 AM</span>
            <span style="display:flex;align-items:center;gap:6px;font-size:0.82rem;color:rgba(255,255,255,0.55);"><i class="fas fa-building" style="color:rgba(245,197,24,0.6);font-size:0.75rem;"></i> Main Building · Ground Floor</span>
          </div>
        </div>
      </div>
      <div style="display:flex;flex-direction:column;align-items:flex-end;gap:12px;position:relative;z-index:1;flex-shrink:0;">
        <span style="display:inline-flex;align-items:center;gap:7px;padding:7px 16px;border-radius:100px;font-size:0.78rem;font-weight:700;letter-spacing:0.04em;background:rgba(245,197,24,0.15);color:#f5c518;border:1px solid rgba(245,197,24,0.3);">
          <span style="width:6px;height:6px;border-radius:50%;background:#f5c518;box-shadow:0 0 6px rgba(245,197,24,0.6);"></span>
          ONGOING
        </span>
        <div style="display:flex;gap:8px;">
          <button style="display:flex;align-items:center;gap:7px;padding:9px 18px;border-radius:9px;font-size:0.84rem;font-weight:600;font-family:'Inter',sans-serif;border:1.5px solid rgba(255,255,255,0.2);color:rgba(255,255,255,0.8);background:rgba(255,255,255,0.07);cursor:pointer;"><i class="fas fa-pen"></i> Edit</button>
          <button style="display:flex;align-items:center;gap:7px;padding:9px 18px;border-radius:9px;font-size:0.84rem;font-weight:700;font-family:'Inter',sans-serif;background:#f5c518;color:#0b1640;border:none;cursor:pointer;box-shadow:0 4px 14px rgba(245,197,24,0.35);"><i class="fas fa-print"></i> Export</button>
        </div>
      </div>
    </div>

    <!-- QUICK STATS -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px;">
      ${[
        {icon:'fas fa-users',     bg:'#dbeafe', co:'#1d4ed8', val:'38',  label:'Enrolled Students'},
        {icon:'fas fa-circle-check', bg:'#dcfce7', co:'#16a34a', val:'35', label:'Present Today'},
        {icon:'fas fa-calendar-days', bg:'#fff8e1', co:'#b45309', val:'14', label:'Sessions Done'},
        {icon:'fas fa-star',      bg:'#ede9fe', co:'#7c3aed', val:'92%', label:'Avg. Attendance'},
      ].map(s=>`
        <div style="background:#fff;border-radius:14px;border:1.5px solid #e8ecf3;padding:18px 20px;box-shadow:0 2px 8px rgba(0,0,0,0.06);display:flex;align-items:center;gap:14px;">
          <div style="width:40px;height:40px;border-radius:10px;background:${s.bg};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="${s.icon}" style="color:${s.co};font-size:1rem;"></i>
          </div>
          <div>
            <div style="font-size:1.5rem;font-weight:800;color:#111827;letter-spacing:-0.03em;line-height:1;">${s.val}</div>
            <div style="font-size:0.76rem;color:#6b7280;font-weight:500;margin-top:3px;">${s.label}</div>
          </div>
        </div>
      `).join('')}
    </div>

    <!-- TWO COL -->
    <div style="display:grid;grid-template-columns:1.1fr 0.9fr;gap:20px;margin-bottom:24px;">
      <!-- Course Info -->
      <div style="background:#fff;border-radius:14px;border:1.5px solid #e8ecf3;box-shadow:0 2px 8px rgba(0,0,0,0.06);overflow:hidden;">
        <div style="padding:18px 24px 14px;display:flex;align-items:center;gap:10px;border-bottom:1px solid #e8ecf3;font-size:0.95rem;font-weight:700;color:#111827;">
          <div style="width:30px;height:30px;border-radius:8px;background:#dbeafe;display:flex;align-items:center;justify-content:center;"><i class="fas fa-book-open" style="color:#1d4ed8;font-size:0.8rem;"></i></div>
          Course Information
        </div>
        <div style="padding:16px 24px;">
          ${[
            ['Course Code','IT 301'],
            ['Section','BSIT 3-A'],
            ['Time','7:30 AM – 9:00 AM'],
            ['Room','Room 101 – CIT Laboratory'],
            ['Building','Main Building · Ground Floor'],
            ['Capacity','40 Students'],
          ].map(([l,v])=>`
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f3f4f6;">
              <span style="font-size:0.78rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.06em;">${l}</span>
              <span style="font-size:0.88rem;color:#111827;font-weight:500;">${v}</span>
            </div>
          `).join('')}
          <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;">
            <span style="font-size:0.78rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.06em;">Meeting Days</span>
            <div style="display:flex;gap:4px;">
              ${['Mon','Tue','Wed','Thu','Fri'].map((d,i)=>`<span style="padding:3px 9px;border-radius:6px;font-size:0.72rem;font-weight:700;background:${[0,2,4].includes(i)?'#0b1640':'#f4f6f9'};color:${[0,2,4].includes(i)?'#fff':'#9ca3af'};">${d}</span>`).join('')}
            </div>
          </div>
        </div>
      </div>

      <!-- Instructor + Enrollment -->
      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="background:#fff;border-radius:14px;border:1.5px solid #e8ecf3;box-shadow:0 2px 8px rgba(0,0,0,0.06);overflow:hidden;">
          <div style="padding:18px 24px 14px;display:flex;align-items:center;gap:10px;border-bottom:1px solid #e8ecf3;font-size:0.95rem;font-weight:700;color:#111827;">
            <div style="width:30px;height:30px;border-radius:8px;background:#fff8e1;display:flex;align-items:center;justify-content:center;"><i class="fas fa-user-tie" style="color:#b45309;font-size:0.8rem;"></i></div>
            Instructor
          </div>
          <div style="padding:16px 24px;">
            <div style="background:rgba(11,22,64,0.03);border:1px solid rgba(11,22,64,0.08);border-radius:12px;padding:14px;display:flex;align-items:center;gap:12px;margin-bottom:14px;">
              <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#0b1640,#1a2f80);display:flex;align-items:center;justify-content:center;font-size:0.88rem;font-weight:700;color:#fff;border:2px solid rgba(245,197,24,0.3);flex-shrink:0;">ES</div>
              <div>
                <div style="font-size:0.92rem;font-weight:700;color:#111827;margin-bottom:2px;">Prof. Elena Santos</div>
                <div style="font-size:0.76rem;color:#6b7280;"><i class="fas fa-envelope" style="font-size:0.68rem;margin-right:4px;"></i>e.santos@psu.edu.ph</div>
              </div>
            </div>
          </div>
        </div>
        <div style="background:#fff;border-radius:14px;border:1.5px solid #e8ecf3;box-shadow:0 2px 8px rgba(0,0,0,0.06);overflow:hidden;">
          <div style="padding:18px 24px 14px;display:flex;align-items:center;gap:10px;border-bottom:1px solid #e8ecf3;font-size:0.95rem;font-weight:700;color:#111827;">
            <div style="width:30px;height:30px;border-radius:8px;background:#dcfce7;display:flex;align-items:center;justify-content:center;"><i class="fas fa-chart-pie" style="color:#16a34a;font-size:0.8rem;"></i></div>
            Enrollment
          </div>
          <div style="padding:16px 24px;">
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-bottom:14px;">
              ${[['38','Enrolled'],['2','Available'],['95%','Fill Rate']].map(([v,l])=>`<div style="text-align:center;padding:10px 8px;background:#f4f6f9;border-radius:10px;border:1px solid #e8ecf3;"><div style="font-size:1.3rem;font-weight:800;color:#111827;">${v}</div><div style="font-size:0.7rem;color:#6b7280;margin-top:2px;">${l}</div></div>`).join('')}
            </div>
            <div style="font-size:0.75rem;color:#6b7280;display:flex;justify-content:space-between;margin-bottom:5px;"><span>Enrollment Progress</span><span>38/40</span></div>
            <div style="height:7px;background:#e8ecf3;border-radius:99px;overflow:hidden;"><div style="width:95%;height:100%;background:linear-gradient(90deg,#d97706,#fbbf24);border-radius:99px;"></div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- UPCOMING SESSIONS -->
    <div style="background:#fff;border-radius:14px;border:1.5px solid #e8ecf3;box-shadow:0 2px 8px rgba(0,0,0,0.06);overflow:hidden;margin-bottom:24px;">
      <div style="padding:18px 24px 14px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #e8ecf3;">
        <div style="display:flex;align-items:center;gap:10px;font-size:0.95rem;font-weight:700;color:#111827;">
          <div style="width:30px;height:30px;border-radius:8px;background:#fff8e1;display:flex;align-items:center;justify-content:center;"><i class="fas fa-calendar-check" style="color:#b45309;font-size:0.8rem;"></i></div>
          Upcoming Sessions
        </div>
        <a href="#" style="font-size:0.82rem;font-weight:600;color:#1a2f80;text-decoration:none;">Full Calendar</a>
      </div>
      <div style="padding:16px 24px;display:flex;flex-direction:column;gap:8px;">
        ${[
          {day:'Today',num:'23',subj:'Session 15 – Trees & Graphs',time:'7:30–9:00 AM',room:'Room 101',today:true},
          {day:'Wed',  num:'25',subj:'Session 16 – Sorting Algorithms',time:'7:30–9:00 AM',room:'Room 101',today:false},
          {day:'Fri',  num:'27',subj:'Session 17 – Dynamic Programming',time:'7:30–9:00 AM',room:'Room 101',today:false},
          {day:'Mon',  num:'30',subj:'Session 18 – Graph Traversal',time:'7:30–9:00 AM',room:'Room 101',today:false},
        ].map(s=>`
          <div style="display:flex;align-items:center;gap:14px;padding:12px 14px;border-radius:10px;border:1.5px solid ${s.today?'rgba(245,197,24,0.35)':'#e8ecf3'};background:#f4f6f9;transition:all 0.18s;">
            <div style="width:44px;text-align:center;flex-shrink:0;background:${s.today?'#b45309':'#0b1640'};border-radius:9px;padding:6px 4px;">
              <div style="font-size:0.6rem;font-weight:700;color:rgba(245,197,24,0.8);text-transform:uppercase;letter-spacing:0.08em;">${s.day}</div>
              <div style="font-size:1.05rem;font-weight:800;color:#fff;line-height:1;margin-top:1px;">${s.num}</div>
            </div>
            <div style="flex:1;">
              <div style="font-size:0.86rem;font-weight:600;color:#111827;margin-bottom:2px;">${s.subj}</div>
              <div style="font-size:0.74rem;color:#6b7280;display:flex;gap:10px;">
                <span><i class="fas fa-clock" style="font-size:0.65rem;margin-right:3px;"></i>${s.time}</span>
                <span><i class="fas fa-door-open" style="font-size:0.65rem;margin-right:3px;"></i>${s.room}</span>
              </div>
            </div>
            <span style="font-size:0.68rem;font-weight:700;padding:3px 9px;border-radius:6px;background:${s.today?'#fff8e1':'#dbeafe'};color:${s.today?'#b45309':'#1d4ed8'};">${s.today?'TODAY':'UPCOMING'}</span>
          </div>
        `).join('')}
      </div>
    </div>
  `;
}
</script>

</body>
</html>