@extends('layouts.admin')

@section('title', 'Edit Blog: ' . $blog->title)

@section('breadcrumb')
    <span style="color:var(--ink-muted);">/</span>
    <a href="{{ route('admin.blogs.index') }}" style="color:var(--ink-soft); text-decoration:none; font-weight:500;">All Blogs</a>
    <span style="color:var(--ink-muted);">/</span>
    <span style="color:var(--ink); font-weight:600;" style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ Str::limit($blog->title, 30) }}</span>
@endsection

@section('admin-content')

<div class="page-title-row">
    <div>
        <div class="page-title">Edit Blog Post</div>
        <div class="page-subtitle" style="max-width:480px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
            {{ $blog->title }}
        </div>
    </div>
    <div style="display:flex; gap:10px;">
        @if ($blog->is_published)
        <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="btn btn-secondary btn-sm">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            View Live
        </a>
        @endif
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-sm">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            Back to Blogs
        </a>
    </div>
</div>

<form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.blogs._form')
</form>

@endsection
