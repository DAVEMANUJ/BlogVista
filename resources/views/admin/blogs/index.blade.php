@extends('layouts.admin')

@section('title', 'Manage Blogs')

@section('breadcrumb')
    <span style="color:var(--ink-muted);">/</span>
    <span style="color:var(--ink); font-weight:600;">All Blogs</span>
@endsection

@section('admin-content')

<div class="page-title-row">
    <div>
        <div class="page-title">Manage Blogs</div>
        <div class="page-subtitle">{{ $blogs->total() }} post{{ $blogs->total() !== 1 ? 's' : '' }} found</div>
    </div>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
        New Blog Post
    </a>
</div>

{{-- ── Search / Filter Bar ──────────────────────── --}}
<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 22px;">
        <form id="filter-form" method="GET" action="{{ route('admin.blogs.index') }}" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
            <div style="flex:1; min-width:200px;">
                <label class="form-label" style="margin-bottom:5px;">Search</label>
                <input id="search-input" type="text" name="search" class="form-control"
                    placeholder="Search by title…" value="{{ request('search') }}"
                    style="height:40px; padding:8px 14px;">
            </div>
            <div style="min-width:180px;">
                <label class="form-label" style="margin-bottom:5px;">Category</label>
                <select name="category" id="category-filter" class="form-control" style="height:40px; padding:8px 14px;">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:160px;">
                <label class="form-label" style="margin-bottom:5px;">Status</label>
                <select name="status" id="status-filter" class="form-control" style="height:40px; padding:8px 14px;">
                    <option value="">All Status</option>
                    <option value="published" @selected(request('status') === 'published')>Published</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                </select>
            </div>
            <div style="display:flex; gap:8px;">
                <button type="submit" class="btn btn-primary btn-sm" style="height:40px;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    Filter
                </button>
                @if(request()->hasAny(['search','category','status']))
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-sm" style="height:40px;">Clear</a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- ── Loading Spinner (AJAX) ───────────────── --}}
<div id="blogs-loading" style="display:none; text-align:center; padding:24px; color:var(--ink-muted);">
    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
        style="animation:spin 1s linear infinite; display:inline-block;">
        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
    </svg>
    <p style="margin-top:8px; font-size:.85rem;">Loading blogs…</p>
</div>
<style>@keyframes spin { to { transform: rotate(360deg); } }</style>

{{-- ── Blogs Table ──────────────────────────── --}}
<div class="card" id="blogs-table-wrap">
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th style="width:64px;">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody id="blogs-tbody">
                @forelse ($blogs as $blog)
                <tr id="blog-row-{{ $blog->id }}">
                    <td style="color:var(--ink-muted); font-size:.8rem;">{{ $blog->id }}</td>
                    <td>
                        <div style="width:44px; height:44px; border-radius:8px; overflow:hidden; background:var(--surface-3);">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}"
                                style="width:100%; height:100%; object-fit:cover;" loading="lazy">
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600; color:var(--ink); max-width:260px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="{{ $blog->title }}">
                            {{ $blog->title }}
                        </div>
                        <div style="font-size:.75rem; color:var(--ink-muted); margin-top:2px;">{{ $blog->reading_time }}</div>
                    </td>
                    <td>
                        @if($blog->category)
                        <span style="background:#ede9fe; color:#5b21b6; padding:2px 10px; border-radius:30px; font-size:.75rem; font-weight:600;">
                            {{ $blog->category->name }}
                        </span>
                        @else
                        <span style="color:var(--ink-muted); font-size:.8rem;">Uncategorized</span>
                        @endif
                    </td>
                    <td>
                        {{-- AJAX Toggle publish status --}}
                        <form class="toggle-status-form" data-blog-id="{{ $blog->id }}"
                            action="{{ route('admin.blogs.toggle', $blog) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="status-badge {{ $blog->is_published ? 'status-published' : 'status-draft' }}"
                                style="border:none; cursor:pointer; font-family:inherit;"
                                title="Click to toggle status">
                                {{ $blog->is_published ? '● Published' : '● Draft' }}
                            </button>
                        </form>
                    </td>
                    <td style="color:var(--ink-muted); font-size:.83rem; white-space:nowrap;">
                        {{ $blog->published_at?->format('M d, Y') ?: '—' }}
                    </td>
                    <td style="text-align:right; white-space:nowrap;">
                        <div style="display:flex; gap:6px; justify-content:flex-end;">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-secondary btn-xs">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <form id="del-{{ $blog->id }}"
                                action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-xs"
                                    onclick="confirmDelete('del-{{ $blog->id }}')">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 6h18M19 6l-1 14H6L5 6M10 11v6M14 11v6M9 6V4h6v2"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:48px; color:var(--ink-muted);">
                        <div style="font-size:2.5rem; margin-bottom:10px;">📭</div>
                        <div style="font-weight:600; margin-bottom:6px;">No blog posts found</div>
                        <div style="font-size:.85rem; margin-bottom:18px;">
                            @if(request()->hasAny(['search','category','status']))
                                No results match your search criteria.
                            @else
                                You haven't created any blog posts yet.
                            @endif
                        </div>
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">Create Your First Blog</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($blogs->hasPages())
    <div style="padding:16px 22px; border-top:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
        <div style="font-size:.83rem; color:var(--ink-muted);">
            Showing {{ $blogs->firstItem() }}–{{ $blogs->lastItem() }} of {{ $blogs->total() }} results
        </div>
        <div style="display:flex; gap:6px; align-items:center;">
            @if ($blogs->onFirstPage())
                <span class="btn btn-secondary btn-xs" style="opacity:.4; cursor:default;">← Prev</span>
            @else
                <a href="{{ $blogs->previousPageUrl() }}" class="btn btn-secondary btn-xs">← Prev</a>
            @endif

            @foreach ($blogs->getUrlRange(max(1, $blogs->currentPage()-2), min($blogs->lastPage(), $blogs->currentPage()+2)) as $page => $url)
                @if ($page == $blogs->currentPage())
                    <span class="btn btn-primary btn-xs">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="btn btn-secondary btn-xs">{{ $page }}</a>
                @endif
            @endforeach

            @if ($blogs->hasMorePages())
                <a href="{{ $blogs->nextPageUrl() }}" class="btn btn-secondary btn-xs">Next →</a>
            @else
                <span class="btn btn-secondary btn-xs" style="opacity:.4; cursor:default;">Next →</span>
            @endif
        </div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
// AJAX live search with debounce
let searchTimer;
$('#search-input').on('input', function() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(function() {
        $('#filter-form').trigger('submit');
    }, 450);
});

// AJAX filter change
$('#category-filter, #status-filter').on('change', function() {
    $('#filter-form').trigger('submit');
});

// Intercept form submit → AJAX fetch and replace table
$('#filter-form').on('submit', function(e) {
    e.preventDefault();
    const params = $(this).serialize();
    const url = '{{ route("admin.blogs.index") }}?' + params;

    $('#blogs-loading').show();
    $('#blogs-table-wrap').css('opacity', '0.4');

    $.ajax({
        url: url,
        method: 'GET',
        success: function(html) {
            const $doc = $(html);
            const newTbody = $doc.find('#blogs-tbody').html();
            const newSubtitle = $doc.find('.page-subtitle').text();
            if (newTbody !== undefined) {
                $('#blogs-tbody').html(newTbody);
                $('.page-subtitle').text(newSubtitle);
            }
        },
        complete: function() {
            $('#blogs-loading').hide();
            $('#blogs-table-wrap').css('opacity', '1');
        }
    });
});

// AJAX publish/unpublish toggle
$(document).on('submit', '.toggle-status-form', function(e) {
    e.preventDefault();
    const form = $(this);
    const blogId = form.data('blog-id');
    const btn = form.find('button');

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),
        success: function() {
            // Toggle visuals
            const isPublished = btn.hasClass('status-published');
            btn.toggleClass('status-published', !isPublished)
               .toggleClass('status-draft', isPublished)
               .text(!isPublished ? '● Published' : '● Draft');
        },
        error: function() {
            alert('Failed to toggle status. Please try again.');
        }
    });
});
</script>
@endpush
