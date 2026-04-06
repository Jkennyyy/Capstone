<?php
$faculty_name     = "Prof. Elena Santos";
$faculty_dept     = "Faculty of IT";
$faculty_initials = "ES";
$semester         = "1st Semester 2025–2026";

$stats = [
  ["value"=>"8",   "label"=>"Classes/Week",  "icon"=>"grid",   "color"=>"blue",   "trend"=>"This semester"],
  ["value"=>"359", "label"=>"Total Students","icon"=>"users",  "color"=>"purple", "trend"=>"+12 vs last sem"],
  ["value"=>"4",   "label"=>"Subjects",      "icon"=>"target", "color"=>"green",  "trend"=>"Full teaching load"],
  ["value"=>"12",  "label"=>"Total Units",   "icon"=>"zap",    "color"=>"amber",  "trend"=>"Regular load"],
];

$schedule = [
  ["day"=>"Monday",   "abbr"=>"Mon","total_hrs"=>"4 hrs","classes"=>[
    ["code"=>"CS 301","section"=>"BSCS 3A","time"=>"8:00 AM", "subject"=>"Database Systems",   "duration"=>"8:00 AM – 10:00 AM","location"=>"IT-301, IT Building",      "students"=>45,"color"=>"blue"],
    ["code"=>"CS 302","section"=>"BSCS 3B","time"=>"1:00 PM", "subject"=>"Software Engineering","duration"=>"1:00 PM – 3:00 PM", "location"=>"IT-205, IT Building",      "students"=>42,"color"=>"purple"],
  ]],
  ["day"=>"Tuesday",  "abbr"=>"Tue","total_hrs"=>"2 hrs","classes"=>[
    ["code"=>"CS 301","section"=>"BSCS 3C","time"=>"10:00 AM","subject"=>"Database Systems",   "duration"=>"10:00 AM – 12:00 PM","location"=>"IT-301, IT Building",      "students"=>48,"color"=>"blue"],
  ]],
  ["day"=>"Wednesday","abbr"=>"Wed","total_hrs"=>"3 hrs","classes"=>[
    ["code"=>"CS 205","section"=>"BSCS 2A","time"=>"8:00 AM", "subject"=>"Web Development",    "duration"=>"8:00 AM – 11:00 AM", "location"=>"MB-104, Main Building",    "students"=>50,"color"=>"green"],
  ]],
  ["day"=>"Thursday", "abbr"=>"Thu","total_hrs"=>"5 hrs","classes"=>[
    ["code"=>"CS 302","section"=>"BSCS 3A","time"=>"1:00 PM", "subject"=>"Software Engineering","duration"=>"1:00 PM – 3:00 PM", "location"=>"IT-205, IT Building",      "students"=>45,"color"=>"purple"],
    ["code"=>"CS 205","section"=>"BSCS 2B","time"=>"3:00 PM", "subject"=>"Web Development",    "duration"=>"3:00 PM – 6:00 PM", "location"=>"IT-401, IT Building",      "students"=>46,"color"=>"green"],
  ]],
  ["day"=>"Friday",   "abbr"=>"Fri","total_hrs"=>"5 hrs","classes"=>[
    ["code"=>"CS 301","section"=>"BSCS 3A","time"=>"8:00 AM", "subject"=>"Database Systems",   "duration"=>"8:00 AM – 10:00 AM","location"=>"IT-301, IT Building",      "students"=>45,"color"=>"blue"],
    ["code"=>"CS 401","section"=>"BSCS 4A","time"=>"1:00 PM", "subject"=>"Mobile Programming", "duration"=>"1:00 PM – 4:00 PM", "location"=>"SCI-201, Science Building","students"=>38,"color"=>"amber"],
  ]],
];

$subjects = [
  ["code"=>"CS 301","name"=>"Database Systems",   "sections"=>2,"students"=>138,"classes"=>3,"units"=>3,"color"=>"blue"],
  ["code"=>"CS 302","name"=>"Software Engineering","sections"=>2,"students"=>87, "classes"=>2,"units"=>3,"color"=>"purple"],
  ["code"=>"CS 205","name"=>"Web Development",     "sections"=>2,"students"=>96, "classes"=>2,"units"=>3,"color"=>"green"],
  ["code"=>"CS 401","name"=>"Mobile Programming",  "sections"=>1,"students"=>38, "classes"=>1,"units"=>3,"color"=>"amber"],
];

$icons = [
  "grid"    =>'<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>',
  "users"   =>'<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
  "target"  =>'<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
  "zap"     =>'<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
  "clock"   =>'<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/>',
  "pin"     =>'<path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
  "print"   =>'<polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/>',
  "export"  =>'<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
  "search"  =>'<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
  "book"    =>'<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
  "calendar"=>'<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
  "bell"    =>'<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>',
  "timeline"=>'<line x1="17" y1="12" x2="3" y2="12"/><line x1="17" y1="6" x2="3" y2="6"/><line x1="17" y1="18" x2="3" y2="18"/><circle cx="20" cy="12" r="1" fill="currentColor"/><circle cx="20" cy="6" r="1" fill="currentColor"/><circle cx="20" cy="18" r="1" fill="currentColor"/>',
  "chevdown"=>'<polyline points="6 9 12 15 18 9"/>',
  "home"    =>'<path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9.5z"/><polyline points="9 21 9 12 15 12 15 21"/>',
  "door"    =>'<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="14.5" cy="12" r="1.2"/>',
  "user"    =>'<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
  "logout"  =>'<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>',
  "robot"   =>'<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/><line x1="12" y1="3" x2="12" y2="3.01"/><circle cx="9" cy="16" r="1" fill="currentColor"/><circle cx="15" cy="16" r="1" fill="currentColor"/>',
  "barchart"=>'<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
];

function ic($icons,$name,$size=16){
  $p=$icons[$name]??'';
  return "<svg width=\"{$size}\" height=\"{$size}\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\">{$p}</svg>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>SmartDoor — Semester Schedule</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  --sw: 230px;

  /* Sidebar (UNCHANGED) */
  --yellow: #f5c518;
  --navy: #0b1640;
  --navy-mid: #1a2f80;

  /* Main content – clean refined light */
  --bg:      #f4f6fb;
  --white:   #ffffff;
  --border:  #e3e8f0;
  --border2: #d0d8ea;
  --text:    #0f1829;
  --text2:   #3d4b61;
  --text3:   #7a8899;
  --text4:   #b4bfcc;

  /* Accent palette */
  --blue:         #2563eb;
  --blue-lt:      #eff4ff;
  --blue-border:  #bfd1fd;
  --blue-mid:     #1d4ed8;

  --purple:        #7c3aed;
  --purple-lt:     #f5f0ff;
  --purple-border: #d4bbfd;

  --green:        #059669;
  --green-lt:     #ecfdf5;
  --green-border: #a7f3d0;

  --amber:        #d97706;
  --amber-lt:     #fffbeb;
  --amber-border: #fcd38a;

  --font-head: 'Plus Jakarta Sans', sans-serif;
  --font-body: 'DM Sans', sans-serif;
  --mono:      'DM Mono', monospace;
  --r:   14px;
  --r2:  10px;
  --r3:   7px;
}

html{scroll-behavior:smooth}
body{font-family:var(--font-body);background:var(--bg);color:var(--text);display:flex;min-height:100vh;-webkit-font-smoothing:antialiased;}
::-webkit-scrollbar{width:5px}::-webkit-scrollbar-thumb{background:#d0d8ea;border-radius:99px}

/* ═══════════════════════════════════════
   SIDEBAR — EXACT ORIGINAL, ZERO CHANGES
   ═══════════════════════════════════════ */
.sidebar{
  position:fixed;left:0;top:0;
  width:var(--sw);height:100vh;
  background:var(--navy);
  display:flex;flex-direction:column;
  overflow:hidden;z-index:100;
}
.sidebar::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(160deg,rgba(245,197,24,.06) 0%,transparent 55%);
  pointer-events:none;
}
.sidebar::after{
  content:'';position:absolute;bottom:-60px;right:-60px;
  width:180px;height:180px;border-radius:50%;
  border:1px solid rgba(245,197,24,.08);pointer-events:none;
}
.sidebar-logo{
  display:flex;align-items:center;gap:12px;
  padding:28px 20px 24px 24px;text-decoration:none;
  border-bottom:1px solid rgba(255,255,255,.06);margin-bottom:8px;
}
.logo-mark{
  width:40px;height:40px;background:var(--yellow);border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;color:var(--navy);flex-shrink:0;
  box-shadow:0 4px 12px rgba(245,197,24,.4);
}
.logo-text .brand-psu{
  font-size:.6rem;font-weight:600;letter-spacing:.18em;
  color:rgba(255,255,255,.45);text-transform:uppercase;display:block;margin-bottom:3px;
}
.logo-text .brand-main{font-size:1.05rem;font-weight:700;color:#fff;letter-spacing:-.01em;}
.logo-text .brand-main span{color:var(--yellow);}
.nav-section-label{
  font-size:.68rem;font-weight:700;letter-spacing:.12em;
  text-transform:uppercase;color:rgba(255,255,255,.25);padding:16px 24px 6px;
}
.sidebar-nav{list-style:none;overflow-y:auto;padding:0 12px;}
.sidebar-nav::-webkit-scrollbar{width:0;}
.sidebar-nav li{margin-bottom:2px;}
.sidebar-nav a{
  display:flex;align-items:center;gap:11px;padding:11px 12px;
  text-decoration:none;color:rgba(255,255,255,.6);
  font-size:.88rem;font-weight:500;border-radius:10px;
  transition:all .22s cubic-bezier(.4,0,.2,1);position:relative;overflow:hidden;
}
.sidebar-nav a .nav-icon{
  width:32px;height:32px;border-radius:8px;
  display:flex;align-items:center;justify-content:center;
  font-size:.85rem;background:rgba(255,255,255,.05);flex-shrink:0;transition:all .22s;
}
.sidebar-nav a:hover{color:rgba(255,255,255,.9);background:rgba(255,255,255,.06);}
.sidebar-nav a:hover .nav-icon{background:rgba(255,255,255,.1);}
.sidebar-nav a.active{background:rgba(245,197,24,.14);color:var(--yellow);}
.sidebar-nav a.active .nav-icon{background:rgba(245,197,24,.2);color:var(--yellow);}
.sidebar-nav a.active::before{
  content:'';position:absolute;left:0;top:20%;bottom:20%;
  width:3px;background:var(--yellow);border-radius:0 2px 2px 0;
}
.sidebar-footer{margin-top:auto;padding:16px 12px 24px;border-top:1px solid rgba(255,255,255,.06);}
.user-widget{
  display:flex;align-items:center;gap:10px;padding:10px 12px;
  border-radius:10px;background:rgba(255,255,255,.05);margin-bottom:8px;
}
.user-avatar{
  width:34px;height:34px;border-radius:50%;flex-shrink:0;
  background:var(--navy-mid);border:2px solid rgba(245,197,24,.4);
  display:flex;align-items:center;justify-content:center;
  font-size:.78rem;font-weight:700;color:var(--yellow);
}
.user-widget-info{flex:1;min-width:0;}
.user-widget-name{font-size:.83rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.user-widget-role{font-size:.73rem;color:rgba(255,255,255,.4);}
.sidebar-logout-btn{
  display:flex;align-items:center;gap:10px;padding:9px 12px;
  color:rgba(255,255,255,.4);font-size:.84rem;font-weight:500;
  border-radius:10px;transition:all .22s;width:100%;
  background:none;border:none;cursor:pointer;font-family:inherit;
}
.sidebar-logout-btn:hover{color:#f87171;background:rgba(244,63,94,.08);}

/* ═══════════════════════════════════════
   MAIN LAYOUT
   ═══════════════════════════════════════ */
.main{margin-left:var(--sw);flex:1;display:flex;flex-direction:column;min-height:100vh;}

/* ── TOPBAR ── */
.topbar{
  background:var(--white);
  border-bottom:1px solid var(--border);
  padding:0 34px;height:62px;
  display:flex;align-items:center;justify-content:space-between;gap:16px;
  position:sticky;top:0;z-index:50;
  box-shadow:0 1px 0 var(--border),0 2px 8px rgba(15,24,41,.04);
}
.topbar-search{
  display:flex;align-items:center;gap:9px;
  background:var(--bg);
  border:1.5px solid var(--border);
  border-radius:24px;
  padding:8px 18px;width:320px;
  transition:border-color .2s,box-shadow .2s;
}
.topbar-search:focus-within{border-color:#93c5fd;box-shadow:0 0 0 3px rgba(59,130,246,.1);}
.topbar-search svg{color:var(--text4);flex-shrink:0;}
.topbar-search input{
  border:none;outline:none;background:transparent;
  font-size:.87rem;font-family:var(--font-body);
  color:var(--text);width:100%;
}
.topbar-search input::placeholder{color:var(--text4);}
.topbar-right{display:flex;align-items:center;gap:16px;}
.notif-btn{
  position:relative;background:var(--bg);border:1.5px solid var(--border);
  cursor:pointer;color:var(--text2);
  padding:8px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  transition:background .15s,border-color .15s;
}
.notif-btn:hover{background:#eef2ff;border-color:#c7d7fd;}
.notif-dot{
  position:absolute;top:6px;right:6px;
  width:7px;height:7px;background:#ef4444;
  border-radius:50%;border:1.5px solid var(--white);
}
.tb-divider{display:none;}
.tb-profile{
  position:relative;
  display:flex;align-items:center;gap:10px;
  padding:6px 10px;border-radius:10px;cursor:pointer;
  transition:background .15s;
}
.tb-profile:hover{background:var(--bg);}
.tb-avatar{
  width:36px;height:36px;border-radius:50%;
  object-fit:cover;
  border:2px solid #e3e8f5;
  box-shadow:0 2px 8px rgba(15,24,41,.18);
  flex-shrink:0;
}
.tb-profile-info{text-align:right;}
.tb-profile-name{font-size:.82rem;font-weight:700;color:var(--text);line-height:1.2;}
.tb-profile-role{font-size:.72rem;color:var(--text3);}
.tb-chevron{display:none;}

/* Profile dropdown */
.profile-dropdown{
  position:absolute;top:115%;right:0;min-width:230px;
  background:var(--white);border-radius:10px;
  border:1px solid var(--border);
  box-shadow:0 8px 24px rgba(15,24,41,.14);
  padding:10px 12px 8px;display:none;z-index:2000;
}
.profile-dropdown.is-open{display:block;}
.profile-dropdown-item{display:flex;flex-direction:column;gap:2px;margin-bottom:8px;}
.profile-dropdown-label{font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:var(--text3);font-weight:700;padding:2px 0 3px;}
.profile-dropdown-value{font-size:.82rem;color:var(--text2);}
.profile-signout-btn{
  width:100%;margin-top:4px;border:none;outline:none;
  border-radius:999px;padding:7px 10px;font-size:.82rem;font-weight:700;
  display:flex;align-items:center;justify-content:center;gap:6px;
  background:#fef2f2;color:#b91c1c;cursor:pointer;
  transition:background .16s ease,transform .08s ease;
}
.profile-signout-btn:hover{background:#fee2e2;transform:translateY(-1px);}

/* ── CONTENT WRAPPER ── */
.content{padding:28px 32px 52px;display:flex;flex-direction:column;gap:22px;}

/* ── PAGE HEADER ── */
.pg-header{
  display:flex;align-items:center;justify-content:space-between;
  background:linear-gradient(135deg,#1a2f80 0%,#0b1640 100%);
  border-radius:var(--r);padding:22px 26px;
  position:relative;overflow:hidden;animation:fadeUp .4s ease both;
}
.pg-header::before{content:'';position:absolute;top:-40px;right:-40px;width:200px;height:200px;border-radius:50%;background:rgba(245,197,24,.07);pointer-events:none;}
.pg-header::after{content:'';position:absolute;bottom:-60px;right:160px;width:160px;height:160px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none;}
.ph-left{display:flex;align-items:center;gap:16px;position:relative;}
.ph-icon{width:48px;height:48px;border-radius:13px;background:rgba(245,197,24,.15);border:1px solid rgba(245,197,24,.25);display:flex;align-items:center;justify-content:center;color:#f5c518;flex-shrink:0;}
.ph-title h1{font-family:var(--font-head);font-size:1.5rem;font-weight:800;color:#fff;letter-spacing:-.02em;}
.ph-title p{font-size:.78rem;color:rgba(255,255,255,.5);margin-top:4px;}
.ph-actions{display:flex;gap:8px;position:relative;}
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 16px;border-radius:var(--r2);border:none;cursor:pointer;font-family:var(--font-body);font-size:.78rem;font-weight:700;transition:transform .14s,box-shadow .14s,opacity .14s;}
.btn:hover{transform:translateY(-1px);}
.btn svg{width:13px;height:13px;}
.btn-white{background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);color:#fff;}
.btn-white:hover{background:rgba(255,255,255,.2);}
.btn-yellow{background:var(--yellow);color:var(--navy);font-weight:800;box-shadow:0 4px 14px rgba(245,197,24,.4);}
.btn-yellow:hover{box-shadow:0 6px 20px rgba(245,197,24,.55);}
.btn-ghost{background:var(--white);border:1.5px solid var(--border);color:var(--text2);}
.btn-ghost:hover{background:var(--bg);}
.btn-primary{background:var(--blue);color:#fff;box-shadow:0 3px 10px rgba(37,99,235,.28);}
.btn-sm{padding:7px 12px;font-size:.72rem;}

/* ── STATS GRID ── */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;animation:fadeUp .4s ease .07s both;}
.stat-card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--r);padding:18px 18px 16px;position:relative;overflow:hidden;box-shadow:0 1px 3px rgba(15,24,41,.05),0 4px 12px rgba(15,24,41,.04);transition:transform .18s,box-shadow .18s;}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 8px 24px rgba(15,24,41,.1);}
.stat-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:var(--grad);border-radius:0 0 var(--r) var(--r);}
.stat-card.blue{--grad:linear-gradient(90deg,#2563eb,#60a5fa);}
.stat-card.purple{--grad:linear-gradient(90deg,#7c3aed,#c084fc);}
.stat-card.green{--grad:linear-gradient(90deg,#059669,#34d399);}
.stat-card.amber{--grad:linear-gradient(90deg,#d97706,#fbbf24);}
.stat-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:8px;}
.stat-val{font-family:var(--font-head);font-size:2rem;font-weight:800;letter-spacing:-.04em;line-height:1;color:var(--text);}
.stat-ic{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.stat-card.blue .stat-ic  {background:var(--blue-lt);color:var(--blue);}
.stat-card.purple .stat-ic{background:var(--purple-lt);color:var(--purple);}
.stat-card.green .stat-ic {background:var(--green-lt);color:var(--green);}
.stat-card.amber .stat-ic {background:var(--amber-lt);color:var(--amber);}
.stat-label{font-size:.73rem;color:var(--text3);font-weight:600;letter-spacing:.01em;}
.stat-trend{font-size:.69rem;color:var(--text4);margin-top:3px;display:flex;align-items:center;gap:4px;}

/* ── TOOLBAR ── */
.toolbar{display:flex;align-items:center;gap:10px;background:var(--white);border:1.5px solid var(--border);border-radius:var(--r);padding:12px 16px;box-shadow:0 1px 3px rgba(15,24,41,.04);animation:fadeUp .4s ease .12s both;}
.search-wrap{display:flex;align-items:center;gap:8px;background:var(--bg);border:1.5px solid var(--border);border-radius:var(--r2);padding:8px 13px;flex:0 0 260px;transition:border-color .15s,box-shadow .15s;}
.search-wrap:focus-within{border-color:var(--blue-border);box-shadow:0 0 0 3px rgba(37,99,235,.08);}
.search-wrap svg{color:var(--text4);flex-shrink:0;}
.search-wrap input{border:none;outline:none;background:transparent;font-family:var(--font-body);font-size:.82rem;color:var(--text);width:100%;}
.search-wrap input::placeholder{color:var(--text4);}
.tb-spacer{flex:1;}
.sem-chip{display:flex;align-items:center;gap:7px;background:var(--blue-lt);border:1.5px solid var(--blue-border);border-radius:var(--r2);padding:7px 13px;font-size:.75rem;font-weight:700;color:var(--blue-mid);}
.view-toggle{display:flex;gap:4px;background:var(--bg);border:1.5px solid var(--border);border-radius:var(--r2);padding:4px;}
.vt-btn{display:flex;align-items:center;gap:6px;padding:6px 12px;border:none;border-radius:7px;background:none;cursor:pointer;font-family:var(--font-body);font-size:.75rem;font-weight:700;color:var(--text3);transition:background .14s,color .14s;}
.vt-btn.active{background:var(--white);color:var(--blue);box-shadow:0 1px 4px rgba(15,24,41,.08);}

/* ── SCHEDULE SECTION ── */
.sched-wrap{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:14px;align-items:start;}
.day-section{animation:fadeUp .45s ease var(--d,.2s) both;background:linear-gradient(180deg,#ffffff 0%,#fbfdff 100%);border:1.5px solid var(--border);border-radius:16px;padding:14px;box-shadow:0 4px 16px rgba(15,24,41,.05);transition:transform .18s,box-shadow .18s,border-color .18s;min-height:100%;}
.day-section:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(15,24,41,.1);border-color:#cdd7ea;}
.day-header{display:flex;align-items:center;gap:10px;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid var(--border);}
.day-pill{display:flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:10px;background:var(--navy);font-size:.68rem;font-weight:800;color:rgba(255,255,255,.9);letter-spacing:.03em;flex-shrink:0;box-shadow:0 4px 12px rgba(11,22,64,.22);}
.day-info{flex:1;}
.day-name{font-family:var(--font-head);font-size:.92rem;font-weight:800;color:var(--text);letter-spacing:-.01em;}
.day-sep{display:none;}
.day-hrs-pill{display:flex;align-items:center;gap:5px;padding:3px 8px;border-radius:99px;background:#f8fafc;border:1px solid var(--border);font-size:.64rem;font-weight:700;color:var(--text3);}
.class-grid{display:grid;grid-template-columns:1fr;gap:10px;}

/* ── CLASS CARD ── */
.cls-card{background:var(--white);border:1px solid var(--border);border-radius:12px;overflow:hidden;box-shadow:0 1px 2px rgba(15,24,41,.04);transition:transform .18s,box-shadow .18s,border-color .18s;position:relative;}
.cls-card:hover{transform:translateY(-1px);box-shadow:0 4px 10px rgba(15,24,41,.06);border-color:var(--card-border);}
.cls-card.blue  {--card-accent:var(--blue);  --card-lt:var(--blue-lt);  --card-border:var(--blue-border);  --card-text:var(--blue-mid);}
.cls-card.purple{--card-accent:var(--purple);--card-lt:var(--purple-lt);--card-border:var(--purple-border);--card-text:var(--purple);}
.cls-card.green {--card-accent:var(--green); --card-lt:var(--green-lt); --card-border:var(--green-border); --card-text:var(--green);}
.cls-card.amber {--card-accent:var(--amber); --card-lt:var(--amber-lt); --card-border:var(--amber-border); --card-text:var(--amber);}
.cls-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:var(--card-accent);}
.cls-top{display:flex;align-items:center;justify-content:space-between;padding:10px 12px 8px;border-bottom:1px solid var(--border);margin-top:3px;}
.cls-badges{display:flex;align-items:center;gap:7px;}
.code-badge{font-family:var(--mono);font-size:.64rem;font-weight:600;padding:2px 8px;border-radius:99px;background:var(--card-lt);color:var(--card-text);border:1px solid var(--card-border);letter-spacing:.04em;}
.cls-time-chip{display:flex;align-items:center;gap:5px;font-size:.65rem;font-weight:700;color:var(--text3);font-family:var(--mono);}
.cls-time-chip svg{color:var(--text4);}
.cls-body{padding:11px 12px 12px;}
.cls-name{font-family:var(--font-head);font-size:.8rem;font-weight:800;color:var(--text);letter-spacing:-.01em;margin-bottom:10px;}
.cls-rows{display:flex;flex-direction:column;gap:6px;margin-bottom:8px;}
.cls-row{display:flex;align-items:center;justify-content:space-between;}
.cr-lbl{display:flex;align-items:center;gap:6px;font-size:.66rem;color:var(--text3);}
.cr-lbl svg{color:var(--text4);}
.cr-val{font-size:.65rem;font-weight:700;color:var(--text2);text-align:right;}
.cls-footer{display:flex;align-items:center;padding-top:8px;border-top:1px solid var(--border);gap:8px;}
.students-chip{display:flex;align-items:center;gap:5px;font-size:.65rem;color:var(--text3);}
.students-chip svg{color:var(--text4);}
.students-num{font-family:var(--mono);font-weight:700;color:var(--card-text);font-size:.72rem;}
.cls-actions{margin-left:auto;display:flex;gap:6px;}

/* ── SUBJECT OVERVIEW ── */
.subj-section{background:var(--white);border:1.5px solid var(--border);border-radius:var(--r);padding:22px 24px;box-shadow:0 1px 3px rgba(15,24,41,.05),0 4px 12px rgba(15,24,41,.04);animation:fadeUp .45s ease .42s both;}
.subj-hd{display:flex;align-items:center;gap:10px;margin-bottom:16px;}
.subj-hd-icon{width:34px;height:34px;border-radius:9px;background:var(--amber-lt);color:var(--amber);border:1px solid var(--amber-border);display:flex;align-items:center;justify-content:center;}
.subj-hd h2{font-family:var(--font-head);font-size:.95rem;font-weight:800;letter-spacing:-.01em;}
.subj-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
.subj-card{border:1.5px solid var(--border);border-radius:var(--r2);padding:14px;background:var(--bg);transition:transform .18s,border-color .18s,box-shadow .18s;position:relative;overflow:hidden;}
.subj-card:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(15,24,41,.08);}
.subj-card.blue  {--card-lt:var(--blue-lt);  --card-border:var(--blue-border);  --card-text:var(--blue-mid); --card-accent:var(--blue);}
.subj-card.purple{--card-lt:var(--purple-lt);--card-border:var(--purple-border);--card-text:var(--purple);   --card-accent:var(--purple);}
.subj-card.green {--card-lt:var(--green-lt); --card-border:var(--green-border); --card-text:var(--green);    --card-accent:var(--green);}
.subj-card.amber {--card-lt:var(--amber-lt); --card-border:var(--amber-border); --card-text:var(--amber);    --card-accent:var(--amber);}
.subj-card:hover{border-color:var(--card-border);}
.sc-code{display:inline-block;font-family:var(--mono);font-size:.66rem;font-weight:600;padding:2px 9px;border-radius:99px;margin-bottom:9px;background:var(--card-lt);color:var(--card-text);border:1px solid var(--card-border);letter-spacing:.04em;}
.sc-name{font-family:var(--font-head);font-size:.82rem;font-weight:800;color:var(--text);margin-bottom:10px;line-height:1.3;}
.sc-divider{height:1px;background:var(--border);margin-bottom:9px;}
.sc-rows{display:flex;flex-direction:column;gap:5px;}
.sc-row{display:flex;justify-content:space-between;font-size:.71rem;}
.sc-lbl{color:var(--text3);}
.sc-val{font-weight:800;color:var(--text2);font-family:var(--mono);}

/* ── ANIMATION ── */
@keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}

/* ── RESPONSIVE ── */
@media(max-width:1400px){.sched-wrap{grid-template-columns:repeat(3,minmax(0,1fr));}}
@media(max-width:1200px){.stats-grid{grid-template-columns:repeat(2,1fr)}.subj-grid{grid-template-columns:repeat(2,1fr)}.sched-wrap{grid-template-columns:repeat(2,minmax(0,1fr));}}
@media(max-width:960px){.sidebar{display:none}.main{margin-left:0}}
@media(max-width:680px){.sched-wrap{grid-template-columns:1fr}.class-grid{grid-template-columns:1fr}.pg-header{flex-direction:column;align-items:flex-start;gap:12px}.content{padding:18px 14px 40px}}
</style>
</head>
<body>

<!-- ═══════════════ SIDEBAR (FACULTY NAVIGATION) ═══════════════ -->
<div class="sidebar">
  <a href="{{ url('/faculty_dashboard') }}" class="sidebar-logo">
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
      <div class="user-avatar"><?= htmlspecialchars($faculty_initials) ?></div>
      <div class="user-widget-info">
        <div class="user-widget-name"><?= htmlspecialchars($faculty_name) ?></div>
        <div class="user-widget-role"><?= htmlspecialchars($faculty_dept) ?></div>
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

<!-- ═══════════════ MAIN ═══════════════ -->
<div class="main">

  <!-- Topbar -->
  <div class="topbar">
    <div class="topbar-search">
      <?=ic($icons,'search',14)?>
      <input type="text" placeholder="Search classrooms, faculty, subjects…">
    </div>
    <div class="topbar-right">
      <button class="notif-btn" title="Notifications">
        <?=ic($icons,'bell',16)?>
        <span class="notif-dot"></span>
      </button>
      <div class="tb-divider"></div>
      <div class="tb-profile">
        <div class="tb-profile-info">
          <div class="tb-profile-name"><?=htmlspecialchars($faculty_name)?></div>
          <div class="tb-profile-role"><?=htmlspecialchars($faculty_dept)?></div>
        </div>
        <img class="tb-avatar" src="https://randomuser.me/api/portraits/women/44.jpg" alt="<?=htmlspecialchars($faculty_name)?>">
        <div class="profile-dropdown">
          <div class="profile-dropdown-item">
            <span class="profile-dropdown-label">Email</span>
            <span class="profile-dropdown-value">elena.santos@university.edu</span>
          </div>
          <div class="profile-dropdown-item">
            <span class="profile-dropdown-label">University Position</span>
            <span class="profile-dropdown-value"><?=htmlspecialchars($faculty_dept)?></span>
          </div>
          <form method="POST" action="<?= htmlspecialchars(url('/logout')) ?>">
            <?php csrf_field(); ?>
            <button type="submit" class="profile-signout-btn">
              <?= ic($icons,'logout',14) ?>
              Sign Out
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="content">

    <!-- Page Header -->
    <div class="pg-header">
      <div class="ph-left">
        <div class="ph-icon"><?=ic($icons,'calendar',22)?></div>
        <div class="ph-title">
          <h1>Semester Schedule</h1>
          <p><?=htmlspecialchars($faculty_name)?> &bull; <?=htmlspecialchars($semester)?></p>
        </div>
      </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
      <?php foreach($stats as $s):?>
      <div class="stat-card <?=htmlspecialchars($s['color'])?>">
        <div class="stat-top">
          <div class="stat-val"><?=htmlspecialchars($s['value'])?></div>
          <div class="stat-ic"><?=ic($icons,$s['icon'],17)?></div>
        </div>
        <div class="stat-label"><?=htmlspecialchars($s['label'])?></div>
        <div class="stat-trend"><?=htmlspecialchars($s['trend'])?></div>
      </div>
      <?php endforeach;?>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
      <div class="search-wrap">
        <?=ic($icons,'search',14)?>
        <input type="text" placeholder="Filter classes…" id="classSearch">
      </div>
      <div class="tb-spacer"></div>
      <div class="sem-chip">
        <?=ic($icons,'calendar',13)?>
        <?=htmlspecialchars($semester)?>
      </div>
      <div class="view-toggle">
        <button class="vt-btn active" id="gridBtn"><?=ic($icons,'grid',13)?> Grid</button>
        <button class="vt-btn" id="tlBtn"><?=ic($icons,'timeline',13)?> Timeline</button>
      </div>
    </div>

    <!-- Schedule -->
    <div class="sched-wrap">
      <?php foreach($schedule as $di=>$day):
        $delay = round(.17+$di*.07,2);
      ?>
      <div class="day-section" style="--d:<?=$delay?>s">
        <div class="day-header">
          <div class="day-pill"><?=htmlspecialchars($day['abbr'])?></div>
          <div class="day-info">
            <div class="day-name"><?=htmlspecialchars($day['day'])?></div>
          </div>
          <div class="day-sep"></div>
          <div class="day-hrs-pill"><?=ic($icons,'clock',12)?> <?=htmlspecialchars($day['total_hrs'])?></div>
        </div>

        <div class="class-grid">
          <?php foreach($day['classes'] as $cls):?>
          <div class="cls-card <?=htmlspecialchars($cls['color'])?>">
            <div class="cls-top">
              <div class="cls-badges">
                <span class="code-badge"><?=htmlspecialchars($cls['code'])?></span>
              </div>
              <div class="cls-time-chip">
                <?=ic($icons,'clock',12)?>
                <?=htmlspecialchars($cls['time'])?>
              </div>
            </div>
            <div class="cls-body">
              <div class="cls-name"><?=htmlspecialchars($cls['subject'])?></div>
              <div class="cls-rows">
                <div class="cls-row">
                  <span class="cr-lbl"><?=ic($icons,'pin',12)?> Location</span>
                  <span class="cr-val"><?=htmlspecialchars($cls['location'])?></span>
                </div>
              </div>
              <div class="cls-footer">
                <span class="students-chip">
                  <?=ic($icons,'users',12)?>
                  Students&nbsp;<span class="students-num"><?=htmlspecialchars($cls['students'])?></span>
                </span>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
      <?php endforeach;?>
    </div>

    <!-- Subject Overview -->
    <div class="subj-section">
      <div class="subj-hd">
        <div class="subj-hd-icon"><?=ic($icons,'book',16)?></div>
        <h2>Subject Overview</h2>
      </div>
      <div class="subj-grid">
        <?php foreach($subjects as $s):?>
        <div class="subj-card <?=htmlspecialchars($s['color'])?>">
          <span class="sc-code"><?=htmlspecialchars($s['code'])?></span>
          <div class="sc-name"><?=htmlspecialchars($s['name'])?></div>
          <div class="sc-divider"></div>
          <div class="sc-rows">
            <div class="sc-row"><span class="sc-lbl">Sections</span><span class="sc-val"><?=$s['sections']?></span></div>
            <div class="sc-row"><span class="sc-lbl">Students</span><span class="sc-val"><?=$s['students']?></span></div>
            <div class="sc-row"><span class="sc-lbl">Classes/Week</span><span class="sc-val"><?=$s['classes']?></span></div>
            <div class="sc-row"><span class="sc-lbl">Units</span><span class="sc-val"><?=$s['units']?></span></div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<script>
// View toggle
document.querySelectorAll('.vt-btn').forEach(b=>{
  b.addEventListener('click',()=>{
    document.querySelectorAll('.vt-btn').forEach(x=>x.classList.remove('active'));
    b.classList.add('active');
  });
});
// Live filter
document.getElementById('classSearch').addEventListener('input',function(){
  const q=this.value.toLowerCase();
  document.querySelectorAll('.cls-card').forEach(c=>{
    const match=!q||c.textContent.toLowerCase().includes(q);
    c.style.opacity=match?'1':'.2';
    c.style.transform=match?'':'scale(.97)';
    c.style.transition='opacity .2s,transform .2s';
  });
});

// Profile dropdown toggle
document.addEventListener('DOMContentLoaded', function () {
  function closeAllProfileDropdowns() {
    document.querySelectorAll('.profile-dropdown').forEach(function (el) {
      el.classList.remove('is-open');
    });
  }

  document.querySelectorAll('.tb-profile').forEach(function (profile) {
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