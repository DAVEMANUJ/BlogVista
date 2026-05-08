<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBlogs      = Blog::count();
        $publishedBlogs  = Blog::where('is_published', true)->count();
        $draftBlogs      = Blog::where('is_published', false)->count();
        $totalCategories = Category::count();

        $recentBlogs = Blog::with('category')
            ->latest()
            ->take(5)
            ->get();

        $blogsByCategory = Category::withCount('blogs')
            ->orderByDesc('blogs_count')
            ->get();

        return view('admin.dashboard', compact(
            'totalBlogs', 'publishedBlogs', 'draftBlogs',
            'totalCategories', 'recentBlogs', 'blogsByCategory'
        ));
    }
}