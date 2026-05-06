<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Public homepage
     */
    public function home()
    {
        $featuredBlogs = Blog::with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = Category::withCount(['blogs' => function ($q) {
            $q->where('is_published', true);
        }])->get();

        $totalBlogs = Blog::where('is_published', true)->count();

        return view('public.home', compact('featuredBlogs', 'categories', 'totalBlogs'));
    }

    /**
     * Blog listing page with AJAX support
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->ajax()) {
            return $this->ajaxFilter($request);
        }

        $blogs = Blog::with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('public.index', compact('blogs', 'categories'));
    }

    /**
     * AJAX Filter/Search handler
     */
    public function ajaxFilter(Request $request)
    {
        $query = Blog::with('category')->where('is_published', true);

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('published_at', $request->date);
        }

        $blogs = $query->latest('published_at')->paginate(9);

        return response()->json([
            'html'  => view('public.blog-cards', compact('blogs'))->render(),
            'total' => $blogs->total(),
            'pagination' => $blogs->links('public.pagination')->render(),
        ]);
    }

    /**
     * Blog detail page
     */
    public function show(string $slug)
    {
        $blog = Blog::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $recentBlogs = Blog::with('category')
            ->where('is_published', true)
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        $relatedBlogs = Blog::with('category')
            ->where('is_published', true)
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.show', compact('blog', 'recentBlogs', 'relatedBlogs'));
    }
}