<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — BlogVista</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:       #0f172a;
            --ink-soft:  #475569;
            --ink-muted: #94a3b8;
            --surface:   #ffffff;
            --surface-2: #f8fafc;
            --surface-3: #f1f5f9;
            --border:    #e2e8f0;
            --accent:    #dc2626;
            --accent-hover: #b91c1c;
            --accent-soft: #fef2f2;
            --sidebar-bg: #0f172a;
            --sidebar-w:  240px;
            --topbar-h:   60px;
            --radius:     10px;
            --shadow-sm:  0 1px 3px rgba(0,0,0,.08);
            --shadow:     0 4px 16px rgba(0,0,0,.08);
            --font: 'DM Sans', system-ui, sans-serif;
        }

        body { font-family: var(--font); background: var(--surface-2); color: var(--ink); -webkit-font-smoothing: antialiased; }

        /* ── Sidebar ─────────────────────────── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 50;
            transition: transform .25s;
        }

        .sidebar-header {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-logo {
            width: 34px; height: 34px;
            background: var(--accent);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .sidebar-logo svg { color: #fff; }

        .sidebar-brand { font-size: 1.05rem; font-weight: 700; color: #f1f5f9; }
        .sidebar-brand span { color: #fca5a5; }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

        .nav-section-label {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #475569;
            padding: 12px 10px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            color: #94a3b8;
            font-size: .85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all .15s;
            margin-bottom: 2px;
        }

        .nav-item:hover { background: rgba(255,255,255,.06); color: #f1f5f9; }
        .nav-item.active { background: rgba(220,38,38,.2); color: #fca5a5; }
        .nav-item.active svg { color: #f87171; }

        .nav-item svg { flex-shrink: 0; opacity: .7; }
        .nav-item:hover svg, .nav-item.active svg { opacity: 1; }

        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: #fff;
            font-size: .68rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 30px;
        }

        .sidebar-footer {
            padding: 14px 12px;
            border-top: 1px solid rgba(255,255,255,.07);
        }

        /* ── Topbar ──────────────────────────── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            z-index: 40;
            justify-content: space-between;
            gap: 16px;
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        .topbar-title {
            font-size: .9rem;
            font-weight: 600;
            color: var(--ink);
        }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--surface-3);
            border-radius: 10px;
            padding: 7px 14px;
        }

        .user-avatar {
            width: 30px; height: 30px;
            background: var(--accent);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
        }

        .user-name { font-size: .825rem; font-weight: 600; color: var(--ink); }

        /* ── Main content ────────────────────── */
        .admin-main {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
        }

        .page-content { padding: 28px; }

        /* ── Page header ─────────────────────── */
        .page-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 14px;
        }

        .page-title {
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--ink);
        }

        .page-subtitle { font-size: .85rem; color: var(--ink-soft); margin-top: 3px; }

        /* ── Cards ───────────────────────────── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            gap: 14px;
            flex-wrap: wrap;
        }

        .card-header-title {
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
        }

        .card-body { padding: 22px; }

        /* ── Stat cards ──────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 22px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
        }

        .stat-icon {
            width: 42px; height: 42px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 14px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-label { font-size: .8rem; color: var(--ink-soft); font-weight: 500; }

        /* ── Table ───────────────────────────── */
        .admin-table { width: 100%; border-collapse: collapse; font-size: .85rem; }
        .admin-table th {
            background: var(--surface-2);
            color: var(--ink-soft);
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 11px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        .admin-table td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--surface-3);
            vertical-align: middle;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: var(--surface-2); }

        /* ── Buttons ─────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px;
            border-radius: 8px;
            font-family: var(--font);
            font-size: .85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all .16s;
        }

        .btn-sm { padding: 6px 13px; font-size: .8rem; }
        .btn-xs { padding: 4px 10px; font-size: .77rem; border-radius: 6px; }

        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-hover); }

        .btn-secondary { background: var(--surface-3); color: var(--ink); border: 1px solid var(--border); }
        .btn-secondary:hover { background: var(--border); }

        .btn-success { background: #d1fae5; color: #065f46; }
        .btn-success:hover { background: #a7f3d0; }

        .btn-warning { background: #fef3c7; color: #92400e; }
        .btn-warning:hover { background: #fde68a; }

        .btn-danger { background: #fee2e2; color: #991b1b; }
        .btn-danger:hover { background: #fca5a5; color: #7f1d1d; }

        .btn-outline { background: transparent; color: var(--ink-soft); border: 1.5px solid var(--border); }
        .btn-outline:hover { border-color: var(--ink-soft); color: var(--ink); }

        /* ── Forms ───────────────────────────── */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block;
            font-size: .825rem;
            font-weight: 600;
            color: var(--ink-soft);
            margin-bottom: 7px;
        }

        .form-label span { color: var(--accent); }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: var(--font);
            font-size: .875rem;
            color: var(--ink);
            background: var(--surface);
            outline: none;
            transition: border-color .15s;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(220,38,38,.08);
        }

        textarea.form-control { resize: vertical; min-height: 120px; }

        .form-hint { font-size: .77rem; color: var(--ink-muted); margin-top: 5px; }

        .form-error { font-size: .8rem; color: var(--accent); margin-top: 5px; font-weight: 500; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        /* ── Toggle switch ───────────────────── */
        .toggle-wrap { display: flex; align-items: center; gap: 12px; }
        .toggle { position: relative; display: inline-block; width: 44px; height: 24px; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; inset: 0;
            background: var(--border);
            border-radius: 30px;
            cursor: pointer;
            transition: .2s;
        }
        .toggle-slider::before {
            content: '';
            position: absolute;
            height: 18px; width: 18px;
            left: 3px; bottom: 3px;
            background: #fff;
            border-radius: 50%;
            transition: .2s;
        }
        .toggle input:checked + .toggle-slider { background: #059669; }
        .toggle input:checked + .toggle-slider::before { transform: translateX(20px); }

        /* ── Flash alerts ────────────────────── */
        .flash {
            padding: 13px 18px;
            border-radius: 10px;
            font-size: .875rem;
            font-weight: 500;
            margin-bottom: 22px;
            display: flex; align-items: center; gap: 10px;
        }
        .flash-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .flash-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        /* ── Badge ───────────────────────────── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px;
            border-radius: 30px;
            font-size: .75rem;
            font-weight: 600;
        }
        .status-published { background: #d1fae5; color: #065f46; }
        .status-draft      { background: #fef3c7; color: #92400e; }

        /* ── Image preview ───────────────────── */
        .img-preview-wrap {
            width: 100%;
            max-width: 280px;
            height: 160px;
            border: 2px dashed var(--border);
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ink-muted);
            background: var(--surface-2);
            cursor: pointer;
            transition: border-color .15s;
            margin-top: 10px;
        }
        .img-preview-wrap:hover { border-color: var(--accent); }
        .img-preview-wrap img { width: 100%; height: 100%; object-fit: cover; }

        /* ── Responsive ──────────────────────── */
        @media (max-width: 900px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .form-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .topbar, .admin-main { left: 0; margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .page-content { padding: 18px; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="admin-sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
        <div class="sidebar-brand">Blog<span>Vista</span> <span style="font-size:.7rem; opacity:.5; font-weight:400;">Admin</span></div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>

        <div class="nav-section-label" style="margin-top:8px;">Blog Management</div>
        <a href="{{ route('admin.blogs.index') }}" class="nav-item {{ request()->routeIs('admin.blogs.index') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            All Blogs
        </a>
        <a href="{{ route('admin.blogs.create') }}" class="nav-item {{ request()->routeIs('admin.blogs.create') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
            Add New Blog
        </a>

        <div class="nav-section-label" style="margin-top:8px;">Other</div>
        <a href="{{ route('home') }}" target="_blank" class="nav-item">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            View Website
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-item" style="width:100%; border:none; cursor:pointer; background:none; text-align:left;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>

<!-- Topbar -->
<header class="topbar">
    <div class="topbar-left">
        <button id="sidebar-toggle" style="display:none; background:none; border:none; cursor:pointer; padding:4px; color:var(--ink);">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
        </button>
        <nav style="display:flex; align-items:center; gap:6px; font-size:.8rem; color:var(--ink-muted);">
            <a href="{{ route('admin.dashboard') }}" style="color:var(--ink-soft); text-decoration:none; font-weight:500;">Admin</a>
            @yield('breadcrumb')
        </nav>
    </div>
    <div class="topbar-right">
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
            New Blog
        </a>
        <div class="topbar-user">
            <div class="user-avatar">{{ substr(Auth::guard('admin')->user()->name, 0, 1) }}</div>
            <span class="user-name">{{ Auth::guard('admin')->user()->name }}</span>
        </div>
    </div>
</header>

<!-- Main -->
<main class="admin-main">
    <div class="page-content">

        @if(session('success'))
        <div class="flash flash-success">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="flash flash-error">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/></svg>
            {{ session('error') }}
        </div>
        @endif

        @yield('admin-content')
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
// Mobile sidebar toggle
$('#sidebar-toggle').on('click', function() {
    $('#admin-sidebar').toggleClass('open');
});

$(window).on('resize', function() {
    if ($(window).width() <= 768) {
        $('#sidebar-toggle').show();
    } else {
        $('#sidebar-toggle').hide();
        $('#admin-sidebar').removeClass('open');
    }
}).trigger('resize');

// Image preview
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Confirm delete
function confirmDelete(formId) {
    if (confirm('Are you sure you want to delete this blog post? This action cannot be undone.')) {
        document.getElementById(formId).submit();
    }
}
</script>

@stack('scripts')
</body>
</html>