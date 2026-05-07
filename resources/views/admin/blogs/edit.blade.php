@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
    <div class="panel">
        <h1>Edit Blog</h1>
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.blogs._form')
        </form>
    </div>
@endsection
