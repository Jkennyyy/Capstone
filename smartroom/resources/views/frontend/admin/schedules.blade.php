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
.schedule-search {
  display: flex; align-items: center; gap: 8px;
  width: 270px;
  padding: 9px 14px; border-radius: 10px;
  background: var(--white); border: 1.5px solid var(--border);
  box-shadow: var(--shadow);
  transition: border-color 0.18s, box-shadow 0.18s;
}
.schedule-search:focus-within { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(59,130,246,0.08); }
.schedule-search i { color: var(--text-light); font-size: 0.82rem; }
.schedule-search input {
  border: none; outline: none; background: transparent;
  width: 100%; color: var(--text); font-size: 0.84rem; font-family: 'Inter', sans-serif;
}
.schedule-search input::placeholder { color: var(--text-light); }
.btn-filter {
  display: flex; align-items: center; gap: 7px;
  padding: 10px 16px; border-radius: 11px;
  font-size: 0.84rem; font-weight: 700; letter-spacing: 0.01em; font-family: 'Inter', sans-serif;
  background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
  color: #334155;
  border: 1px solid #dbe3ef; cursor: pointer;
  transition: all 0.2s ease; box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
}
.btn-filter i { font-size: 0.8rem; }
.btn-filter:hover {
  border-color: #9fb5d8;
  color: #0f172a;
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(15, 23, 42, 0.12);
}
.btn-danger {
  background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
  color: #fff;
  border-color: #b91c1c;
  box-shadow: 0 6px 16px rgba(220, 38, 38, 0.26);
}
.btn-danger:hover {
  background: linear-gradient(180deg, #f87171 0%, #dc2626 100%);
  border-color: #991b1b;
  color: #fff;
}
.btn-filter[disabled] {
  opacity: 0.6;
  cursor: not-allowed;
}
.btn-add {
  display: flex; align-items: center; gap: 8px;
  padding: 10px 18px; border-radius: 11px;
  font-size: 0.84rem; font-weight: 700; letter-spacing: 0.01em; font-family: 'Inter', sans-serif;
  background: linear-gradient(135deg, #0b1640 0%, #1a2f80 100%);
  color: #fff; border: 1px solid #1e3a8a; cursor: pointer;
  transition: all 0.2s ease; box-shadow: 0 8px 20px rgba(11,22,64,0.28);
}
.btn-add i { font-size: 0.8rem; }
.btn-add:hover {
  background: linear-gradient(135deg, #13245f 0%, #2642aa 100%);
  transform: translateY(-1px);
  box-shadow: 0 10px 24px rgba(11,22,64,0.34);
}

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
.cal-day { padding: 7px 16px; border-radius: 9px; font-size: 0.86rem; font-weight: 600; color: var(--text-secondary); cursor: pointer; transition: all 0.18s; border: 1.5px solid transparent; background: transparent; }
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
.sc-select-wrap {
  display: none;
  align-items: center;
  gap: 7px;
  padding: 6px 10px;
  border-radius: 8px;
  border: 1.5px solid var(--border);
  background: #fff;
  color: var(--text-secondary);
  font-size: 0.76rem;
  font-weight: 600;
  cursor: pointer;
}
.sc-select-wrap input {
  width: 14px;
  height: 14px;
  accent-color: var(--navy-mid);
}
.schedule-list.selection-mode .sc-select-wrap {
  display: inline-flex;
}
.schedule-card.is-selected {
  border-color: #60a5fa;
  box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.12), var(--shadow-card);
}

/* AI ADVISOR */
.ai-advisor {
  background: var(--orange-bg); border: 1.5px solid var(--orange-border);
  border-radius: var(--radius); padding: 20px 24px;
  display: flex; gap: 16px; align-items: flex-start;
  animation: fadeIn 0.35s both 0.2s;
}
.ai-icon { width: 42px; height: 42px; border-radius: 11px; background: rgba(245,197,24,0.2); border: 1px solid rgba(245,197,24,0.35); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #b45309; flex-shrink: 0; }
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

/* IMPORT OVERLAY */
.import-overlay {
  position: fixed;
  inset: 0;
  z-index: 2600;
  display: none;
  align-items: center;
  justify-content: center;
  background: rgba(11, 22, 64, 0.48);
  backdrop-filter: blur(3px);
  padding: 18px;
}
.import-overlay.is-open { display: flex; }
.import-dialog {
  width: min(980px, 100%);
  max-height: calc(100vh - 36px);
  overflow: auto;
  border-radius: 14px;
  border: 1.5px solid var(--border);
  background: var(--white);
  box-shadow: 0 16px 42px rgba(11, 22, 64, 0.26);
}
.import-head {
  padding: 16px 18px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.import-title { font-size: 1rem; font-weight: 800; color: var(--text); }
.import-sub { margin-top: 3px; font-size: 0.8rem; color: var(--text-secondary); }
.import-close {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  border: 1.5px solid var(--border);
  background: var(--white);
  color: var(--text-secondary);
  cursor: pointer;
}
.import-body { padding: 16px 18px 18px; display: flex; flex-direction: column; gap: 12px; }
.import-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px; }
.import-field { display: flex; flex-direction: column; gap: 5px; }
.import-label { font-size: 0.72rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-secondary); }
.import-input, .import-select {
  height: 38px;
  border-radius: 9px;
  border: 1.5px solid var(--border);
  padding: 0 10px;
  font-size: 0.84rem;
  font-family: 'Inter', sans-serif;
  color: var(--text);
  background: var(--bg);
}
.import-file { grid-column: 1 / -1; }
.import-actions { display: flex; gap: 8px; align-items: center; }
.import-btn {
  height: 38px;
  border-radius: 9px;
  border: 1.5px solid var(--border);
  padding: 0 14px;
  font-size: 0.82rem;
  font-weight: 700;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  background: var(--white);
  color: var(--text-secondary);
}
.import-btn.primary {
  border-color: var(--navy);
  background: var(--navy);
  color: #fff;
}
.import-btn.primary:disabled,
.import-btn:disabled { opacity: 0.7; cursor: not-allowed; }
.import-summary { font-size: 0.82rem; color: var(--text-secondary); }
.import-error {
  display: none;
  padding: 10px 12px;
  border-radius: 9px;
  border: 1px solid #fecaca;
  background: #fef2f2;
  color: #991b1b;
  font-size: 0.8rem;
}
.import-error.is-visible { display: block; }
.import-preview-wrap {
  border: 1px solid var(--border);
  border-radius: 10px;
  overflow: hidden;
}
.import-preview-table {
  width: 100%;
  border-collapse: collapse;
}
.import-preview-table th,
.import-preview-table td {
  font-size: 0.78rem;
  text-align: left;
  padding: 8px 10px;
  border-bottom: 1px solid var(--border);
  vertical-align: top;
}
.import-preview-table th { background: #f8fafc; color: var(--text-secondary); font-weight: 700; }
.import-row-valid { color: #166534; }
.import-row-error { color: #991b1b; }

.create-overlay {
  position: fixed;
  inset: 0;
  z-index: 2700;
  display: none;
  align-items: center;
  justify-content: center;
  background: rgba(11, 22, 64, 0.5);
  backdrop-filter: blur(3px);
  padding: 18px;
}
.create-overlay.is-open { display: flex; }
.create-dialog {
  width: min(980px, 100%);
  max-height: calc(100vh - 36px);
  overflow: auto;
  border-radius: 14px;
  border: 1.5px solid var(--border);
  background: var(--white);
  box-shadow: 0 16px 42px rgba(11, 22, 64, 0.26);
}
.create-head {
  padding: 16px 18px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.create-title { font-size: 1rem; font-weight: 800; color: var(--text); }
.create-sub { margin-top: 3px; font-size: 0.8rem; color: var(--text-secondary); }
.create-close {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  border: 1.5px solid var(--border);
  background: var(--white);
  color: var(--text-secondary);
  cursor: pointer;
}
.create-body { padding: 16px 18px 18px; display: flex; flex-direction: column; gap: 12px; }
.create-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
.create-field { display: flex; flex-direction: column; gap: 5px; }
.create-field.full { grid-column: 1 / -1; }
.create-label { font-size: 0.72rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-secondary); }
.create-input, .create-select {
  height: 38px;
  border-radius: 9px;
  border: 1.5px solid var(--border);
  padding: 0 10px;
  font-size: 0.84rem;
  font-family: 'Inter', sans-serif;
  color: var(--text);
  background: var(--bg);
}
.create-context-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.create-room-summary {
  border: 1px solid var(--border);
  border-radius: 10px;
  background: #f8fafc;
  padding: 12px;
}
.create-room-summary-title {
  font-size: 0.78rem;
  font-weight: 800;
  color: var(--text);
  margin-bottom: 8px;
  letter-spacing: 0.02em;
}
.room-schedule-list { display: flex; flex-direction: column; gap: 8px; }
.room-schedule-item {
  border: 1px solid var(--border);
  border-radius: 9px;
  background: var(--white);
  padding: 8px 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}
.room-schedule-main { display: flex; flex-direction: column; gap: 3px; }
.room-schedule-subject { font-size: 0.8rem; font-weight: 700; color: var(--text); }
.room-schedule-meta { font-size: 0.75rem; color: var(--text-secondary); }
.room-schedule-time { font-size: 0.74rem; font-weight: 700; color: var(--navy-mid); white-space: nowrap; }
.room-schedule-empty { font-size: 0.78rem; color: var(--text-secondary); }
.create-actions { display: flex; gap: 8px; align-items: center; }
.create-btn {
  height: 38px;
  border-radius: 9px;
  border: 1.5px solid var(--border);
  padding: 0 14px;
  font-size: 0.82rem;
  font-weight: 700;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  background: var(--white);
  color: var(--text-secondary);
}
.create-btn.primary {
  border-color: var(--navy);
  background: var(--navy);
  color: #fff;
}

.edit-overlay {
  position: fixed;
  inset: 0;
  z-index: 2750;
  display: none;
  align-items: center;
  justify-content: center;
  background: rgba(11, 22, 64, 0.46);
  backdrop-filter: blur(3px);
  padding: 18px;
}
.edit-overlay.is-open { display: flex; }
.edit-dialog {
  width: min(560px, 100%);
  max-height: calc(100vh - 36px);
  overflow: auto;
  border-radius: 14px;
  border: 1.5px solid var(--border);
  background: var(--white);
  box-shadow: 0 16px 42px rgba(11, 22, 64, 0.22);
}
.edit-head {
  padding: 14px 16px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.edit-title { font-size: 0.96rem; font-weight: 800; color: var(--text); }
.edit-sub { margin-top: 3px; font-size: 0.78rem; color: var(--text-secondary); }
.edit-close {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  border: 1.5px solid var(--border);
  background: var(--white);
  color: var(--text-secondary);
  cursor: pointer;
}
.edit-body { padding: 14px 16px 16px; display: flex; flex-direction: column; gap: 10px; }
.edit-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
.edit-field { display: flex; flex-direction: column; gap: 5px; }
.edit-field.full { grid-column: 1 / -1; }
.edit-label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-secondary); }
.edit-input, .edit-select {
  height: 38px;
  border-radius: 9px;
  border: 1.5px solid var(--border);
  padding: 0 10px;
  font-size: 0.84rem;
  font-family: 'Inter', sans-serif;
  color: var(--text);
  background: var(--bg);
}
.edit-error {
  display: none;
  padding: 10px 12px;
  border-radius: 9px;
  border: 1px solid #fecaca;
  background: #fef2f2;
  color: #991b1b;
  font-size: 0.78rem;
}
.edit-error.is-visible { display: block; }
.edit-actions { display: flex; gap: 8px; align-items: center; }
.edit-btn {
  height: 38px;
  border-radius: 9px;
  border: 1.5px solid var(--border);
  padding: 0 14px;
  font-size: 0.82rem;
  font-weight: 700;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  background: var(--white);
  color: var(--text-secondary);
}
.edit-btn.primary {
  border-color: var(--navy);
  background: var(--navy);
  color: #fff;
}

@media (max-width:900px) {
  .import-grid { grid-template-columns: 1fr; }
  .create-grid { grid-template-columns: 1fr; }
  .edit-grid { grid-template-columns: 1fr; }
  .create-context-grid { grid-template-columns: 1fr; }
}
</style>
@include('frontend.admin.partials.minimal-ui-overrides')
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
      <a href="{{ route('admin.classrooms') }}">
        <span class="nav-icon"><i class="fas fa-school"></i></span>
        Room Management
      </a>
    </li>
    <li>
      <a href="{{ url('/admin/schedule') }}" class="active">
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
        <div class="schedule-search">
          <i class="fas fa-magnifying-glass"></i>
          <input type="text" id="scheduleSearchInput" placeholder="Search schedules...">
        </div>
        <button class="btn-filter" id="openImportBtn">
          <i class="fas fa-file-import"></i> Import
        </button>
        <button class="btn-filter" id="selectDeleteBtn" type="button">
          <i class="fas fa-check-square"></i> Select to Delete
        </button>
        <button class="btn-filter btn-danger" id="deleteSelectedBtn" type="button" style="display:none;" disabled>
          <i class="fas fa-trash"></i> Delete Selected (0)
        </button>
        <button class="btn-add" id="addScheduleBtn">
          <i class="fas fa-plus"></i> Add Schedule
        </button>
      </div>
    </div>

    <!-- Calendar Nav -->
    <div class="calendar-nav">
      <button class="cal-arrow" id="calPrevBtn" type="button" aria-label="Previous week"><i class="fas fa-chevron-left"></i></button>
      <span class="cal-month" id="calMonthLabel"></span>
      <button class="cal-arrow" id="calNextBtn" type="button" aria-label="Next week"><i class="fas fa-chevron-right"></i></button>

      <button class="cal-today-btn" id="calTodayBtn" type="button">Today</button>

      <div class="cal-days" id="calDaysContainer"></div>

      <div class="cal-spacer"></div>
      <button class="cal-icon-btn"><i class="fas fa-search"></i></button>
      <button class="cal-icon-btn"><i class="fas fa-calendar"></i></button>
    </div>

    <!-- Schedule List -->
    <div class="schedule-section">
      @php
        $scheduleRows = collect($schedules ?? []);
      @endphp
      <div class="schedule-day-header">
        <div class="schedule-day-label">Official Schedules</div>
        <div class="schedule-count" id="scheduleCountLabel">{{ $scheduleRows->count() }} Session(s)</div>
      </div>

      <div class="schedule-list" id="scheduleListContainer">
        @foreach ($scheduleRows as $schedule)
          @php
            $badge = $schedule->classroom?->name ?? 'N/A';
            $badge = strlen($badge) > 3 ? strtoupper(substr($badge, 0, 3)) : strtoupper($badge);
          @endphp
          <a href="{{ route('admin.schedule.show', $schedule->id) }}" class="schedule-card" data-start-date="{{ optional($schedule->start_at)->format('Y-m-d') }}">
            <div class="sc-time">
              <div class="sc-time-start">{{ optional($schedule->start_at)->format('h:i A') }}</div>
              <div class="sc-time-end">{{ optional($schedule->end_at)->format('h:i A') }}</div>
            </div>
            <div class="sc-bar bar-blue"></div>
            <div class="sc-room-badge">{{ $badge }}</div>
            <div class="sc-info">
              <div class="sc-title-row">
                <span class="sc-subject">{{ $schedule->course?->title ?? 'Untitled Subject' }}</span>
                <span class="sc-code">{{ $schedule->course?->code ?? 'N/A' }}</span>
              </div>
              <div class="sc-meta">
                <span class="sc-meta-item"><i class="fas fa-user"></i> {{ $schedule->course?->instructor?->name ?? 'Unassigned Faculty' }}</span>
                <span class="sc-meta-item"><i class="fas fa-location-dot"></i> {{ $schedule->classroom?->name ?? 'Room N/A' }}, {{ $schedule->classroom?->building ?? '-' }}</span>
              </div>
              <div class="sc-tag">
                <i class="fas fa-circle-check"></i> {{ ucfirst((string) ($schedule->status ?? 'scheduled')) }}
              </div>
            </div>
            <div class="sc-actions">
              <label class="sc-select-wrap" onclick="event.preventDefault();event.stopPropagation();">
                <input
                  type="checkbox"
                  class="schedule-select-checkbox"
                  value="{{ $schedule->id }}"
                  aria-label="Select schedule {{ $schedule->id }} for deletion"
                >
                <span>Select</span>
              </label>
              <button
                class="sc-edit-btn js-edit-schedule"
                data-schedule-id="{{ $schedule->id }}"
                data-schedule-classroom-id="{{ (int) ($schedule->classroom_id ?? 0) }}"
                data-schedule-course-id="{{ (int) ($schedule->course_id ?? 0) }}"
                data-schedule-status="{{ (string) ($schedule->status ?? 'scheduled') }}"
                data-schedule-start="{{ optional($schedule->start_at)->toIso8601String() }}"
                data-schedule-end="{{ optional($schedule->end_at)->toIso8601String() }}"
                data-schedule-enrolled="{{ (int) ($schedule->enrolled ?? 0) }}"
                data-schedule-subject="{{ (string) ($schedule->course?->title ?? 'Untitled Subject') }}"
                data-schedule-room="{{ (string) ($schedule->classroom?->name ?? 'Room N/A') }}"
                onclick="event.preventDefault();event.stopPropagation();"
              >Edit</button>
            </div>
          </a>
        @endforeach

        <div class="room-schedule-empty" id="scheduleEmptyAll" @if($scheduleRows->isNotEmpty()) style="display:none;" @endif>No schedules found yet.</div>
        <div class="room-schedule-empty" id="scheduleFilteredEmpty" style="display:none;">No schedules found for selected day.</div>

      </div>
    </div>

  </div>
</div>

<div class="edit-overlay" id="editScheduleOverlay" aria-hidden="true">
  <div class="edit-dialog" role="dialog" aria-modal="true" aria-labelledby="editScheduleTitle">
    <div class="edit-head">
      <div>
        <div class="edit-title" id="editScheduleTitle">Edit Schedule</div>
        <div class="edit-sub" id="editScheduleSub">Update schedule and optionally extend weekly sessions until semester end.</div>
      </div>
      <button class="edit-close" id="editScheduleClose" type="button" aria-label="Close edit schedule dialog">
        <i class="fas fa-xmark"></i>
      </button>
    </div>

    <form class="edit-body" id="editScheduleForm">
      <input type="hidden" id="editScheduleId">

      <div class="edit-grid">
        <div class="edit-field">
          <label class="edit-label" for="editScheduleClassroom">Room</label>
          <select class="edit-select" id="editScheduleClassroom" required>
            <option value="">Select room...</option>
            @foreach (($classrooms ?? []) as $classroom)
              <option value="{{ $classroom->id }}">{{ $classroom->name }} ({{ $classroom->building }})</option>
            @endforeach
          </select>
        </div>

        <div class="edit-field full">
          <label class="edit-label" for="editScheduleCourse">Subject</label>
          <select class="edit-select" id="editScheduleCourse" required>
            <option value="">Select subject...</option>
            @foreach (collect($courses ?? [])->filter() as $course)
              <option value="{{ $course->id }}">{{ $course->code }} - {{ $course->title }}</option>
            @endforeach
          </select>
        </div>

        <div class="edit-field">
          <label class="edit-label" for="editScheduleEnrolled">Expected Enrolled</label>
          <input class="edit-input" id="editScheduleEnrolled" type="number" min="0" value="0">
        </div>

        <div class="edit-field">
          <label class="edit-label" for="editScheduleStart">Start</label>
          <input class="edit-input" id="editScheduleStart" type="datetime-local" required>
        </div>

        <div class="edit-field">
          <label class="edit-label" for="editScheduleEnd">End</label>
          <input class="edit-input" id="editScheduleEnd" type="datetime-local" required>
        </div>

        <div class="edit-field">
          <label class="edit-label" for="editScheduleRepeatUntil">Repeat Until (Semester End)</label>
          <input class="edit-input" id="editScheduleRepeatUntil" type="date">
        </div>
      </div>

      <div class="edit-error" id="editScheduleError"></div>

      <div class="edit-actions">
        <button class="edit-btn primary" id="editScheduleSave" type="submit">
          <i class="fas fa-floppy-disk"></i> Save Changes
        </button>
        <button class="edit-btn" id="editScheduleCancel" type="button">Cancel</button>
      </div>
    </form>
  </div>
</div>

@php
  $instructors = collect($facultyUsers ?? [])->filter()->unique('id')->sortBy('name')->values();

  if ($instructors->isEmpty()) {
    $instructors = collect($courses ?? [])->pluck('instructor')->filter()->unique('id')->sortBy('name')->values();
  }
@endphp

<div class="create-overlay" id="createScheduleOverlay" aria-hidden="true">
  <div class="create-dialog" role="dialog" aria-modal="true" aria-labelledby="createScheduleTitle">
    <div class="create-head">
      <div>
        <div class="create-title" id="createScheduleTitle">Add Schedule Per Room</div>
        <div class="create-sub">Choose a room and save a weekly class schedule that repeats until semester end.</div>
      </div>
      <button class="create-close" id="createScheduleClose" type="button" aria-label="Close create schedule dialog">
        <i class="fas fa-xmark"></i>
      </button>
    </div>

    <form method="POST" action="{{ route('admin.schedule.store') }}" class="create-body">
      @csrf
      <div class="create-grid">
        <div class="create-field">
          <label class="create-label" for="createInstructorId">Instructor / Faculty</label>
          <select class="create-select" id="createInstructorId">
            <option value="">All instructors</option>
            @foreach ($instructors as $instructor)
              <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="create-field">
          <label class="create-label" for="createClassroomId">Room</label>
          <select class="create-select" id="createClassroomId" name="classroom_id" required>
            <option value="">Select room...</option>
            @foreach (($classrooms ?? []) as $classroom)
              <option value="{{ $classroom->id }}">{{ $classroom->name }} ({{ $classroom->building }})</option>
            @endforeach
          </select>
        </div>

        <div class="create-field">
          <label class="create-label" for="createCourseId">Subject</label>
          <select class="create-select" id="createCourseId" name="course_id" required>
            <option value="">Select subject...</option>
            @foreach (collect($courses ?? [])->filter() as $course)
              <option value="{{ $course->id }}" data-instructor-id="{{ $course->instructor_user_id }}">
                {{ $course->code }} - {{ $course->title }} @if($course->instructor) ({{ $course->instructor->name }}) @endif
              </option>
            @endforeach
          </select>
        </div>

        <div class="create-field">
          <label class="create-label" for="createStartAt">Start Time</label>
          <input class="create-input" id="createStartAt" name="start_at" type="datetime-local" required>
        </div>

        <div class="create-field">
          <label class="create-label" for="createEndAt">End Time</label>
          <input class="create-input" id="createEndAt" name="end_at" type="datetime-local" required>
        </div>

        <div class="create-field">
          <label class="create-label" for="createRepeatUntil">Repeat Until (Semester End)</label>
          <input class="create-input" id="createRepeatUntil" name="repeat_until" type="date" required>
        </div>

        <div class="create-field">
          <label class="create-label" for="createEnrolled">Expected Enrolled</label>
          <input class="create-input" id="createEnrolled" name="enrolled" type="number" min="0" value="0">
        </div>
      </div>

      <div class="create-context-grid">
        <div class="create-room-summary">
          <div class="create-room-summary-title">Room Schedule Context</div>
          <div class="room-schedule-list" id="roomScheduleList">
            <div class="room-schedule-empty">Select a room to view its current faculty subjects and time blocks.</div>
          </div>
        </div>

        <div class="create-room-summary">
          <div class="create-room-summary-title">Instructor Schedule Context</div>
          <div class="room-schedule-list" id="instructorScheduleList">
            <div class="room-schedule-empty">Select an instructor to view assigned subjects and schedule time blocks.</div>
          </div>
        </div>
      </div>

      <div class="create-actions">
        <button class="create-btn primary" type="submit">
          <i class="fas fa-floppy-disk"></i> Save Schedule
        </button>
        <button class="create-btn" id="createScheduleCancel" type="button">Cancel</button>
      </div>
    </form>
  </div>
</div>

<div class="import-overlay" id="scheduleImportOverlay" aria-hidden="true">
  <div class="import-dialog" role="dialog" aria-modal="true" aria-labelledby="scheduleImportTitle">
    <div class="import-head">
      <div>
        <div class="import-title" id="scheduleImportTitle">Import Admin Schedules</div>
        <div class="import-sub">Upload CSV/XLS/XLSX with room, instructor, start_at, and end_at for quick testing.</div>
      </div>
      <button class="import-close" id="scheduleImportClose" type="button" aria-label="Close import dialog">
        <i class="fas fa-xmark"></i>
      </button>
    </div>

    <div class="import-body">
      <div class="import-grid">
        <div class="import-field import-file">
          <label class="import-label" for="scheduleImportFile">Import File</label>
          <input class="import-input" id="scheduleImportFile" type="file" accept=".csv,.txt,.xls,.xlsx">
        </div>

        <div class="import-field">
          <label class="import-label" for="importDefaultRoom">Default Room (Optional)</label>
          <select class="import-select" id="importDefaultRoom">
            <option value="">None</option>
            @foreach (($classrooms ?? []) as $classroom)
              <option value="{{ $classroom->id }}">{{ $classroom->name }} ({{ $classroom->building }})</option>
            @endforeach
          </select>
        </div>

        <div class="import-field">
          <label class="import-label">Rows</label>
          <div class="import-summary" id="importSummaryText">No preview yet.</div>
        </div>
      </div>

      <div class="import-error" id="importErrorBox"></div>

      <div class="import-actions">
        <button class="import-btn" id="schedulePreviewBtn" type="button">
          <i class="fas fa-magnifying-glass"></i> Preview
        </button>
        <button class="import-btn primary" id="scheduleImportSaveBtn" type="button" disabled>
          <i class="fas fa-upload"></i> Save Valid Rows
        </button>
        <button class="import-btn" id="scheduleImportCancelBtn" type="button">Cancel</button>
      </div>

      <div class="import-preview-wrap">
        <table class="import-preview-table">
          <thead>
            <tr>
              <th>Row</th>
              <th>Room</th>
              <th>Instructor</th>
              <th>Start</th>
              <th>End</th>
              <th>Result</th>
            </tr>
          </thead>
          <tbody id="scheduleImportPreviewBody">
            <tr><td colspan="6" style="color:var(--text-light);">Upload a file and click Preview.</td></tr>
          </tbody>
        </table>
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

@php
  $roomSchedulesData = collect($schedules ?? [])->map(function ($schedule) {
      return [
          'classroom_id' => $schedule->classroom_id,
          'classroom_name' => (string) ($schedule->classroom?->name ?? 'Unknown Room'),
          'instructor_user_id' => $schedule->course?->instructor_user_id,
          'course_code' => (string) ($schedule->course?->code ?? 'N/A'),
          'subject' => (string) ($schedule->course?->title ?? 'Untitled Subject'),
          'faculty' => (string) ($schedule->course?->instructor?->name ?? 'Unassigned Faculty'),
          'start_at' => optional($schedule->start_at)->toIso8601String(),
          'end_at' => optional($schedule->end_at)->toIso8601String(),
          'status' => (string) ($schedule->status ?? 'scheduled'),
      ];
  })->values();
@endphp

<script type="application/json" id="roomSchedulesData">@json($roomSchedulesData)</script>

<script>
const toastWrap = (() => {
  let wrap = document.getElementById('toastWrap');
  if (!wrap) {
    wrap = document.createElement('div');
    wrap.id = 'toastWrap';
    wrap.style.cssText = 'position:fixed;right:18px;bottom:18px;display:flex;flex-direction:column;gap:8px;z-index:2200;pointer-events:none;';
    document.body.appendChild(wrap);
  }
  return wrap;
})();

function showToast(message, type = 'info') {
  if (!message) return;

  let background = '#eff6ff';
  let border = '#bfdbfe';
  let color = '#1d4ed8';

  if (type === 'error') {
    background = '#fef2f2';
    border = '#fecaca';
    color = '#991b1b';
  }

  if (type === 'success') {
    background = '#ecfdf5';
    border = '#86efac';
    color = '#166534';
  }

  const toast = document.createElement('div');
  toast.textContent = message;
  toast.style.cssText = `min-width:240px;max-width:360px;padding:10px 12px;border-radius:10px;border:1px solid ${border};box-shadow:0 10px 28px rgba(11,22,64,.2);font-size:.8rem;font-weight:600;opacity:0;transform:translateY(10px);transition:opacity .2s,transform .2s;background:${background};color:${color};`;
  toastWrap.appendChild(toast);

  requestAnimationFrame(() => {
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';
  });

  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateY(10px)';
    setTimeout(() => toast.remove(), 220);
  }, 2600);
}

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
            <span style="display:flex;align-items:center;gap:6px;font-size:0.82rem;color:rgba(255,255,255,0.55);"><i class="fas fa-location-dot" style="color:rgba(245,197,24,0.6);font-size:0.75rem;"></i> Room 15 – CIT Laboratory</span>
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
          <button onclick="window.location.href='{{ route('admin.schedule.export.csv') }}'" style="display:flex;align-items:center;gap:7px;padding:9px 18px;border-radius:9px;font-size:0.84rem;font-weight:700;font-family:'Inter',sans-serif;background:#f5c518;color:#0b1640;border:none;cursor:pointer;box-shadow:0 4px 14px rgba(245,197,24,0.35);"><i class="fas fa-print"></i> Export</button>
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
            ['Room','Room 15 – CIT Laboratory'],
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
          {day:'Today',num:'23',subj:'Session 15 – Trees & Graphs',time:'7:30–9:00 AM',room:'Room 15',today:true},
          {day:'Wed',  num:'25',subj:'Session 16 – Sorting Algorithms',time:'7:30–9:00 AM',room:'Room 16',today:false},
          {day:'Fri',  num:'27',subj:'Session 17 – Dynamic Programming',time:'7:30–9:00 AM',room:'Room 17',today:false},
          {day:'Mon',  num:'30',subj:'Session 18 – Graph Traversal',time:'7:30–9:00 AM',room:'Room 15',today:false},
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

const importOverlay = document.getElementById('scheduleImportOverlay');
const createOverlay = document.getElementById('createScheduleOverlay');
const editOverlay = document.getElementById('editScheduleOverlay');
const createCloseBtn = document.getElementById('createScheduleClose');
const createCancelBtn = document.getElementById('createScheduleCancel');
const editCloseBtn = document.getElementById('editScheduleClose');
const editCancelBtn = document.getElementById('editScheduleCancel');
const editForm = document.getElementById('editScheduleForm');
const editScheduleIdInput = document.getElementById('editScheduleId');
const editScheduleClassroomInput = document.getElementById('editScheduleClassroom');
const editScheduleCourseInput = document.getElementById('editScheduleCourse');
const editScheduleEnrolledInput = document.getElementById('editScheduleEnrolled');
const editScheduleStartInput = document.getElementById('editScheduleStart');
const editScheduleEndInput = document.getElementById('editScheduleEnd');
const editScheduleRepeatUntilInput = document.getElementById('editScheduleRepeatUntil');
const editScheduleErrorBox = document.getElementById('editScheduleError');
const editScheduleSub = document.getElementById('editScheduleSub');
const editScheduleSaveBtn = document.getElementById('editScheduleSave');
const createInstructorSelect = document.getElementById('createInstructorId');
const createClassroomSelect = document.getElementById('createClassroomId');
const createCourseSelect = document.getElementById('createCourseId');
const createStartAtInput = document.getElementById('createStartAt');
const createRepeatUntilInput = document.getElementById('createRepeatUntil');
const roomScheduleList = document.getElementById('roomScheduleList');
const instructorScheduleList = document.getElementById('instructorScheduleList');
const openImportBtn = document.getElementById('openImportBtn');
const importCloseBtn = document.getElementById('scheduleImportClose');
const importCancelBtn = document.getElementById('scheduleImportCancelBtn');
const importFileInput = document.getElementById('scheduleImportFile');
const importPreviewBtn = document.getElementById('schedulePreviewBtn');
const importSaveBtn = document.getElementById('scheduleImportSaveBtn');
const importPreviewBody = document.getElementById('scheduleImportPreviewBody');
const importErrorBox = document.getElementById('importErrorBox');
const importSummaryText = document.getElementById('importSummaryText');
const importDefaultRoom = document.getElementById('importDefaultRoom');

const previewEndpoint = "{{ route('admin.schedule.import.preview') }}";
const importEndpoint = "{{ route('admin.schedule.import.store') }}";
const roomSchedulesData = JSON.parse(document.getElementById('roomSchedulesData')?.textContent || '[]');
const calMonthLabel = document.getElementById('calMonthLabel');
const calDaysContainer = document.getElementById('calDaysContainer');
const calPrevBtn = document.getElementById('calPrevBtn');
const calNextBtn = document.getElementById('calNextBtn');
const calTodayBtn = document.getElementById('calTodayBtn');
const scheduleListContainer = document.getElementById('scheduleListContainer');
const scheduleCountLabel = document.getElementById('scheduleCountLabel');
const scheduleEmptyAll = document.getElementById('scheduleEmptyAll');
const scheduleFilteredEmpty = document.getElementById('scheduleFilteredEmpty');
const scheduleSearchInput = document.getElementById('scheduleSearchInput');
const selectDeleteBtn = document.getElementById('selectDeleteBtn');
const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
const bulkDeleteEndpoint = "{{ route('admin.schedule.bulk-destroy') }}";

let calendarAnchorDate = new Date();
let selectedCalendarDate = new Date();
let selectionModeEnabled = false;

function getScheduleCheckboxes() {
  return Array.from(document.querySelectorAll('.schedule-select-checkbox'));
}

function updateSelectionState() {
  const checkboxes = getScheduleCheckboxes();
  const selected = checkboxes.filter((checkbox) => checkbox.checked);
  const selectedCount = selected.length;

  checkboxes.forEach((checkbox) => {
    const card = checkbox.closest('.schedule-card');
    if (!(card instanceof HTMLElement)) return;
    card.classList.toggle('is-selected', checkbox.checked);
  });

  if (deleteSelectedBtn) {
    deleteSelectedBtn.disabled = selectedCount === 0;
    deleteSelectedBtn.innerHTML = `<i class="fas fa-trash"></i> Delete Selected (${selectedCount})`;
  }
}

function setSelectionMode(enabled) {
  selectionModeEnabled = enabled;

  if (scheduleListContainer) {
    scheduleListContainer.classList.toggle('selection-mode', enabled);
  }

  if (selectDeleteBtn) {
    selectDeleteBtn.innerHTML = enabled
      ? '<i class="fas fa-xmark"></i> Cancel Selection'
      : '<i class="fas fa-check-square"></i> Select to Delete';
  }

  if (deleteSelectedBtn) {
    deleteSelectedBtn.style.display = enabled ? '' : 'none';
  }

  if (!enabled) {
    getScheduleCheckboxes().forEach((checkbox) => {
      checkbox.checked = false;
    });
  }

  updateSelectionState();
}

async function deleteSelectedSchedules() {
  const selectedIds = getScheduleCheckboxes()
    .filter((checkbox) => checkbox.checked)
    .map((checkbox) => Number(checkbox.value))
    .filter((value) => Number.isInteger(value) && value > 0);

  if (selectedIds.length === 0) {
    showToast('Select at least one schedule to delete.', 'error');
    return;
  }

  const confirmed = window.confirm(`Delete ${selectedIds.length} selected schedule(s)? This cannot be undone.`);
  if (!confirmed) return;

  if (deleteSelectedBtn) {
    deleteSelectedBtn.disabled = true;
  }

  try {
    const response = await fetch(bulkDeleteEndpoint, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
      },
      body: JSON.stringify({ schedule_ids: selectedIds }),
    });

    const payload = await response.json().catch(() => ({}));

    if (!response.ok) {
      const errors = payload?.errors ? Object.values(payload.errors).flat().join(' ') : '';
      showToast(errors || payload?.message || 'Failed to delete selected schedules.', 'error');
      updateSelectionState();
      return;
    }

    showToast(payload?.message || 'Selected schedules deleted successfully.', 'success');
    window.location.reload();
  } catch (error) {
    showToast('Unable to delete selected schedules right now.', 'error');
    updateSelectionState();
  }
}

function startOfWeekMonday(date) {
  const cursor = new Date(date);
  cursor.setHours(0, 0, 0, 0);
  const day = cursor.getDay();
  const diff = day === 0 ? -6 : 1 - day;
  cursor.setDate(cursor.getDate() + diff);
  return cursor;
}

function addDays(date, days) {
  const next = new Date(date);
  next.setDate(next.getDate() + days);
  return next;
}

function toLocalDateKey(date) {
  return [
    date.getFullYear(),
    String(date.getMonth() + 1).padStart(2, '0'),
    String(date.getDate()).padStart(2, '0'),
  ].join('-');
}

function renderCalendarNav() {
  if (!calMonthLabel || !calDaysContainer) return;

  calMonthLabel.textContent = calendarAnchorDate.toLocaleDateString([], {
    month: 'long',
    year: 'numeric',
  });

  const weekStart = startOfWeekMonday(calendarAnchorDate);
  const activeKey = toLocalDateKey(selectedCalendarDate);
  const labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

  calDaysContainer.innerHTML = labels
    .map((label, index) => {
      const date = addDays(weekStart, index);
      const dateKey = toLocalDateKey(date);
      const isActive = dateKey === activeKey;

      return `<button type="button" class="cal-day ${isActive ? 'active' : ''}" data-date="${dateKey}">${label}</button>`;
    })
    .join('');
}

renderCalendarNav();

function applyScheduleDayFilter() {
  if (!scheduleListContainer) return;

  const cards = Array.from(scheduleListContainer.querySelectorAll('.schedule-card'));
  const activeDate = toLocalDateKey(selectedCalendarDate);
  const searchTerm = String(scheduleSearchInput?.value || '').trim().toLowerCase();
  let visibleCount = 0;

  cards.forEach((card) => {
    const cardDate = card.getAttribute('data-start-date') || '';
    const matchesDate = cardDate === activeDate;
    const matchesSearch = searchTerm === '' || String(card.textContent || '').toLowerCase().includes(searchTerm);
    const isVisible = matchesDate && matchesSearch;
    card.style.display = isVisible ? '' : 'none';
    if (isVisible) visibleCount += 1;
  });

  if (scheduleCountLabel) {
    scheduleCountLabel.textContent = `${visibleCount} Session(s)`;
  }

  if (scheduleEmptyAll) {
    scheduleEmptyAll.style.display = cards.length === 0 ? '' : 'none';
  }

  if (scheduleFilteredEmpty) {
    scheduleFilteredEmpty.style.display = cards.length > 0 && visibleCount === 0 ? '' : 'none';
  }
}

calDaysContainer?.addEventListener('click', (event) => {
  const target = event.target;
  if (!(target instanceof HTMLElement)) return;

  const dayBtn = target.closest('.cal-day');
  if (!(dayBtn instanceof HTMLElement)) return;

  const dateKey = dayBtn.getAttribute('data-date');
  if (!dateKey) return;

  selectedCalendarDate = new Date(`${dateKey}T00:00:00`);
  renderCalendarNav();
  applyScheduleDayFilter();
});

calPrevBtn?.addEventListener('click', () => {
  calendarAnchorDate = addDays(calendarAnchorDate, -7);
  selectedCalendarDate = startOfWeekMonday(calendarAnchorDate);
  renderCalendarNav();
  applyScheduleDayFilter();
});

calNextBtn?.addEventListener('click', () => {
  calendarAnchorDate = addDays(calendarAnchorDate, 7);
  selectedCalendarDate = startOfWeekMonday(calendarAnchorDate);
  renderCalendarNav();
  applyScheduleDayFilter();
});

calTodayBtn?.addEventListener('click', () => {
  calendarAnchorDate = new Date();
  selectedCalendarDate = new Date();
  renderCalendarNav();
  applyScheduleDayFilter();
});

scheduleSearchInput?.addEventListener('input', () => {
  applyScheduleDayFilter();
});

selectDeleteBtn?.addEventListener('click', (event) => {
  event.preventDefault();
  setSelectionMode(!selectionModeEnabled);
});

deleteSelectedBtn?.addEventListener('click', (event) => {
  event.preventDefault();
  deleteSelectedSchedules();
});

getScheduleCheckboxes().forEach((checkbox) => {
  checkbox.addEventListener('click', (event) => {
    event.stopPropagation();
  });

  checkbox.addEventListener('change', (event) => {
    event.stopPropagation();
    updateSelectionState();
  });
});

document.querySelectorAll('.schedule-card').forEach((card) => {
  card.addEventListener('click', (event) => {
    if (!selectionModeEnabled) return;

    const target = event.target;
    if (target instanceof HTMLElement && target.closest('.js-edit-schedule')) {
      return;
    }

    event.preventDefault();
    const checkbox = card.querySelector('.schedule-select-checkbox');
    if (!(checkbox instanceof HTMLInputElement)) return;
    checkbox.checked = !checkbox.checked;
    updateSelectionState();
  });
});

function formatRoomTime(value) {
  if (!value) return '-';
  const date = new Date(value);
  if (Number.isNaN(date.getTime())) return '-';

  return date.toLocaleString([], {
    month: 'short',
    day: '2-digit',
    hour: 'numeric',
    minute: '2-digit',
  });
}

function renderRoomSchedules(classroomId) {
  if (!roomScheduleList) return;

  if (!classroomId) {
    roomScheduleList.innerHTML = '<div class="room-schedule-empty">Select a room to view its current faculty subjects and time blocks.</div>';
    return;
  }

  const selectedInstructorId = createInstructorSelect?.value || '';

  const rows = roomSchedulesData
    .filter((row) => String(row.classroom_id) === String(classroomId))
    .filter((row) => !selectedInstructorId || String(row.instructor_user_id) === String(selectedInstructorId))
    .sort((a, b) => new Date(a.start_at || 0).getTime() - new Date(b.start_at || 0).getTime());

  if (rows.length === 0) {
    roomScheduleList.innerHTML = '<div class="room-schedule-empty">No schedule yet for this room.</div>';
    return;
  }

  roomScheduleList.innerHTML = rows.map((row) => {
    return `
      <div class="room-schedule-item">
        <div class="room-schedule-main">
          <div class="room-schedule-subject">${row.course_code} - ${row.subject}</div>
          <div class="room-schedule-meta">${row.faculty} • ${row.status}</div>
        </div>
        <div class="room-schedule-time">${formatRoomTime(row.start_at)} - ${formatRoomTime(row.end_at)}</div>
      </div>
    `;
  }).join('');
}

function renderInstructorSchedules(instructorId) {
  if (!instructorScheduleList) return;

  if (!instructorId) {
    instructorScheduleList.innerHTML = '<div class="room-schedule-empty">Select an instructor to view assigned subjects and schedule time blocks.</div>';
    return;
  }

  const rows = roomSchedulesData
    .filter((row) => String(row.instructor_user_id) === String(instructorId))
    .sort((a, b) => new Date(a.start_at || 0).getTime() - new Date(b.start_at || 0).getTime());

  if (rows.length === 0) {
    instructorScheduleList.innerHTML = '<div class="room-schedule-empty">No schedule yet for this instructor.</div>';
    return;
  }

  instructorScheduleList.innerHTML = rows.map((row) => {
    return `
      <div class="room-schedule-item">
        <div class="room-schedule-main">
          <div class="room-schedule-subject">${row.course_code} - ${row.subject}</div>
          <div class="room-schedule-meta">${row.classroom_name || 'No room'} • ${row.status}</div>
        </div>
        <div class="room-schedule-time">${formatRoomTime(row.start_at)} - ${formatRoomTime(row.end_at)}</div>
      </div>
    `;
  }).join('');
}

function filterCoursesByInstructor(instructorId) {
  if (!createCourseSelect) return;

  const options = Array.from(createCourseSelect.options);
  let hasVisibleSelected = false;

  options.forEach((option, index) => {
    if (index === 0) {
      option.hidden = false;
      option.disabled = false;
      return;
    }

    const optionInstructorId = option.getAttribute('data-instructor-id') || '';
    const visible = !instructorId || optionInstructorId === String(instructorId);
    option.hidden = !visible;
    option.disabled = !visible;

    if (visible && option.selected) {
      hasVisibleSelected = true;
    }
  });

  if (!hasVisibleSelected) {
    createCourseSelect.value = '';
  }
}

function toLocalDateInputValue(date) {
  return new Date(date.getTime() - date.getTimezoneOffset() * 60000)
    .toISOString()
    .slice(0, 10);
}

function getSemesterEndDate(referenceDate) {
  const month = referenceDate.getMonth() + 1;

  // Align defaults to common university terms: Jan-May and Jun-Dec.
  if (month <= 5) {
    return new Date(referenceDate.getFullYear(), 4, 31);
  }

  return new Date(referenceDate.getFullYear(), 11, 31);
}

function openCreateOverlay() {
  if (!createOverlay) return;
  createOverlay.classList.add('is-open');
  createOverlay.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';

  if (createRepeatUntilInput && !createRepeatUntilInput.value) {
    const startReference = createStartAtInput?.value ? new Date(createStartAtInput.value) : new Date();
    const semesterEnd = getSemesterEndDate(startReference);
    createRepeatUntilInput.value = toLocalDateInputValue(semesterEnd);
  }

  filterCoursesByInstructor(createInstructorSelect?.value || '');
  renderInstructorSchedules(createInstructorSelect?.value || '');
  renderRoomSchedules(createClassroomSelect?.value || '');
}

function closeCreateOverlay() {
  if (!createOverlay) return;
  createOverlay.classList.remove('is-open');
  createOverlay.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
}

function toDateTimeLocalValue(value) {
  if (!value) return '';
  const parsed = new Date(value);
  if (Number.isNaN(parsed.getTime())) return '';

  const local = new Date(parsed.getTime() - parsed.getTimezoneOffset() * 60000);
  return local.toISOString().slice(0, 16);
}

function clearEditError() {
  if (!editScheduleErrorBox) return;
  editScheduleErrorBox.textContent = '';
  editScheduleErrorBox.classList.remove('is-visible');
}

function setEditError(message) {
  if (!editScheduleErrorBox) return;
  editScheduleErrorBox.textContent = message;
  editScheduleErrorBox.classList.add('is-visible');
}

function openEditOverlay(payload) {
  if (!editOverlay) return;

  editScheduleIdInput.value = payload.id || '';
  editScheduleClassroomInput.value = payload.classroomId || '';
  editScheduleCourseInput.value = payload.courseId || '';
  editScheduleEnrolledInput.value = String(payload.enrolled ?? 0);
  editScheduleStartInput.value = toDateTimeLocalValue(payload.startAt);
  editScheduleEndInput.value = toDateTimeLocalValue(payload.endAt);
  if (editScheduleRepeatUntilInput) {
    const startReference = payload.startAt ? new Date(payload.startAt) : new Date();
    const semesterEnd = getSemesterEndDate(startReference);
    editScheduleRepeatUntilInput.value = toLocalDateInputValue(semesterEnd);
  }
  editScheduleSub.textContent = `${payload.subject || 'Schedule'} • ${payload.room || 'Room'}`;
  clearEditError();

  editOverlay.classList.add('is-open');
  editOverlay.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';
}

function closeEditOverlay() {
  if (!editOverlay) return;
  editOverlay.classList.remove('is-open');
  editOverlay.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
  clearEditError();
}

function openImportOverlay() {
  if (!importOverlay) return;
  importOverlay.classList.add('is-open');
  importOverlay.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';
}

function closeImportOverlay() {
  if (!importOverlay) return;
  importOverlay.classList.remove('is-open');
  importOverlay.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
}

function clearImportError() {
  if (!importErrorBox) return;
  importErrorBox.textContent = '';
  importErrorBox.classList.remove('is-visible');
}

function setImportError(message) {
  if (!importErrorBox) return;
  importErrorBox.textContent = message;
  importErrorBox.classList.add('is-visible');
}

function renderImportPreview(rows) {
  if (!importPreviewBody) return;

  if (!Array.isArray(rows) || rows.length === 0) {
    importPreviewBody.innerHTML = '<tr><td colspan="6" style="color:var(--text-light);">No rows found in file.</td></tr>';
    return;
  }

  importPreviewBody.innerHTML = rows.map((row) => {
    const statusClass = row.is_valid ? 'import-row-valid' : 'import-row-error';
    const resultText = row.is_valid ? 'Valid' : (row.errors || []).join(' | ');

    return `
      <tr>
        <td>${row.row_number ?? '-'}</td>
        <td>${row.room ?? '-'}</td>
        <td>${row.instructor ?? '-'}</td>
        <td>${row.start_at ?? '-'}</td>
        <td>${row.end_at ?? '-'}</td>
        <td class="${statusClass}">${resultText}</td>
      </tr>
    `;
  }).join('');
}

async function requestImportPreview() {
  clearImportError();

  const file = importFileInput?.files?.[0];
  if (!file) {
    setImportError('Select a CSV/XLS/XLSX file first.');
    return;
  }

  const formData = new FormData();
  formData.append('file', file);
  if (importDefaultRoom?.value) formData.append('default_classroom_id', importDefaultRoom.value);

  importPreviewBtn.disabled = true;
  importSaveBtn.disabled = true;
  const controller = new AbortController();
  const timeoutId = setTimeout(() => controller.abort(), 30000);

  try {
    const response = await fetch(previewEndpoint, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
      },
      body: formData,
      signal: controller.signal,
    });

    const payload = await response.json().catch(() => ({}));

    if (!response.ok) {
      setImportError(payload?.message || 'Failed to preview import file.');
      return;
    }

    const rows = payload?.data?.rows || [];
    const validCount = Number(payload?.data?.valid_count || 0);
    const errorCount = Number(payload?.data?.error_count || 0);

    renderImportPreview(rows);
    importSummaryText.textContent = `${rows.length} row(s): ${validCount} valid, ${errorCount} with errors.`;
    importSaveBtn.disabled = rows.length === 0 || errorCount > 0;
  } catch (error) {
    if (error?.name === 'AbortError') {
      setImportError('Preview timed out. Try a smaller file or try again.');
    } else {
      setImportError('Unable to reach server for preview.');
    }
  } finally {
    clearTimeout(timeoutId);
    importPreviewBtn.disabled = false;
  }
}

async function submitImportRows() {
  clearImportError();

  const file = importFileInput?.files?.[0];
  if (!file) {
    setImportError('Select a CSV/XLS/XLSX file first.');
    return;
  }

  const formData = new FormData();
  formData.append('file', file);
  if (importDefaultRoom?.value) formData.append('default_classroom_id', importDefaultRoom.value);

  importSaveBtn.disabled = true;
  const controller = new AbortController();
  const timeoutId = setTimeout(() => controller.abort(), 45000);

  try {
    const response = await fetch(importEndpoint, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
      },
      body: formData,
      signal: controller.signal,
    });

    const payload = await response.json().catch(() => ({}));

    if (!response.ok) {
      setImportError(payload?.message || 'Import failed.');
      if (payload?.data?.rows) {
        renderImportPreview(payload.data.rows);
        importSummaryText.textContent = `${payload?.data?.rows?.length || 0} row(s): ${payload?.data?.valid_count || 0} valid, ${payload?.data?.error_count || 0} with errors.`;
      }
      return;
    }

    showToast(payload?.message || 'Schedule import completed successfully.', 'success');
    window.location.reload();
  } catch (error) {
    if (error?.name === 'AbortError') {
      setImportError('Import timed out. Try importing fewer rows per batch.');
    } else {
      setImportError('Unable to reach server for import.');
    }
  } finally {
    clearTimeout(timeoutId);
    importSaveBtn.disabled = false;
  }
}

document.getElementById('addScheduleBtn')?.addEventListener('click', (event) => {
  event.preventDefault();
  openCreateOverlay();
});

openImportBtn?.addEventListener('click', (event) => {
  event.preventDefault();
  openImportOverlay();
});

createCloseBtn?.addEventListener('click', closeCreateOverlay);
createCancelBtn?.addEventListener('click', closeCreateOverlay);
createInstructorSelect?.addEventListener('change', (event) => {
  const instructorId = event.target.value;
  filterCoursesByInstructor(instructorId);
  renderInstructorSchedules(instructorId);
  renderRoomSchedules(createClassroomSelect?.value || '');
});
createClassroomSelect?.addEventListener('change', (event) => {
  renderRoomSchedules(event.target.value);
});

createStartAtInput?.addEventListener('change', () => {
  if (!createRepeatUntilInput || !createStartAtInput?.value) return;

  const startDate = new Date(createStartAtInput.value);
  if (Number.isNaN(startDate.getTime())) return;

  const minDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());
  const localMinDate = toLocalDateInputValue(minDate);

  createRepeatUntilInput.min = localMinDate;

  const currentRepeat = createRepeatUntilInput.value ? new Date(`${createRepeatUntilInput.value}T00:00:00`) : null;
  if (!currentRepeat || currentRepeat < minDate) {
    const semesterEnd = getSemesterEndDate(startDate);
    const chosen = semesterEnd < minDate ? minDate : semesterEnd;
    createRepeatUntilInput.value = toLocalDateInputValue(chosen);
  }
});

editScheduleStartInput?.addEventListener('change', () => {
  if (!editScheduleRepeatUntilInput || !editScheduleStartInput?.value) return;

  const startDate = new Date(editScheduleStartInput.value);
  if (Number.isNaN(startDate.getTime())) return;

  const minDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());
  const localMinDate = toLocalDateInputValue(minDate);
  editScheduleRepeatUntilInput.min = localMinDate;

  const currentRepeat = editScheduleRepeatUntilInput.value ? new Date(`${editScheduleRepeatUntilInput.value}T00:00:00`) : null;
  if (!currentRepeat || currentRepeat < minDate) {
    const semesterEnd = getSemesterEndDate(startDate);
    const chosen = semesterEnd < minDate ? minDate : semesterEnd;
    editScheduleRepeatUntilInput.value = toLocalDateInputValue(chosen);
  }
});

importCloseBtn?.addEventListener('click', closeImportOverlay);
importCancelBtn?.addEventListener('click', closeImportOverlay);
importPreviewBtn?.addEventListener('click', requestImportPreview);
importSaveBtn?.addEventListener('click', submitImportRows);

importOverlay?.addEventListener('click', (event) => {
  if (event.target === importOverlay) {
    closeImportOverlay();
  }
});

createOverlay?.addEventListener('click', (event) => {
  if (event.target === createOverlay) {
    closeCreateOverlay();
  }
});

editOverlay?.addEventListener('click', (event) => {
  if (event.target === editOverlay) {
    closeEditOverlay();
  }
});

document.addEventListener('keydown', (event) => {
  if (event.key !== 'Escape') return;

  if (createOverlay?.classList.contains('is-open')) {
    closeCreateOverlay();
    return;
  }

  if (editOverlay?.classList.contains('is-open')) {
    closeEditOverlay();
    return;
  }

  if (importOverlay?.classList.contains('is-open')) {
    closeImportOverlay();
  }
});

editCloseBtn?.addEventListener('click', closeEditOverlay);
editCancelBtn?.addEventListener('click', closeEditOverlay);

editForm?.addEventListener('submit', async (event) => {
  event.preventDefault();

  clearEditError();

  const scheduleId = editScheduleIdInput?.value;
  if (!scheduleId) {
    setEditError('Missing schedule id.');
    return;
  }

  const classroomId = (editScheduleClassroomInput?.value || '').trim();
  const courseId = (editScheduleCourseInput?.value || '').trim();
  const startAt = editScheduleStartInput?.value || '';
  const endAt = editScheduleEndInput?.value || '';
  const repeatUntil = editScheduleRepeatUntilInput?.value || '';
  const enrolledRaw = editScheduleEnrolledInput?.value || '0';
  const enrolled = Number.isNaN(Number(enrolledRaw)) ? 0 : Math.max(0, parseInt(enrolledRaw, 10));

  if (!classroomId || !courseId || !startAt || !endAt) {
    setEditError('Room, subject, start, and end are required.');
    return;
  }

  if (new Date(endAt).getTime() <= new Date(startAt).getTime()) {
    setEditError('End time must be after start time.');
    return;
  }

  editScheduleSaveBtn.disabled = true;

  try {
    const response = await fetch(`/admin/schedule/${scheduleId}`, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
      },
      body: JSON.stringify({
        classroom_id: Number(classroomId),
        course_id: Number(courseId),
        start_at: startAt,
        end_at: endAt,
        repeat_until: repeatUntil || null,
        enrolled,
      }),
    });

    const payload = await response.json().catch(() => ({}));

    if (!response.ok) {
      const errors = payload?.errors ? Object.values(payload.errors).flat().join(' ') : '';
      setEditError(errors || payload?.message || 'Failed to update schedule.');
      return;
    }

    closeEditOverlay();
    window.location.reload();
  } catch (error) {
    setEditError('Unable to update schedule right now.');
  } finally {
    editScheduleSaveBtn.disabled = false;
  }
});

document.querySelectorAll('.js-edit-schedule').forEach((button) => {
  button.addEventListener('click', (event) => {
    event.preventDefault();
    event.stopPropagation();

    const scheduleId = button.getAttribute('data-schedule-id');
    if (!scheduleId) return;

    openEditOverlay({
      id: scheduleId,
      classroomId: button.getAttribute('data-schedule-classroom-id') || '',
      courseId: button.getAttribute('data-schedule-course-id') || '',
      startAt: button.getAttribute('data-schedule-start') || '',
      endAt: button.getAttribute('data-schedule-end') || '',
      enrolled: button.getAttribute('data-schedule-enrolled') || '0',
      subject: button.getAttribute('data-schedule-subject') || 'Schedule',
      room: button.getAttribute('data-schedule-room') || 'Room',
    });
  });
});
</script>

</body>
</html>