<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'blogs'      => Blog::count(),
            'published'  => Blog::where('is_published', true)->count(),
            'categories' => Category::count(),
        ];

        $recentBlogs = Blog::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBlogs'));
    }
}