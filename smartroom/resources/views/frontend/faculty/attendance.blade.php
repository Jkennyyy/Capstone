<?php
$facultyName     = $facultyName     ?? request()->user()?->name ?? 'Faculty';
$facultyDept     = $facultyDept     ?? request()->user()?->department ?? 'Faculty';
$facultyEmail    = $facultyEmail    ?? request()->user()?->email ?? '';
$facultyInitials = $facultyInitials ?? strtoupper(substr((string) $facultyName, 0, 1));

$courses      = $courses      ?? [];
$sessions     = $sessions     ?? collect([]);
$stats        = $stats        ?? ['total_sessions'=>0,'this_month'=>0,'overall_rate'=>0,'open_session'=>null];
$filterCourse = $filterCourse ?? '';
$filterStatus = $filterStatus ?? '';
$filterMonth  = $filterMonth  ?? now()->format('Y-m');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance – SmartDoor</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root {
  --yellow:#f5c518; --yellow-light:#fef9e7;
  --navy:#0b1640; --navy-mid:#1a2f80; --navy-light:#e8ecfb;
  --white:#ffffff; --bg:#f0f2f8; --bg-card:#ffffff;
  --border:#e4e8f0; --border-strong:#cdd3e0;
  --text:#0f1729; --text-2:#3d4a5c; --text-3:#7c8a9e; --text-4:#b0bac8;
  --green:#0f9d58; --green-mid:#12b564; --green-bg:#e6f9f0; --green-border:#a7e9c8; --green-text:#0a7a43;
  --blue:#1a56db; --blue-mid:#2563eb; --blue-bg:#eaf0fd; --blue-border:#93b8f8; --blue-text:#1740b0;
  --amber:#d97706; --amber-bg:#fef3e2; --amber-border:#fcd38a; --amber-text:#b45309;
  --purple:#7c3aed; --purple-bg:#f4f0fe; --purple-border:#c4b5fd; --purple-text:#5b21b6;
  --red:#dc2626; --red-bg:#fef2f2; --red-border:#fca5a5; --red-text:#b91c1c;
  --shadow-xs:0 1px 2px rgba(15,23,41,.05);
  --shadow-sm:0 2px 6px rgba(15,23,41,.06),0 1px 2px rgba(15,23,41,.04);
  --shadow-md:0 4px 16px rgba(15,23,41,.08),0 1px 4px rgba(15,23,41,.04);
  --shadow-lg:0 8px 32px rgba(15,23,41,.10),0 2px 8px rgba(15,23,41,.06);
  --radius-xs:6px; --radius-sm:10px; --radius:14px; --radius-lg:18px;
  --sidebar-w:230px;
  --font-head:'Plus Jakarta Sans',sans-serif;
  --font-body:'DM Sans',sans-serif;
}

body{font-family:var(--font-body);background:var(--bg);color:var(--text);min-height:100vh;display:flex;-webkit-font-smoothing:antialiased}

/* ══ SIDEBAR ══ */
.sidebar{position:fixed;left:0;top:0;width:var(--sidebar-w);height:100vh;background:var(--navy);display:flex;flex-direction:column;overflow:hidden;z-index:100}
.sidebar::before{content:'';position:absolute;inset:0;background:linear-gradient(160deg,rgba(245,197,24,.06) 0%,transparent 55%);pointer-events:none}
.sidebar::after{content:'';position:absolute;bottom:-60px;right:-60px;width:180px;height:180px;border-radius:50%;border:1px solid rgba(245,197,24,.08);pointer-events:none}
.sidebar-logo{display:flex;align-items:center;gap:12px;padding:28px 20px 24px 24px;text-decoration:none;border-bottom:1px solid rgba(255,255,255,.06);margin-bottom:8px}
.logo-mark{width:40px;height:40px;background:var(--yellow);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:var(--navy);flex-shrink:0;box-shadow:0 4px 12px rgba(245,197,24,.4)}
.logo-text .brand-psu{font-size:.6rem;font-weight:600;letter-spacing:.18em;color:rgba(255,255,255,.45);text-transform:uppercase;display:block;margin-bottom:3px}
.logo-text .brand-main{font-size:1.05rem;font-weight:700;color:#fff;letter-spacing:-.01em}
.logo-text .brand-main span{color:var(--yellow)}
.nav-section-label{font-size:.68rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.25);padding:16px 24px 6px}
.sidebar-nav{list-style:none;overflow-y:auto;padding:0 12px}
.sidebar-nav::-webkit-scrollbar{width:0}
.sidebar-nav li{margin-bottom:2px}
.sidebar-nav a{display:flex;align-items:center;gap:11px;padding:11px 12px;text-decoration:none;color:rgba(255,255,255,.6);font-size:.88rem;font-weight:500;border-radius:var(--radius-sm);transition:all .22s cubic-bezier(.4,0,.2,1);position:relative;overflow:hidden}
.sidebar-nav a .nav-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;background:rgba(255,255,255,.05);flex-shrink:0;transition:all .22s}
.sidebar-nav a:hover{color:rgba(255,255,255,.9);background:rgba(255,255,255,.06)}
.sidebar-nav a:hover .nav-icon{background:rgba(255,255,255,.1)}
.sidebar-nav a.active{background:rgba(245,197,24,.14);color:var(--yellow)}
.sidebar-nav a.active .nav-icon{background:rgba(245,197,24,.2);color:var(--yellow)}
.sidebar-nav a.active::before{content:'';position:absolute;left:0;top:20%;bottom:20%;width:3px;background:var(--yellow);border-radius:0 2px 2px 0}
.sidebar-footer{margin-top:auto;padding:16px 12px 24px;border-top:1px solid rgba(255,255,255,.06)}
.user-widget{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:var(--radius-sm);background:rgba(255,255,255,.05);margin-bottom:8px}
.user-avatar{width:34px;height:34px;border-radius:50%;flex-shrink:0;background:var(--navy-mid);border:2px solid rgba(245,197,24,.4);display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700;color:var(--yellow)}
.user-widget-name{font-size:.83rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.user-widget-role{font-size:.73rem;color:rgba(255,255,255,.4)}
.sidebar-logout-btn{display:flex;align-items:center;gap:10px;padding:9px 12px;color:rgba(255,255,255,.4);font-size:.84rem;font-weight:500;border-radius:var(--radius-sm);transition:all .22s;width:100%;background:none;border:none;cursor:pointer;font-family:inherit}
.sidebar-logout-btn:hover{color:#f87171;background:rgba(244,63,94,.08)}
.sidebar-logout-btn .nav-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;background:rgba(255,255,255,.05)}

/* ══ MAIN ══ */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}

/* ── TOPBAR ── */
.topbar{background:rgba(255,255,255,.92);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border-bottom:1px solid rgba(229,231,235,.7);padding:0 32px;height:68px;display:flex;align-items:center;gap:16px;position:sticky;top:0;z-index:50;box-shadow:0 1px 12px rgba(26,43,109,.06)}
.topbar-left{display:flex;align-items:center;gap:10px}
.topbar-title{font-family:var(--font-head);font-size:1.05rem;font-weight:700;color:var(--text)}
.topbar-subtitle{font-size:.78rem;color:var(--text-3);font-weight:400}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:12px}
.topbar-profile{position:relative;display:flex;align-items:center;gap:10px;cursor:pointer;padding:6px 10px;border-radius:var(--radius-sm);transition:background .16s}
.topbar-profile:hover{background:#f4f6fa}
.topbar-profile-name{font-size:.86rem;font-weight:700;color:var(--text);line-height:1.2}
.topbar-profile-role{font-size:.73rem;color:var(--text-3)}
.topbar-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#4a6cf7,#1a2b6d);border:2px solid rgba(74,108,247,.3);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.78rem;color:#fff;box-shadow:0 2px 8px rgba(74,108,247,.25)}
.notif-btn{position:relative;background:none;border:1.5px solid #e8eaf0;cursor:pointer;color:var(--text-2);font-size:.95rem;width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:background .18s,border-color .18s}
.notif-btn:hover{background:#f0f2ff;border-color:#c7d2fe}

/* ══ CONTENT ══ */
.content{padding:28px 32px 60px;display:flex;flex-direction:column;gap:24px}

/* ── PAGE HEADER ── */
.page-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;background:#2340a0;border-radius:var(--radius-lg);padding:26px 32px;position:relative;overflow:hidden;box-shadow:0 8px 32px rgba(26,43,109,.22)}
.page-header::before{content:'';position:absolute;top:-40px;right:-40px;width:220px;height:220px;border-radius:50%;background:rgba(245,197,24,.08);pointer-events:none}
.page-header::after{content:'';position:absolute;bottom:-60px;left:40%;width:160px;height:160px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none}
.page-header-left{position:relative;z-index:1}
.page-header-eyebrow{font-size:.72rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.5);margin-bottom:6px}
.page-header-title{font-family:var(--font-head);font-size:1.55rem;font-weight:800;color:#fff;letter-spacing:-.02em;line-height:1.2;margin-bottom:4px}
.page-header-title span{color:var(--yellow)}
.page-header-sub{font-size:.87rem;color:rgba(255,255,255,.6)}
.page-header-right{position:relative;z-index:1;display:flex;gap:10px;flex-wrap:wrap}

/* Buttons */
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:var(--radius-sm);font-size:.85rem;font-weight:600;font-family:var(--font-body);cursor:pointer;border:none;text-decoration:none;transition:all .18s cubic-bezier(.4,0,.2,1);white-space:nowrap}
.btn-primary{background:var(--yellow);color:var(--navy);box-shadow:0 2px 8px rgba(245,197,24,.35)}
.btn-primary:hover{background:#f0bc10;transform:translateY(-1px);box-shadow:0 4px 14px rgba(245,197,24,.45)}
.btn-outline-white{background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.2)}
.btn-outline-white:hover{background:rgba(255,255,255,.18)}
.btn-ghost{background:none;color:var(--text-2);border:1.5px solid var(--border)}
.btn-ghost:hover{background:#f4f6fb;border-color:var(--border-strong)}
.btn-sm{padding:7px 13px;font-size:.8rem}
.btn-danger{background:var(--red-bg);color:var(--red-text);border:1.5px solid var(--red-border)}
.btn-danger:hover{background:#fee2e2}
.btn-success{background:var(--green-bg);color:var(--green-text);border:1.5px solid var(--green-border)}
.btn-success:hover{background:#d1fae5}

/* ── STATS ROW ── */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.stat-card{background:var(--bg-card);border-radius:var(--radius);border:1px solid var(--border);padding:20px 22px;box-shadow:var(--shadow-sm);display:flex;align-items:center;gap:16px;transition:box-shadow .18s,transform .18s}
.stat-card:hover{box-shadow:var(--shadow-md);transform:translateY(-1px)}
.stat-icon{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0}
.stat-icon.blue{background:var(--blue-bg);color:var(--blue-text)}
.stat-icon.green{background:var(--green-bg);color:var(--green-text)}
.stat-icon.purple{background:var(--purple-bg);color:var(--purple-text)}
.stat-icon.amber{background:var(--amber-bg);color:var(--amber-text)}
.stat-value{font-family:var(--font-head);font-size:1.7rem;font-weight:800;color:var(--text);letter-spacing:-.03em;line-height:1}
.stat-label{font-size:.78rem;color:var(--text-3);margin-top:3px;font-weight:500}

/* ── OPEN SESSION BANNER ── */
.open-session-banner{background:linear-gradient(135deg,#065f46,#047857);border-radius:var(--radius);padding:18px 24px;display:flex;align-items:center;justify-content:space-between;gap:16px;box-shadow:0 4px 20px rgba(6,95,70,.2)}
.osb-left{display:flex;align-items:center;gap:14px}
.osb-pulse{width:10px;height:10px;border-radius:50%;background:#4ade80;box-shadow:0 0 0 0 rgba(74,222,128,.5);animation:pulse 1.6s infinite}
@keyframes pulse{0%{box-shadow:0 0 0 0 rgba(74,222,128,.5)}70%{box-shadow:0 0 0 8px rgba(74,222,128,0)}100%{box-shadow:0 0 0 0 rgba(74,222,128,0)}}
.osb-title{font-size:.88rem;font-weight:700;color:#fff}
.osb-sub{font-size:.78rem;color:rgba(255,255,255,.65);margin-top:1px}
.osb-right{display:flex;gap:10px}
.btn-continue{background:rgba(255,255,255,.15);color:#fff;border:1.5px solid rgba(255,255,255,.3);display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:var(--radius-sm);font-size:.83rem;font-weight:600;cursor:pointer;text-decoration:none;transition:all .18s}
.btn-continue:hover{background:rgba(255,255,255,.22)}

/* ── FILTERS ── */
.filters-bar{background:var(--bg-card);border-radius:var(--radius);border:1px solid var(--border);padding:16px 20px;display:flex;align-items:center;gap:12px;flex-wrap:wrap;box-shadow:var(--shadow-xs)}
.filter-group{display:flex;align-items:center;gap:8px}
.filter-label{font-size:.78rem;font-weight:600;color:var(--text-3);white-space:nowrap}
.filter-select,.filter-input{padding:8px 12px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-size:.84rem;font-family:var(--font-body);color:var(--text);background:var(--bg);outline:none;transition:border-color .18s,box-shadow .18s;cursor:pointer}
.filter-select:focus,.filter-input:focus{border-color:#93b8f8;box-shadow:0 0 0 3px rgba(59,130,246,.08);background:#fff}
.filter-divider{width:1px;height:28px;background:var(--border);flex-shrink:0}
.filter-results{font-size:.8rem;color:var(--text-3);margin-left:auto}
.filter-results strong{color:var(--text-2);font-weight:700}

/* ── SESSIONS TABLE ── */
.sessions-section{background:var(--bg-card);border-radius:var(--radius);border:1px solid var(--border);box-shadow:var(--shadow-sm);overflow:hidden}
.section-header{padding:20px 24px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px}
.section-title{font-family:var(--font-head);font-size:1rem;font-weight:700;color:var(--text)}
.section-sub{font-size:.78rem;color:var(--text-3);margin-top:2px}
.sessions-table{width:100%;border-collapse:collapse}
.sessions-table th{padding:11px 16px;text-align:left;font-size:.73rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--text-3);border-bottom:1px solid var(--border);background:#fafbfc;white-space:nowrap}
.sessions-table td{padding:14px 16px;font-size:.85rem;border-bottom:1px solid var(--border);vertical-align:middle}
.sessions-table tbody tr:last-child td{border-bottom:none}
.sessions-table tbody tr{transition:background .14s}
.sessions-table tbody tr:hover{background:#f7f8fc}

/* Date cell */
.date-cell{display:flex;align-items:center;gap:10px}
.date-block{width:40px;height:40px;border-radius:10px;background:var(--navy-light);display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0}
.date-block .d-num{font-size:.9rem;font-weight:800;color:var(--navy-mid);line-height:1}
.date-block .d-mon{font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text-3)}
.date-meta .date-full{font-size:.84rem;font-weight:600;color:var(--text)}
.date-meta .date-day{font-size:.76rem;color:var(--text-3)}

/* Course chip */
.course-chip{display:inline-flex;align-items:center;gap:6px;background:var(--blue-bg);color:var(--blue-text);padding:4px 10px;border-radius:20px;font-size:.78rem;font-weight:700;border:1px solid var(--blue-border)}

/* Status badge */
.status-badge{display:inline-flex;align-items:center;gap:5px;padding:5px 10px;border-radius:20px;font-size:.76rem;font-weight:700;white-space:nowrap}
.status-badge.open{background:#dcfce7;color:#15803d;border:1px solid #bbf7d0}
.status-badge.closed{background:var(--navy-light);color:var(--navy-mid);border:1px solid #c7d2fe}
.status-badge.cancelled{background:var(--red-bg);color:var(--red-text);border:1px solid var(--red-border)}
.status-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.status-badge.open .status-dot{background:#16a34a}
.status-badge.closed .status-dot{background:var(--navy-mid)}
.status-badge.cancelled .status-dot{background:var(--red)}

/* Attendance bar */
.att-bar-wrap{display:flex;align-items:center;gap:10px}
.att-bar{flex:1;height:6px;background:#e9ecef;border-radius:3px;overflow:hidden;min-width:60px}
.att-bar-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,#16a34a,#22c55e);transition:width .4s ease}
.att-bar-fill.low{background:linear-gradient(90deg,#dc2626,#f87171)}
.att-bar-fill.mid{background:linear-gradient(90deg,#d97706,#fbbf24)}
.att-rate{font-size:.82rem;font-weight:700;color:var(--text-2);white-space:nowrap}
.att-counts{font-size:.75rem;color:var(--text-3)}

/* Action buttons */
.action-group{display:flex;align-items:center;gap:6px}
.action-btn{width:32px;height:32px;border-radius:var(--radius-xs);border:1.5px solid var(--border);background:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.8rem;color:var(--text-3);transition:all .16s;text-decoration:none}
.action-btn:hover{background:var(--blue-bg);border-color:var(--blue-border);color:var(--blue-text)}
.action-btn.danger:hover{background:var(--red-bg);border-color:var(--red-border);color:var(--red-text)}
.action-btn.export:hover{background:var(--green-bg);border-color:var(--green-border);color:var(--green-text)}

/* ── EMPTY STATE ── */
.empty-state{padding:60px 24px;display:flex;flex-direction:column;align-items:center;text-align:center;gap:12px}
.empty-icon{width:72px;height:72px;border-radius:50%;background:var(--navy-light);display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:var(--navy-mid);margin-bottom:4px}
.empty-title{font-family:var(--font-head);font-size:1.05rem;font-weight:700;color:var(--text)}
.empty-sub{font-size:.87rem;color:var(--text-3);max-width:340px}

/* ── MODAL ── */
.modal-overlay{position:fixed;inset:0;background:rgba(11,22,64,.45);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;z-index:2000;opacity:0;pointer-events:none;transition:opacity .22s}
.modal-overlay.is-open{opacity:1;pointer-events:auto}
.modal{background:#fff;border-radius:var(--radius-lg);width:100%;max-width:520px;box-shadow:0 24px 64px rgba(11,22,64,.18);transform:translateY(12px) scale(.98);transition:transform .22s cubic-bezier(.4,0,.2,1);overflow:hidden}
.modal-overlay.is-open .modal{transform:translateY(0) scale(1)}
.modal-header{padding:24px 28px 20px;border-bottom:1px solid var(--border);display:flex;align-items:flex-start;justify-content:space-between;gap:12px}
.modal-title{font-family:var(--font-head);font-size:1.1rem;font-weight:800;color:var(--text)}
.modal-sub{font-size:.82rem;color:var(--text-3);margin-top:2px}
.modal-close{width:32px;height:32px;border-radius:50%;border:none;background:var(--bg);cursor:pointer;font-size:.85rem;color:var(--text-3);display:flex;align-items:center;justify-content:center;transition:background .15s,color .15s;flex-shrink:0}
.modal-close:hover{background:#fee2e2;color:var(--red)}
.modal-body{padding:24px 28px}
.modal-footer{padding:16px 28px 24px;display:flex;justify-content:flex-end;gap:10px}
.form-group{margin-bottom:18px}
.form-label{display:block;font-size:.8rem;font-weight:700;color:var(--text-2);margin-bottom:6px;letter-spacing:.02em}
.form-label span{color:var(--red)}
.form-control{width:100%;padding:10px 14px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-size:.88rem;font-family:var(--font-body);color:var(--text);outline:none;transition:border-color .18s,box-shadow .18s;background:#fff}
.form-control:focus{border-color:#93b8f8;box-shadow:0 0 0 3px rgba(59,130,246,.08)}
.form-hint{font-size:.76rem;color:var(--text-3);margin-top:4px}
.flash-error{background:var(--red-bg);border:1px solid var(--red-border);color:var(--red-text);padding:10px 14px;border-radius:var(--radius-sm);font-size:.83rem;margin-bottom:16px;display:none}
.flash-error.is-visible{display:block}

/* ── TOAST ── */
.toast-container{position:fixed;bottom:28px;right:28px;display:flex;flex-direction:column;gap:10px;z-index:3000}
.toast{display:flex;align-items:center;gap:12px;padding:12px 18px;border-radius:var(--radius-sm);background:#fff;border:1px solid var(--border);box-shadow:var(--shadow-lg);font-size:.85rem;color:var(--text-2);min-width:280px;transform:translateX(110%);transition:transform .28s cubic-bezier(.4,0,.2,1);font-weight:500}
.toast.is-visible{transform:translateX(0)}
.toast-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;flex-shrink:0}
.toast.success .toast-icon{background:var(--green-bg);color:var(--green-text)}
.toast.error .toast-icon{background:var(--red-bg);color:var(--red-text)}

/* Responsive */
@media(max-width:900px){
  .stats-row{grid-template-columns:repeat(2,1fr)}
  .content{padding:20px 16px 48px}
  .page-header{padding:20px 20px}
}
</style>
</head>
<body>

<!-- ══ SIDEBAR ══ -->
<aside class="sidebar">
  <a href="{{ url('/faculty_dashboard') }}" class="sidebar-logo">
    <div class="logo-mark"><i class="fas fa-door-open"></i></div>
    <div class="logo-text">
      <span class="brand-psu">PSU</span>
      <span class="brand-main">Smart<span>Door</span></span>
    </div>
  </a>

  <span class="nav-section-label">Main</span>
  <ul class="sidebar-nav">
    <li>
      <a href="{{ url('/faculty_dashboard') }}" class="{{ Request::is('faculty_dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>Dashboard
      </a>
    </li>
    <li>
      <a href="{{ url('/rooms') }}" class="{{ Request::is('rooms*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-door-open"></i></span>Rooms
      </a>
    </li>
    <li>
      <a href="{{ url('/faculty-schedule') }}" class="{{ Request::is('faculty-schedule') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-clock"></i></span>Schedule
      </a>
    </li>
    <li>
      <a href="{{ url('/attendance') }}" class="{{ Request::is('attendance*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-clipboard-check"></i></span>Attendance
      </a>
    </li>
  </ul>

  <span class="nav-section-label">Tools</span>
  <ul class="sidebar-nav">
    <li>
      <a href="{{ url('/ai-recommendations') }}" class="{{ Request::is('ai-recommendations') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-robot"></i></span>AI Recommendations
      </a>
    </li>
    <li>
      <a href="{{ url('/reports') }}" class="{{ Request::is('reports*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>Reports
      </a>
    </li>
  </ul>

  <div class="sidebar-footer">
    <div class="user-widget">
      <div class="user-avatar">{{ $facultyInitials }}</div>
      <div>
        <div class="user-widget-name">{{ $facultyName }}</div>
        <div class="user-widget-role">{{ $facultyDept }}</div>
      </div>
    </div>
    <form method="POST" action="{{ route('auth.logout') }}">
      @csrf
      <button type="submit" class="sidebar-logout-btn">
        <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>Sign Out
      </button>
    </form>
  </div>
</aside>

<!-- ══ MAIN ══ -->
<main class="main">

  <!-- TOPBAR -->
  <header class="topbar">
    <div class="topbar-left">
      <div>
        <div class="topbar-title">Attendance</div>
        <div class="topbar-subtitle">Track and manage class attendance</div>
      </div>
    </div>
    <div class="topbar-right">
      <button class="notif-btn"><i class="fas fa-bell"></i></button>
      <div class="topbar-profile">
        <div class="topbar-avatar">{{ $facultyInitials }}</div>
        <div>
          <div class="topbar-profile-name">{{ $facultyName }}</div>
          <div class="topbar-profile-role">Faculty · {{ $facultyDept }}</div>
        </div>
      </div>
    </div>
  </header>

  <div class="content">

    <!-- SESSION ERROR / SUCCESS -->
    @if(session('error'))
    <div style="background:var(--red-bg);border:1px solid var(--red-border);color:var(--red-text);padding:12px 18px;border-radius:var(--radius-sm);font-size:.85rem;display:flex;align-items:center;gap:10px">
      <i class="fas fa-circle-exclamation"></i> {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div style="background:var(--green-bg);border:1px solid var(--green-border);color:var(--green-text);padding:12px 18px;border-radius:var(--radius-sm);font-size:.85rem;display:flex;align-items:center;gap:10px">
      <i class="fas fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <!-- PAGE HEADER -->
    <div class="page-header">
      <div class="page-header-left">
        <div class="page-header-eyebrow">Faculty · Attendance Management</div>
        <h1 class="page-header-title">Class <span>Attendance</span></h1>
        <p class="page-header-sub">Open sessions, take roll call, and track student presence across all your classes.</p>
      </div>
      <div class="page-header-right">
        <button class="btn btn-outline-white" id="openNewSessionBtn">
          <i class="fas fa-plus"></i> New Session
        </button>
      </div>
    </div>

    <!-- OPEN SESSION BANNER -->
    @if($stats['open_session'])
    <div class="open-session-banner">
      <div class="osb-left">
        <div class="osb-pulse"></div>
        <div>
          <div class="osb-title">Session In Progress — {{ $stats['open_session']['course'] }}</div>
          <div class="osb-sub">Room {{ $stats['open_session']['room'] }} · Started now · Attendance is open</div>
        </div>
      </div>
      <div class="osb-right">
        <a href="{{ route('faculty.attendance.session', $stats['open_session']['id']) }}" class="btn-continue">
          <i class="fas fa-arrow-right"></i> Continue Taking Attendance
        </a>
      </div>
    </div>
    @endif

    <!-- STATS ROW -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-calendar-check"></i></div>
        <div>
          <div class="stat-value">{{ $stats['total_sessions'] }}</div>
          <div class="stat-label">Total Sessions</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-calendar-days"></i></div>
        <div>
          <div class="stat-value">{{ $stats['this_month'] }}</div>
          <div class="stat-label">This Month</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-user-check"></i></div>
        <div>
          <div class="stat-value">{{ number_format($stats['overall_rate'], 1) }}%</div>
          <div class="stat-label">Overall Attendance Rate</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon amber"><i class="fas fa-book-open"></i></div>
        <div>
          <div class="stat-value">{{ count($courses) }}</div>
          <div class="stat-label">Active Courses</div>
        </div>
      </div>
    </div>

    <!-- FILTERS -->
    <div class="filters-bar">
      <form method="GET" action="{{ route('faculty.attendance') }}" id="filterForm" style="display:contents">
        <div class="filter-group">
          <label class="filter-label">Course</label>
          <select name="course_id" class="filter-select" onchange="document.getElementById('filterForm').submit()">
            <option value="">All Courses</option>
            @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ $filterCourse == $course->id ? 'selected' : '' }}>
              {{ $course->code }} – {{ Str::limit($course->title, 28) }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="filter-divider"></div>
        <div class="filter-group">
          <label class="filter-label">Status</label>
          <select name="status" class="filter-select" onchange="document.getElementById('filterForm').submit()">
            <option value="">All Status</option>
            <option value="open"      {{ $filterStatus === 'open'      ? 'selected' : '' }}>Open</option>
            <option value="closed"    {{ $filterStatus === 'closed'    ? 'selected' : '' }}>Closed</option>
            <option value="cancelled" {{ $filterStatus === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
          </select>
        </div>
        <div class="filter-divider"></div>
        <div class="filter-group">
          <label class="filter-label">Month</label>
          <input type="month" name="month" class="filter-input" value="{{ $filterMonth }}" onchange="document.getElementById('filterForm').submit()">
        </div>
        @if($filterCourse || $filterStatus)
        <a href="{{ route('faculty.attendance') }}" class="btn btn-ghost btn-sm" style="margin-left:4px">
          <i class="fas fa-xmark"></i> Clear
        </a>
        @endif
        <span class="filter-results"><strong>{{ $sessions->count() }}</strong> session{{ $sessions->count() !== 1 ? 's' : '' }}</span>
      </form>
    </div>

    <!-- SESSIONS TABLE -->
    <div class="sessions-section">
      <div class="section-header">
        <div>
          <div class="section-title">Attendance Sessions</div>
          <div class="section-sub">All recorded class sessions with attendance summary</div>
        </div>
      </div>

      @if($sessions->isEmpty())
      <div class="empty-state">
        <div class="empty-icon"><i class="fas fa-clipboard-list"></i></div>
        <div class="empty-title">No sessions found</div>
        <div class="empty-sub">
          @if($filterCourse || $filterStatus)
            No sessions match the current filters. Try adjusting the course or status filter.
          @else
            You haven't opened any attendance sessions yet. Click <strong>New Session</strong> to get started.
          @endif
        </div>
        @if(!$filterCourse && !$filterStatus)
        <button class="btn btn-primary" style="margin-top:8px" onclick="document.getElementById('newSessionOverlay').classList.add('is-open')">
          <i class="fas fa-plus"></i> Open First Session
        </button>
        @endif
      </div>
      @else
      <div style="overflow-x:auto">
        <table class="sessions-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Course</th>
              <th>Room</th>
              <th>Time</th>
              <th>Status</th>
              <th>Attendance</th>
              <th style="text-align:right">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sessions as $s)
            <tr>
              <td>
                <div class="date-cell">
                  <div class="date-block">
                    <span class="d-num">{{ \Carbon\Carbon::parse($s['date'])->format('d') }}</span>
                    <span class="d-mon">{{ \Carbon\Carbon::parse($s['date'])->format('M') }}</span>
                  </div>
                  <div class="date-meta">
                    <div class="date-full">{{ $s['date'] }}</div>
                    <div class="date-day">{{ $s['day'] }}</div>
                  </div>
                </div>
              </td>
              <td>
                <div class="course-chip"><i class="fas fa-book-open" style="font-size:.7rem"></i> {{ $s['course_code'] }}</div>
                <div style="font-size:.77rem;color:var(--text-3);margin-top:4px">{{ Str::limit($s['course_title'],32) }}</div>
              </td>
              <td>
                <div style="font-size:.86rem;font-weight:600;color:var(--text)">{{ $s['room'] }}</div>
                @if($s['building'])<div style="font-size:.76rem;color:var(--text-3)">{{ $s['building'] }}</div>@endif
              </td>
              <td>
                <div style="font-size:.84rem;font-weight:500;color:var(--text-2)">{{ $s['started_at'] }}</div>
                @if($s['ended_at'] !== '--:--')<div style="font-size:.76rem;color:var(--text-3)">Ended {{ $s['ended_at'] }}</div>@endif
              </td>
              <td>
                <span class="status-badge {{ $s['status'] }}">
                  <span class="status-dot"></span>
                  {{ ucfirst($s['status']) }}
                </span>
              </td>
              <td>
                @if($s['total'] > 0)
                <div class="att-bar-wrap">
                  <div class="att-bar">
                    <div class="att-bar-fill {{ $s['rate'] < 60 ? 'low' : ($s['rate'] < 80 ? 'mid' : '') }}" style="width:{{ $s['rate'] }}%"></div>
                  </div>
                  <span class="att-rate">{{ $s['rate'] }}%</span>
                </div>
                <div class="att-counts">{{ $s['present'] }} present · {{ $s['absent'] }} absent · {{ $s['total'] }} total</div>
                @else
                <span style="font-size:.8rem;color:var(--text-4)">No records yet</span>
                @endif
              </td>
              <td>
                <div class="action-group" style="justify-content:flex-end">
                  <a href="{{ route('faculty.attendance.session', $s['id']) }}" class="action-btn" title="{{ $s['status'] === 'open' ? 'Take Attendance' : 'View Session' }}">
                    <i class="fas fa-{{ $s['status'] === 'open' ? 'pen-to-square' : 'eye' }}"></i>
                  </a>
                  <a href="{{ route('faculty.attendance.export', $s['id']) }}" class="action-btn export" title="Export CSV">
                    <i class="fas fa-file-csv"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>

  </div><!-- /content -->
</main>

<!-- ══ NEW SESSION MODAL ══ -->
<div class="modal-overlay" id="newSessionOverlay">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-header">
      <div>
        <div class="modal-title" id="modalTitle">Open New Attendance Session</div>
        <div class="modal-sub">Select the class and date to begin taking attendance.</div>
      </div>
      <button class="modal-close" id="closeModalBtn" aria-label="Close"><i class="fas fa-xmark"></i></button>
    </div>
    <form method="POST" action="{{ route('faculty.attendance.store') }}" id="newSessionForm">
      @csrf
      <div class="modal-body">
        <div class="flash-error" id="modalError"></div>

        <div class="form-group">
          <label class="form-label" for="schedule_id">Class / Schedule <span>*</span></label>
          <select name="schedule_id" id="schedule_id" class="form-control" required>
            <option value="">— Select a class —</option>
            @foreach($courses as $course)
              @foreach($course->schedules as $schedule)
              <option value="{{ $schedule->id }}">
                {{ $course->code }} – {{ $course->title }}
                · {{ $schedule->classroom?->name ?? 'N/A' }}
                ({{ $schedule->start_at ? $schedule->start_at->format('D g:i A') : 'TBA' }})
              </option>
              @endforeach
            @endforeach
          </select>
          <div class="form-hint">Only your assigned courses appear here.</div>
        </div>

        <div class="form-group">
          <label class="form-label" for="session_date">Session Date <span>*</span></label>
          <input type="date" name="session_date" id="session_date" class="form-control" required
                 value="{{ now()->format('Y-m-d') }}"
                 max="{{ now()->format('Y-m-d') }}">
          <div class="form-hint">Cannot be a future date.</div>
        </div>

        <div class="form-group" style="margin-bottom:0">
          <label class="form-label" for="remarks">Remarks <span style="font-weight:400;color:var(--text-4)">(optional)</span></label>
          <input type="text" name="remarks" id="remarks" class="form-control" placeholder="e.g. Make-up class, Lab session…" maxlength="255">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" id="cancelModalBtn">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-play"></i> Open Session</button>
      </div>
    </form>
  </div>
</div>

<!-- ══ TOAST CONTAINER ══ -->
<div class="toast-container" id="toastContainer"></div>

<script>
// ── Modal (new session) ──
const newSessionOverlay = document.getElementById('newSessionOverlay');
const openBtn           = document.getElementById('openNewSessionBtn');
const closeBtn          = document.getElementById('closeModalBtn');
const cancelBtn         = document.getElementById('cancelModalBtn');

function openNewSessionModal()  { newSessionOverlay?.classList.add('is-open');  document.body.style.overflow = 'hidden'; }
function closeNewSessionModal() { newSessionOverlay?.classList.remove('is-open'); document.body.style.overflow = ''; }

openBtn?.addEventListener('click', openNewSessionModal);
closeBtn?.addEventListener('click', closeNewSessionModal);
cancelBtn?.addEventListener('click', closeNewSessionModal);
newSessionOverlay?.addEventListener('click', e => { if (e.target === newSessionOverlay) closeNewSessionModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeNewSessionModal(); });

// ── Toast helper ──
function showToast(message, type = 'success') {
  const c = document.getElementById('toastContainer');
  const t = document.createElement('div');
  t.className = 'toast ' + type;
  t.innerHTML = `<div class="toast-icon"><i class="fas fa-${type === 'success' ? 'circle-check' : 'circle-exclamation'}"></i></div><span>${message}</span>`;
  c.appendChild(t);
  requestAnimationFrame(() => t.classList.add('is-visible'));
  setTimeout(() => {
    t.classList.remove('is-visible');
    setTimeout(() => t.remove(), 300);
  }, 3500);
}

// ── Auto-open modal if validation failed (session() errors) ──
@if($errors->any())
  openModal();
  document.getElementById('modalError').textContent = @json($errors->first());
  document.getElementById('modalError').classList.add('is-visible');
@endif

// ── Flash toast on success ──
@if(session('success'))
  showToast(@json(session('success')), 'success');
@endif
@if(session('error'))
  showToast(@json(session('error')), 'error');
@endif
</script>
</body>
</html>