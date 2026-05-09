@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <span style="color:var(--ink-muted);">/</span>
    <span style="color:var(--ink); font-weight:600;">Dashboard</span>
@endsection

@section('admin-content')

{{-- ── Stat Cards ──────────────────────────────────────── --}}
<div class="stats-grid" id="stats-grid">
    <div class="stat-card" style="--accent-bar:#dc2626;">
        <div class="stat-icon" style="background:#fee2e2;">
            <svg width="20" height="20" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div class="stat-number" id="stat-total">{{ $stats['blogs'] }}</div>
        <div class="stat-label">Total Blog Posts</div>
        <div style="margin-top:12px; font-size:.75rem; color:var(--ink-muted);">All posts in the system</div>
        <div style="position:absolute; bottom:0; left:0; right:0; height:3px; background:#dc2626; border-radius:0 0 12px 12px;"></div>
    </div>

    <div class="stat-card" style="border-top:3px solid #059669;">
        <div class="stat-icon" style="background:#d1fae5;">
            <svg width="20" height="20" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="stat-number" id="stat-published" style="color:#059669;">{{ $stats['published'] }}</div>
        <div class="stat-label">Published</div>
        <div style="margin-top:12px; font-size:.75rem; color:var(--ink-muted);">Live on the website</div>
        <div style="position:absolute; bottom:0; left:0; right:0; height:3px; background:#059669; border-radius:0 0 12px 12px;"></div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:#fef3c7;">
            <svg width="20" height="20" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24">
                <path d="M7 4V2m10 2V2M3 8h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/>
            </svg>
        </div>
        <div class="stat-number" id="stat-drafts" style="color:#d97706;">{{ $stats['blogs'] - $stats['published'] }}</div>
        <div class="stat-label">Drafts</div>
        <div style="margin-top:12px; font-size:.75rem; color:var(--ink-muted);">Unpublished posts</div>
        <div style="position:absolute; bottom:0; left:0; right:0; height:3px; background:#d97706; border-radius:0 0 12px 12px;"></div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:#ede9fe;">
            <svg width="20" height="20" fill="none" stroke="#7c3aed" stroke-width="2" viewBox="0 0 24 24">
                <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
        </div>
        <div class="stat-number" id="stat-categories" style="color:#7c3aed;">{{ $stats['categories'] }}</div>
        <div class="stat-label">Categories</div>
        <div style="margin-top:12px; font-size:.75rem; color:var(--ink-muted);">Blog categories</div>
        <div style="position:absolute; bottom:0; left:0; right:0; height:3px; background:#7c3aed; border-radius:0 0 12px 12px;"></div>
    </div>
</div>

{{-- ── Quick actions + recent blogs ──────────────────────────── --}}
<div style="display:grid; grid-template-columns:1fr 320px; gap:24px; align-items:start;">

    {{-- Recent Blogs Table --}}
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-header-title">Recent Blog Posts</div>
                <div style="font-size:.8rem; color:var(--ink-muted); margin-top:2px;">Latest 5 posts in the system</div>
            </div>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div style="overflow-x:auto;">
            <table class="admin-table" id="recent-blogs-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentBlogs as $blog)
                    <tr>
                        <td>
                            <div style="font-weight:600; color:var(--ink); max-width:220px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                {{ $blog->title }}
                            </div>
                        </td>
                        <td>
                            <span style="background:#ede9fe; color:#5b21b6; padding:2px 10px; border-radius:30px; font-size:.75rem; font-weight:600;">
                                {{ optional($blog->category)->name ?: 'Uncategorized' }}
                            </span>
                        </td>
                        <td>
                            @if($blog->is_published)
                                <span class="status-badge status-published">● Published</span>
                            @else
                                <span class="status-badge status-draft">● Draft</span>
                            @endif
                        </td>
                        <td style="color:var(--ink-muted); white-space:nowrap;">
                            {{ $blog->created_at?->format('M d, Y') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-secondary btn-xs">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:32px; color:var(--ink-muted);">
                            <div style="font-size:2rem; margin-bottom:8px;">📝</div>
                            No blog posts yet. <a href="{{ route('admin.blogs.create') }}" style="color:var(--accent);">Create one!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div style="display:flex; flex-direction:column; gap:16px;">
        <div class="card">
            <div class="card-header" style="border-bottom:none; padding-bottom:10px;">
                <div class="card-header-title">Quick Actions</div>
            </div>
            <div class="card-body" style="padding-top:0; display:flex; flex-direction:column; gap:10px;">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary" style="justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                    New Blog Post
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary" style="justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Manage All Blogs
                </a>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary" style="justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View Website
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="border-bottom:none; padding-bottom:10px;">
                <div class="card-header-title">System Status</div>
            </div>
            <div class="card-body" style="padding-top:0;">
                <div style="display:flex; flex-direction:column; gap:12px;">
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span style="font-size:.82rem; color:var(--ink-soft);">Database</span>
                        <span style="display:flex; align-items:center; gap:5px; font-size:.8rem; font-weight:600; color:#059669;">
                            <span style="width:7px; height:7px; background:#059669; border-radius:50%; display:inline-block;"></span>
                            Connected
                        </span>
                    </div>
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span style="font-size:.82rem; color:var(--ink-soft);">Storage</span>
                        <span style="display:flex; align-items:center; gap:5px; font-size:.8rem; font-weight:600; color:#059669;">
                            <span style="width:7px; height:7px; background:#059669; border-radius:50%; display:inline-block;"></span>
                            Active
                        </span>
                    </div>
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span style="font-size:.82rem; color:var(--ink-soft);">Last refresh</span>
                        <span id="last-refresh" style="font-size:.78rem; color:var(--ink-muted);">Just now</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
// AJAX Live Stats Refresh every 30 seconds
function refreshStats() {
    $.ajax({
        url: '{{ route("admin.dashboard") }}',
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function() {
            $('#last-refresh').text(new Date().toLocaleTimeString());
        }
    });
}
setInterval(refreshStats, 30000);

// Animate stat numbers on page load
$(document).ready(function() {
    $('.stat-number').each(function() {
        const target = parseInt($(this).text()) || 0;
        $(this).text('0');
        $({n: 0}).animate({n: target}, {
            duration: 900,
            step: function() { $(this.element).text(Math.round(this.n)); },
            complete: function() { $(this.element).text(target); }
        });
    });
});
</script>
@endpush
