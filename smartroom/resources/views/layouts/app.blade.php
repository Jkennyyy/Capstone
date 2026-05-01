<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'SmartRoom') – SmartRoom</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3H59N9lWKQCaYMx50uDF08MkCsBPSP3E2McJ6+8WcGXflyZ2Zy1H56ZWDr8ZGhnPJ+9WMwQvvN4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/classroom-detail.css') }}" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #f5c518;
            --primary-light: #fde97a;
            --primary-dark: #d4a10a;
            --blue: #112060;
            --blue-light: #1a2f80;
            --green: #16a34a;
            --gray: #5a6785;
            --gray-light: #eef2ff;
            --gray-lighter: #f4f7ff;
            --white: #ffffff;
            --border: #dbe3f5;
            --text: #0b1640;
            --text-secondary: #5a6785;
            --red: #ef4444;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-lighter);
            color: var(--text);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--text) 0%, var(--blue) 100%);
            border-right: 1px solid rgba(245, 197, 24, 0.18);
            display: flex;
            flex-direction: column;
            padding: 24px 0;
            overflow-y: auto;
            z-index: 10;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            box-shadow: 1px 0 8px rgba(0, 0, 0, 0.25), 2px 0 20px rgba(0, 0, 0, 0.2);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 3px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
            margin-bottom: 40px;
            text-decoration: none;
            color: var(--white);
            cursor: pointer;
            transition: all 0.3s;
        }

        .sidebar-logo-img {
            width: 36px;
            height: 36px;
            display: block;
            object-fit: contain;
            object-position: center;
            flex-shrink: 0;
        }

        .sidebar-logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
            color: var(--white);
        }

        .sidebar-logo-text .brand-psu {
            font-size: 0.56rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            color: rgba(255, 255, 255, 0.72);
            margin-left: 2px;
            margin-bottom: 2px;
            text-transform: uppercase;
        }

        .sidebar-logo-text .brand-main {
            font-weight: 700;
            font-size: 0.98rem;
            letter-spacing: -0.01em;
            color: var(--white);
        }

        .sidebar-logo-text .door-accent {
            color: var(--primary);
        }

        .sidebar-nav {
            flex: 1;
            list-style: none;
        }

        .sidebar-nav li {
            margin: 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.78);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.9rem;
            font-weight: 500;
            position: relative;
        }

        .sidebar-nav a:hover {
            color: var(--primary-light);
            background: rgba(255, 255, 255, 0.06);
        }

        .sidebar-nav a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary);
            opacity: 0;
        }

        .sidebar-nav a.active {
            color: var(--primary);
            background: rgba(245, 197, 24, 0.16);
        }

        .sidebar-nav a.active::before {
            opacity: 1;
        }

        .sidebar-logout {
            border-top: 1px solid rgba(245, 197, 24, 0.2);
            padding-top: 16px;
            padding-bottom: 16px;
            margin: 16px 0 0 0;
        }

        .sidebar-logout a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.78);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sidebar-logout a:hover {
            color: var(--primary-light);
            background: rgba(255, 255, 255, 0.06);
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            flex: 1;
            margin-left: 260px;
            overflow-y: auto;
            background: var(--gray-lighter);
            padding: 32px;
            z-index: 1;
        }

        .main-content::-webkit-scrollbar {
            width: 8px;
        }

        .main-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .main-content::-webkit-scrollbar-thumb {
            background: #d0d0d0;
            border-radius: 4px;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
            background: var(--white);
            padding: 24px 28px;
            border-radius: 12px;
            border: 1px solid rgba(229, 231, 235, 0.6);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        /* Notification dropdown */
        .notif-dropdown { position: relative; }
        .notif-panel { position: absolute; right: 0; top: 44px; width: 320px; background: var(--white); border: 1px solid var(--border); border-radius: 8px; box-shadow: 0 6px 30px rgba(11,22,64,0.12); display: none; z-index: 1200; max-height: 480px; overflow: auto; }
        .notif-panel.is-open { display: block; }
        .notif-item { padding: 12px; border-bottom: 1px solid var(--gray-light); font-size: 0.9rem; cursor: pointer; }
        .notif-item.unread { background: linear-gradient(90deg, rgba(245,197,24,0.04), transparent); }
        .notif-item:last-child { border-bottom: none; }
        .notif-item h4 { font-size: 0.9rem; margin-bottom: 4px; }

        /* Notification modal */
        .notif-modal { position: fixed; left: 0; top: 0; right: 0; bottom: 0; display: none; align-items: center; justify-content: center; background: rgba(11,22,64,0.4); z-index: 1300; }
        .notif-modal.is-open { display: flex; }
        .notif-modal .modal-content { width: 520px; background: var(--white); border-radius: 10px; padding: 20px; box-shadow: 0 8px 40px rgba(11,22,64,0.18); }
        .notif-modal .modal-header { display:flex;justify-content:space-between;align-items:center;margin-bottom:12px }
        .notif-modal .modal-body { color: var(--text-secondary); font-size: 0.95rem; line-height:1.5 }
        .notif-modal .close-btn { background:none;border:0;font-size:1.1rem;cursor:pointer;color:var(--text-secondary) }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text);
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .filter-tabs {
            display: flex;
            gap: 8px;
        }

        .filter-tab {
            padding: 8px 16px;
            border-radius: 8px;
            background: transparent;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        .filter-icon-btn {
            background: var(--white);
            border: 1px solid rgba(229, 231, 235, 0.6);
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        /* ── ROOM GRID ── */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .room-card {
            background: var(--white);
            border: 1px solid rgba(229, 231, 235, 0.6);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 0 rgba(255, 255, 255, 0.5);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .room-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .room-location {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .room-status {
            display: inline-flex;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-available {
            background: rgba(39, 174, 96, 0.1);
            color: var(--green);
        }

        .status-occupied {
            background: rgba(26, 47, 128, 0.12);
            color: var(--blue-light);
        }

        .status-reserved {
            background: rgba(245, 197, 24, 0.14);
            color: var(--primary);
        }

        .card-body {
            padding: 20px;
            flex: 1;
        }

        .room-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
        }

        .info-label {
            color: var(--text-secondary);
        }

        .info-value {
            font-weight: 600;
            color: var(--text);
        }

        .room-class {
            padding: 12px;
            border-radius: 8px;
            background: var(--gray-light);
            font-size: 0.85rem;
        }

        .class-title {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 4px;
        }

        .class-time {
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1200px) {
            .room-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -260px;
                transition: left 0.3s;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                gap: 16px;
                align-items: stretch;
            }

            .filter-bar {
                flex-direction: column;
            }

            .room-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="#" class="sidebar-logo">
                <img src="{{ asset('images/logo.png') }}" alt="PSU SmartDoor Logo" class="sidebar-logo-img">
                <div class="sidebar-logo-text">
                    <span class="brand-psu">PSU</span>
                    <span class="brand-main">Smart<span class="door-accent">Door</span></span>
                </div>
            </a>

            <ul class="sidebar-nav">
                <li><a href="/dashboard" class="{{ Request::is('dashboard') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="/classrooms" class="{{ Request::is('classrooms*') ? 'active' : '' }}"><i class="fas fa-school"></i> Classrooms</a></li>
                <li><a href="/schedule" class="{{ Request::is('schedule*') ? 'active' : '' }}"><i class="fas fa-calendar"></i> Schedule</a></li>
                <li><a href="/smartlocking" class="{{ Request::is('smartlocking*') ? 'active' : '' }}"><i class="fas fa-lock"></i> SmartLocking</a></li>
                <!-- AI Recommendations removed from sidebar -->
                <li><a href="/attendance" class="{{ Request::is('attendance*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Attendance</a></li>
                <!-- Reports link removed from sidebar -->
            </ul>

            <div class="sidebar-logout">
                <form method="POST" action="/logout" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;padding:0;color:inherit;font:inherit;cursor:pointer;display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-sign-out-alt"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;margin-bottom:12px;">
                <div class="notif-dropdown">
                    <button class="filter-icon-btn notif-btn" id="notifBtn" title="Notifications">
                        <i class="fas fa-bell"></i>
                        <span id="notifBadge" class="notif-badge" style="display:none;"></span>
                    </button>
                    <div id="notifPanel" class="notif-panel" aria-hidden="true"></div>
                        <div id="notifModal" class="notif-modal" aria-hidden="true">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <strong id="notifModalTitle">Notification</strong>
                                    <button id="notifModalClose" class="close-btn">×</button>
                                </div>
                                <div class="modal-body">
                                    <div id="notifModalBody"></div>
                                    <pre id="notifModalData" style="background:#f6f8ff;padding:8px;margin-top:12px;border-radius:6px;display:none;white-space:pre-wrap;font-size:0.85rem;color:var(--text-secondary)"></pre>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>

    <script>
        // Current user id for realtime subscriptions
        var CURRENT_USER_ID = {{ auth()->check() ? auth()->id() : 'null' }};
        // Pusher realtime setup (optional if env configured)
        (function () {
            try {
                var pusherKey = '{{ env('PUSHER_APP_KEY') }}';
                var pusherCluster = '{{ env('PUSHER_APP_CLUSTER') }}';
                if (pusherKey) {
                    var script = document.createElement('script');
                    script.src = 'https://js.pusher.com/7.2/pusher.min.js';
                    script.onload = function () {
                        try {
                            var pusher = new Pusher(pusherKey, { cluster: pusherCluster || undefined, forceTLS: true });
                            pusher.subscribe('notifications').bind('notification.created', function (data) {
                                // prepend incoming announcement
                                lastItems.unshift(data);
                                // cap to 50
                                lastItems = lastItems.slice(0,50);
                                renderNotifications(lastItems);
                            });
                            if (CURRENT_USER_ID) {
                                pusher.subscribe('notifications.user.' + CURRENT_USER_ID).bind('notification.created', function (data) {
                                    lastItems.unshift(data);
                                    lastItems = lastItems.slice(0,50);
                                    renderNotifications(lastItems);
                                });
                            }
                        } catch (e) {
                            console.error('Realtime init error', e);
                        }
                    };
                    document.head.appendChild(script);
                }
            } catch (e) {
                // ignore
            }
        })();

        // Active nav link
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });

        // Notifications polling and mark-read hookup
        (function () {
            var pollInterval = 15000;
            var notifBtn = document.getElementById('notifBtn');
            var notifBadge = document.getElementById('notifBadge');
            var notifPanel = document.getElementById('notifPanel');
            var open = false;
            var lastItems = [];

            async function fetchNotifications() {
                try {
                    var res = await fetch('/api/v1/notifications', { credentials: 'same-origin', headers: { 'Accept': 'application/json' } });
                    if (!res.ok) return;
                    var payload = await res.json().catch(()=>({}));
                    var items = Array.isArray(payload.data) ? payload.data : [];
                    lastItems = items;
                    renderNotifications(items);
                } catch (e) {
                    console.error('Failed to fetch notifications', e);
                }
            }

            function renderNotifications(items) {
                if (!notifPanel) return;
                if (!items || items.length === 0) {
                    notifPanel.innerHTML = '<div class="notif-item">No notifications</div>';
                    notifBadge.style.display = 'none';
                    return;
                }

                var header = '<div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;border-bottom:1px solid var(--gray-light);font-size:0.85rem;">'
                    + '<span style="color:var(--text-secondary);font-weight:600;">Notifications</span>'
                    + '<button id="markAllBtn" style="background:none;border:0;color:var(--blue);cursor:pointer;padding:4px 8px;border-radius:6px">Mark all read</button>'
                    + '</div>';

                var list = items.map(function (it) {
                    var title = String(it.title || 'Notification');
                    var body = String(it.body || '');
                    var time = it.created_at ? new Date(it.created_at).toLocaleString() : '';
                    var unreadClass = it.read_at ? '' : ' unread';
                    return '<div class="notif-item' + unreadClass + '" data-id="' + (it.id || '') + '">' 
                        + '<h4>' + escapeHtml(title) + '</h4>'
                        + '<div style="color:var(--text-secondary);font-size:0.85rem;">' + escapeHtml(body) + '</div>'
                        + '<div style="margin-top:6px;font-size:0.75rem;color:var(--text-secondary);">' + escapeHtml(time) + '</div>'
                        + '</div>';
                }).join('');
                notifPanel.innerHTML = header + list;

                // show badge for unread count
                var unreadCount = items.filter(function (i) { return !i.read_at; }).length;
                notifBadge.style.display = unreadCount ? '' : 'none';
                notifBadge.textContent = unreadCount > 9 ? '9+' : String(unreadCount);

                // hook mark all button
                var markAllBtn = document.getElementById('markAllBtn');
                if (markAllBtn) {
                    markAllBtn.addEventListener('click', function () {
                        fetch('/api/v1/notifications/read-all', { method: 'PATCH', credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
                            .then(function (r) { if (!r.ok) throw r; return r.json(); })
                            .then(function () { lastItems.forEach(function (it) { it.read_at = new Date().toISOString(); }); renderNotifications(lastItems); })
                            .catch(function (e) { console.error('Failed to mark all read', e); });
                    });
                }
            }

            function escapeHtml(value) {
                return String(value || '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            async function markAsRead(id) {
                if (!id) return;
                try {
                    var res = await fetch('/api/v1/notifications/' + encodeURIComponent(id) + '/read', { method: 'PATCH', credentials: 'same-origin', headers: { 'Accept': 'application/json' } });
                    if (!res.ok) return;
                    var payload = await res.json().catch(()=>({}));
                    // update local copy
                    var it = lastItems.find(function (x) { return String(x.id) === String(id); });
                    if (it) {
                        it.read_at = payload.data?.read_at || new Date().toISOString();
                        renderNotifications(lastItems);
                    }
                } catch (e) {
                    console.error('Failed to mark notification read', e);
                }
            }

            notifBtn?.addEventListener('click', function () {
                open = !open;
                if (open) {
                    notifPanel.classList.add('is-open');
                    notifPanel.setAttribute('aria-hidden', 'false');
                    // mark unread items as read when opening the panel
                    var unread = lastItems.filter(function (i) { return !i.read_at; });
                    unread.forEach(function (u) { markAsRead(u.id); });
                } else {
                    notifPanel.classList.remove('is-open');
                    notifPanel.setAttribute('aria-hidden', 'true');
                }
            });

            // click handler to mark single item read and open detail view
            var notifModal = document.getElementById('notifModal');
            var notifModalTitle = document.getElementById('notifModalTitle');
            var notifModalBody = document.getElementById('notifModalBody');
            var notifModalData = document.getElementById('notifModalData');
            var notifModalClose = document.getElementById('notifModalClose');

            function showNotificationDetail(item) {
                if (!item) return;
                notifModalTitle.textContent = item.title || 'Notification';
                notifModalBody.textContent = item.body || '';
                if (item.data) {
                    try {
                        notifModalData.style.display = '';
                        notifModalData.textContent = JSON.stringify(item.data, null, 2);
                    } catch (e) {
                        notifModalData.style.display = 'none';
                    }
                } else {
                    notifModalData.style.display = 'none';
                }
                notifModal.classList.add('is-open');
                notifModal.setAttribute('aria-hidden', 'false');
            }

            function closeNotificationDetail() {
                notifModal.classList.remove('is-open');
                notifModal.setAttribute('aria-hidden', 'true');
            }

            notifModalClose?.addEventListener('click', closeNotificationDetail);
            notifModal?.addEventListener('click', function (ev) {
                if (ev.target === notifModal) closeNotificationDetail();
            });

            notifPanel?.addEventListener('click', function (ev) {
                var el = ev.target;
                while (el && !el.classList?.contains('notif-item')) el = el.parentElement;
                if (!el) return;
                var id = el.getAttribute('data-id');
                if (!id) return;

                var item = lastItems.find(function (x) { return String(x.id) === String(id); });
                // mark read then show details
                markAsRead(id).finally(function () {
                    showNotificationDetail(item);
                });
            });

            // initial fetch + polling
            fetchNotifications();
            setInterval(fetchNotifications, pollInterval);
        })();
    </script>
</body>
</html>
