@extends('layouts.admin')

@section('title', 'Manage Blogs')

@section('content')
    <div class="panel">
        <h1>Manage Blogs</h1>
        <a class="btn" href="{{ route('admin.blogs.create') }}">Create Blog</a>
    </div>

    <div class="panel">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ optional($blog->category)->name ?: 'Uncategorized' }}</td>
                        <td>{{ $blog->published_at?->format('M d, Y') ?: 'Draft' }}</td>
                        <td>
                            <a class="btn" href="{{ route('admin.blogs.edit', $blog) }}">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No blog posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
