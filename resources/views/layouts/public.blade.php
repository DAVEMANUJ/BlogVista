<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BlogVista') — Stay Informed</title>
    <meta name="description" content="@yield('meta_desc', 'BlogVista — Your trusted source for exam news, admit cards, results, job alerts and more.')">

    <!-- Google Fonts: Playfair Display + DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

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
            --accent-soft: #fef2f2;
            --accent-hover: #b91c1c;
            --green:     #059669;
            --blue:      #2563eb;
            --amber:     #d97706;
            --purple:    #7c3aed;
            --teal:      #0891b2;
            --radius:    10px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.05);
            --shadow:    0 4px 16px rgba(0,0,0,.08), 0 2px 6px rgba(0,0,0,.04);
            --shadow-lg: 0 10px 40px rgba(0,0,0,.10), 0 4px 12px rgba(0,0,0,.06);
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', system-ui, sans-serif;
            --nav-h:        68px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            color: var(--ink);
            background: var(--surface);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Navbar ─────────────────────────────── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            height: var(--nav-h);
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
        }

        .nav-inner {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            background: var(--accent);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon svg { color: #fff; }

        .brand-name {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -.01em;
        }

        .brand-name span { color: var(--accent); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
        }

        .nav-links a {
            font-size: .875rem;
            font-weight: 500;
            color: var(--ink-soft);
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 8px;
            transition: background .15s, color .15s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: var(--surface-3);
            color: var(--ink);
        }

        .nav-cta {
            background: var(--accent) !important;
            color: #fff !important;
            font-weight: 600 !important;
        }

        .nav-cta:hover { background: var(--accent-hover) !important; }

        .nav-hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            color: var(--ink);
        }

        .nav-mobile {
            display: none;
            position: absolute;
            top: var(--nav-h);
            left: 0;
            right: 0;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 12px 24px 20px;
            flex-direction: column;
            gap: 4px;
        }

        .nav-mobile.open { display: flex; }
        .nav-mobile a { display: block; padding: 10px 14px; color: var(--ink); text-decoration: none; font-weight: 500; border-radius: 8px; }
        .nav-mobile a:hover { background: var(--surface-3); }

        /* ── Container ──────────────────────────── */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ── Buttons ────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all .18s;
        }

        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-hover); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(220,38,38,.3); }

        .btn-outline { background: transparent; color: var(--ink); border: 1.5px solid var(--border); }
        .btn-outline:hover { border-color: var(--ink); background: var(--surface-3); }

        .btn-sm { padding: 7px 16px; font-size: .8125rem; }

        /* ── Category Badge ─────────────────────── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 11px;
            border-radius: 30px;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .02em;
            text-transform: uppercase;
        }

        /* ── Blog Card ──────────────────────────── */
        .blog-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            transition: box-shadow .22s, transform .22s;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
        }

        .card-image-wrap {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .card-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }

        .blog-card:hover .card-image-wrap img { transform: scale(1.04); }

        .card-badge {
            position: absolute;
            top: 12px;
            left: 12px;
        }

        .card-body {
            padding: 20px 22px 24px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .78rem;
            color: var(--ink-muted);
            margin-bottom: 10px;
        }

        .card-meta .dot { width: 3px; height: 3px; background: var(--border); border-radius: 50%; }

        .card-title {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.45;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-desc {
            font-size: .875rem;
            color: var(--ink-soft);
            line-height: 1.65;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 18px;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: .825rem;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
            transition: gap .15s;
        }

        .read-more:hover { gap: 8px; }

        /* ── Grid ───────────────────────────────── */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        /* ── Section Heading ────────────────────── */
        .section-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 32px;
            gap: 16px;
        }

        .section-title {
            font-family: var(--font-display);
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.25;
        }

        .section-title span { color: var(--accent); }

        .section-sub {
            font-size: .9rem;
            color: var(--ink-soft);
            margin-top: 6px;
        }

        /* ── Flash messages ─────────────────────── */
        .flash {
            padding: 14px 20px;
            border-radius: 10px;
            font-size: .875rem;
            font-weight: 500;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flash-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .flash-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        /* ── Footer ─────────────────────────────── */
        .footer {
            background: var(--ink);
            color: #94a3b8;
            padding: 60px 0 30px;
            margin-top: 80px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-brand-name {
            font-family: var(--font-display);
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 12px;
        }

        .footer-brand-name span { color: var(--accent); }

        .footer h4 { font-size: .875rem; font-weight: 600; color: #e2e8f0; margin-bottom: 16px; text-transform: uppercase; letter-spacing: .05em; }

        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: #94a3b8; text-decoration: none; font-size: .875rem; transition: color .15s; }
        .footer-links a:hover { color: #fff; }

        .footer-bottom {
            border-top: 1px solid #1e293b;
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .8rem;
        }

        /* ── Utilities ──────────────────────────── */
        .text-muted { color: var(--ink-muted); }
        .mt-2 { margin-top: 8px; }
        .mb-4 { margin-bottom: 16px; }
        .py-section { padding: 64px 0; }

        /* ── Responsive ─────────────────────────── */
        @media (max-width: 1024px) {
            .blog-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .blog-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .nav-hamburger { display: flex; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
            .section-heading { flex-direction: column; align-items: flex-start; }
            .section-title { font-size: 1.5rem; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-brand">
            <div class="brand-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <span class="brand-name">Blog<span>Vista</span></span>
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('blogs.index') }}" class="{{ request()->routeIs('blogs.*') ? 'active' : '' }}">Blogs</a></li>
            <li><a href="{{ route('blogs.index') }}?category=" class="">Categories</a></li>
            <li><a href="{{ route('admin.login') }}" class="nav-cta">Admin Panel</a></li>
        </ul>

        <button class="nav-hamburger" id="hamburger" aria-label="Menu">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 12h18M3 6h18M3 18h18"/>
            </svg>
        </button>
    </div>

    <div class="nav-mobile" id="nav-mobile">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('blogs.index') }}">Blogs</a>
        <a href="{{ route('admin.login') }}">Admin Panel</a>
    </div>
</nav>

@if(session('success'))
    <div class="container" style="padding-top:16px;">
        <div class="flash flash-success">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    </div>
@endif

@yield('content')

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-name">Blog<span>Vista</span></div>
                <p style="font-size:.875rem; line-height:1.7; max-width:280px;">
                    Your trusted source for government exam updates, admit cards, results, job alerts, and educational news.
                </p>
            </div>
            <div>
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('blogs.index') }}">All Blogs</a></li>
                    <li><a href="{{ route('blogs.index') }}?category=1">Admit Cards</a></li>
                    <li><a href="{{ route('blogs.index') }}?category=2">Results</a></li>
                </ul>
            </div>
            <div>
                <h4>Categories</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('blogs.index') }}?category=3">Job Alerts</a></li>
                    <li><a href="{{ route('blogs.index') }}?category=4">Syllabus</a></li>
                    <li><a href="{{ route('blogs.index') }}?category=5">Answer Key</a></li>
                    <li><a href="{{ route('blogs.index') }}?category=6">Recruitment</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} BlogVista. All rights reserved.</span>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    // Mobile nav toggle
    $('#hamburger').on('click', function () {
        $('#nav-mobile').toggleClass('open');
    });
</script>

@stack('scripts')
</body>
</html>