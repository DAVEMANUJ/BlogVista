@extends('layouts.admin')

@section('title', 'Create New Blog')

@section('breadcrumb')
    <span style="color:var(--ink-muted);">/</span>
    <a href="{{ route('admin.blogs.index') }}" style="color:var(--ink-soft); text-decoration:none; font-weight:500;">All Blogs</a>
    <span style="color:var(--ink-muted);">/</span>
    <span style="color:var(--ink); font-weight:600;">New Post</span>
@endsection

@section('admin-content')

<div class="page-title-row">
    <div>
        <div class="page-title">Create New Blog Post</div>
        <div class="page-subtitle">Fill in the details below to publish a new article</div>
    </div>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-sm">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Back to Blogs
    </a>
</div>

<form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.blogs._form')
</form>

@endsection
