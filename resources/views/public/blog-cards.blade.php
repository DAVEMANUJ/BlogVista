@if($blogs->count() > 0)
<div class="blog-grid">
    @foreach($blogs as $blog)
    <article class="blog-card">
        <div class="card-image-wrap">
            <a href="{{ route('blogs.show', $blog->slug) }}">
                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" loading="lazy">
            </a>
            <div class="card-badge">
                <span class="badge" style="background:{{ $blog->category->color }}22; color:{{ $blog->category->color }}; border:1px solid {{ $blog->category->color }}44;">
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
                <a href="{{ route('blogs.show', $blog->slug) }}" style="color:inherit;text-decoration:none;transition:color .15s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='inherit'">
                    {{ $blog->title }}
                </a>
            </h3>
            <p class="card-desc">{{ $blog->short_description }}</p>
            <div class="card-footer">
                <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more">
                    Read More
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <span style="font-size:.775rem; color:var(--ink-muted);">
                    #{{ $blog->id }}
                </span>
            </div>
        </div>
    </article>
    @endforeach
</div>
@else
<div class="empty-state">
    <div class="empty-icon">🔍</div>
    <h3>No results found</h3>
    <p>Try adjusting your search or filters to find what you're looking for.</p>
    <button onclick="$('#filter-reset').click()" class="btn btn-outline" style="margin-top:20px;">Clear Filters</button>
</div>
@endif