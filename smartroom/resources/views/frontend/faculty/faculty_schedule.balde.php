<?php
// SmartDoor Faculty Portal - My Schedule
$faculty_name = "Prof. Elena Santos";
$faculty_dept = "Faculty of IT";
$faculty_initials = "ES";
$semester = "Spring Semester 2026";

$stats = [
    ["label" => "Total Subjects", "value" => "7", "icon" => "calendar"],
    ["label" => "Total Units", "value" => "21", "icon" => "clock"],
    ["label" => "This Week", "value" => "18 hrs", "icon" => "person"],
];

$days = ["Mon", "Tue", "Wed", "Thu", "Fri"];
$active_day = "Mon";

$full_day_names = [
    "Mon" => "Monday",
    "Tue" => "Tuesday",
    "Wed" => "Wednesday",
    "Thu" => "Thursday",
    "Fri" => "Friday",
];

$schedule_by_day = [
    "Mon" => [
        [
            "start" => "08:00",
            "end" => "10:00",
            "subject" => "Web Development",
            "code" => "IT-301",
            "section" => "BSIT 3A",
            "room" => "Room 101, IT Building",
            "type" => "Laboratory",
            "time_display" => "08:00 AM - 10:00 AM",
            "color" => "#1e3a5f",
        ],
        [
            "start" => "10:30",
            "end" => "12:30",
            "subject" => "Database Systems",
            "code" => "Room 16",
            "section" => "BSIT 3B",
            "room" => "Lab 105, IT Building",
            "type" => "Laboratory",
            "time_display" => "10:30 AM - 12:30 PM",
            "color" => "#3b4ab0",
        ],
        [
            "start" => "14:00",
            "end" => "16:00",
            "subject" => "Ethics in Computing",
            "code" => "IT-205",
            "section" => "BSIT 2A",
            "room" => "Room 201, Admin Building",
            "type" => "Lecture",
            "time_display" => "02:00 PM - 04:00 PM",
            "color" => "#7c3aed",
        ],
    ],
    "Tue" => [
        [
            "start" => "09:00",
            "end" => "11:00",
            "subject" => "Systems Analysis",
            "code" => "IT-312",
            "section" => "BSIT 3A",
            "room" => "Room 205, IT Building",
            "type" => "Lecture",
            "time_display" => "09:00 AM - 11:00 AM",
            "color" => "#1e3a5f",
        ],
        [
            "start" => "13:00",
            "end" => "15:00",
            "subject" => "Information Assurance",
            "code" => "IT-325",
            "section" => "BSIT 4A",
            "room" => "Room 302, Engineering Building",
            "type" => "Lecture",
            "time_display" => "01:00 PM - 03:00 PM",
            "color" => "#3b4ab0",
        ],
    ],
    "Wed" => [
        [
            "start" => "08:00",
            "end" => "10:00",
            "subject" => "Web Development",
            "code" => "IT-301",
            "section" => "BSIT 3A",
            "room" => "Room 101, IT Building",
            "type" => "Laboratory",
            "time_display" => "08:00 AM - 10:00 AM",
            "color" => "#1e3a5f",
        ],
        [
            "start" => "15:00",
            "end" => "17:00",
            "subject" => "Capstone Project",
            "code" => "IT-401",
            "section" => "BSIT 4A",
            "room" => "Innovation Lab, IT Building",
            "type" => "Consultation",
            "time_display" => "03:00 PM - 05:00 PM",
            "color" => "#7c3aed",
        ],
    ],
    "Thu" => [
        [
            "start" => "10:00",
            "end" => "12:00",
            "subject" => "Database Systems",
            "code" => "Room 16",
            "section" => "BSIT 3B",
            "room" => "Lab 105, IT Building",
            "type" => "Laboratory",
            "time_display" => "10:00 AM - 12:00 PM",
            "color" => "#3b4ab0",
        ],
    ],
    "Fri" => [
        [
            "start" => "13:30",
            "end" => "15:30",
            "subject" => "Faculty Advising",
            "code" => "ADV-101",
            "section" => "Advisees",
            "room" => "Faculty Office, IT Building",
            "type" => "Advising",
            "time_display" => "01:30 PM - 03:30 PM",
            "color" => "#7c3aed",
        ],
    ],
];

$active_classes = $schedule_by_day[$active_day] ?? [];

$weekly_overview = [];
foreach ($days as $day) {
    $weekly_overview[] = [
        "day" => $full_day_names[$day],
        "count" => count($schedule_by_day[$day] ?? []),
    ];
}

$nav_items = [
    ["icon" => "home",     "label" => "Dashboard"],
    ["icon" => "door",     "label" => "Reserve Room"],
    ["icon" => "list",     "label" => "My Reservations"],
    ["icon" => "building", "label" => "Room Availability"],
    ["icon" => "clock",    "label" => "My Schedule", "active" => true],
    ["icon" => "user",     "label" => "Profile"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartDoor – My Schedule</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3H59N9lWKQCaYMx50uDF08MkCsBPSP3E2McJ6+8WcGXflyZ2Zy1H56ZWDr8ZGhnPJ+9WMwQvvN4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:      #0f2044;
            --navy-mid:  #1a3060;
            --navy-soft: #1e3a5f;
            --accent:    #f5a623;
            --accent2:   #3b4ab0;
            --violet:    #7c3aed;
            --bg:        #f0f2f7;
            --white:     #ffffff;
            --text:      #1a2540;
            --muted:     #6b7a99;
            --border:    #dde2ef;
            --radius:    14px;
            --sidebar-w: 240px;
            --shadow:    0 2px 16px rgba(15,32,68,.08);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR (align with other faculty screens) ── */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 100;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(245,197,24,.06) 0%, transparent 55%);
            pointer-events: none;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 1px solid rgba(245,197,24,.08);
            pointer-events: none;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 28px 20px 24px 24px;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,.06);
            margin-bottom: 8px;
        }

        .logo-mark {
            width: 40px;
            height: 40px;
            background: #f5c518;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #0b1640;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(245,197,24,.4);
        }

        .logo-text { line-height: 1.2; }
        .logo-text .brand-psu {
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            color: rgba(255,255,255,.45);
            text-transform: uppercase;
            display: block;
            margin-bottom: 3px;
        }

        .logo-text .brand-main {
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.01em;
        }

        .logo-text .brand-main span {
            color: #f5c518;
        }

        .nav-section-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,.25);
            padding: 16px 24px 6px;
        }

        .sidebar-nav {
            padding: 0 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 500;
            color: rgba(255,255,255,.6);
            cursor: pointer;
            transition: all 0.22s cubic-bezier(.4,0,.2,1);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .nav-item:hover {
            background: rgba(255,255,255,.06);
            color: rgba(255,255,255,.9);
        }

        .nav-item.active {
            background: rgba(245,197,24,.14);
            color: #f5c518;
            font-weight: 600;
        }

        .nav-item svg {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            background: rgba(255,255,255,.05);
            flex-shrink: 0;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px 24px;
            border-top: 1px solid rgba(255,255,255,.06);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--navy-mid);
            border: 2px solid rgba(245,197,24,.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            color: #f5c518;
            flex-shrink: 0;
        }

        .faculty-info strong {
            font-size: 0.83rem;
            font-weight: 600;
            color: #fff;
            display: block;
        }

        .faculty-info span {
            font-size: 0.73rem;
            color: rgba(255,255,255,.4);
        }

        /* ── TOPBAR (matches other faculty screens) ── */
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar-search {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f3f5fb;
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 8px 18px;
            width: 340px;
        }

        .topbar-search i {
            color: #b3bed4;
            font-size: 0.9rem;
        }

        .topbar-search input {
            border: none;
            outline: none;
            background: transparent;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            width: 100%;
        }

        .topbar-search input::placeholder {
            color: #bcc5da;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notif-btn {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--navy-soft);
            font-size: 1.2rem;
            padding: 6px;
            border-radius: 10px;
            transition: background 0.18s;
        }

        .notif-btn:hover {
            background: #f3f5fb;
        }

        .notif-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 1.5px solid #ffffff;
        }

        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .topbar-profile-info {
            text-align: right;
        }

        .topbar-profile-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.2;
        }

        .topbar-profile-role {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .topbar-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e3e8f5;
            box-shadow: 0 4px 10px rgba(15,32,68,.18);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            padding: 30px 34px 40px;
            min-height: 100vh;
            background:
                radial-gradient(circle at 92% 8%, rgba(59,74,176,0.08) 0%, transparent 40%),
                radial-gradient(circle at 12% 92%, rgba(124,58,237,0.08) 0%, transparent 36%),
                var(--bg);
        }

        /* ── HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 22px;
            background: linear-gradient(145deg, #ffffff 0%, #f8faff 100%);
            border: 1px solid #dfe5f2;
            border-radius: 18px;
            padding: 20px 22px;
            box-shadow: 0 10px 26px rgba(15,32,68,0.08);
        }

        .page-title h1 {
            font-size: 30px;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.02em;
            line-height: 1.05;
        }
        .page-title p {
            font-size: 13px;
            color: var(--muted);
            margin-top: 5px;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: opacity .18s, transform .12s, box-shadow .18s;
        }
        .btn:hover { opacity: .92; transform: translateY(-1px); box-shadow: 0 6px 14px rgba(15,32,68,.12); }
        .btn svg { width: 15px; height: 15px; }

        .btn-share    { background: var(--white); border: 1px solid var(--border); color: var(--text); }
        .btn-download { background: var(--accent); color: var(--white); box-shadow: 0 3px 10px rgba(245,166,35,.35); }
        .btn-primary  { background: var(--navy); color: var(--white); }
        .btn-outline  { background: transparent; border: 1px solid var(--border); color: var(--muted); }

        /* ── STATS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 10px 24px rgba(15,32,68,.08);
            border: 1px solid #e1e7f4;
            position: relative;
            overflow: hidden;
            transition: transform .18s ease, box-shadow .18s ease;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 14px 30px rgba(15,32,68,.12); }
        .stat-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 14px;
            bottom: 14px;
            width: 4px;
            border-radius: 0 3px 3px 0;
            background: var(--accent2);
        }
        .stat-card:nth-child(2)::before { background: var(--accent); }
        .stat-card:nth-child(3)::before { background: #22a96a; }

        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon.blue   { background: #eef1fc; color: var(--accent2); }
        .stat-icon.orange { background: #fff5e0; color: var(--accent); }
        .stat-icon.green  { background: #e6f8f0; color: #22a96a; }
        .stat-icon svg { width: 20px; height: 20px; }

        .stat-label { font-size: 12px; color: var(--muted); font-weight: 500; margin-bottom: 3px; }
        .stat-value { font-size: 28px; font-weight: 800; color: var(--text); line-height: 1; letter-spacing: -0.02em; }

        /* ── DAY TABS ── */
        .day-tabs-wrap {
            background: var(--white);
            border-radius: var(--radius);
            padding: 10px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 8px 22px rgba(15,32,68,.08);
            border: 1px solid #e1e7f4;
        }

        .day-nav-btn {
            width: 32px; height: 32px;
            background: none;
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted);
            flex-shrink: 0;
        }

        .day-tabs {
            flex: 1;
            display: flex;
            gap: 6px;
        }

        .day-tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            transition: background .18s, color .18s;
            border: none;
            background: none;
        }
        .day-tab:hover { background: #eef2fb; color: var(--text); }
        .day-tab.active {
            background: linear-gradient(135deg, var(--navy-mid) 0%, var(--navy) 100%);
            color: var(--white);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(15,32,68,.24);
        }

        /* ── SECTION HEADER ── */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }
        .section-header h2 { font-size: 18px; font-weight: 800; }
        .section-header span { font-size: 13px; color: var(--muted); }

        /* ── CLASS CARDS ── */
        .classes-list { display: flex; flex-direction: column; gap: 14px; margin-bottom: 28px; }

        .class-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 0;
            overflow: hidden;
            box-shadow: 0 10px 24px rgba(15,32,68,.08);
            border: 1px solid #e1e7f4;
            display: flex;
            transition: transform .18s ease, box-shadow .18s ease;
        }
        .class-card:hover { transform: translateY(-2px); box-shadow: 0 14px 28px rgba(15,32,68,.11); }

        .class-accent-bar {
            width: 6px;
            flex-shrink: 0;
            border-radius: 0;
        }

        .class-inner {
            flex: 1;
            padding: 18px 20px;
        }

        .class-time-col {
            min-width: 52px;
            display: flex;
            flex-direction: column;
            font-family: 'DM Mono', monospace;
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
            line-height: 1.6;
            margin-top: 2px;
            background: #f7f9fd;
            border: 1px solid #e8edf8;
            border-radius: 10px;
            padding: 8px 10px;
            height: fit-content;
        }

        .class-body {
            display: flex;
            flex: 1;
            gap: 16px;
        }

        .class-details { flex: 1; }

        .class-title-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .class-name  { font-size: 17px; font-weight: 800; letter-spacing: -0.01em; }
        .class-badge {
            padding: 2px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: #eef1fc;
            color: var(--accent2);
        }

        .class-meta {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .class-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .class-meta svg { width: 13px; height: 13px; }

        .class-time-badge {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .class-actions { display: flex; gap: 8px; }

        /* ── WEEKLY OVERVIEW ── */
        .weekly-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 22px 24px;
            box-shadow: 0 10px 24px rgba(15,32,68,.08);
            border: 1px solid #e1e7f4;
        }

        .weekly-card h2 { font-size: 16px; font-weight: 700; margin-bottom: 16px; }

        .weekly-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }
        .weekly-row:last-child { border-bottom: none; }

        .weekly-row .day-dot {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--accent2);
            flex-shrink: 0;
        }

        .weekly-row .count { color: var(--muted); font-size: 13px; }

        .semester-banner {
            background: linear-gradient(135deg, #0f2044 0%, #1a3060 100%);
            border-radius: 16px;
            padding: 18px 20px;
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            color: #fff;
            box-shadow: 0 12px 24px rgba(15,32,68,.18);
        }
        .semester-title { font-size: 0.8rem; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.7); }
        .semester-sub { font-size: 1.08rem; font-weight: 700; margin-top: 3px; }
        .semester-pills { display: flex; gap: 8px; flex-wrap: wrap; }
        .semester-pill {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 999px;
            padding: 5px 11px;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255,255,255,.9);
        }

        .empty-state {
            background: #fff;
            border: 1px dashed #cbd5e8;
            border-radius: 12px;
            padding: 22px;
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 20px 16px; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .page-header { flex-direction: column; gap: 14px; }
            .class-body { flex-direction: column; }
            .class-time-col { width: 100%; }
            .semester-banner { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<!-- ═══════════════ SIDEBAR (FACULTY NAVIGATION) ═══════════════ -->
<div class="sidebar">
    <a href="<?= htmlspecialchars(url('/dashboard')) ?>" class="sidebar-logo">
        <div class="logo-mark">🚪</div>
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
                <span class="nav-icon"><i class="fas fa-home"></i></span>
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
        <div class="avatar"><?= htmlspecialchars($faculty_initials) ?></div>
        <div class="faculty-info">
            <strong><?= htmlspecialchars($faculty_name) ?></strong>
            <span><?= htmlspecialchars($faculty_dept) ?></span>
        </div>
    </div>
</div>

<!-- ══════════ MAIN ══════════ -->
<main class="main">

    <!-- Topbar -->
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
                    <div class="topbar-profile-name"><?= htmlspecialchars($faculty_name) ?></div>
                    <div class="topbar-profile-role"><?= htmlspecialchars($faculty_dept) ?></div>
                </div>
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="<?= htmlspecialchars($faculty_name) ?>">
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="page-header">
        <div class="page-title">
            <h1><?= htmlspecialchars($faculty_name) ?> Schedule</h1>
            <p>Your personal teaching timetable for <?= htmlspecialchars($semester) ?></p>
        </div>
        <div class="header-actions">
            <button class="btn btn-share">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                Share
            </button>
            <button class="btn btn-download">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Download
            </button>
        </div>
    </div>

    <div class="semester-banner">
        <div>
            <div class="semester-title">Semester Focus</div>
            <div class="semester-sub">Teaching Load: 5 Teaching Days / Week</div>
        </div>
        <div class="semester-pills">
            <span class="semester-pill">BSIT Program</span>
            <span class="semester-pill">Academic Year 2025-2026</span>
            <span class="semester-pill"><?= htmlspecialchars($semester) ?></span>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <?php
        $icon_defs = [
            "calendar" => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
            "clock"    => '<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/>',
            "person"   => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        ];
        $icon_colors = ["blue", "orange", "green"];
        foreach ($stats as $i => $s):
        ?>
        <div class="stat-card">
            <div class="stat-icon <?= $icon_colors[$i] ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <?= $icon_defs[$s['icon']] ?>
                </svg>
            </div>
            <div>
                <div class="stat-label"><?= htmlspecialchars($s['label']) ?></div>
                <div class="stat-value"><?= htmlspecialchars($s['value']) ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Day Tabs -->
    <div class="day-tabs-wrap">
        <button class="day-nav-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <div class="day-tabs">
            <?php foreach ($days as $day): ?>
            <button class="day-tab <?= $day === $active_day ? 'active' : '' ?>"><?= $day ?></button>
            <?php endforeach; ?>
        </div>
        <button class="day-nav-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
    </div>

    <!-- Monday Classes -->
    <div class="section-header">
        <h2 id="dayTitle"><?= htmlspecialchars($full_day_names[$active_day]) ?>'s Classes</h2>
        <span id="dayCount"><?= count($active_classes) ?> classes</span>
    </div>

    <div class="classes-list" id="classesList">
        <?php
        $time_badge_colors = [
            "#1e3a5f" => ["bg" => "#e8edf5", "color" => "#1e3a5f"],
            "#3b4ab0" => ["bg" => "#eef0fb", "color" => "#3b4ab0"],
            "#7c3aed" => ["bg" => "#f0ebff", "color" => "#7c3aed"],
        ];
        foreach ($active_classes as $cls):
            $badge = $time_badge_colors[$cls['color']] ?? ["bg" => "#eef1fc", "color" => "#3b4ab0"];
        ?>
        <div class="class-card">
            <div class="class-accent-bar" style="background:<?= $cls['color'] ?>;"></div>
            <div class="class-inner">
                <div class="class-body">
                    <div class="class-time-col">
                        <span><?= $cls['start'] ?></span>
                        <span><?= $cls['end'] ?></span>
                    </div>
                    <div class="class-details">
                        <div class="class-title-row">
                            <span class="class-name"><?= htmlspecialchars($cls['subject']) ?></span>
                            <span class="class-badge"><?= htmlspecialchars($cls['code']) ?></span>
                            <span class="class-time-badge" style="background:<?= $badge['bg'] ?>;color:<?= $badge['color'] ?>;">
                                <?= htmlspecialchars($cls['time_display']) ?>
                            </span>
                        </div>
                        <div class="class-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M7 12h10"/><path d="M10 18h4"/></svg>
                                <?= htmlspecialchars($cls['section']) ?>
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <?= htmlspecialchars($cls['room']) ?>
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/></svg>
                                <?= htmlspecialchars($cls['type']) ?>
                            </span>
                        </div>
                        <div class="class-actions">
                            <button class="btn btn-primary" style="font-size:12px;padding:8px 16px;border-radius:8px;">View Room</button>
                            <button class="btn btn-outline" style="font-size:12px;padding:8px 16px;border-radius:8px;">Get Directions</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <?php if (empty($active_classes)): ?>
        <div class="empty-state">No classes scheduled for <?= htmlspecialchars($full_day_names[$active_day]) ?>.</div>
        <?php endif; ?>
    </div>

    <!-- Weekly Overview -->
    <div class="weekly-card">
        <h2>Weekly Overview</h2>
        <?php foreach ($weekly_overview as $row): ?>
        <div class="weekly-row">
            <div class="day-dot">
                <span class="dot"></span>
                <span><?= htmlspecialchars($row['day']) ?></span>
            </div>
            <span class="count"><?= $row['count'] === 1 ? '1 class' : $row['count'] . ' classes' ?></span>
        </div>
        <?php endforeach; ?>
    </div>

</main>

<script>
    const scheduleData = <?= json_encode($schedule_by_day, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
    const dayNames = <?= json_encode($full_day_names, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
    const timeBadgeColors = {
        '#1e3a5f': { bg: '#e8edf5', color: '#1e3a5f' },
        '#3b4ab0': { bg: '#eef0fb', color: '#3b4ab0' },
        '#7c3aed': { bg: '#f0ebff', color: '#7c3aed' }
    };

    const dayTitle = document.getElementById('dayTitle');
    const dayCount = document.getElementById('dayCount');
    const classesList = document.getElementById('classesList');

    function renderDay(dayCode) {
        const classes = scheduleData[dayCode] || [];
        dayTitle.textContent = `${dayNames[dayCode]}'s Classes`;
        dayCount.textContent = `${classes.length} ${classes.length === 1 ? 'class' : 'classes'}`;

        if (classes.length === 0) {
            classesList.innerHTML = `<div class="empty-state">No classes scheduled for ${dayNames[dayCode]}.</div>`;
            return;
        }

        classesList.innerHTML = classes.map((cls) => {
            const badge = timeBadgeColors[cls.color] || { bg: '#eef1fc', color: '#3b4ab0' };
            return `
            <div class="class-card">
                <div class="class-accent-bar" style="background:${cls.color};"></div>
                <div class="class-inner">
                    <div class="class-body">
                        <div class="class-time-col">
                            <span>${cls.start}</span>
                            <span>${cls.end}</span>
                        </div>
                        <div class="class-details">
                            <div class="class-title-row">
                                <span class="class-name">${cls.subject}</span>
                                <span class="class-badge">${cls.code}</span>
                                <span class="class-time-badge" style="background:${badge.bg};color:${badge.color};">${cls.time_display}</span>
                            </div>
                            <div class="class-meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M7 12h10"/><path d="M10 18h4"/></svg>
                                    ${cls.section}
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    ${cls.room}
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/></svg>
                                    ${cls.type}
                                </span>
                            </div>
                            <div class="class-actions">
                                <button class="btn btn-primary" style="font-size:12px;padding:8px 16px;border-radius:8px;">View Room</button>
                                <button class="btn btn-outline" style="font-size:12px;padding:8px 16px;border-radius:8px;">Get Directions</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        }).join('');
    }

    document.querySelectorAll('.day-tab').forEach((tab) => {
        tab.addEventListener('click', function () {
            document.querySelectorAll('.day-tab').forEach((t) => t.classList.remove('active'));
            this.classList.add('active');
            renderDay(this.textContent.trim());
        });
    });
</script>
</body>
</html>