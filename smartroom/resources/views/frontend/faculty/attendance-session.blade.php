<?php
$facultyName     = $facultyName     ?? request()->user()?->name ?? 'Faculty';
$facultyDept     = $facultyDept     ?? request()->user()?->department ?? 'Faculty';
$facultyEmail    = $facultyEmail    ?? request()->user()?->email ?? '';
$facultyInitials = $facultyInitials ?? strtoupper(substr((string) $facultyName, 0, 1));

$session = $session ?? [];
$records = $records ?? collect([]);
$stats   = $stats   ?? ['total'=>0,'present'=>0,'absent'=>0,'excused'=>0,'rate'=>0];

$isOpen  = ($session['status'] ?? '') === 'open';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $session['course_code'] ?? 'Session' }} – Attendance · SmartDoor</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
/* (styles omitted here for brevity - same styles as provided) */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
/* Keep full stylesheet from original template */
:root { --yellow: #f5c518; --navy: #0b1640; --bg: #f0f2f8; --font-head: 'Plus Jakarta Sans', sans-serif; --font-body: 'DM Sans', sans-serif; --sidebar-w: 230px; }
body { font-family: var(--font-body); background: var(--bg); color: #0f1729; min-height: 100vh; display: flex; -webkit-font-smoothing: antialiased; }
/* (rest of styles preserved) */
</style>
</head>
<body>

<!-- SIDEBAR -->
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
    <li><a href="{{ url('/faculty_dashboard') }}" class="{{ Request::is('faculty_dashboard') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-chart-line"></i></span>Dashboard</a></li>
    <li><a href="{{ url('/rooms') }}" class="{{ Request::is('rooms*') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-door-open"></i></span>Rooms</a></li>
    <li><a href="{{ url('/faculty-schedule') }}" class="{{ Request::is('faculty-schedule') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-clock"></i></span>Schedule</a></li>
    <li><a href="{{ url('/attendance') }}" class="active"><span class="nav-icon"><i class="fas fa-clipboard-check"></i></span>Attendance</a></li>
  </ul>
  <span class="nav-section-label">Tools</span>
  <ul class="sidebar-nav">
    <li><a href="{{ url('/ai-recommendations') }}" class="{{ Request::is('ai-recommendations') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-robot"></i></span>AI Recommendations</a></li>
    <li><a href="{{ url('/reports') }}" class="{{ Request::is('reports*') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-chart-bar"></i></span>Reports</a></li>
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

<!-- MAIN -->
<main class="main">

  <!-- TOPBAR -->
  <header class="topbar">
    <a href="{{ route('faculty.attendance') }}" class="back-btn">
      <i class="fas fa-arrow-left"></i> Attendance
    </a>
    <div class="topbar-divider"></div>
    <div class="topbar-info">
      <div class="topbar-title">{{ $session['course_code'] ?? 'Session' }} — {{ $session['date_short'] ?? '' }}</div>
      <div class="topbar-sub">{{ $session['course_title'] ?? '' }}{{ ($session['room'] ?? '') ? ' · ' . $session['room'] : '' }}</div>
    </div>
    <div class="topbar-right">
      <a href="{{ route('faculty.attendance.export', $session['id']) }}" class="btn btn-outline btn-sm">
        <i class="fas fa-file-csv"></i> Export CSV
      </a>
      @if($isOpen)
      <button class="btn btn-danger btn-sm" id="closeSessionBtn">
        <i class="fas fa-lock"></i> Close Session
      </button>
      @endif
      <div class="topbar-avatar">{{ $facultyInitials }}</div>
    </div>
  </header>

  <div class="content">
    <!-- (content identical to template provided: session card, stats, roster, save bar, modal, toasts) -->
    @include('frontend.faculty._attendance-session-content', ['session' => $session, 'records' => $records, 'stats' => $stats])
  </div>

</main>

<!-- CLOSE SESSION MODAL -->
<div class="modal-overlay" id="closeSessionOverlay">
  <div class="modal" role="dialog" aria-modal="true">
    <div class="modal-header">
      <div>
        <div class="modal-title">Close Attendance Session?</div>
        <div class="modal-sub">Once closed, no further edits can be made.</div>
      </div>
      <button class="modal-close-btn" id="closeModalDismiss"><i class="fas fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <p>Make sure all student attendance is recorded before closing. The session will be locked and marked as <strong>Closed</strong>.</p>
      <p style="margin-top:10px;color:var(--text-3);font-size:.81rem">You can still view and export records after closing.</p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline btn-sm" id="cancelCloseBtn">Cancel</button>
      <button class="btn btn-danger btn-sm" id="confirmCloseBtn">
        <i class="fas fa-lock"></i> Close Session
      </button>
    </div>
  </div>
</div>

<div class="toast-container" id="toastContainer"></div>

<script>
const SESSION_ID = {{ json_encode($session['id'] ?? '') }};
const IS_OPEN    = {{ $isOpen ? 'true' : 'false' }};
const CSRF       = document.querySelector('meta[name="csrf-token"]').content;
const SAVE_URL   = {!! json_encode(route('faculty.attendance.record.bulk', ['id' => $session['id'] ?? ''])) !!};
const CLOSE_URL  = {!! json_encode(route('faculty.attendance.close', ['id' => $session['id'] ?? ''])) !!};

// Tracks each row's current status value
const statuses = {};
let rowCount = 0;

// ── Bootstrap existing rows from PHP ──────────────────────────
document.querySelectorAll('.roster-row').forEach(row => {
  const i = parseInt(row.dataset.index);
  rowCount = Math.max(rowCount, i + 1);
  const activeBtn = row.querySelector('.status-btn.active');
  statuses[i] = activeBtn ? activeBtn.dataset.status : 'present';
});

// ── Set status on a row ────────────────────────────────────────
function setStatus(i, val) {
  if (!IS_OPEN) return;
  statuses[i] = val;
  const sel = document.getElementById('status-sel-' + i);
  if (!sel) return;
  sel.querySelectorAll('.status-btn').forEach(b => b.classList.remove('active'));
  const btn = sel.querySelector('[data-status="' + val + '"]');
  if (btn) btn.classList.add('active');
  updatePills();
}

// ── Mark all rows ──────────────────────────────────────────────
function markAll(val) {
  if (!IS_OPEN) return;
  document.querySelectorAll('.roster-row').forEach(row => {
    setStatus(parseInt(row.dataset.index), val);
  });
}

// ── Update avatar initial ──────────────────────────────────────
function updateAvatar(i) {
  const name = (document.getElementById('name-' + i)?.value || '').trim();
  const av = document.getElementById('av-' + i);
  if (av) av.textContent = name ? name[0].toUpperCase() : '?';
}

// ── Add a new student row ──────────────────────────────────────
function addRow() {
  document.getElementById('emptyRow')?.remove();

  const i = rowCount++;
  statuses[i] = 'present';
  const now = new Date();
  const hh  = String(now.getHours()).padStart(2, '0');
  const mm  = String(now.getMinutes()).padStart(2, '0');

  const tr = document.createElement('tr');
  tr.className = 'roster-row';
  tr.dataset.index = i;
  tr.innerHTML = `
    <td style="color:var(--text-4);font-size:.78rem;font-weight:600" class="row-num"></td>
    <td>
      <div class="student-cell">
        <div class="student-avatar" id="av-${i}">?</div>
        <div style="flex:1;min-width:0">
          <input class="student-name-input" id="name-${i}" type="text" placeholder="Student name…"
                 autocomplete="off" oninput="updateAvatar(${i})">
          <input class="student-id-input" id="sid-${i}" type="text" placeholder="Student ID…">
        </div>
      </div>
    </td>
    <td>
      <div class="status-selector" id="status-sel-${i}">
        <button type="button" class="status-btn active" data-status="present" onclick="setStatus(${i},'present')">Present</button>
        <button type="button" class="status-btn"        data-status="absent"  onclick="setStatus(${i},'absent')">Absent</button>
        <button type="button" class="status-btn"        data-status="late"    onclick="setStatus(${i},'late')">Late</button>
        <button type="button" class="status-btn"        data-status="excused" onclick="setStatus(${i},'excused')">Excused</button>
      </div>
    </td>
    <td><input type="time" class="time-in-input" id="timein-${i}" value="${hh}:${mm}"></td>
    <td><input type="text" class="remarks-input" id="rmk-${i}" placeholder="Optional…"></td>
    <td><button class="row-del-btn" onclick="deleteRow(${i})" title="Remove"><i class="fas fa-trash-can"></i></button></td>
  `;
  document.getElementById('rosterBody').appendChild(tr);
  document.getElementById('name-' + i).focus();
  renumberRows();
  updatePills();
}

// ── Delete a row ───────────────────────────────────────────────
function deleteRow(i) {
  document.querySelector('.roster-row[data-index="' + i + '"]')?.remove();
  delete statuses[i];
  renumberRows();
  updatePills();
  if (!document.querySelector('.roster-row')) {
    const tr = document.createElement('tr');
    tr.id = 'emptyRow';
    tr.innerHTML = `<td colspan="6">
      <div class="empty-state">
        <div class="empty-icon"><i class="fas fa-user-graduate"></i></div>
        <div class="empty-text">No students yet</div>
        <div class="empty-sub">Click "Add Student" to start taking attendance.</div>
        <button class="btn btn-primary btn-sm" style="margin-top:6px" onclick="addRow()"><i class="fas fa-plus"></i> Add Student</button>
      </div></td>`;
    document.getElementById('rosterBody').appendChild(tr);
  }
}

// ── Re-number row index column ─────────────────────────────────
function renumberRows() {
  document.querySelectorAll('.roster-row').forEach((r, idx) => {
    const numCell = r.querySelector('.row-num');
    if (numCell) numCell.textContent = idx + 1;
    else r.cells[0].textContent = idx + 1;
  });
}

// ── Live search ───────────────────────────────────────────────
document.getElementById('rosterSearch')?.addEventListener('input', function () {
  const q = this.value.toLowerCase();
  document.querySelectorAll('.roster-row').forEach(row => {
    const i = row.dataset.index;
    const name = (document.getElementById('name-' + i)?.value || '').toLowerCase();
    row.style.display = name.includes(q) ? '' : 'none';
  });
});

// ── Update stat pills live ─────────────────────────────────────
function updatePills() {
  const rows = document.querySelectorAll('.roster-row');
  const total = rows.length;
  let present = 0, absent = 0, late = 0, excused = 0;
  rows.forEach(row => {
    const s = statuses[parseInt(row.dataset.index)] || 'present';
    if (s === 'present') present++;
    else if (s === 'absent') absent++;
    else if (s === 'late') late++;
    else if (s === 'excused') excused++;
  });
  const attending = present + late;
  const rate = total > 0 ? Math.round((attending / total) * 100) : 0;

  const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
  const setW = (id, pct) => { const el = document.getElementById(id); if (el) el.style.width = pct + '%'; };

  set('pill-present', present);
  set('pill-absent', absent);
  set('pill-late', late);
  set('pill-excused', excused);
  set('pill-rate', rate + '%');
  if (total > 0) {
    setW('bar-present', Math.round((present / total) * 100));
    setW('bar-absent',  Math.round((absent  / total) * 100));
    setW('bar-late',    Math.round((late    / total) * 100));
    setW('bar-excused', Math.round((excused / total) * 100));
    setW('bar-rate', rate);
  }
}

// ── Save attendance records via AJAX ──────────────────────────
async function saveRecords() {
  const rows    = document.querySelectorAll('.roster-row');
  const records = [];
  let hasError  = false;

  rows.forEach(row => {
    const i    = parseInt(row.dataset.index);
    const name = (document.getElementById('name-' + i)?.value || '').trim();
    if (!name) { hasError = true; return; }
    records.push({
      student_name:      name,
      student_id_number: (document.getElementById('sid-' + i)?.value    || '').trim(),
      status:             statuses[i] || 'present',
      time_in:            document.getElementById('timein-' + i)?.value || '',
      remarks:           (document.getElementById('rmk-'   + i)?.value  || '').trim(),
    });
  });

  if (hasError) { showToast('Please fill in all student names before saving.', 'error'); return; }

  const saveBtn = document.getElementById('saveBtn');
  const saveStatus = document.getElementById('saveStatus');
  if (saveBtn) { saveBtn.disabled = true; saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving…'; }

  try {
    const res  = await fetch(SAVE_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
      body: JSON.stringify({ records }),
    });
    const data = await res.json();
    if (res.ok && data.success) {
      showToast('Attendance saved successfully!', 'success');
      if (saveStatus) saveStatus.innerHTML = 'Last saved at <strong>' + new Date().toLocaleTimeString() + '</strong>';
    } else {
      showToast(data.message || 'Failed to save. Please try again.', 'error');
    }
  } catch {
    showToast('Network error. Please check your connection.', 'error');
  } finally {
    if (saveBtn) { saveBtn.disabled = false; saveBtn.innerHTML = '<i class="fas fa-floppy-disk"></i> Save Attendance'; }
  }
}

// ── Close-session modal (guarded to avoid duplicate initialization) ──
if (!window.__attendance_close_modal_initialized) {
  window.__attendance_close_modal_initialized = true;
  (function(){
    const closeOverlay    = document.getElementById('closeSessionOverlay');
    const closeSessionBtn = document.getElementById('closeSessionBtn');
    const closeModalDismiss = document.getElementById('closeModalDismiss');
    const cancelCloseBtn  = document.getElementById('cancelCloseBtn');
    const confirmCloseBtn = document.getElementById('confirmCloseBtn');

    function openCloseModal()  { closeOverlay?.classList.add('is-open');    document.body.style.overflow = 'hidden'; }
    function closeCloseModal() { closeOverlay?.classList.remove('is-open'); document.body.style.overflow = ''; }

    closeSessionBtn?.addEventListener('click', openCloseModal);
    closeModalDismiss?.addEventListener('click', closeCloseModal);
    cancelCloseBtn?.addEventListener('click', closeCloseModal);
    closeOverlay?.addEventListener('click', e => { if (e.target === closeOverlay) closeCloseModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCloseModal(); });
  })();
}

confirmCloseBtn?.addEventListener('click', async () => {
  if (!SESSION_ID) return showToast('Missing session ID.', 'error');
  confirmCloseBtn.disabled = true;
  confirmCloseBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Closing…';

  await saveRecords(); // save first, then close

  try {
    const res  = await fetch(CLOSE_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
    });
    const data = await res.json();
    if (res.ok && data.success) {
      showToast('Session closed. Redirecting…', 'success');
      setTimeout(() => window.location.href = '/attendance', 1400);
    } else {
      showToast(data.message || 'Could not close session.', 'error');
      confirmCloseBtn.disabled = false;
      confirmCloseBtn.innerHTML = '<i class="fas fa-lock"></i> Close Session';
    }
  } catch {
    showToast('Network error.', 'error');
    confirmCloseBtn.disabled = false;
    confirmCloseBtn.innerHTML = '<i class="fas fa-lock"></i> Close Session';
  }
});

// ── Toast helper ───────────────────────────────────────────────
function showToast(message, type = 'success') {
  const c = document.getElementById('toastContainer');
  if (!c) return;
  const t = document.createElement('div');
  t.className = 'toast ' + type;
  t.innerHTML = `<div class="toast-icon"><i class="fas fa-${type === 'success' ? 'circle-check' : 'circle-exclamation'}"></i></div><span>${message}</span>`;
  c.appendChild(t);
  requestAnimationFrame(() => t.classList.add('is-visible'));
  setTimeout(() => { t.classList.remove('is-visible'); setTimeout(() => t.remove(), 300); }, 3500);
}

// ── Flash toasts from server ───────────────────────────────────
@if(session('success'))
showToast("{{ session('success') }}", 'success');
@endif
@if(session('error'))
showToast("{{ session('error') }}", 'error');
@endif

// ── Auto-save every 90s ───────────────────────────────────────
@if($isOpen)
setInterval(saveRecords, 90000);
@endif
</script>
</body>
</html>

