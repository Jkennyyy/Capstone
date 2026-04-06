<?php
// SmartDoor Faculty Portal - Room Availability Page

$rooms = [
    ['id' => 101, 'name' => 'Room 101',  'building' => 'IT Building',          'floor' => '1st Floor', 'seats' => 40, 'status' => 'occupied',  'time_info' => 'Free at 10:30 AM', 'amenities' => ['Projector', 'AC', 'WiFi']],
    ['id' => 205, 'name' => 'Room 205',  'building' => 'IT Building',          'floor' => '2nd Floor', 'seats' => 35, 'status' => 'available', 'time_info' => 'Until 01:00 PM',  'amenities' => ['Projector', 'AC', 'WiFi', 'Whiteboard']],
    ['id' => 105, 'name' => 'Lab 105',   'building' => 'IT Building',          'floor' => '1st Floor', 'seats' => 30, 'status' => 'available', 'time_info' => 'Until 10:30 AM',  'amenities' => ['Computers', 'AC', 'WiFi', 'Projector']],
    ['id' => 302, 'name' => 'Room 302',  'building' => 'Engineering Building', 'floor' => '3rd Floor', 'seats' => 45, 'status' => 'occupied',  'time_info' => 'Free at 12:00 PM', 'amenities' => ['Projector', 'AC', 'Sound System']],
    ['id' => 201, 'name' => 'Room 201',  'building' => 'Admin Building',       'floor' => '2nd Floor', 'seats' => 50, 'status' => 'available', 'time_info' => 'Until 02:00 PM',  'amenities' => ['Projector', 'AC', 'WiFi', 'Sound System']],
    ['id' => 203, 'name' => 'Lab 203',   'building' => 'IT Building',          'floor' => '2nd Floor', 'seats' => 30, 'status' => 'available', 'time_info' => 'Until 03:00 PM',  'amenities' => ['Computers', 'AC', 'WiFi']],
];

$filter = $_GET['filter'] ?? 'all';
$search = $_GET['search'] ?? '';

$filtered_rooms = array_filter($rooms, function($room) use ($filter, $search) {
    $match_filter = $filter === 'all' || $room['status'] === $filter;
    $match_search = empty($search) ||
        stripos($room['name'], $search) !== false ||
        stripos($room['building'], $search) !== false;
    return $match_filter && $match_search;
});

$available_count = count(array_filter($rooms, fn($r) => $r['status'] === 'available'));
$occupied_count  = count(array_filter($rooms, fn($r) => $r['status'] === 'occupied'));
$total_count     = count($rooms);

function amenity_icon($amenity) {
    $icons = [
        'Projector'    => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="10" rx="2"/><circle cx="12" cy="12" r="2"/></svg>',
        'AC'           => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20M4.93 4.93l14.14 14.14M19.07 4.93L4.93 19.07"/></svg>',
        'WiFi'         => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg>',
        'Whiteboard'   => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="1"/><path d="M8 21h8M12 17v4"/></svg>',
        'Computers'    => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>',
        'Sound System' => '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>',
    ];
    return $icons[$amenity] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Room Availability – SmartDoor</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root {
  --yellow:     #f5c518;
  --navy:       #0b1640;
  --navy-mid:   #1a2f80;
  --navy-light: #e8ecfb;
  --white:      #ffffff;
  --bg:         #f0f2f5;
  --border:     #e5e7eb;
  --text:       #1a1d2e;
  --text-2:     #3d4a5c;
  --text-3:     #6b7280;
  --text-4:     #b0bac8;
  --accent:     #1a2b6d;
  --accent2:    #4a6cf7;
  --green:      #16a34a;
  --green-bg:   #dcfce7;
  --green-bd:   #bbf7d0;
  --green-text: #15803d;
  --red:        #dc2626;
  --red-bg:     #fee2e2;
  --red-bd:     #fca5a5;
  --orange:     #f59e0b;
  --shadow-sm:  0 1px 3px rgba(0,0,0,.07),0 1px 2px rgba(0,0,0,.05);
  --shadow-md:  0 4px 16px rgba(0,0,0,.08),0 1px 4px rgba(0,0,0,.04);
  --r-xs: 6px; --r-sm: 10px; --r: 14px; --r-lg: 18px;
  --sidebar-w: 230px;
  --fh: 'Plus Jakarta Sans',sans-serif;
  --fb: 'DM Sans',sans-serif;
}

body { font-family:var(--fb); background:var(--bg); color:var(--text); min-height:100vh; display:flex; -webkit-font-smoothing:antialiased; }

/* ══ SIDEBAR (UNCHANGED) ══ */
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
.sidebar-nav a{display:flex;align-items:center;gap:11px;padding:11px 12px;text-decoration:none;color:rgba(255,255,255,.6);font-size:.88rem;font-weight:500;border-radius:var(--r-sm);transition:all .22s cubic-bezier(.4,0,.2,1);position:relative;overflow:hidden}
.sidebar-nav a .nav-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;background:rgba(255,255,255,.05);flex-shrink:0;transition:all .22s}
.sidebar-nav a:hover{color:rgba(255,255,255,.9);background:rgba(255,255,255,.06)}
.sidebar-nav a:hover .nav-icon{background:rgba(255,255,255,.1)}
.sidebar-nav a.active{background:rgba(245,197,24,.14);color:var(--yellow)}
.sidebar-nav a.active .nav-icon{background:rgba(245,197,24,.2);color:var(--yellow)}
.sidebar-nav a.active::before{content:'';position:absolute;left:0;top:20%;bottom:20%;width:3px;background:var(--yellow);border-radius:0 2px 2px 0}
.sidebar-footer{margin-top:auto;padding:16px 12px 24px;border-top:1px solid rgba(255,255,255,.06)}
.user-widget{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:var(--r-sm);background:rgba(255,255,255,.05);margin-bottom:8px}
.user-avatar{width:34px;height:34px;border-radius:50%;flex-shrink:0;background:var(--navy-mid);border:2px solid rgba(245,197,24,.4);display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700;color:var(--yellow)}
.user-widget-name{font-size:.83rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.user-widget-role{font-size:.73rem;color:rgba(255,255,255,.4)}
.sidebar-logout-btn{display:flex;align-items:center;gap:10px;padding:9px 12px;color:rgba(255,255,255,.4);font-size:.84rem;font-weight:500;border-radius:var(--r-sm);transition:all .22s;width:100%;background:none;border:none;cursor:pointer;font-family:inherit}
.sidebar-logout-btn:hover{color:#f87171;background:rgba(244,63,94,.08)}

/* ══ MAIN ══ */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}

/* ── TOPBAR ── */
.topbar{background:var(--white);border-bottom:1px solid var(--border);padding:0 32px;height:64px;display:flex;align-items:center;gap:16px;position:sticky;top:0;z-index:50}
.topbar-search{flex:1;max-width:420px;display:flex;align-items:center;gap:10px;background:var(--bg);border:1.5px solid var(--border);border-radius:24px;padding:9px 18px;transition:border-color .2s,box-shadow .2s}
.topbar-search:focus-within{border-color:#93c5fd;box-shadow:0 0 0 3px rgba(59,130,246,.09)}
.topbar-search i{color:var(--text-4);font-size:.88rem}
.topbar-search input{border:none;outline:none;background:transparent;font-size:.88rem;font-family:var(--fb);color:var(--text);width:100%}
.topbar-search input::placeholder{color:var(--text-4)}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:16px}
.notif-btn{position:relative;background:none;border:1.5px solid var(--border);cursor:pointer;color:var(--text-2);font-size:1rem;width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:background .18s}
.notif-btn:hover{background:var(--bg)}
.notif-badge{position:absolute;top:6px;right:6px;width:7px;height:7px;background:var(--red);border-radius:50%;border:1.5px solid #fff}
.topbar-profile{position:relative;display:flex;align-items:center;gap:10px;cursor:pointer}
.topbar-profile-name{font-size:.88rem;font-weight:700;color:var(--text);line-height:1.2}
.topbar-profile-role{font-size:.75rem;color:var(--text-3)}
.topbar-avatar{width:38px;height:38px;border-radius:50%;background:#e0e7ff;border:2px solid var(--border);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;color:var(--accent2);overflow:hidden}
.topbar-avatar img{width:100%;height:100%;object-fit:cover}

/* Profile dropdown */
.profile-dropdown{position:absolute;top:115%;right:0;min-width:230px;background:var(--white);border-radius:var(--r-sm);border:1px solid var(--border);box-shadow:var(--shadow-md);padding:10px 12px 8px;display:none;z-index:2000}
.profile-dropdown.is-open{display:block}
.profile-dropdown-item{display:flex;align-items:flex-start;gap:8px;margin-bottom:8px}
.profile-dropdown-icon{width:28px;height:28px;border-radius:999px;display:inline-flex;align-items:center;justify-content:center;background:var(--bg);color:var(--text-3);font-size:.82rem;flex-shrink:0}
.profile-dropdown-label{font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:var(--text-3);font-weight:700;padding:2px 0 3px}
.profile-dropdown-value{font-size:.82rem;color:var(--text-2)}
.profile-signout-btn{width:100%;margin-top:4px;border:none;outline:none;border-radius:999px;padding:7px 10px;font-size:.82rem;font-weight:600;display:flex;align-items:center;justify-content:center;gap:6px;background:var(--red-bg);color:var(--red);cursor:pointer;transition:background .16s,transform .08s;font-family:inherit}
.profile-signout-btn:hover{background:#fee2e2;transform:translateY(-1px)}

/* ══ CONTENT ══ */
.content{padding:28px 32px 52px;display:flex;flex-direction:column;gap:22px}

/* ── PAGE HEADER ── */
.page-header{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px}
.page-title{font-family:var(--fh);font-size:1.35rem;font-weight:800;color:var(--text)}
.page-sub{font-size:.82rem;color:var(--text-3);margin-top:3px}
.header-actions{display:flex;gap:10px;align-items:center}
.btn-outline{display:flex;align-items:center;gap:7px;padding:9px 16px;border:1.5px solid var(--border);border-radius:var(--r-sm);background:var(--white);font-family:var(--fb);font-size:.82rem;font-weight:600;color:var(--text-2);cursor:pointer;transition:background .15s}
.btn-outline:hover{background:var(--bg)}
.btn-primary{display:flex;align-items:center;gap:7px;padding:9px 18px;border:none;border-radius:var(--r-sm);background:var(--accent);color:#fff;font-family:var(--fb);font-size:.82rem;font-weight:600;cursor:pointer;transition:opacity .15s}
.btn-primary:hover{opacity:.88}

/* ── SEARCH + FILTER ── */
.search-filter-row{background:var(--white);border-radius:var(--r);padding:16px 20px;box-shadow:var(--shadow-sm);display:flex;align-items:center;gap:14px;flex-wrap:wrap}
.search-wrap{flex:1;position:relative;min-width:200px}
.search-wrap i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--text-4);font-size:.8rem;pointer-events:none}
.search-wrap input{width:100%;padding:10px 14px 10px 36px;border:1.5px solid var(--border);border-radius:var(--r-sm);background:var(--bg);font-size:.85rem;font-family:var(--fb);color:var(--text);outline:none;transition:border .15s,box-shadow .15s}
.search-wrap input:focus{border-color:#93c5fd;box-shadow:0 0 0 3px rgba(59,130,246,.09);background:#fff}
.search-wrap input::placeholder{color:var(--text-4)}
.sf-divider{width:1px;height:26px;background:var(--border);flex-shrink:0}
.filter-label{font-size:.75rem;font-weight:700;color:var(--text-3);white-space:nowrap}
.filter-pills{display:flex;gap:5px}
.filter-btn{padding:6px 16px;border-radius:20px;font-size:.78rem;font-weight:600;font-family:var(--fb);border:1.5px solid transparent;cursor:pointer;color:var(--text-3);background:var(--bg);text-decoration:none;transition:all .15s}
.filter-btn:hover{background:#e8ecfb;color:var(--accent2);border-color:#c7d2fe}
.filter-btn.active{background:var(--accent);color:#fff;border-color:var(--accent)}

/* ── CAMPUS MAP ── */
.map-card{background:var(--white);border-radius:var(--r);box-shadow:var(--shadow-sm);overflow:hidden}
.map-card-header{padding:18px 22px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.map-title-group{display:flex;align-items:center;gap:10px}
.map-icon{width:32px;height:32px;border-radius:8px;background:#eff2ff;color:var(--accent2);display:flex;align-items:center;justify-content:center;font-size:.82rem}
.map-title{font-family:var(--fh);font-size:.95rem;font-weight:700;color:var(--text)}
.map-sub{font-size:.74rem;color:var(--text-3);margin-top:1px}
.live-badge{display:flex;align-items:center;gap:5px;font-size:.72rem;font-weight:700;color:var(--green);background:var(--green-bg);padding:4px 11px;border-radius:20px;border:1px solid var(--green-bd)}
.live-dot{width:7px;height:7px;border-radius:50%;background:var(--green);animation:pulse 1.6s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
.map-grid{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;gap:2px;background:#cde0cd;min-height:240px;position:relative}
.map-cell{background:#edf7ed;display:flex;align-items:center;justify-content:center;min-height:105px;position:relative}
.map-cell:last-child{background:#f4f7f4}
.building-pin{display:flex;flex-direction:column;align-items:center;gap:7px}
.pin-box{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;position:relative;box-shadow:0 4px 14px rgba(0,0,0,.18)}
.pin-box.avail{background:linear-gradient(135deg,#22c55e,#16a34a)}
.pin-box.full {background:linear-gradient(135deg,#f87171,#dc2626)}
.pin-num{position:absolute;top:-7px;right:-7px;width:20px;height:20px;border:2px solid #fff;border-radius:50%;font-size:9px;font-weight:800;display:flex;align-items:center;justify-content:center}
.pin-num.g{background:#fff;color:var(--green)}
.pin-num.r{background:#fff;color:var(--red)}
.building-lbl{font-size:11px;font-weight:700;color:var(--text-2);text-align:center;max-width:90px;line-height:1.35}
.map-north{position:absolute;top:12px;right:12px;width:26px;height:26px;background:#fff;border-radius:50%;box-shadow:0 1px 4px rgba(0,0,0,.1);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:800;color:var(--navy);z-index:5}
.map-legend{position:absolute;bottom:12px;left:12px;background:rgba(255,255,255,.96);backdrop-filter:blur(4px);border-radius:10px;padding:10px 14px;box-shadow:var(--shadow-sm);z-index:5;border:1px solid var(--border)}
.legend-row{display:flex;align-items:center;gap:7px;font-size:.72rem;font-weight:600;color:var(--text-2);padding:2px 0}
.legend-dot{width:9px;height:9px;border-radius:50%;flex-shrink:0}

/* ── ROOMS SECTION ── */
.rooms-header{display:flex;align-items:center;justify-content:space-between}
.rooms-section-title{font-family:var(--fh);font-size:.95rem;font-weight:700;color:var(--text)}
.rooms-count-badge{font-size:.78rem;color:var(--text-3);background:var(--white);padding:4px 13px;border-radius:20px;border:1.5px solid var(--border);font-weight:600;box-shadow:var(--shadow-sm)}

/* ── ROOM CARDS GRID ── */
.rooms-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}
.room-card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--r);padding:20px;box-shadow:var(--shadow-sm);transition:transform .18s,box-shadow .18s;display:flex;flex-direction:column}
.room-card:hover{transform:translateY(-3px);box-shadow:var(--shadow-md)}
.card-strip{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.room-id{font-size:.68rem;font-weight:700;letter-spacing:.07em;color:var(--text-4);text-transform:uppercase}
.status-pill{display:inline-flex;align-items:center;gap:5px;font-size:.7rem;font-weight:700;padding:4px 10px;border-radius:20px}
.pill-avail{background:var(--green-bg);color:var(--green-text);border:1px solid var(--green-bd)}
.pill-occ  {background:var(--red-bg);color:var(--red);border:1px solid var(--red-bd)}
.room-name{font-family:var(--fh);font-size:1.05rem;font-weight:800;color:var(--text);margin-bottom:4px}
.room-loc{display:flex;align-items:center;gap:5px;font-size:.77rem;color:var(--text-3);margin-bottom:14px}
.room-loc i{font-size:.65rem;color:var(--text-4)}
.room-meta{display:flex;margin-bottom:14px}
.meta-chip{display:flex;align-items:center;gap:5px;font-size:.76rem;font-weight:500;color:var(--text-3);background:var(--bg);border:1px solid var(--border);padding:5px 10px}
.meta-chip:first-child{border-radius:var(--r-xs) 0 0 var(--r-xs);border-right:none}
.meta-chip:last-child {border-radius:0 var(--r-xs) var(--r-xs) 0}
.meta-chip i{font-size:.65rem;color:var(--text-4)}
.meta-chip.tg{background:var(--green-bg);color:var(--green-text);border-color:var(--green-bd);font-weight:600}
.meta-chip.tg i{color:var(--green)}
.meta-chip.tr{background:var(--red-bg);color:var(--red);border-color:var(--red-bd);font-weight:600}
.meta-chip.tr i{color:var(--red)}
.am-label{font-size:.67rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text-4);margin-bottom:7px}
.am-row{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:16px}
.am-chip{display:inline-flex;align-items:center;gap:4px;background:var(--bg);border:1px solid var(--border);border-radius:var(--r-xs);padding:3px 9px;font-size:.72rem;color:var(--text-3);font-weight:500}
.card-actions{display:flex;gap:8px;margin-top:auto}
.btn-map,.btn-res{flex:1;padding:10px;border-radius:var(--r-sm);font-size:.8rem;font-weight:700;font-family:var(--fb);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .15s}
.btn-map{background:var(--bg);color:var(--text-2);border:1.5px solid var(--border)}
.btn-map:hover{background:#e8ecfb;color:var(--accent2);border-color:#c7d2fe}
.btn-map.off{color:var(--text-4);cursor:default}
.btn-map.off:hover{background:var(--bg);color:var(--text-4);border-color:var(--border)}
.btn-res.on{background:var(--accent);color:#fff;box-shadow:0 2px 8px rgba(26,43,109,.22)}
.btn-res.on:hover{background:var(--navy-mid);transform:translateY(-1px);box-shadow:0 4px 14px rgba(26,43,109,.3)}
.btn-res.off{background:var(--bg);color:var(--text-4);cursor:not-allowed;border:1.5px solid var(--border)}

/* ── ANIMATIONS ── */
@keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
.page-header      {animation:fadeUp .35s both .02s}
.search-filter-row{animation:fadeUp .35s both .07s}
.map-card         {animation:fadeUp .35s both .12s}
.rooms-header     {animation:fadeUp .35s both .17s}
.rooms-grid       {animation:fadeUp .35s both .22s}

@media(max-width:1200px){.rooms-grid{grid-template-columns:1fr}}
@media(max-width:900px){.content{padding:20px 18px 40px}}
@media(max-width:768px){:root{--sidebar-w:0px}.sidebar{display:none}}
</style>
</head>
<body>

<!-- ═══ SIDEBAR — DO NOT CHANGE ═══ -->
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
      <div class="user-avatar">ES</div>
      <div class="user-widget-info">
        <div class="user-widget-name">Prof. Elena Santos</div>
        <div class="user-widget-role">Faculty of IT</div>
      </div>
    </div>
    <form method="POST" action="<?= htmlspecialchars(url('/logout')) ?>">
      <?php csrf_field(); ?>
      <button type="submit" class="sidebar-logout-btn">
        <i class="fas fa-arrow-right-from-bracket"></i> Sign Out
      </button>
    </form>
  </div>
</div>

<!-- ═══ MAIN ═══ -->
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
        <div>
          <div class="topbar-profile-name">Prof. Elena Santos</div>
          <div class="topbar-profile-role">Faculty of IT</div>
        </div>
        <div class="topbar-avatar">
          <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Prof. Elena Santos">
        </div>
        <div class="profile-dropdown">
          <div class="profile-dropdown-item">
            <span class="profile-dropdown-icon"><i class="fas fa-envelope"></i></span>
            <div>
              <div class="profile-dropdown-label">Email</div>
              <div class="profile-dropdown-value">elena.santos@university.edu</div>
            </div>
          </div>
          <div class="profile-dropdown-item">
            <span class="profile-dropdown-icon"><i class="fas fa-briefcase"></i></span>
            <div>
              <div class="profile-dropdown-label">Position</div>
              <div class="profile-dropdown-value">Faculty of IT</div>
            </div>
          </div>
          <form method="POST" action="<?= htmlspecialchars(url('/logout')) ?>">
            <?php csrf_field(); ?>
            <button type="submit" class="profile-signout-btn">
              <i class="fas fa-arrow-right-from-bracket"></i> Sign Out
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- Page Header -->
    <div class="page-header">
      <div>
        <div class="page-title">Room Availability</div>
        <div class="page-sub">Real-time overview of PSU SmartRoom availability across all buildings.</div>
      </div>
      <div class="header-actions">
        <button class="btn-outline"><i class="fas fa-sliders"></i> Filter</button>
        <button class="btn-primary"><i class="fas fa-file-export"></i> Export PDF</button>
      </div>
    </div>

    <!-- Search + Filter -->
    <form method="GET" action="">
      <div class="search-filter-row">
        <div class="search-wrap">
          <i class="fas fa-magnifying-glass"></i>
          <input type="text" name="search" placeholder="Search by room name or building…" value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="sf-divider"></div>
        <span class="filter-label"><i class="fas fa-filter"></i>&nbsp; Show:</span>
        <div class="filter-pills">
          <a href="?filter=all&search=<?= urlencode($search) ?>"       class="filter-btn <?= $filter==='all'       ? 'active':'' ?>">All Rooms</a>
          <a href="?filter=available&search=<?= urlencode($search) ?>" class="filter-btn <?= $filter==='available' ? 'active':'' ?>">Available</a>
          <a href="?filter=occupied&search=<?= urlencode($search) ?>"  class="filter-btn <?= $filter==='occupied'  ? 'active':'' ?>">Occupied</a>
        </div>
      </div>
    </form>

    <!-- Campus Map -->
    <div class="map-card">
      <div class="map-card-header">
        <div class="map-title-group">
          <div class="map-icon"><i class="fas fa-map"></i></div>
          <div>
            <div class="map-title">Campus Map</div>
            <div class="map-sub">PSU Assingan Campus Layout</div>
          </div>
        </div>
        <span class="live-badge"><span class="live-dot"></span> Live</span>
      </div>
      <div class="map-grid">
        <div class="map-cell">
          <div class="building-pin">
            <div class="pin-box avail"><i class="fas fa-building"></i><span class="pin-num g">3</span></div>
            <span class="building-lbl">IT Building</span>
          </div>
        </div>
        <div class="map-cell">
          <div class="building-pin">
            <div class="pin-box full"><i class="fas fa-building"></i><span class="pin-num r">0</span></div>
            <span class="building-lbl">Engineering Building</span>
          </div>
        </div>
        <div class="map-cell">
          <div class="building-pin">
            <div class="pin-box avail"><i class="fas fa-building-columns"></i><span class="pin-num g">1</span></div>
            <span class="building-lbl">Admin Building</span>
          </div>
        </div>
        <div class="map-cell"></div>
        <div class="map-north">N</div>
        <div class="map-legend">
          <div class="legend-row"><div class="legend-dot" style="background:#22c55e"></div> Has Available Rooms</div>
          <div class="legend-row"><div class="legend-dot" style="background:#dc2626"></div> All Rooms Occupied</div>
          <div class="legend-row"><div class="legend-dot" style="background:#f5c518"></div> Selected Room</div>
        </div>
      </div>
    </div>

    <!-- Rooms Header -->
    <div class="rooms-header">
      <div class="rooms-section-title">Classrooms &amp; Labs</div>
      <span class="rooms-count-badge"><?= count($filtered_rooms) ?> rooms found</span>
    </div>

    <!-- Rooms Grid -->
    <div class="rooms-grid">
      <?php foreach ($filtered_rooms as $room):
        $a = $room['status'] === 'available';
        $pillCls  = $a ? 'pill-avail' : 'pill-occ';
        $pillIcon = $a ? 'fas fa-circle-check' : 'fas fa-circle-xmark';
        $pillLbl  = $a ? 'Available' : 'Occupied';
        $tCls     = $a ? 'tg' : 'tr';
      ?>
      <div class="room-card">
        <div class="card-strip">
          <span class="room-id">ID · <?= $room['id'] ?></span>
          <span class="status-pill <?= $pillCls ?>"><i class="<?= $pillIcon ?>"></i> <?= $pillLbl ?></span>
        </div>
        <div class="room-name"><?= htmlspecialchars($room['name']) ?></div>
        <div class="room-loc">
          <i class="fas fa-location-dot"></i>
          <?= htmlspecialchars($room['building']) ?> &bull; <?= htmlspecialchars($room['floor']) ?>
        </div>
        <div class="room-meta">
          <div class="meta-chip"><i class="fas fa-users"></i> <?= $room['seats'] ?> seats</div>
          <div class="meta-chip <?= $tCls ?>"><i class="fas fa-clock"></i> <?= htmlspecialchars($room['time_info']) ?></div>
        </div>
        <div class="am-label">Amenities</div>
        <div class="am-row">
          <?php foreach ($room['amenities'] as $am): ?>
          <span class="am-chip"><?= amenity_icon($am) ?> <?= htmlspecialchars($am) ?></span>
          <?php endforeach; ?>
        </div>
        <div class="card-actions">
          <button class="btn-map <?= $a ? '' : 'off' ?>">
            <i class="fas fa-location-dot"></i> Show on Map
          </button>
          <button class="btn-res <?= $a ? 'on' : 'off' ?>" <?= $a ? '' : 'disabled' ?>>
            <i class="fas fa-calendar-plus"></i> Reserve
          </button>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<script>
document.addEventListener('DOMContentLoaded', function () {
  function closeAll() {
    document.querySelectorAll('.profile-dropdown').forEach(el => el.classList.remove('is-open'));
  }
  document.querySelectorAll('.topbar-profile').forEach(function (profile) {
    var dd = profile.querySelector('.profile-dropdown');
    if (!dd) return;
    profile.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = dd.classList.contains('is-open');
      closeAll();
      if (!open) dd.classList.add('is-open');
    });
  });
  document.addEventListener('click', closeAll);
});
</script>
</body>
</html>