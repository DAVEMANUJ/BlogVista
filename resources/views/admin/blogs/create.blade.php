@extends('layouts.admin')

@section('title', 'Create Blog')

@section('content')
    <div class="panel">
        <h1>Create Blog</h1>
        <form action="{{ route('admin.blogs.store') }}" method="POST">
            @csrf
            @include('admin.blogs._form')
        </form>
    </div>
@endsection
