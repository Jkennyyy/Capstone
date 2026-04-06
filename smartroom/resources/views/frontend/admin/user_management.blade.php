<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Management – SmartRoom</title>

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
  --orange-bg:     #ffedd5;
  --orange-border: #fdba74;
  --orange-text:   #c2410c;
  --red:           #dc2626;
  --red-bg:        #fee2e2;
  --red-border:    #fca5a5;
  --purple-bg:     #f3e8ff;
  --purple-border: #d8b4fe;
  --purple-text:   #7c3aed;
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

/* ══ SIDEBAR ══ */
.sidebar {
  position: fixed; left: 0; top: 0;
  width: var(--sidebar-w); height: 100vh;
  background: var(--navy);
  display: flex; flex-direction: column;
  overflow: hidden; z-index: 100;
}
.sidebar::before {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(160deg, rgba(245,197,24,0.06) 0%, transparent 55%);
  pointer-events: none;
}
.sidebar::after {
  content: ''; position: absolute;
  bottom: -60px; right: -60px;
  width: 180px; height: 180px;
  border-radius: 50%;
  border: 1px solid rgba(245,197,24,0.08);
  pointer-events: none;
}
.sidebar-logo {
  display: flex; align-items: center; gap: 12px;
  padding: 28px 20px 24px 24px;
  text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,0.06);
  margin-bottom: 8px;
}
.logo-mark {
  width: 40px; height: 40px;
  background: var(--yellow); border-radius: 12px;
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
.logo-text .brand-main { font-size: 1.05rem; font-weight: 700; color: #fff; letter-spacing: -0.01em; }
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
.user-widget-name { font-size: 0.83rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.user-widget-role { font-size: 0.73rem; color: rgba(255,255,255,0.4); }
.sidebar-logout-btn {
  display: flex; align-items: center; gap: 10px;
  padding: 9px 12px; color: rgba(255,255,255,0.4);
  font-size: 0.84rem; font-weight: 500; border-radius: var(--radius-sm);
  transition: all 0.22s; width: 100%;
  background: none; border: none; cursor: pointer; font-family: inherit;
}
.sidebar-logout-btn:hover { color: #f87171; background: rgba(244,63,94,0.08); }

/* ══ MAIN ══ */
.main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

.topbar {
  background: var(--white); border-bottom: 1px solid var(--border);
  padding: 0 36px; height: 64px;
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  position: sticky; top: 0; z-index: 50;
  box-shadow: 0 1px 0 var(--border);
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

/* ══ CONTENT ══ */
.content { padding: 32px 36px 48px; display: flex; flex-direction: column; gap: 24px; }

/* ── Page Header ── */
.page-header { display: flex; align-items: flex-start; justify-content: space-between; }
.page-header-left h1 { font-size: 1.55rem; font-weight: 800; color: var(--text); letter-spacing: -0.02em; margin-bottom: 4px; }
.page-header-left p { font-size: 0.92rem; color: var(--text-secondary); }

.btn-primary {
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--navy); color: #fff;
  font-size: 0.88rem; font-weight: 600;
  padding: 10px 20px; border-radius: 10px;
  border: none; cursor: pointer; font-family: 'Inter', sans-serif;
  transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
  box-shadow: 0 2px 8px rgba(11,22,64,0.18);
  text-decoration: none;
}
.btn-primary:hover { background: var(--navy-mid); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(11,22,64,0.22); }
.btn-primary i { font-size: 0.82rem; }

/* ── Summary Cards ── */
.summary-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; }
.sum-card {
  background: var(--white); border-radius: var(--radius);
  border: 1.5px solid var(--border); padding: 20px 22px;
  box-shadow: var(--shadow-card);
  display: flex; align-items: center; gap: 16px;
  transition: transform 0.2s, box-shadow 0.2s;
}
.sum-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
.sum-icon {
  width: 46px; height: 46px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.2rem; flex-shrink: 0;
}
.sum-info { flex: 1; }
.sum-value { font-size: 1.8rem; font-weight: 800; letter-spacing: -0.04em; line-height: 1; margin-bottom: 3px; }
.sum-label { font-size: 0.82rem; color: var(--text-secondary); font-weight: 500; }

/* ── Toolbar ── */
.toolbar {
  display: flex; align-items: center; gap: 12px;
  background: var(--white); border: 1.5px solid var(--border);
  border-radius: var(--radius); padding: 16px 20px;
  box-shadow: var(--shadow-card);
}
.toolbar-search {
  display: flex; align-items: center; gap: 9px;
  background: var(--bg); border: 1.5px solid var(--border);
  border-radius: 8px; padding: 8px 14px; flex: 1; max-width: 340px;
  transition: border-color 0.2s;
}
.toolbar-search:focus-within { border-color: #93c5fd; }
.toolbar-search i { color: var(--text-light); font-size: 0.85rem; }
.toolbar-search input { border: none; outline: none; background: transparent; font-size: 0.88rem; font-family: 'Inter', sans-serif; color: var(--text); width: 100%; }
.toolbar-search input::placeholder { color: var(--text-light); }

.filter-group { display: flex; align-items: center; gap: 8px; margin-left: auto; }
.filter-select {
  background: var(--bg); border: 1.5px solid var(--border);
  border-radius: 8px; padding: 8px 32px 8px 12px;
  font-size: 0.85rem; font-family: 'Inter', sans-serif; font-weight: 500;
  color: var(--text); cursor: pointer; outline: none;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 10px center;
  transition: border-color 0.2s;
}
.filter-select:focus { border-color: #93c5fd; }

.btn-icon {
  width: 38px; height: 38px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  background: var(--bg); border: 1.5px solid var(--border);
  color: var(--text-secondary); cursor: pointer; font-size: 0.9rem;
  transition: all 0.2s;
}
.btn-icon:hover { border-color: #93c5fd; color: var(--blue-text); background: var(--blue-bg); }

/* ── Table Card ── */
.table-card {
  background: var(--white); border-radius: var(--radius);
  border: 1.5px solid var(--border); box-shadow: var(--shadow-card);
  overflow: hidden;
}
.table-card-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 20px 24px 16px;
  border-bottom: 1px solid var(--border);
}
.table-card-title { font-size: 1rem; font-weight: 700; color: var(--text); }
.table-count {
  font-size: 0.82rem; font-weight: 600;
  background: var(--yellow-bg); color: #92400e;
  border: 1.5px solid #fde68a;
  border-radius: 20px; padding: 3px 12px;
}

table { width: 100%; border-collapse: collapse; }
thead th {
  padding: 11px 24px; text-align: left;
  font-size: 0.76rem; font-weight: 700; letter-spacing: 0.06em;
  text-transform: uppercase; color: var(--text-light);
  background: #fafbfc; border-bottom: 1px solid var(--border);
  white-space: nowrap;
}
tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: #fafbfd; }
tbody td { padding: 14px 24px; font-size: 0.88rem; vertical-align: middle; }

.user-cell { display: flex; align-items: center; gap: 12px; }
.user-avatar {
  width: 38px; height: 38px; border-radius: 50%;
  object-fit: cover; border: 2px solid var(--border); flex-shrink: 0;
}
.avatar-placeholder {
  width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.85rem; font-weight: 700; color: #fff;
}
.user-cell-name { font-weight: 600; color: var(--text); margin-bottom: 2px; }
.user-cell-email { font-size: 0.78rem; color: var(--text-secondary); }

.role-badge {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: 0.78rem; font-weight: 700; border-radius: 7px;
  padding: 4px 11px; letter-spacing: 0.01em;
}
.role-admin       { background: var(--purple-bg);  color: var(--purple-text); border: 1.5px solid var(--purple-border); }
.role-faculty     { background: var(--blue-bg);     color: var(--blue-text);   border: 1.5px solid var(--blue-border); }
.role-staff       { background: var(--orange-bg);   color: var(--orange-text); border: 1.5px solid var(--orange-border); }
.role-student     { background: var(--green-bg);    color: var(--green);       border: 1.5px solid var(--green-border); }

.status-dot {
  display: inline-flex; align-items: center; gap: 6px;
  font-size: 0.82rem; font-weight: 600;
}
.status-dot::before {
  content: ''; width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0;
}
.dot-active::before   { background: var(--green); box-shadow: 0 0 0 2px var(--green-bg); }
.dot-inactive::before { background: var(--text-light); box-shadow: 0 0 0 2px #f3f4f6; }
.dot-suspended::before{ background: var(--red); box-shadow: 0 0 0 2px var(--red-bg); }
.dot-active   { color: var(--green); }
.dot-inactive { color: var(--text-light); }
.dot-suspended{ color: var(--red); }

.action-btns { display: flex; align-items: center; gap: 6px; }
.act-btn {
  width: 32px; height: 32px; border-radius: 7px;
  display: flex; align-items: center; justify-content: center;
  border: 1.5px solid var(--border); background: var(--bg);
  color: var(--text-secondary); cursor: pointer; font-size: 0.82rem;
  transition: all 0.18s; text-decoration: none;
}
.act-btn:hover         { border-color: #93c5fd; color: var(--blue-text); background: var(--blue-bg); }
.act-btn.act-delete:hover { border-color: var(--red-border); color: var(--red); background: var(--red-bg); }
.act-btn.act-edit:hover   { border-color: var(--green-border); color: var(--green); background: var(--green-bg); }

/* ── Pagination ── */
.pagination {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 24px;
  border-top: 1px solid var(--border);
}
.pagination-info { font-size: 0.83rem; color: var(--text-secondary); font-weight: 500; }
.pagination-btns { display: flex; align-items: center; gap: 4px; }
.page-btn {
  width: 34px; height: 34px; border-radius: 7px;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.84rem; font-weight: 600;
  border: 1.5px solid var(--border); background: var(--bg);
  color: var(--text-secondary); cursor: pointer;
  transition: all 0.18s; font-family: 'Inter', sans-serif;
}
.page-btn:hover { border-color: #93c5fd; color: var(--blue-text); background: var(--blue-bg); }
.page-btn.active { background: var(--navy); color: #fff; border-color: var(--navy); }
.page-btn:disabled { opacity: 0.4; cursor: not-allowed; }
.page-btn:disabled:hover { border-color: var(--border); background: var(--bg); color: var(--text-secondary); }

/* ── Modal ── */
.modal-overlay {
  position: fixed; inset: 0;
  background: rgba(11,22,64,0.45);
  backdrop-filter: blur(3px);
  z-index: 200;
  display: flex; align-items: center; justify-content: center;
  opacity: 0; pointer-events: none;
  transition: opacity 0.25s;
}
.modal-overlay.open { opacity: 1; pointer-events: all; }
.modal {
  background: var(--white); border-radius: 18px;
  width: 100%; max-width: 480px;
  box-shadow: 0 20px 60px rgba(11,22,64,0.2);
  transform: translateY(20px) scale(0.98);
  transition: transform 0.28s cubic-bezier(0.34,1.56,0.64,1);
  overflow: hidden;
}
.modal-overlay.open .modal { transform: translateY(0) scale(1); }
.modal-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 22px 24px 18px;
  border-bottom: 1px solid var(--border);
}
.modal-title { font-size: 1.1rem; font-weight: 800; color: var(--text); letter-spacing: -0.01em; }
.modal-close {
  width: 32px; height: 32px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  background: var(--bg); border: 1.5px solid var(--border);
  color: var(--text-secondary); cursor: pointer; font-size: 0.9rem;
  transition: all 0.18s;
}
.modal-close:hover { background: var(--red-bg); border-color: var(--red-border); color: var(--red); }
.modal-body { padding: 24px; display: flex; flex-direction: column; gap: 16px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.full { grid-column: 1 / -1; }
.form-label { font-size: 0.8rem; font-weight: 700; color: var(--text); letter-spacing: 0.02em; }
.form-input, .form-select {
  padding: 10px 14px; border-radius: 9px;
  border: 1.5px solid var(--border); background: var(--bg);
  font-size: 0.88rem; font-family: 'Inter', sans-serif; color: var(--text);
  outline: none; transition: border-color 0.2s, box-shadow 0.2s;
}
.form-input:focus, .form-select:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); background: #fff; }
.form-select { appearance: none; cursor: pointer;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 12px center;
  background-color: var(--bg);
  padding-right: 36px;
}
.modal-footer {
  padding: 16px 24px 24px;
  display: flex; align-items: center; justify-content: flex-end; gap: 10px;
}
.btn-cancel {
  padding: 10px 20px; border-radius: 9px;
  font-size: 0.88rem; font-weight: 600; font-family: 'Inter', sans-serif;
  background: var(--bg); border: 1.5px solid var(--border);
  color: var(--text-secondary); cursor: pointer; transition: all 0.18s;
}
.btn-cancel:hover { border-color: #d1d5db; color: var(--text); }

/* ── Animations ── */
@keyframes fadeSlideUp {
  from { opacity: 0; transform: translateY(14px); }
  to   { opacity: 1; transform: translateY(0); }
}
.page-header  { animation: fadeSlideUp 0.4s both 0.04s; }
.summary-grid { animation: fadeSlideUp 0.4s both 0.10s; }
.toolbar      { animation: fadeSlideUp 0.4s both 0.15s; }
.table-card   { animation: fadeSlideUp 0.4s both 0.20s; }

/* ── Responsive ── */
@media (max-width: 1200px) {
  .summary-grid { grid-template-columns: repeat(2,1fr); }
  .content { padding: 24px 20px 40px; }
  .topbar  { padding: 0 20px; }
}
@media (max-width: 768px) {
  :root { --sidebar-w: 0px; }
  .sidebar { display: none; }
  .topbar-search { width: 200px; }
  .summary-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
  .form-row { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <a href="#" class="sidebar-logo">
    <div class="logo-mark"><i class="fas fa-door-open"></i></div>
    <div class="logo-text">
      <span class="brand-psu">PSU</span>
      <span class="brand-main">Smart<span>Room</span></span>
    </div>
  </a>

  <span class="nav-section-label">Main Menu</span>
  <ul class="sidebar-nav">
    <li><a href="{{ url('/dashboard') }}"><span class="nav-icon"><i class="fas fa-chart-line"></i></span>Dashboard</a></li>
    <li><a href="{{ url('/classrooms') }}"><span class="nav-icon"><i class="fas fa-school"></i></span>Classrooms</a></li>
    <li><a href="{{ url('/schedule') }}"><span class="nav-icon"><i class="fas fa-calendar-days"></i></span>Schedule</a></li>
    <li><a href="{{ url('/admin/users') }}" class="active"><span class="nav-icon"><i class="fas fa-users-cog"></i></span>User Management</a></li>
    <li><a href="{{ url('/smartlocking') }}"><span class="nav-icon"><i class="fas fa-lock"></i></span>SmartLocking</a></li>
  </ul>

  <div class="sidebar-footer">
    <div class="user-widget">
      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Prof. Elena Santos">
      <div class="user-widget-info">
        <div class="user-widget-name">Prof. Elena Santos</div>
        <div class="user-widget-role">Admin</div>
      </div>
    </div>
    <button class="sidebar-logout-btn">
      <i class="fas fa-arrow-right-from-bracket"></i>
      Sign Out
    </button>
  </div>
</div>

<!-- MAIN -->
<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="topbar-search">
      <i class="fas fa-magnifying-glass"></i>
      <input type="text" placeholder="Search anything…">
    </div>
    <div class="topbar-right">
      <button class="notif-btn"><i class="fas fa-bell"></i><span class="notif-badge"></span></button>
      <div class="topbar-profile">
        <div class="topbar-profile-info">
          <div class="topbar-profile-name">Elena Santos</div>
          <div class="topbar-profile-role">Administrator</div>
        </div>
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Elena Santos">
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- Page Header -->
    <div class="page-header">
      <div class="page-header-left">
        <h1>User Management</h1>
        <p>Manage all system users, roles, and access permissions.</p>
      </div>
      <button class="btn-primary" onclick="openModal()">
        <i class="fas fa-plus"></i>
        Add New User
      </button>
    </div>

    <!-- Summary Cards -->
    <div class="summary-grid">
      <div class="sum-card">
        <div class="sum-icon" style="background:var(--blue-bg);color:var(--blue-text);">
          <i class="fas fa-users"></i>
        </div>
        <div class="sum-info">
          <div class="sum-value" style="color:var(--text);">124</div>
          <div class="sum-label">Total Users</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon" style="background:var(--green-bg);color:var(--green);">
          <i class="fas fa-user-check"></i>
        </div>
        <div class="sum-info">
          <div class="sum-value" style="color:var(--green);">108</div>
          <div class="sum-label">Active Users</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon" style="background:var(--purple-bg);color:var(--purple-text);">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="sum-info">
          <div class="sum-value" style="color:var(--purple-text);">4</div>
          <div class="sum-label">Administrators</div>
        </div>
      </div>
      <div class="sum-card">
        <div class="sum-icon" style="background:var(--red-bg);color:var(--red);">
          <i class="fas fa-user-slash"></i>
        </div>
        <div class="sum-info">
          <div class="sum-value" style="color:var(--red);">3</div>
          <div class="sum-label">Suspended</div>
        </div>
      </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
      <div class="toolbar-search">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" placeholder="Search by name, email, or ID…" id="searchInput" oninput="filterTable()">
      </div>
      <div class="filter-group">
        <select class="filter-select" id="roleFilter" onchange="filterTable()">
          <option value="">All Roles</option>
          <option>Admin</option>
          <option>Faculty</option>
          <option>Staff</option>
          <option>Student</option>
        </select>
        <select class="filter-select" id="statusFilter" onchange="filterTable()">
          <option value="">All Status</option>
          <option>Active</option>
          <option>Inactive</option>
          <option>Suspended</option>
        </select>
        <button class="btn-icon" title="Export CSV" onclick="exportCSV()"><i class="fas fa-arrow-down-to-line"></i></button>
        <button class="btn-icon" title="Refresh"><i class="fas fa-rotate-right"></i></button>
      </div>
    </div>

    <!-- Table -->
    <div class="table-card">
      <div class="table-card-header">
        <div class="table-card-title">All Users</div>
        <span class="table-count" id="rowCount">12 users</span>
      </div>

      <table id="userTable">
        <thead>
          <tr>
            <th style="width:40px;"><input type="checkbox" id="checkAll" onchange="toggleAll(this)" style="accent-color:var(--navy);width:15px;height:15px;cursor:pointer;"></th>
            <th>User</th>
            <th>ID / Department</th>
            <th>Role</th>
            <th>Status</th>
            <th>Last Active</th>
            <th style="text-align:center;">Actions</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <!-- rows injected by JS -->
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="pagination">
        <div class="pagination-info">Showing <strong>1–12</strong> of <strong>124</strong> users</div>
        <div class="pagination-btns">
          <button class="page-btn" disabled><i class="fas fa-chevron-left"></i></button>
          <button class="page-btn active">1</button>
          <button class="page-btn">2</button>
          <button class="page-btn">3</button>
          <span style="color:var(--text-light);padding:0 4px;font-size:0.84rem;">…</span>
          <button class="page-btn">11</button>
          <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<!-- ADD USER MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
  <div class="modal" id="modalBox">
    <div class="modal-header">
      <div class="modal-title">Add New User</div>
      <button class="modal-close" onclick="closeModal()"><i class="fas fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">First Name</label>
          <input class="form-input" type="text" placeholder="e.g. Maria">
        </div>
        <div class="form-group">
          <label class="form-label">Last Name</label>
          <input class="form-input" type="text" placeholder="e.g. Santos">
        </div>
      </div>
      <div class="form-group full">
        <label class="form-label">Email Address</label>
        <input class="form-input" type="email" placeholder="user@psu.edu.ph">
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Role</label>
          <select class="form-select">
            <option value="">Select role…</option>
            <option>Admin</option>
            <option>Faculty</option>
            <option>Staff</option>
            <option>Student</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Department</label>
          <select class="form-select">
            <option value="">Select dept…</option>
            <option>CITE</option>
            <option>CAS</option>
            <option>COE</option>
            <option>CBA</option>
            <option>COED</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Employee / Student ID</label>
          <input class="form-input" type="text" placeholder="PSU-2024-0001">
        </div>
        <div class="form-group">
          <label class="form-label">Status</label>
          <select class="form-select">
            <option>Active</option>
            <option>Inactive</option>
            <option>Suspended</option>
          </select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-primary" onclick="closeModal()"><i class="fas fa-user-plus"></i>Create User</button>
    </div>
  </div>
</div>

<script>
/* ── Data ── */
const USERS = [
  { name:'Elena Santos',   email:'e.santos@psu.edu.ph',   id:'PSU-ADM-001', dept:'Administration', role:'Admin',   status:'Active',    avatar:'https://randomuser.me/api/portraits/women/44.jpg', last:'Just now' },
  { name:'Ramon Reyes',    email:'r.reyes@psu.edu.ph',    id:'PSU-ADM-002', dept:'CITE',           role:'Admin',   status:'Active',    avatar:'https://randomuser.me/api/portraits/men/32.jpg',   last:'2 hrs ago' },
  { name:'Dr. Ana Cruz',   email:'a.cruz@psu.edu.ph',     id:'PSU-FAC-041', dept:'CAS',            role:'Faculty', status:'Active',    avatar:'https://randomuser.me/api/portraits/women/68.jpg', last:'1 hr ago' },
  { name:'Engr. Luis Tan', email:'l.tan@psu.edu.ph',      id:'PSU-FAC-018', dept:'COE',            role:'Faculty', status:'Active',    avatar:'https://randomuser.me/api/portraits/men/55.jpg',   last:'3 hrs ago' },
  { name:'Prof. Joy Basa', email:'j.basa@psu.edu.ph',     id:'PSU-FAC-029', dept:'COED',           role:'Faculty', status:'Active',    avatar:'https://randomuser.me/api/portraits/women/12.jpg', last:'Yesterday' },
  { name:'Mark Lim',       email:'m.lim@psu.edu.ph',      id:'PSU-STF-007', dept:'Facilities',     role:'Staff',   status:'Active',    avatar:'https://randomuser.me/api/portraits/men/78.jpg',   last:'5 hrs ago' },
  { name:'Carla Dizon',    email:'c.dizon@psu.edu.ph',    id:'PSU-STF-011', dept:'IT Office',      role:'Staff',   status:'Inactive',  avatar:'',                                                 last:'3 days ago' },
  { name:'Paolo Mercado',  email:'p.mercado@psu.edu.ph',  id:'PSU-STU-2024-0112', dept:'CITE',     role:'Student', status:'Active',    avatar:'https://randomuser.me/api/portraits/men/22.jpg',   last:'Today' },
  { name:'Sofia Garcia',   email:'s.garcia@psu.edu.ph',   id:'PSU-STU-2024-0089', dept:'CBA',      role:'Student', status:'Active',    avatar:'https://randomuser.me/api/portraits/women/25.jpg', last:'Today' },
  { name:'Jeric Abad',     email:'j.abad@psu.edu.ph',     id:'PSU-STU-2023-0445', dept:'COE',      role:'Student', status:'Suspended', avatar:'https://randomuser.me/api/portraits/men/41.jpg',   last:'2 weeks ago' },
  { name:'Rhea Villanueva',email:'r.villanueva@psu.edu.ph',id:'PSU-FAC-033', dept:'CAS',           role:'Faculty', status:'Active',    avatar:'https://randomuser.me/api/portraits/women/56.jpg', last:'30 min ago' },
  { name:'Ben Ocampo',     email:'b.ocampo@psu.edu.ph',   id:'PSU-STF-003', dept:'Security',       role:'Staff',   status:'Active',    avatar:'https://randomuser.me/api/portraits/men/63.jpg',   last:'1 hr ago' },
];

const ROLE_CLASS   = { Admin:'role-admin', Faculty:'role-faculty', Staff:'role-staff', Student:'role-student' };
const STATUS_CLASS = { Active:'dot-active', Inactive:'dot-inactive', Suspended:'dot-suspended' };
const AVATAR_COLORS= ['#1d4ed8','#16a34a','#7c3aed','#c2410c','#0891b2','#b45309'];

function initials(name) {
  return name.split(' ').filter(Boolean).slice(0,2).map(w=>w[0]).join('').toUpperCase();
}
function avatarColor(name) {
  let h=0; for(let c of name) h=(h*31+c.charCodeAt(0))%AVATAR_COLORS.length;
  return AVATAR_COLORS[h];
}

function renderRows(data) {
  const tbody = document.getElementById('tableBody');
  tbody.innerHTML = data.map((u,i)=>`
    <tr>
      <td><input type="checkbox" style="accent-color:var(--navy);width:15px;height:15px;cursor:pointer;"></td>
      <td>
        <div class="user-cell">
          ${u.avatar
            ? `<img class="user-avatar" src="${u.avatar}" alt="${u.name}">`
            : `<div class="avatar-placeholder" style="background:${avatarColor(u.name)}">${initials(u.name)}</div>`}
          <div>
            <div class="user-cell-name">${u.name}</div>
            <div class="user-cell-email">${u.email}</div>
          </div>
        </div>
      </td>
      <td>
        <div style="font-size:0.86rem;font-weight:600;color:var(--text);margin-bottom:2px;">${u.id}</div>
        <div style="font-size:0.78rem;color:var(--text-secondary);">${u.dept}</div>
      </td>
      <td><span class="role-badge ${ROLE_CLASS[u.role]}">${u.role}</span></td>
      <td><span class="status-dot ${STATUS_CLASS[u.status]}">${u.status}</span></td>
      <td style="color:var(--text-secondary);font-size:0.84rem;">${u.last}</td>
      <td>
        <div class="action-btns" style="justify-content:center;">
          <button class="act-btn" title="View"><i class="fas fa-eye"></i></button>
          <button class="act-btn act-edit" title="Edit"><i class="fas fa-pen"></i></button>
          <button class="act-btn act-delete" title="Delete"><i class="fas fa-trash-can"></i></button>
        </div>
      </td>
    </tr>
  `).join('');
  document.getElementById('rowCount').textContent = `${data.length} user${data.length!==1?'s':''}`;
}

function filterTable() {
  const q      = document.getElementById('searchInput').value.toLowerCase();
  const role   = document.getElementById('roleFilter').value;
  const status = document.getElementById('statusFilter').value;
  const filtered = USERS.filter(u=>{
    const matchQ = !q || u.name.toLowerCase().includes(q) || u.email.toLowerCase().includes(q) || u.id.toLowerCase().includes(q);
    const matchR = !role   || u.role   === role;
    const matchS = !status || u.status === status;
    return matchQ && matchR && matchS;
  });
  renderRows(filtered);
}

function toggleAll(el) {
  document.querySelectorAll('#tableBody input[type=checkbox]').forEach(c=>c.checked=el.checked);
}

function exportCSV() {
  const header = 'Name,Email,ID,Department,Role,Status,Last Active\n';
  const rows   = USERS.map(u=>`"${u.name}","${u.email}","${u.id}","${u.dept}","${u.role}","${u.status}","${u.last}"`).join('\n');
  const blob   = new Blob([header+rows], {type:'text/csv'});
  const a      = Object.assign(document.createElement('a'), {href:URL.createObjectURL(blob), download:'smartroom-users.csv'});
  a.click();
}

function openModal()        { document.getElementById('modalOverlay').classList.add('open'); }
function closeModal()       { document.getElementById('modalOverlay').classList.remove('open'); }
function closeModalOutside(e){ if(e.target===document.getElementById('modalOverlay')) closeModal(); }

/* init */
renderRows(USERS);
</script>
</body>
</html>