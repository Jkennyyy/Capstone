<?php
$faculty_name     = "Prof. Elena Santos";
$faculty_dept     = "Faculty of IT";
$faculty_initials = "ES";
$semester         = "1st Semester 2025–2026";

$stats = [
  ["value" => "8",   "label" => "Classes/Week",   "icon" => "grid",    "color" => "blue"],
  ["value" => "359", "label" => "Total Students",  "icon" => "users",   "color" => "purple"],
  ["value" => "4",   "label" => "Subjects",        "icon" => "target",  "color" => "green"],
  ["value" => "12",  "label" => "Total Units",     "icon" => "zap",     "color" => "amber"],
];

$schedule = [
  [
    "day" => "Monday", "abbr" => "Mon", "total_hrs" => "4 hrs",
    "classes" => [
      ["code"=>"CS 301","section"=>"BSCS 3A","time"=>"8:00 AM","subject"=>"Database Systems",   "duration"=>"8:00 AM – 10:00 AM","location"=>"IT-301, IT Building","students"=>45,"color"=>"blue",  "hsl"=>"220,75%,55%"],
      ["code"=>"CS 302","section"=>"BSCS 3B","time"=>"1:00 PM","subject"=>"Software Engineering","duration"=>"1:00 PM – 3:00 PM", "location"=>"IT-205, IT Building","students"=>42,"color"=>"purple","hsl"=>"262,75%,60%"],
    ],
  ],
  [
    "day" => "Tuesday", "abbr" => "Tue", "total_hrs" => "2 hrs",
    "classes" => [
      ["code"=>"CS 301","section"=>"BSCS 3C","time"=>"10:00 AM","subject"=>"Database Systems",  "duration"=>"10:00 AM – 12:00 PM","location"=>"IT-301, IT Building","students"=>48,"color"=>"blue",  "hsl"=>"220,75%,55%"],
    ],
  ],
  [
    "day" => "Wednesday", "abbr" => "Wed", "total_hrs" => "3 hrs",
    "classes" => [
      ["code"=>"CS 205","section"=>"BSCS 2A","time"=>"8:00 AM","subject"=>"Web Development",    "duration"=>"8:00 AM – 11:00 AM", "location"=>"MB-104, Main Building","students"=>50,"color"=>"green", "hsl"=>"152,70%,40%"],
    ],
  ],
  [
    "day" => "Thursday", "abbr" => "Thu", "total_hrs" => "5 hrs",
    "classes" => [
      ["code"=>"CS 302","section"=>"BSCS 3A","time"=>"1:00 PM","subject"=>"Software Engineering","duration"=>"1:00 PM – 3:00 PM", "location"=>"IT-205, IT Building","students"=>45,"color"=>"purple","hsl"=>"262,75%,60%"],
      ["code"=>"CS 205","section"=>"BSCS 2B","time"=>"3:00 PM","subject"=>"Web Development",    "duration"=>"3:00 PM – 6:00 PM", "location"=>"IT-401, IT Building","students"=>46,"color"=>"green", "hsl"=>"152,70%,40%"],
    ],
  ],
  [
    "day" => "Friday", "abbr" => "Fri", "total_hrs" => "5 hrs",
    "classes" => [
      ["code"=>"CS 301","section"=>"BSCS 3A","time"=>"8:00 AM","subject"=>"Database Systems",   "duration"=>"8:00 AM – 10:00 AM","location"=>"IT-301, IT Building","students"=>45,"color"=>"blue",  "hsl"=>"220,75%,55%"],
      ["code"=>"CS 401","section"=>"BSCS 4A","time"=>"1:00 PM","subject"=>"Mobile Programming", "duration"=>"1:00 PM – 4:00 PM", "location"=>"SCI-201, Science Building","students"=>38,"color"=>"amber","hsl"=>"38,90%,52%"],
    ],
  ],
];

$subjects = [
  ["code"=>"CS 301","name"=>"Database Systems",   "sections"=>2,"students"=>138,"classes"=>3,"units"=>3,"color"=>"blue"],
  ["code"=>"CS 302","name"=>"Software Engineering","sections"=>2,"students"=>87, "classes"=>2,"units"=>3,"color"=>"purple"],
  ["code"=>"CS 205","name"=>"Web Development",     "sections"=>2,"students"=>96, "classes"=>2,"units"=>3,"color"=>"green"],
  ["code"=>"CS 401","name"=>"Mobile Programming",  "sections"=>1,"students"=>38, "classes"=>1,"units"=>3,"color"=>"amber"],
];

$nav_items = [
  ["icon"=>"home",    "label"=>"Dashboard"],
  ["icon"=>"door",    "label"=>"Reserve Room"],
  ["icon"=>"list",    "label"=>"My Reservations"],
  ["icon"=>"building","label"=>"Room Availability"],
  ["icon"=>"clock",   "label"=>"My Schedule","active"=>true],
  ["icon"=>"user",    "label"=>"Profile"],
];

$icons = [
  "home"     =>'<path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9.5z"/><polyline points="9 21 9 12 15 12 15 21"/>',
  "door"     =>'<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="14.5" cy="12" r="1.2"/>',
  "list"     =>'<line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><circle cx="3.5" cy="6" r=".5" fill="currentColor"/><circle cx="3.5" cy="12" r=".5" fill="currentColor"/><circle cx="3.5" cy="18" r=".5" fill="currentColor"/>',
  "building" =>'<rect x="4" y="2" width="16" height="20" rx="1"/><line x1="9" y1="22" x2="9" y2="12"/><line x1="15" y1="22" x2="15" y2="12"/><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/>',
  "clock"    =>'<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/>',
  "user"     =>'<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
  "grid"     =>'<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>',
  "users"    =>'<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
  "target"   =>'<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
  "zap"      =>'<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
  "pin"      =>'<path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
  "print"    =>'<polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/>',
  "export"   =>'<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
  "search"   =>'<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
  "timeline" =>'<line x1="17" y1="12" x2="3" y2="12"/><line x1="17" y1="6" x2="3" y2="6"/><line x1="17" y1="18" x2="3" y2="18"/><circle cx="20" cy="12" r="1" fill="currentColor"/><circle cx="20" cy="6" r="1" fill="currentColor"/><circle cx="20" cy="18" r="1" fill="currentColor"/>',
  "book"     =>'<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
  "calendar" =>'<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
];

function svg($icons, $name, $size = 16) {
  $p = $icons[$name] ?? '';
  return "<svg width=\"{$size}\" height=\"{$size}\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\">{$p}</svg>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>SmartDoor — Semester Schedule</title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --sw:256px;
  --bg:#08090e;
  --surf:#0d1018;
  --card:#111520;
  --card2:#141826;
  --border:rgba(255,255,255,.065);
  --border2:rgba(255,255,255,.11);
  --t1:#eaf0ff;
  --t2:#8896b8;
  --t3:#4a5472;
  --blue:#4b87e8;
  --blue-bg:rgba(75,135,232,.13);
  --blue-border:rgba(75,135,232,.28);
  --purple:#8b5cf6;
  --purple-bg:rgba(139,92,246,.13);
  --purple-border:rgba(139,92,246,.28);
  --green:#10b981;
  --green-bg:rgba(16,185,129,.13);
  --green-border:rgba(16,185,129,.28);
  --amber:#f59e0b;
  --amber-bg:rgba(245,158,11,.12);
  --amber-border:rgba(245,158,11,.26);
  --r:14px;
  --r2:10px;
  --font:'Sora',sans-serif;
  --mono:'JetBrains Mono',monospace;
}
html{scroll-behavior:smooth}
body{font-family:var(--font);background:var(--bg);color:var(--t1);display:flex;min-height:100vh;-webkit-font-smoothing:antialiased;}
::-webkit-scrollbar{width:4px}::-webkit-scrollbar-thumb{background:rgba(255,255,255,.09);border-radius:99px}

/* ── SIDEBAR ── */
.sidebar{width:var(--sw);background:var(--surf);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;inset:0 auto 0 0;z-index:100;overflow:hidden;}
.sidebar::before{content:'';position:absolute;top:0;left:0;right:0;height:200px;background:radial-gradient(ellipse at 50% -10%,rgba(75,135,232,.14) 0%,transparent 68%);pointer-events:none;}
.sb-logo{display:flex;align-items:center;gap:12px;padding:24px 20px 20px;border-bottom:1px solid var(--border);position:relative;}
.sb-mark{width:38px;height:38px;background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:17px;box-shadow:0 5px 18px rgba(245,158,11,.28);flex-shrink:0;}
.sb-title strong{display:block;font-size:14.5px;font-weight:700;letter-spacing:-.01em;}
.sb-title span{font-size:10.5px;color:var(--t3);letter-spacing:.05em;text-transform:uppercase;}
.sb-nav{padding:16px 12px;flex:1;display:flex;flex-direction:column;gap:2px;overflow-y:auto;}
.nav-a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:9px;font-size:13px;font-weight:500;color:var(--t2);text-decoration:none;transition:background .14s,color .14s;position:relative;}
.nav-a:hover{background:rgba(255,255,255,.05);color:var(--t1);}
.nav-a.active{background:rgba(75,135,232,.12);color:#7eaaff;font-weight:600;}
.nav-a.active::before{content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);width:3px;height:56%;background:var(--blue);border-radius:0 3px 3px 0;}
.nav-a svg{opacity:.8;flex-shrink:0;}
.sb-footer{padding:14px 18px;border-top:1px solid var(--border);display:flex;align-items:center;gap:11px;}
.avatar{width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--purple));color:#fff;font-size:11.5px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 3px 10px rgba(75,135,232,.3);}
.fi strong{display:block;font-size:12.5px;font-weight:600;}
.fi span{font-size:10.5px;color:var(--t3);}

/* ── MAIN ── */
.main{margin-left:var(--sw);flex:1;padding:30px 34px 52px;min-height:100vh;position:relative;overflow-x:hidden;}
.main::before,.main::after{content:'';position:fixed;border-radius:50%;pointer-events:none;filter:blur(100px);z-index:0;}
.main::before{width:600px;height:600px;top:-180px;right:-120px;background:radial-gradient(circle,rgba(75,135,232,.065) 0%,transparent 70%);}
.main::after{width:500px;height:500px;bottom:-100px;left:100px;background:radial-gradient(circle,rgba(139,92,246,.055) 0%,transparent 70%);}
.main>*{position:relative;z-index:1;}

/* ── PAGE HEADER ── */
.pg-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:26px;background:var(--card);border:1px solid var(--border);border-radius:var(--r);padding:18px 22px;animation:fadeUp .45s ease both;}
.ph-left{display:flex;align-items:center;gap:16px;}
.ph-icon{width:46px;height:46px;background:rgba(75,135,232,.15);border:1px solid var(--blue-border);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--blue);flex-shrink:0;}
.ph-title h1{font-size:26px;font-weight:800;letter-spacing:-.03em;background:linear-gradient(130deg,var(--t1) 40%,var(--t2) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.ph-title p{font-size:12px;color:var(--t3);margin-top:4px;font-weight:500;}
.ph-actions{display:flex;gap:8px;}
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 16px;border-radius:var(--r2);font-size:12.5px;font-weight:600;font-family:var(--font);cursor:pointer;border:none;transition:transform .14s,box-shadow .14s,opacity .14s;}
.btn:hover{transform:translateY(-1px);}
.btn svg{width:13px;height:13px;}
.btn-ghost{background:rgba(255,255,255,.05);border:1px solid var(--border2);color:var(--t2);}
.btn-ghost:hover{background:rgba(255,255,255,.09);color:var(--t1);}
.btn-amber{background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;box-shadow:0 4px 16px rgba(245,158,11,.28);}
.btn-amber:hover{box-shadow:0 6px 22px rgba(245,158,11,.4);}
.btn-sm{padding:7px 13px;font-size:12px;}

/* ── STATS ── */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:22px;animation:fadeUp .45s ease .07s both;}
.stat-card{background:var(--card);border:1px solid var(--border);border-radius:var(--r);padding:18px 18px 16px;position:relative;overflow:hidden;transition:transform .18s,border-color .2s;}
.stat-card:hover{transform:translateY(-3px);border-color:var(--border2);}
.stat-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:var(--grad);opacity:.75;}
.stat-card.blue{--grad:linear-gradient(90deg,var(--blue),#7eb4ff);}
.stat-card.purple{--grad:linear-gradient(90deg,var(--purple),#c084fc);}
.stat-card.green{--grad:linear-gradient(90deg,var(--green),#34d399);}
.stat-card.amber{--grad:linear-gradient(90deg,var(--amber),#fcd34d);}
.stat-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:10px;}
.stat-val{font-size:32px;font-weight:800;letter-spacing:-.04em;line-height:1;}
.stat-card.blue .stat-val{color:var(--blue);}
.stat-card.purple .stat-val{color:var(--purple);}
.stat-card.green .stat-val{color:var(--green);}
.stat-card.amber .stat-val{color:var(--amber);}
.stat-ic{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.stat-card.blue .stat-ic{background:var(--blue-bg);color:var(--blue);}
.stat-card.purple .stat-ic{background:var(--purple-bg);color:var(--purple);}
.stat-card.green .stat-ic{background:var(--green-bg);color:var(--green);}
.stat-card.amber .stat-ic{background:var(--amber-bg);color:var(--amber);}
.stat-label{font-size:11.5px;color:var(--t3);font-weight:500;letter-spacing:.03em;}

/* ── TOOLBAR ── */
.toolbar{display:flex;align-items:center;gap:10px;margin-bottom:26px;animation:fadeUp .45s ease .12s both;}
.search-box{display:flex;align-items:center;gap:8px;background:var(--card);border:1px solid var(--border);border-radius:var(--r2);padding:9px 14px;flex:0 0 240px;color:var(--t3);font-family:var(--font);font-size:13px;transition:border-color .15s;}
.search-box:focus-within{border-color:rgba(75,135,232,.4);}
.search-box input{background:none;border:none;outline:none;color:var(--t2);font-family:var(--font);font-size:13px;width:100%;}
.search-box input::placeholder{color:var(--t3);}
.tb-spacer{flex:1;}
.view-toggle{display:flex;background:var(--card);border:1px solid var(--border);border-radius:var(--r2);overflow:hidden;}
.vt-btn{display:flex;align-items:center;gap:7px;padding:9px 16px;font-size:13px;font-weight:500;font-family:var(--font);cursor:pointer;border:none;background:none;color:var(--t3);transition:background .14s,color .14s;}
.vt-btn.active{background:rgba(75,135,232,.15);color:#7eaaff;}
.vt-btn svg{width:14px;height:14px;}

/* ── DAY SECTION ── */
.day-section{margin-bottom:28px;animation:fadeUp .5s ease var(--delay,.2s) both;}
.day-header{display:flex;align-items:center;gap:12px;margin-bottom:14px;}
.day-badge{width:42px;height:42px;border-radius:12px;background:var(--card2);border:1px solid var(--border2);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:var(--t2);letter-spacing:.02em;flex-shrink:0;}
.day-info{flex:1;}
.day-name{font-size:17px;font-weight:700;letter-spacing:-.01em;}
.day-sub{font-size:11.5px;color:var(--t3);margin-top:1px;}
.day-hrs{font-size:12px;font-weight:600;color:var(--t3);background:rgba(255,255,255,.05);border:1px solid var(--border);border-radius:99px;padding:3px 12px;}

/* ── CLASS GRID ── */
.class-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:12px;}

/* ── CLASS CARD ── */
.cls-card{background:var(--card);border:1px solid var(--border);border-radius:var(--r);overflow:hidden;transition:transform .18s,border-color .2s,box-shadow .2s;}
.cls-card:hover{transform:translateY(-3px);border-color:var(--cb);box-shadow:0 10px 32px rgba(0,0,0,.4);}
.cls-card.blue{--cb:var(--blue-border);--ca:var(--blue);--cbg:var(--blue-bg);}
.cls-card.purple{--cb:var(--purple-border);--ca:var(--purple);--cbg:var(--purple-bg);}
.cls-card.green{--cb:var(--green-border);--ca:var(--green);--cbg:var(--green-bg);}
.cls-card.amber{--cb:var(--amber-border);--ca:var(--amber);--cbg:var(--amber-bg);}

.cls-top{display:flex;align-items:center;justify-content:space-between;padding:14px 16px 10px;border-bottom:1px solid var(--border);}
.cls-badges{display:flex;align-items:center;gap:8px;}
.code-badge{font-size:11px;font-weight:700;font-family:var(--mono);padding:3px 10px;border-radius:99px;background:var(--cbg);color:var(--ca);border:1px solid var(--cb);letter-spacing:.04em;}
.sec-badge{font-size:11px;font-weight:500;color:var(--t3);background:rgba(255,255,255,.05);border:1px solid var(--border);border-radius:99px;padding:2px 9px;}
.cls-time-chip{display:flex;align-items:center;gap:5px;font-size:12px;font-weight:600;color:var(--t2);font-family:var(--mono);}
.cls-time-chip svg{width:12px;height:12px;color:var(--t3);}

.cls-body{padding:12px 16px 14px;}
.cls-name{font-size:15.5px;font-weight:700;letter-spacing:-.015em;margin-bottom:12px;}

.cls-rows{display:flex;flex-direction:column;gap:7px;margin-bottom:14px;}
.cls-row{display:flex;align-items:center;justify-content:space-between;font-size:12px;}
.cr-lbl{display:flex;align-items:center;gap:6px;color:var(--t3);}
.cr-lbl svg{width:12px;height:12px;}
.cr-val{font-weight:600;color:var(--t2);font-size:12.5px;text-align:right;}

.cls-footer{display:flex;align-items:center;gap:8px;padding-top:12px;border-top:1px solid var(--border);}
.students-chip{display:flex;align-items:center;gap:5px;font-size:11.5px;color:var(--t3);}
.students-chip svg{width:12px;height:12px;}
.students-num{font-weight:700;color:var(--ca);font-family:var(--mono);font-size:13px;}
.cls-actions{margin-left:auto;display:flex;gap:6px;}

/* ── SUBJECT OVERVIEW ── */
.subj-section{background:var(--card);border:1px solid var(--border);border-radius:var(--r);padding:22px 24px;animation:fadeUp .5s ease .45s both;}
.subj-header{display:flex;align-items:center;gap:10px;margin-bottom:18px;}
.subj-header h2{font-size:15.5px;font-weight:700;letter-spacing:-.01em;}
.subj-header svg{color:var(--amber);}
.subj-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}

.subj-card{background:var(--card2);border:1px solid var(--border);border-radius:var(--r2);padding:16px;transition:border-color .18s,transform .18s;}
.subj-card:hover{border-color:var(--cb);transform:translateY(-2px);}
.subj-card.blue{--cb:var(--blue-border);--ca:var(--blue);--cbg:var(--blue-bg);}
.subj-card.purple{--cb:var(--purple-border);--ca:var(--purple);--cbg:var(--purple-bg);}
.subj-card.green{--cb:var(--green-border);--ca:var(--green);--cbg:var(--green-bg);}
.subj-card.amber{--cb:var(--amber-border);--ca:var(--amber);--cbg:var(--amber-bg);}

.sc-code{font-size:11px;font-weight:700;font-family:var(--mono);padding:2px 9px;border-radius:99px;background:var(--cbg);color:var(--ca);border:1px solid var(--cb);display:inline-block;margin-bottom:10px;letter-spacing:.04em;}
.sc-name{font-size:13.5px;font-weight:700;letter-spacing:-.01em;margin-bottom:12px;line-height:1.3;}
.sc-rows{display:flex;flex-direction:column;gap:6px;}
.sc-row{display:flex;justify-content:space-between;font-size:12px;}
.sc-lbl{color:var(--t3);}
.sc-val{font-weight:700;color:var(--t2);font-family:var(--mono);}

/* ── ANIMATIONS ── */
@keyframes fadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}

/* ── RESPONSIVE ── */
@media(max-width:1100px){.stats-grid{grid-template-columns:repeat(2,1fr)}.subj-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:960px){.sidebar{display:none}.main{margin-left:0;padding:20px 16px 40px}}
@media(max-width:700px){.class-grid{grid-template-columns:1fr}.pg-header{flex-direction:column;align-items:flex-start;gap:12px}}
</style>
</head>
<body>

<!-- ═══ SIDEBAR ═══ -->
<aside class="sidebar">
  <div class="sb-logo">
    <div class="sb-mark">🏠</div>
    <div class="sb-title">
      <strong>SmartDoor</strong>
      <span>Faculty Portal</span>
    </div>
  </div>
  <nav class="sb-nav">
    <?php foreach($nav_items as $n):
      $a = isset($n['active']) && $n['active'] ? ' active' : '';
    ?>
    <a class="nav-a<?=$a?>" href="#">
      <?=svg($icons,$n['icon'],16)?>
      <?=htmlspecialchars($n['label'])?>
    </a>
    <?php endforeach;?>
  </nav>
  <div class="sb-footer">
    <div class="avatar"><?=htmlspecialchars($faculty_initials)?></div>
    <div class="fi">
      <strong><?=htmlspecialchars($faculty_name)?></strong>
      <span><?=htmlspecialchars($faculty_dept)?></span>
    </div>
  </div>
</aside>

<!-- ═══ MAIN ═══ -->
<main class="main">

  <!-- Page Header -->
  <div class="pg-header">
    <div class="ph-left">
      <div class="ph-icon"><?=svg($icons,'calendar',22)?></div>
      <div class="ph-title">
        <h1>Semester Schedule</h1>
        <p><?=htmlspecialchars($faculty_name)?> &bull; <?=htmlspecialchars($semester)?></p>
      </div>
    </div>
    <div class="ph-actions">
      <button class="btn btn-ghost"><?=svg($icons,'print',13)?> Print</button>
      <button class="btn btn-amber"><?=svg($icons,'export',13)?> Export</button>
    </div>
  </div>

  <!-- Stats -->
  <div class="stats-grid">
    <?php foreach($stats as $s):?>
    <div class="stat-card <?=htmlspecialchars($s['color'])?>">
      <div class="stat-top">
        <div class="stat-val"><?=htmlspecialchars($s['value'])?></div>
        <div class="stat-ic"><?=svg($icons,$s['icon'],18)?></div>
      </div>
      <div class="stat-label"><?=htmlspecialchars($s['label'])?></div>
    </div>
    <?php endforeach;?>
  </div>

  <!-- Toolbar -->
  <div class="toolbar">
    <div class="search-box">
      <?=svg($icons,'search',14)?>
      <input type="text" placeholder="Search classes...">
    </div>
    <div class="tb-spacer"></div>
    <div class="view-toggle">
      <button class="vt-btn active"><?=svg($icons,'grid',14)?> Grid</button>
      <button class="vt-btn"><?=svg($icons,'timeline',14)?> Timeline</button>
    </div>
  </div>

  <!-- Schedule Days -->
  <?php foreach($schedule as $di => $day):
    $delay = round(.18 + $di * .07, 2);
  ?>
  <div class="day-section" style="--delay:<?=$delay?>s">
    <div class="day-header">
      <div class="day-badge"><?=htmlspecialchars($day['abbr'])?></div>
      <div class="day-info">
        <div class="day-name"><?=htmlspecialchars($day['day'])?></div>
        <div class="day-sub"><?=count($day['classes'])?> class<?=count($day['classes'])!==1?'es':''?></div>
      </div>
      <span class="day-hrs"><?=htmlspecialchars($day['total_hrs'])?></span>
    </div>

    <div class="class-grid">
      <?php foreach($day['classes'] as $ci => $cls):?>
      <div class="cls-card <?=htmlspecialchars($cls['color'])?>">
        <div class="cls-top">
          <div class="cls-badges">
            <span class="code-badge"><?=htmlspecialchars($cls['code'])?></span>
            <span class="sec-badge"><?=htmlspecialchars($cls['section'])?></span>
          </div>
          <div class="cls-time-chip">
            <?=svg($icons,'clock',12)?>
            <?=htmlspecialchars($cls['time'])?>
          </div>
        </div>
        <div class="cls-body">
          <div class="cls-name"><?=htmlspecialchars($cls['subject'])?></div>
          <div class="cls-rows">
            <div class="cls-row">
              <span class="cr-lbl"><?=svg($icons,'clock',12)?> Duration</span>
              <span class="cr-val"><?=htmlspecialchars($cls['duration'])?></span>
            </div>
            <div class="cls-row">
              <span class="cr-lbl"><?=svg($icons,'pin',12)?> Location</span>
              <span class="cr-val"><?=htmlspecialchars($cls['location'])?></span>
            </div>
          </div>
          <div class="cls-footer">
            <span class="students-chip">
              <?=svg($icons,'users',12)?>
              Students&nbsp;<span class="students-num"><?=htmlspecialchars($cls['students'])?></span>
            </span>
            <div class="cls-actions">
              <button class="btn btn-ghost btn-sm">Details</button>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <?php endforeach;?>

  <!-- Subject Overview -->
  <div class="subj-section">
    <div class="subj-header">
      <?=svg($icons,'book',17)?>
      <h2>Subject Overview</h2>
    </div>
    <div class="subj-grid">
      <?php foreach($subjects as $s):?>
      <div class="subj-card <?=htmlspecialchars($s['color'])?>">
        <span class="sc-code"><?=htmlspecialchars($s['code'])?></span>
        <div class="sc-name"><?=htmlspecialchars($s['name'])?></div>
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

</main>

<script>
// View toggle
document.querySelectorAll('.vt-btn').forEach(b=>{
  b.addEventListener('click',()=>{
    document.querySelectorAll('.vt-btn').forEach(x=>x.classList.remove('active'));
    b.classList.add('active');
  });
});
// Search live filter
const inp = document.querySelector('.search-box input');
inp && inp.addEventListener('input', function(){
  const q = this.value.toLowerCase();
  document.querySelectorAll('.cls-card').forEach(c=>{
    const txt = c.textContent.toLowerCase();
    c.style.opacity = (!q || txt.includes(q)) ? '1' : '.25';
    c.style.transform = (!q || txt.includes(q)) ? '' : 'scale(.97)';
  });
});
</script>
</body>
</html>