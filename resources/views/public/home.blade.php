@extends('layouts.public')

@section('title', 'BlogVista — Stay Informed')

@push('styles')
<style>
/* ── Hero ─────────────────────────────── */
.hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%);
    position: relative;
    overflow: hidden;
    padding: 80px 0 90px;
}

.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 80% at 70% 50%, rgba(220,38,38,.12) 0%, transparent 70%);
    pointer-events: none;
}

.hero-dots {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 30px 30px;
    pointer-events: none;
}

.hero-inner {
    position: relative;
    z-index: 1;
    max-width: 760px;
}

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(220,38,38,.15);
    border: 1px solid rgba(220,38,38,.3);
    color: #fca5a5;
    font-size: .78rem;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 30px;
    margin-bottom: 24px;
}

.hero-label .pulse {
    width: 7px; height: 7px;
    background: #ef4444;
    border-radius: 50%;
    animation: pulse 1.8s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.4); opacity: .6; }
}

.hero-title {
    font-family: var(--font-display);
    font-size: clamp(2.2rem, 5vw, 3.4rem);
    font-weight: 700;
    color: #f8fafc;
    line-height: 1.18;
    margin-bottom: 20px;
    letter-spacing: -.02em;
}

.hero-title em {
    color: var(--accent);
    font-style: italic;
}

.hero-sub {
    font-size: 1.05rem;
    color: #94a3b8;
    line-height: 1.7;
    max-width: 560px;
    margin-bottom: 36px;
}

.hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }

.hero-stats {
    display: flex;
    gap: 40px;
    margin-top: 56px;
    padding-top: 40px;
    border-top: 1px solid rgba(255,255,255,.08);
}

.stat-num {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: #f1f5f9;
    line-height: 1;
}

.stat-num span { color: var(--accent); }
.stat-label { font-size: .8rem; color: #64748b; margin-top: 4px; text-transform: uppercase; letter-spacing: .06em; }

/* ── Featured Section ─────────────────── */
.featured-section {
    padding: 72px 0;
}

/* ── Categories Strip ─────────────────── */
.categories-section {
    background: var(--surface-2);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    padding: 48px 0;
}

.cat-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 16px;
}

.cat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px 16px;
    text-align: center;
    text-decoration: none;
    transition: all .2s;
    position: relative;
    overflow: hidden;
}

.cat-card::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    opacity: 0;
    transition: opacity .2s;
}

.cat-card:hover {
    box-shadow: var(--shadow);
    transform: translateY(-2px);
}

.cat-card:hover::before { opacity: 1; }

.cat-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 1.2rem;
}

.cat-name {
    font-size: .825rem;
    font-weight: 600;
    color: var(--ink);
    display: block;
    margin-bottom: 4px;
}

.cat-count {
    font-size: .75rem;
    color: var(--ink-muted);
}

@media (max-width: 1024px) { .cat-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 640px)  { .cat-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px)  { .hero-stats { flex-wrap: wrap; gap: 24px; } }
</style>
@endpush

@section('content')

<!-- Hero -->
<section class="hero">
    <div class="hero-dots"></div>
    <div class="container">
        <div class="hero-inner">
            <div class="hero-label">
                <span class="pulse"></span>
                Live Updates
            </div>
            <h1 class="hero-title">
                Every Exam Update,<br>
                <em>Right When You Need It</em>
            </h1>
            <p class="hero-sub">
                Stay ahead with the latest admit cards, results, job alerts, syllabi, and recruitment notifications — all in one trusted place.
            </p>
            <div class="hero-actions">
                <a href="{{ route('blogs.index') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Browse All Blogs
                </a>
                <a href="{{ route('blogs.index') }}?category=3" class="btn btn-outline" style="color:#e2e8f0; border-color:rgba(255,255,255,.2); background:rgba(255,255,255,.05);">
                    Latest Job Alerts
                </a>
            </div>

            <div class="hero-stats">
                <div>
                    <div class="stat-num">{{ $totalBlogs }}<span>+</span></div>
                    <div class="stat-label">Articles</div>
                </div>
                <div>
                    <div class="stat-num">6<span>+</span></div>
                    <div class="stat-label">Categories</div>
                </div>
                <div>
                    <div class="stat-num">Daily</div>
                    <div class="stat-label">Updates</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="categories-section">
    <div class="container">
        <div class="section-heading" style="margin-bottom:28px;">
            <div>
                <h2 class="section-title" style="font-size:1.5rem;">Browse by <span>Category</span></h2>
            </div>
            <a href="{{ route('blogs.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>

        <div class="cat-grid">
            @php
            $icons  = ['📄','🏆','💼','📚','🔑','🎖️'];
            $colors = ['#eff6ff','#f0fdf4','#fffbeb','#faf5ff','#fef2f2','#ecfeff'];
            $accent = ['#2563eb','#059669','#d97706','#7c3aed','#dc2626','#0891b2'];
            $border = ['#2563eb','#059669','#d97706','#7c3aed','#dc2626','#0891b2'];
            @endphp

            @foreach($categories as $i => $cat)
            <a href="{{ route('blogs.index') }}?category={{ $cat->id }}" class="cat-card"
               style="--cat-color:{{ $accent[$i % 6] }};">
                <style>
                    .cat-card:nth-child({{ $loop->iteration }})::before { background: {{ $accent[$i % 6] }}; }
                </style>
                <div class="cat-icon" style="background:{{ $colors[$i % 6] }};">
                    {{ $icons[$i % 6] }}
                </div>
                <span class="cat-name">{{ $cat->name }}</span>
                <span class="cat-count">{{ $cat->blogs_count ?? $cat->blogs->count() }} posts</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest Blogs -->
<section class="featured-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <h2 class="section-title">Latest <span>Updates</span></h2>
                <p class="section-sub">Freshest articles from our editors</p>
            </div>
            <a href="{{ route('blogs.index') }}" class="btn btn-outline btn-sm">View All Posts →</a>
        </div>

        <div class="blog-grid">
            @foreach($featuredBlogs as $blog)
            <article class="blog-card">
                <div class="card-image-wrap">
                    <a href="{{ route('blogs.show', $blog->slug) }}">
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" loading="lazy">
                    </a>
                    <div class="card-badge">
                        <span class="badge" style="background:{{ $blog->category->color }}22; color:{{ $blog->category->color }};">
                            {{ $blog->category->name }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-meta">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') }}
                        <span class="dot"></span>
                        {{ $blog->reading_time }}
                    </div>
                    <h3 class="card-title">
                        <a href="{{ route('blogs.show', $blog->slug) }}" style="color:inherit;text-decoration:none;">
                            {{ $blog->title }}
                        </a>
                    </h3>
                    <p class="card-desc">{{ $blog->short_description }}</p>
                    <div class="card-footer">
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more">
                            Read Full Article
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div style="text-align:center; margin-top:48px;">
            <a href="{{ route('blogs.index') }}" class="btn btn-primary">
                View All Blog Posts
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

@endsection