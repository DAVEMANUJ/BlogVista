@extends('layouts.public')

@section('title', $blog->title . ' — BlogVista')
@section('meta_desc', $blog->short_description)

@push('styles')
<style>
/* ── Article Layout ───────────────────── */
.article-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 48px;
    padding: 48px 0 80px;
    align-items: start;
}

/* ── Hero Image ───────────────────────── */
.article-hero {
    margin: 0 0 36px;
    border-radius: 16px;
    overflow: hidden;
    max-height: 460px;
    box-shadow: var(--shadow-lg);
}

.article-hero img {
    width: 100%;
    height: 460px;
    object-fit: cover;
    display: block;
}

/* ── Article Meta ─────────────────────── */
.article-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 18px;
}

.article-meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: .825rem;
    color: var(--ink-muted);
}

/* ── Article Title ────────────────────── */
.article-title {
    font-family: var(--font-display);
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    font-weight: 700;
    color: var(--ink);
    line-height: 1.3;
    letter-spacing: -.015em;
    margin-bottom: 24px;
}

/* ── Short Description ────────────────── */
.article-intro {
    font-size: 1.05rem;
    color: var(--ink-soft);
    line-height: 1.75;
    padding: 20px 24px;
    border-left: 4px solid var(--accent);
    background: var(--accent-soft);
    border-radius: 0 10px 10px 0;
    margin-bottom: 32px;
    font-style: italic;
}

/* ── Article Content ──────────────────── */
.article-content {
    font-size: .975rem;
    line-height: 1.85;
    color: #334155;
}

.article-content h2,
.article-content h3 {
    font-family: var(--font-display);
    color: var(--ink);
    margin: 28px 0 14px;
    line-height: 1.35;
}

.article-content h2 { font-size: 1.5rem; }
.article-content h3 { font-size: 1.2rem; }

.article-content p { margin-bottom: 18px; }

.article-content ul,
.article-content ol {
    padding-left: 22px;
    margin-bottom: 18px;
}

.article-content li { margin-bottom: 8px; }

.article-content strong { color: var(--ink); font-weight: 600; }

.article-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 24px 0;
    font-size: .9rem;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid var(--border);
}

.article-content th,
.article-content td {
    padding: 11px 16px;
    border: 1px solid var(--border);
    text-align: left;
}

.article-content th {
    background: var(--surface-3);
    font-weight: 600;
    color: var(--ink);
    font-size: .825rem;
    text-transform: uppercase;
    letter-spacing: .04em;
}

.article-content tr:nth-child(even) td { background: var(--surface-2); }

/* ── Share strip ──────────────────────── */
.article-share {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 22px 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    margin: 36px 0;
    flex-wrap: wrap;
}

.share-label { font-size: .825rem; font-weight: 600; color: var(--ink-soft); }

.share-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border-radius: 8px;
    font-size: .8rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

/* ── Related blogs ────────────────────── */
.related-section {
    margin-top: 48px;
    padding-top: 32px;
    border-top: 2px solid var(--surface-3);
}

.related-title {
    font-family: var(--font-display);
    font-size: 1.25rem;
    color: var(--ink);
    margin-bottom: 20px;
    font-weight: 700;
}

/* ── Sidebar ──────────────────────────── */
.article-sidebar {
    position: sticky;
    top: calc(var(--nav-h) + 20px);
}

.sidebar-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 22px;
    margin-bottom: 20px;
}

.sidebar-card-title {
    font-family: var(--font-display);
    font-size: .975rem;
    font-weight: 700;
    color: var(--ink);
    padding-bottom: 14px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 16px;
}

.recent-item {
    display: flex;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--surface-3);
    text-decoration: none;
    transition: opacity .15s;
}

.recent-item:last-child { border-bottom: none; }
.recent-item:hover { opacity: .8; }

.recent-thumb {
    width: 60px;
    height: 55px;
    border-radius: 8px;
    object-fit: cover;
    flex-shrink: 0;
}

.recent-title {
    font-size: .825rem;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 4px;
}

.recent-date { font-size: .75rem; color: var(--ink-muted); }

@media (max-width: 900px) {
    .article-layout { grid-template-columns: 1fr; }
    .article-sidebar { position: static; }
}
</style>
@endpush

@section('content')

<div class="container">
    <!-- Breadcrumb -->
    <div style="padding: 20px 0 0;">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
            <a href="{{ route('blogs.index') }}">Blogs</a>
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
            <span>{{ Str::limit($blog->title, 45) }}</span>
        </div>
    </div>

    <div class="article-layout">
        <!-- Main Article -->
        <main>
            <!-- Hero Image -->
            <div class="article-hero">
                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
            </div>

            <!-- Meta -->
            <div class="article-meta">
                <span class="badge" style="background:{{ $blog->category->color }}22; color:{{ $blog->category->color }}; border:1px solid {{ $blog->category->color }}44;">
                    {{ $blog->category->name }}
                </span>
                <span class="article-meta-item">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ \Carbon\Carbon::parse($blog->published_at)->format('F d, Y') }}
                </span>
                <span class="article-meta-item">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ $blog->reading_time }}
                </span>
            </div>

            <!-- Title -->
            <h1 class="article-title">{{ $blog->title }}</h1>

            <!-- Short Description (intro quote) -->
            <div class="article-intro">
                {{ $blog->short_description }}
            </div>

            <!-- Full Content -->
            <div class="article-content">
                {!! $blog->content !!}
            </div>

            <!-- Share -->
            <div class="article-share">
                <span class="share-label">Share this post:</span>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}"
                   target="_blank" class="share-btn" style="background:#e7f5ff; color:#1d9bf0;">
                   𝕏 Twitter
                </a>
                <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}"
                   target="_blank" class="share-btn" style="background:#d1fae5; color:#059669;">
                   💬 WhatsApp
                </a>
                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!');"
                        class="share-btn" style="background:var(--surface-3); color:var(--ink-soft);">
                   🔗 Copy Link
                </button>
            </div>

            <!-- Back link -->
            <div style="margin-top: 8px;">
                <a href="{{ route('blogs.index') }}" class="btn btn-outline btn-sm">
                    ← Back to All Blogs
                </a>
            </div>

            <!-- Related Blogs -->
            @if($relatedBlogs->count() > 0)
            <div class="related-section">
                <h2 class="related-title">Related in {{ $blog->category->name }}</h2>
                <div class="blog-grid" style="grid-template-columns: repeat({{ min($relatedBlogs->count(), 3) }}, 1fr);">
                    @foreach($relatedBlogs as $related)
                    <article class="blog-card">
                        <div class="card-image-wrap" style="height:160px;">
                            <a href="{{ route('blogs.show', $related->slug) }}">
                                <img src="{{ $related->image_url }}" alt="{{ $related->title }}" loading="lazy">
                            </a>
                            <div class="card-badge">
                                <span class="badge" style="background:{{ $related->category->color }}22; color:{{ $related->category->color }};">
                                    {{ $related->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-meta">{{ \Carbon\Carbon::parse($related->published_at)->format('M d, Y') }}</div>
                            <h4 class="card-title" style="font-size:.975rem;">
                                <a href="{{ route('blogs.show', $related->slug) }}" style="color:inherit;text-decoration:none;">
                                    {{ $related->title }}
                                </a>
                            </h4>
                            <div class="card-footer">
                                <a href="{{ route('blogs.show', $related->slug) }}" class="read-more">
                                    Read More <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif
        </main>

        <!-- Sidebar -->
        <aside class="article-sidebar">
            <!-- Category badge -->
            <div class="sidebar-card" style="background:{{ $blog->category->color }}11; border-color:{{ $blog->category->color }}33;">
                <div style="font-size:.75rem; font-weight:700; color:{{ $blog->category->color }}; text-transform:uppercase; letter-spacing:.06em; margin-bottom:8px;">Category</div>
                <div style="font-family:var(--font-display); font-size:1.1rem; color:var(--ink); font-weight:700;">{{ $blog->category->name }}</div>
                <a href="{{ route('blogs.index') }}?category={{ $blog->category_id }}" style="font-size:.8rem; color:{{ $blog->category->color }}; text-decoration:none; font-weight:600; margin-top:8px; display:inline-block;">
                    View all posts →
                </a>
            </div>

            <!-- Recent Posts -->
            <div class="sidebar-card">
                <div class="sidebar-card-title">Recent Posts</div>
                @foreach($recentBlogs as $recent)
                <a href="{{ route('blogs.show', $recent->slug) }}" class="recent-item">
                    <img src="{{ $recent->image_url }}" class="recent-thumb" alt="{{ $recent->title }}" loading="lazy">
                    <div>
                        <div class="recent-title">{{ $recent->title }}</div>
                        <div class="recent-date">{{ \Carbon\Carbon::parse($recent->published_at)->format('M d, Y') }}</div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Browse by category sidebar -->
            <div class="sidebar-card">
                <div class="sidebar-card-title">Browse All Topics</div>
                <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-sm" style="width:100%; justify-content:center;">
                    🗂 All Blog Posts
                </a>
            </div>
        </aside>
    </div>
</div>

@endsection