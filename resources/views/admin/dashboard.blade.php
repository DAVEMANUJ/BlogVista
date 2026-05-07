@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="panel">
        <h1>Dashboard</h1>
        <p>Overview of blog activity and content counts.</p>
    </div>

    <div class="stats">
        <div class="panel">
            <h3>Total Blogs</h3>
            <p>{{ $stats['blogs'] }}</p>
        </div>
        <div class="panel">
            <h3>Published Blogs</h3>
            <p>{{ $stats['published'] }}</p>
        </div>
        <div class="panel">
            <h3>Categories</h3>
            <p>{{ $stats['categories'] }}</p>
        </div>
    </div>

    <div class="panel">
        <h2>Recent Blogs</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentBlogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ optional($blog->category)->name ?: 'Uncategorized' }}</td>
                        <td>{{ $blog->created_at?->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No blogs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
