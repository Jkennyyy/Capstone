<?php
// dashboard.php
$now = new DateTime();
$dateFormatted = $now->format('h:i A \• l, F j, Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard – SmartDoor</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* ── RESET ─────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  /* Brand */
  --yellow:        #f5c518;
  --yellow-light:  #fef9e7;
  --navy:          #0b1640;
  --navy-mid:      #1a2f80;
  --navy-light:    #e8ecfb;

  /* Surface */
  --white:         #ffffff;
  --bg:            #f0f2f8;
  --bg-card:       #ffffff;
  --border:        #e4e8f0;
  --border-strong: #cdd3e0;

  /* Text */
  --text:          #0f1729;
  --text-2:        #3d4a5c;
  --text-3:        #7c8a9e;
  --text-4:        #b0bac8;

  /* Semantic */
  --green:         #0f9d58;
  --green-mid:     #12b564;
  --green-bg:      #e6f9f0;
  --green-border:  #a7e9c8;
  --green-text:    #0a7a43;

  --blue:          #1a56db;
  --blue-mid:      #2563eb;
  --blue-bg:       #eaf0fd;
  --blue-border:   #93b8f8;
  --blue-text:     #1740b0;

  --amber:         #d97706;
  --amber-bg:      #fef3e2;
  --amber-border:  #fcd38a;
  --amber-text:    #b45309;

  --purple:        #7c3aed;
  --purple-bg:     #f4f0fe;
  --purple-border: #c4b5fd;
  --purple-text:   #5b21b6;

  --red:           #dc2626;
  --red-bg:        #fef2f2;

  /* Shadows */
  --shadow-xs:  0 1px 2px rgba(15,23,41,0.05);
  --shadow-sm:  0 2px 6px rgba(15,23,41,0.06), 0 1px 2px rgba(15,23,41,0.04);
  --shadow-md:  0 4px 16px rgba(15,23,41,0.08), 0 1px 4px rgba(15,23,41,0.04);
  --shadow-lg:  0 8px 32px rgba(15,23,41,0.10), 0 2px 8px rgba(15,23,41,0.06);

  /* Layout */
  --radius-xs:  6px;
  --radius-sm:  10px;
  --radius:     14px;
  --radius-lg:  18px;
  --sidebar-w:  230px;

  /* Fonts */
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
   SIDEBAR — DO NOT CHANGE
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
  color: rgba(255,255,255,0.45); text-transform: uppercase;
  display: block; margin-bottom: 3px;
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
  display: flex; align-items: center; gap: 11px; padding: 11px 12px;
  text-decoration: none; color: rgba(255,255,255,0.6); font-size: 0.88rem; font-weight: 500;
  border-radius: var(--radius-sm);
  transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
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
.sidebar-footer {
  margin-top: auto; padding: 16px 12px 24px;
  border-top: 1px solid rgba(255,255,255,0.06);
}
.user-widget {
  display: flex; align-items: center; gap: 10px; padding: 10px 12px;
  border-radius: var(--radius-sm); background: rgba(255,255,255,0.05); margin-bottom: 8px;
}
.user-avatar {
  width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
  background: var(--navy-mid); border: 2px solid rgba(245,197,24,0.4);
  display: flex; align-items: center; justify-content: center;
  font-size: 0.78rem; font-weight: 700; color: var(--yellow);
}
.user-widget-info { flex: 1; min-width: 0; }
.user-widget-name {
  font-size: 0.83rem; font-weight: 600; color: #fff;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.user-widget-role { font-size: 0.73rem; color: rgba(255,255,255,0.4); }
.sidebar-logout-btn {
  display: flex; align-items: center; gap: 10px; padding: 9px 12px;
  color: rgba(255,255,255,0.4); font-size: 0.84rem; font-weight: 500;
  border-radius: var(--radius-sm); transition: all 0.22s; width: 100%;
  background: none; border: none; cursor: pointer; font-family: inherit;
}
.sidebar-logout-btn:hover { color: #f87171; background: rgba(244,63,94,0.08); }

/* ══════════════════════════════════════════════
   MAIN LAYOUT
══════════════════════════════════════════════ */
.main {
  margin-left: var(--sidebar-w); flex: 1;
  display: flex; flex-direction: column; min-height: 100vh;
}

/* ── TOPBAR ─────────────────────────────────────── */
.topbar {
  background: var(--white);
  border-bottom: 1px solid var(--border);
  padding: 0 36px; height: 64px;
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  position: sticky; top: 0; z-index: 50;
  box-shadow: 0 1px 0 var(--border);
}

.topbar-search {
  display: flex; align-items: center; gap: 10px;
  background: var(--bg);
  border: 1.5px solid var(--border);
  border-radius: 24px;
  padding: 8px 18px;
  width: 340px;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.topbar-search:focus-within {
  border-color: #93c5fd;
  box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}
.topbar-search i { color: var(--text-4); font-size: 0.9rem; }
.topbar-search input {
  border: none; outline: none; background: transparent;
  font-size: 0.9rem; font-family: var(--font-body);
  color: var(--text); width: 100%;
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

.topbar-profile { position: relative; display: flex; align-items: center; gap: 12px; cursor: pointer; }
.topbar-profile-info { text-align: right; }
.topbar-profile-name { font-size: 0.88rem; font-weight: 700; color: var(--text); line-height: 1.2; }
.topbar-profile-role { font-size: 0.78rem; color: var(--text-3); }
.topbar-profile img {
  width: 40px; height: 40px; border-radius: 50%; object-fit: cover;
  border: 2px solid var(--border); box-shadow: var(--shadow-xs);
}

/* Profile dropdown */
.profile-dropdown {
  position: absolute;
  top: 115%;
  right: 0;
  min-width: 230px;
  background: var(--white);
  border-radius: var(--radius-sm);
  border: 1px solid var(--border);
  box-shadow: var(--shadow-md);
  padding: 10px 12px 8px;
  display: none;
  z-index: 2000;
}
.profile-dropdown.is-open { display: block; }
.profile-dropdown-item {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  margin-bottom: 8px;
}
.profile-dropdown-icon {
  width: 28px;
  height: 28px;
  border-radius: 999px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: var(--bg);
  color: var(--text-3);
  font-size: 0.82rem;
  flex-shrink: 0;
}
.profile-dropdown-text {
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.profile-dropdown-label {
  font-size: 0.72rem;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-3);
  font-weight: 700;
  padding: 2px 0 3px;
}
.profile-dropdown-value {
  font-size: 0.82rem;
  color: var(--text-2);
}
.profile-signout-btn {
  width: 100%;
  margin-top: 4px;
  border: none;
  outline: none;
  border-radius: 999px;
  padding: 7px 10px;
  font-size: 0.82rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  background: var(--red-bg);
  color: var(--red);
  cursor: pointer;
  transition: background 0.16s ease, color 0.16s ease, transform 0.08s ease;
}
.profile-signout-btn i { font-size: 0.86rem; }
.profile-signout-btn:hover {
  background: #fee2e2;
  transform: translateY(-1px);
}

/* ── CONTENT AREA ────────────────────────────────── */
.content {
  padding: 28px 36px 52px;
  display: flex; flex-direction: column; gap: 22px;
}

/* ── WELCOME BANNER ──────────────────────────────── */
.welcome-banner {
  background: var(--navy);
  border-radius: var(--radius-lg);
  padding: 26px 30px;
  display: flex; align-items: center; justify-content: space-between;
  position: relative; overflow: hidden;
}
.welcome-banner::before {
  content: '';
  position: absolute; top: -40px; right: 120px;
  width: 200px; height: 200px; border-radius: 50%;
  background: rgba(245,197,24,0.07);
  pointer-events: none;
}
.welcome-banner::after {
  content: '';
  position: absolute; bottom: -50px; right: -20px;
  width: 160px; height: 160px; border-radius: 50%;
  background: rgba(26,47,128,0.5);
  pointer-events: none;
}
.welcome-text { position: relative; z-index: 1; }
.welcome-greeting {
  font-family: var(--font-head);
  font-size: 1.45rem; font-weight: 800;
  color: #fff; letter-spacing: -0.025em; line-height: 1.2;
  margin-bottom: 6px;
}
.welcome-greeting em { color: var(--yellow); font-style: normal; }
.welcome-sub {
  font-size: 0.86rem; color: rgba(255,255,255,0.55); font-weight: 400;
}
.welcome-actions { display: flex; gap: 10px; position: relative; z-index: 1; }
.btn-banner {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 9px 18px; border-radius: 24px;
  font-family: var(--font-body); font-size: 0.82rem; font-weight: 600;
  text-decoration: none; cursor: pointer; transition: all 0.18s;
}
.btn-banner-solid {
  background: var(--yellow); color: var(--navy); border: none;
  box-shadow: 0 2px 8px rgba(245,197,24,0.4);
}
.btn-banner-solid:hover { background: #ffd740; transform: translateY(-1px); }
.btn-banner-outline {
  background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.85);
  border: 1.5px solid rgba(255,255,255,0.15);
}
.btn-banner-outline:hover { background: rgba(255,255,255,0.14); }

/* ── STAT CARDS ──────────────────────────────────── */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
}

.stat-card {
  background: var(--white);
  border-radius: var(--radius);
  border: 1.5px solid var(--border);
  padding: 20px 20px 18px;
  position: relative; overflow: hidden;
  box-shadow: var(--shadow-sm);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  cursor: default;
}
.stat-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
}

/* Colored left accent bar */
.stat-card::before {
  content: '';
  position: absolute; left: 0; top: 16px; bottom: 16px;
  width: 3px; border-radius: 0 3px 3px 0;
}
.stat-card.green::before  { background: var(--green-mid); }
.stat-card.blue::before   { background: var(--blue-mid); }
.stat-card.amber::before  { background: var(--amber); }
.stat-card.purple::before { background: var(--purple); }

.stat-top {
  display: flex; align-items: flex-start; justify-content: space-between;
  margin-bottom: 16px;
}
.stat-icon {
  width: 42px; height: 42px; border-radius: 11px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.05rem; color: #fff; flex-shrink: 0;
}
.stat-icon.green  { background: linear-gradient(135deg, #22c55e 0%, #0f9d58 100%); }
.stat-icon.blue   { background: linear-gradient(135deg, #4f8ef7 0%, #1a56db 100%); }
.stat-icon.amber  { background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%); }
.stat-icon.purple { background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%); }

.stat-tag {
  font-size: 0.69rem; font-weight: 700; padding: 3px 9px;
  border-radius: 20px; letter-spacing: 0.01em; white-space: nowrap;
}
.tag-green  { background: var(--green-bg);  color: var(--green-text); border: 1px solid var(--green-border); }
.tag-blue   { background: var(--blue-bg);   color: var(--blue-text);  border: 1px solid var(--blue-border);  }
.tag-amber  { background: var(--amber-bg);  color: var(--amber-text); border: 1px solid var(--amber-border); }
.tag-purple { background: var(--purple-bg); color: var(--purple-text);border: 1px solid var(--purple-border);}

.stat-value {
  font-family: var(--font-head);
  font-size: 2.1rem; font-weight: 800; letter-spacing: -0.045em;
  line-height: 1; color: var(--text); margin-bottom: 4px;
}
.stat-label {
  font-size: 0.8rem; color: var(--text-3); font-weight: 500; letter-spacing: 0.01em;
}

/* ── BOTTOM GRID ─────────────────────────────────── */
.bottom-grid {
  display: grid;
  grid-template-columns: 1.6fr 1fr;
  gap: 14px;
}

/* ── SHARED PANEL ────────────────────────────────── */
.panel {
  background: var(--white);
  border-radius: var(--radius);
  border: 1.5px solid var(--border);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
  display: flex; flex-direction: column;
}
.panel-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 18px 22px 14px;
  border-bottom: 1px solid var(--border);
}
.panel-title {
  display: flex; align-items: center; gap: 10px;
  font-family: var(--font-head);
  font-size: 0.92rem; font-weight: 700; color: var(--text);
}
.panel-title-icon {
  width: 30px; height: 30px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center; font-size: 0.8rem;
}
.pti-blue   { background: var(--blue-bg);   color: var(--blue-text); }
.pti-green  { background: var(--green-bg);  color: var(--green-text); }

.link-all {
  font-size: 0.78rem; font-weight: 600; color: var(--blue-text);
  text-decoration: none; display: inline-flex; align-items: center; gap: 4px;
  padding: 5px 12px; border-radius: 20px;
  border: 1.5px solid var(--blue-border); background: var(--blue-bg);
  transition: all 0.18s;
}
.link-all:hover { background: var(--blue-text); color: #fff; border-color: var(--blue-text); }

/* ── RESERVATION ROWS ────────────────────────────── */
.res-row {
  display: flex; align-items: center; gap: 14px;
  padding: 15px 22px; border-bottom: 1px solid var(--border);
  transition: background 0.15s; cursor: pointer;
}
.res-row:last-child { border-bottom: none; }
.res-row:hover { background: #fafbfd; }

.res-date-col {
  flex-shrink: 0; width: 52px; text-align: center;
  background: var(--bg); border-radius: var(--radius-sm);
  padding: 8px 4px; border: 1px solid var(--border);
}
.res-date-day { font-size: 1.3rem; font-weight: 800; color: var(--text); line-height: 1; font-family: var(--font-head); }
.res-date-label { font-size: 0.65rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 2px; }
.res-date-col.today { background: var(--navy); border-color: var(--navy); }
.res-date-col.today .res-date-day { color: var(--yellow); }
.res-date-col.today .res-date-label { color: rgba(255,255,255,0.55); }

.res-body { flex: 1; min-width: 0; }
.res-room-name {
  font-family: var(--font-head);
  font-size: 0.88rem; font-weight: 700; color: var(--text);
  margin-bottom: 2px; display: flex; align-items: center; gap: 7px;
}
.res-subject-name { font-size: 0.8rem; color: var(--text-2); font-weight: 500; margin-bottom: 6px; }
.res-chips { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.res-chip {
  display: inline-flex; align-items: center; gap: 4px;
  font-size: 0.72rem; color: var(--text-3); font-weight: 500;
}
.res-chip i { font-size: 0.65rem; color: var(--text-4); }

.badge {
  font-size: 0.68rem; font-weight: 700; padding: 3px 9px;
  border-radius: var(--radius-xs); display: inline-flex; align-items: center; gap: 4px;
  white-space: nowrap;
}
.badge-confirmed { background: var(--green-bg); color: var(--green-text); border: 1px solid var(--green-border); }
.badge-pending   { background: var(--amber-bg);  color: var(--amber-text); border: 1px solid var(--amber-border); }
.badge-cancelled { background: var(--red-bg);    color: var(--red);        border: 1px solid #fca5a5; }

.res-caret {
  flex-shrink: 0; width: 28px; height: 28px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  color: var(--text-4); font-size: 0.72rem;
  background: var(--bg); border: 1px solid var(--border);
  transition: all 0.18s;
}
.res-row:hover .res-caret { background: var(--navy); border-color: var(--navy); color: #fff; }

/* ── AVAILABLE ROOMS ─────────────────────────────── */
.room-row {
  padding: 14px 20px; border-bottom: 1px solid var(--border);
  transition: background 0.15s; cursor: pointer;
}
.room-row:last-child { border-bottom: none; }
.room-row:hover { background: #fafbfd; }

.room-header-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 3px; }
.room-id-text {
  font-family: var(--font-head);
  font-size: 0.92rem; font-weight: 800; color: var(--text); letter-spacing: -0.01em;
}
.room-cap-badge {
  display: inline-flex; align-items: center; gap: 4px;
  font-size: 0.71rem; font-weight: 700;
  background: var(--green-bg); color: var(--green-text);
  padding: 3px 9px; border-radius: var(--radius-xs);
  border: 1px solid var(--green-border);
}
.room-location-text {
  font-size: 0.75rem; color: var(--text-3); margin-bottom: 9px;
  display: flex; align-items: center; gap: 4px;
}
.room-location-text i { font-size: 0.66rem; color: var(--text-4); }
.room-tags { display: flex; gap: 5px; flex-wrap: wrap; }
.rtag {
  font-size: 0.69rem; font-weight: 600; padding: 3px 9px;
  border-radius: var(--radius-xs);
  background: var(--bg); color: var(--text-3); border: 1px solid var(--border);
  transition: all 0.15s;
}
.room-row:hover .rtag { background: var(--navy-light); color: var(--navy-mid); border-color: #c7d0f0; }

/* ── EMPTY STATE ─────────────────────────────────── */
.empty-state {
  padding: 36px 22px; text-align: center;
  color: var(--text-3); font-size: 0.84rem;
}
.empty-state i { font-size: 1.8rem; color: var(--text-4); margin-bottom: 10px; display: block; }

/* ── ANIMATIONS ──────────────────────────────────── */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}
.welcome-banner { animation: fadeUp 0.4s both 0.04s; }
.stats-grid     { animation: fadeUp 0.4s both 0.12s; }
.bottom-grid    { animation: fadeUp 0.4s both 0.2s; }

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 1280px) {
  .stats-grid  { grid-template-columns: repeat(2,1fr); }
  .bottom-grid { grid-template-columns: 1fr; }
  .content     { padding: 22px 20px 40px; }
  .topbar      { padding: 0 20px; }
}
@media (max-width: 768px) {
  :root { --sidebar-w: 0px; }
  .sidebar { display: none; }
  .stats-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
  .welcome-banner { flex-direction: column; gap: 16px; align-items: flex-start; }
}
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
        Rooms
      </a>
    </li>
    <li>
      <a href="{{ url('/faculty-schedule') }}"
         class="{{ Request::is('faculty-schedule') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-clock"></i></span>
        Schedule
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
      <a href="{{ url('/reports') }}" class="{{ Request::is('reports*') ? 'active' : '' }}">
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
        <div class="profile-dropdown">
          <div class="profile-dropdown-item">
            <span class="profile-dropdown-icon"><i class="fas fa-envelope"></i></span>
            <div class="profile-dropdown-text">
              <span class="profile-dropdown-label">Email</span>
              <span class="profile-dropdown-value">elena.santos@university.edu</span>
            </div>
          </div>
          <div class="profile-dropdown-item">
            <span class="profile-dropdown-icon"><i class="fas fa-briefcase"></i></span>
            <div class="profile-dropdown-text">
              <span class="profile-dropdown-label">University Position</span>
              <span class="profile-dropdown-value">Faculty of IT</span>
            </div>
          </div>
          <form method="POST" action="<?= htmlspecialchars(url('/logout')) ?>">
            <?php csrf_field(); ?>
            <button type="submit" class="profile-signout-btn">
              <i class="fas fa-arrow-right-from-bracket"></i>
              Sign Out
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- ── Stat Cards ── -->
    <div class="stats-grid">

      <div class="stat-card green">
        <div class="stat-top">
          <div class="stat-icon green"><i class="fas fa-door-open"></i></div>
          <span class="stat-tag tag-green">+3 new</span>
        </div>
        <div class="stat-value">12</div>
        <div class="stat-label">Available Rooms</div>
      </div>

      <div class="stat-card blue">
        <div class="stat-top">
          <div class="stat-icon blue"><i class="fas fa-calendar-check"></i></div>
          <span class="stat-tag tag-blue">This Week</span>
        </div>
        <div class="stat-value">8</div>
        <div class="stat-label">My Reservations</div>
      </div>

      <div class="stat-card amber">
        <div class="stat-top">
          <div class="stat-icon amber"><i class="fas fa-book-open"></i></div>
          <span class="stat-tag tag-amber">This Semester</span>
        </div>
        <div class="stat-value">12</div>
        <div class="stat-label">Active Classes</div>
      </div>

      <div class="stat-card purple">
        <div class="stat-top">
          <div class="stat-icon purple"><i class="fas fa-users"></i></div>
          <span class="stat-tag tag-purple">Enrolled</span>
        </div>
        <div class="stat-value">340</div>
        <div class="stat-label">Total Students</div>
      </div>

    </div>

    <!-- ── Bottom Grid ── -->
    <div class="bottom-grid">

      <!-- Upcoming Reservations -->
      <div class="panel">
        <div class="panel-header">
          <div class="panel-title">
            <span class="panel-title-icon pti-blue"><i class="fas fa-calendar-days"></i></span>
            Upcoming Reservations
          </div>
          <a href="<?= htmlspecialchars(url('/reservations')) ?>" class="link-all">
            View all <i class="fas fa-arrow-right" style="font-size:0.65rem;"></i>
          </a>
        </div>

        <?php
        // Replace with: $reservations = DB::table('reservations')->where('user_id', auth()->id())->orderBy('date')->get();
        $reservations = [
          [
            'room'     => 'IT Building – Room 301',
            'subject'  => 'Database Systems',
            'date_day' => 'Today',
            'date_num' => '31',
            'time'     => '2:00 PM – 4:00 PM',
            'students' => 42,
            'status'   => 'confirmed',
            'is_today' => true,
          ],
          [
            'room'     => 'IT Building – Room 205',
            'subject'  => 'Software Engineering',
            'date_day' => 'Tomorrow',
            'date_num' => '1',
            'time'     => '10:00 AM – 12:00 PM',
            'students' => 38,
            'status'   => 'confirmed',
            'is_today' => false,
          ],
          [
            'room'     => 'IT Building – Lab 102',
            'subject'  => 'Web Development',
            'date_day' => 'Thu',
            'date_num' => '3',
            'time'     => '1:00 PM – 3:00 PM',
            'students' => 35,
            'status'   => 'confirmed',
            'is_today' => false,
          ],
          [
            'room'     => 'IT Building – Room 310',
            'subject'  => 'Systems Analysis',
            'date_day' => 'Fri',
            'date_num' => '4',
            'time'     => '8:00 AM – 10:00 AM',
            'students' => 30,
            'status'   => 'pending',
            'is_today' => false,
          ],
        ];

        if (empty($reservations)): ?>
          <div class="empty-state">
            <i class="fas fa-calendar-xmark"></i>
            No upcoming reservations found.
          </div>
        <?php else:
          foreach ($reservations as $res):
            $badgeClass = match($res['status']) {
              'confirmed' => 'badge-confirmed',
              'pending'   => 'badge-pending',
              default     => 'badge-cancelled',
            };
            $badgeIcon = match($res['status']) {
              'confirmed' => 'fas fa-circle-check',
              'pending'   => 'fas fa-clock',
              default     => 'fas fa-circle-xmark',
            };
            $badgeLabel = ucfirst($res['status']);
        ?>
        <div class="res-row">
          <div class="res-date-col <?= $res['is_today'] ? 'today' : '' ?>">
            <div class="res-date-day"><?= htmlspecialchars($res['date_num']) ?></div>
            <div class="res-date-label"><?= htmlspecialchars($res['date_day']) ?></div>
          </div>
          <div class="res-body">
            <div class="res-room-name">
              <?= htmlspecialchars($res['room']) ?>
              <span class="badge <?= $badgeClass ?>">
                <i class="<?= $badgeIcon ?>"></i> <?= $badgeLabel ?>
              </span>
            </div>
            <div class="res-subject-name"><?= htmlspecialchars($res['subject']) ?></div>
            <div class="res-chips">
              <span class="res-chip"><i class="fas fa-clock"></i> <?= htmlspecialchars($res['time']) ?></span>
              <span class="res-chip"><i class="fas fa-users"></i> <?= htmlspecialchars($res['students']) ?> students</span>
            </div>
          </div>
          <div class="res-caret"><i class="fas fa-chevron-right"></i></div>
        </div>
        <?php endforeach; endif; ?>
      </div>

      <!-- Available Now -->
      <div class="panel">
        <div class="panel-header">
          <div class="panel-title">
            <span class="panel-title-icon pti-green"><i class="fas fa-door-open"></i></span>
            Available Now
          </div>
        </div>

        <?php
        // Replace with: $rooms = \App\Models\Room::where('status', 'available')->get();
        $rooms = [
          ['id' => 'IT-301', 'capacity' => 50, 'location' => 'IT Building · 3rd Floor', 'tags' => ['Projector', 'AC', 'WiFi']],
          ['id' => 'IT-205', 'capacity' => 45, 'location' => 'IT Building · 2nd Floor', 'tags' => ['Smart Board', 'AC']],
          ['id' => 'IT-104', 'capacity' => 40, 'location' => 'IT Building · 1st Floor', 'tags' => ['Projector', 'WiFi', 'Whiteboard']],
        ];

        if (empty($rooms)): ?>
          <div class="empty-state">
            <i class="fas fa-door-closed"></i>
            No rooms available right now.
          </div>
        <?php else:
          foreach ($rooms as $room): ?>
        <div class="room-row">
          <div class="room-header-row">
            <div class="room-id-text"><?= htmlspecialchars($room['id']) ?></div>
            <div class="room-cap-badge">
              <i class="fas fa-users"></i> <?= htmlspecialchars($room['capacity']) ?>
            </div>
          </div>
          <div class="room-location-text">
            <i class="fas fa-location-dot"></i>
            <?= htmlspecialchars($room['location']) ?>
          </div>
          <div class="room-tags">
            <?php foreach ($room['tags'] as $tag): ?>
            <span class="rtag"><?= htmlspecialchars($tag) ?></span>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; endif; ?>
      </div>

    </div><!-- /bottom-grid -->
  </div><!-- /content -->
</div><!-- /main -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  function closeAllProfileDropdowns() {
    document.querySelectorAll('.profile-dropdown').forEach(function (el) {
      el.classList.remove('is-open');
    });
  }

  document.querySelectorAll('.topbar-profile').forEach(function (profile) {
    var dropdown = profile.querySelector('.profile-dropdown');
    if (!dropdown) return;

    profile.addEventListener('click', function (event) {
      event.stopPropagation();
      var isOpen = dropdown.classList.contains('is-open');
      closeAllProfileDropdowns();
      if (!isOpen) {
        dropdown.classList.add('is-open');
      }
    });
  });

  document.addEventListener('click', closeAllProfileDropdowns);
});
</script>

</body>
</html>