@extends('layouts.public')

@section('title', 'All Blogs — BlogVista')
@section('meta_desc', 'Browse all exam updates, admit cards, results, job alerts and more.')

@push('styles')
<style>
/* ── Page Header ──────────────────────── */
.page-header {
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
    padding: 44px 0 40px;
}

.page-header-title {
    font-family: var(--font-display);
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 8px;
}

.page-header-title span { color: var(--accent); }

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .825rem;
    color: var(--ink-muted);
}

.breadcrumb a { color: var(--ink-soft); text-decoration: none; }
.breadcrumb a:hover { color: var(--ink); }

/* ── Filter Bar ───────────────────────── */
.filter-bar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 20px 24px;
    margin: 32px 0;
    box-shadow: var(--shadow-sm);
}

.filter-row {
    display: flex;
    gap: 14px;
    align-items: flex-end;
    flex-wrap: wrap;
}

.filter-group {
    flex: 1;
    min-width: 160px;
}

.filter-group label {
    display: block;
    font-size: .78rem;
    font-weight: 600;
    color: var(--ink-soft);
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 7px;
}

.filter-input,
.filter-select,
.filter-date {
    width: 100%;
    padding: 9px 14px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: var(--font-body);
    font-size: .875rem;
    color: var(--ink);
    background: var(--surface);
    outline: none;
    transition: border-color .15s;
}

.filter-input:focus,
.filter-select:focus,
.filter-date:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(220,38,38,.08);
}

.filter-search-wrap {
    position: relative;
}

.filter-search-wrap svg {
    position: absolute;
    left: 11px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ink-muted);
    pointer-events: none;
}

.filter-search-wrap .filter-input { padding-left: 38px; }

.btn-filter-reset {
    padding: 9px 18px;
    border-radius: 8px;
    background: var(--surface-3);
    border: 1.5px solid var(--border);
    font-size: .875rem;
    font-weight: 500;
    color: var(--ink-soft);
    cursor: pointer;
    white-space: nowrap;
    transition: all .15s;
    font-family: var(--font-body);
}

.btn-filter-reset:hover { background: var(--border); color: var(--ink); }

/* ── Results bar ──────────────────────── */
.results-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 10px;
}

.results-count {
    font-size: .875rem;
    color: var(--ink-soft);
}

.results-count strong { color: var(--ink); }

/* ── Loading spinner ──────────────────── */
.loading-overlay {
    display: none;
    position: relative;
    min-height: 200px;
}

.loading-overlay.active { display: block; }

.spinner-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 80px 0;
    gap: 16px;
}

.spinner {
    width: 38px; height: 38px;
    border: 3px solid var(--border);
    border-top-color: var(--accent);
    border-radius: 50%;
    animation: spin .75s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

/* ── Empty state ──────────────────────── */
.empty-state {
    text-align: center;
    padding: 80px 24px;
    color: var(--ink-soft);
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 16px;
}

.empty-state h3 {
    font-family: var(--font-display);
    font-size: 1.4rem;
    color: var(--ink);
    margin-bottom: 8px;
}

.empty-state p { font-size: .9rem; max-width: 320px; margin: 0 auto; }

/* ── Pagination ───────────────────────── */
.pagination-wrap {
    display: flex;
    justify-content: center;
    margin-top: 48px;
}

.pagination-wrap nav { display: flex; }

/* ── Layout ───────────────────────────── */
.blogs-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 36px;
    align-items: start;
}

.sidebar {
    position: sticky;
    top: calc(var(--nav-h) + 20px);
}

.sidebar-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 20px;
}

.sidebar-title {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
}

.sidebar-cat-list { list-style: none; }

.sidebar-cat-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 9px 0;
    border-bottom: 1px solid var(--surface-3);
}

.sidebar-cat-list li:last-child { border-bottom: none; }

.sidebar-cat-link {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    color: var(--ink-soft);
    font-size: .875rem;
    font-weight: 500;
    transition: color .15s;
}

.sidebar-cat-link:hover { color: var(--accent); }
.sidebar-cat-link .dot-cat { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

.sidebar-count {
    font-size: .75rem;
    background: var(--surface-3);
    color: var(--ink-muted);
    padding: 2px 9px;
    border-radius: 30px;
    font-weight: 600;
}

@media (max-width: 900px) {
    .blogs-layout { grid-template-columns: 1fr; }
    .sidebar { position: static; }
}

@media (max-width: 600px) {
    .filter-row { flex-direction: column; }
    .filter-group { min-width: 100%; }
}
</style>
@endpush

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="breadcrumb" style="margin-bottom:10px;">
            <a href="{{ route('home') }}">Home</a>
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
            <span>Blogs</span>
        </div>
        <h1 class="page-header-title">All <span>Blog Posts</span></h1>
        <p style="color:var(--ink-soft); font-size:.925rem; margin-top:6px;">
            Discover the latest exam news, admit cards, results, and job alerts.
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="container py-section">

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="filter-row">
            <!-- Search -->
            <div class="filter-group" style="flex:2; min-width:200px;">
                <label for="filter-search">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;margin-right:4px;"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    Search
                </label>
                <div class="filter-search-wrap">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <input type="text" id="filter-search" class="filter-input" placeholder="Search blogs, topics..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Category -->
            <div class="filter-group">
                <label for="filter-category">Category</label>
                <select id="filter-category" class="filter-select">
                    <option value="all">All Categories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Date -->
            <div class="filter-group">
                <label for="filter-date">Date</label>
                <input type="date" id="filter-date" class="filter-date" value="{{ request('date') }}">
            </div>

            <!-- Reset -->
            <div>
                <button id="filter-reset" class="btn-filter-reset">
                    ↺ Reset
                </button>
            </div>
        </div>
    </div>

    <div class="blogs-layout">
        <!-- Main Content Area -->
        <div>
            <!-- Results bar -->
            <div class="results-bar">
                <p class="results-count">
                    Showing <strong id="results-count">{{ $blogs->total() }}</strong> posts
                </p>
            </div>

            <!-- Blog Cards area (replaced by AJAX) -->
            <div id="blogs-container">
                @include('public.blog-cards', ['blogs' => $blogs])
            </div>

            <!-- Loading -->
            <div id="loading-state" style="display:none;">
                <div class="spinner-wrap">
                    <div class="spinner"></div>
                    <span style="font-size:.875rem; color:var(--ink-muted);">Fetching results…</span>
                </div>
            </div>

            <!-- Pagination -->
            <div id="pagination-wrap" class="pagination-wrap">
                {{ $blogs->links('public.pagination') }}
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-card">
                <div class="sidebar-title">Categories</div>
                <ul class="sidebar-cat-list">
                    <li>
                        <a href="#" class="sidebar-cat-link cat-filter-link" data-id="all">
                            <span class="dot-cat" style="background:#94a3b8;"></span>
                            All Categories
                        </a>
                        <span class="sidebar-count">{{ $blogs->total() }}</span>
                    </li>
                    @foreach($categories as $cat)
                    <li>
                        <a href="#" class="sidebar-cat-link cat-filter-link" data-id="{{ $cat->id }}">
                            <span class="dot-cat" style="background:{{ $cat->color }};"></span>
                            {{ $cat->name }}
                        </a>
                        <span class="sidebar-count">{{ $cat->blogs->where('is_published', true)->count() }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-card">
                <div class="sidebar-title">Quick Filters</div>
                <div style="display:flex; flex-direction:column; gap:8px;">
                    <button class="btn btn-outline btn-sm" onclick="filterToday()">📅 Today's Posts</button>
                    <button class="btn btn-outline btn-sm" onclick="filterThisMonth()">📆 This Month</button>
                    <button class="btn btn-outline btn-sm" id="reset-all-btn">🔄 Clear Filters</button>
                </div>
            </div>
        </aside>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
    let debounceTimer;
    const AJAX_URL = '{{ route("blogs.index") }}';

    function runFilter(page) {
        const search   = $('#filter-search').val().trim();
        const category = $('#filter-category').val();
        const date     = $('#filter-date').val();

        $('#blogs-container').hide();
        $('#pagination-wrap').hide();
        $('#loading-state').show();

        $.ajax({
            url: AJAX_URL,
            method: 'GET',
            data: { search, category, date, page: page || 1 },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (res) {
                $('#loading-state').hide();
                $('#blogs-container').html(res.html).show();
                $('#pagination-wrap').html(res.pagination).show();
                $('#results-count').text(res.total);
                // Rebind pagination clicks
                bindPagination();
            },
            error: function () {
                $('#loading-state').hide();
                $('#blogs-container').html('<div class="empty-state"><div class="empty-icon">⚠️</div><h3>Something went wrong</h3><p>Please try again in a moment.</p></div>').show();
            }
        });
    }

    // Debounced search
    $('#filter-search').on('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => runFilter(), 380);
    });

    // Instant select/date filters
    $('#filter-category, #filter-date').on('change', function () {
        runFilter();
    });

    // Reset
    $('#filter-reset, #reset-all-btn').on('click', function () {
        $('#filter-search').val('');
        $('#filter-category').val('all');
        $('#filter-date').val('');
        runFilter();
    });

    // Sidebar category links
    $(document).on('click', '.cat-filter-link', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        $('#filter-category').val(id);
        runFilter();
    });

    // Pagination clicks (delegated)
    function bindPagination() {
        $('#pagination-wrap').find('a').off('click').on('click', function (e) {
            e.preventDefault();
            const url = new URL($(this).attr('href'));
            const page = url.searchParams.get('page') || 1;
            runFilter(page);
            $('html, body').animate({ scrollTop: $('.filter-bar').offset().top - 80 }, 300);
        });
    }

    bindPagination();

    // On load — if URL has params, trigger filter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('category') && urlParams.get('category') !== '') {
        $('#filter-category').val(urlParams.get('category'));
        runFilter();
    }
});

function filterToday() {
    const today = new Date().toISOString().split('T')[0];
    $('#filter-date').val(today);
    $('#filter-date').trigger('change');
}

function filterThisMonth() {
    // We set date to first day of current month — backend can handle range; here just set and go
    const now = new Date();
    const firstDay = new Date(now.getFullYear(), now.getMonth(), 1).toISOString().split('T')[0];
    $('#filter-date').val(firstDay);
    $('#filter-date').trigger('change');
}
</script>
@endpush