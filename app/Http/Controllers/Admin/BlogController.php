<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $blogs      = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $blog = new Blog();
        return view('admin.blogs.create', compact('categories', 'blog'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content'           => 'required|string',
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url'         => 'nullable|url|max:2048',
            'published_at'      => 'nullable|date',
            'is_published'      => 'nullable|boolean',
        ]);

        // Handle image: uploaded file takes priority over URL
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;  // store the URL directly
        }

        // Generate unique slug
        $slug = Str::slug($validated['title']);
        $original = $slug;
        $count = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }

        Blog::create([
            'title'             => $validated['title'],
            'slug'              => $slug,
            'short_description' => $validated['short_description'],
            'content'           => $validated['content'],
            'category_id'       => $validated['category_id'],
            'image'             => $imagePath,
            'published_at'      => $validated['published_at'] ?? now()->toDateString(),
            'is_published'      => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully! 🎉');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content'           => 'required|string',
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url'         => 'nullable|url|max:2048',
            'published_at'      => 'nullable|date',
            'is_published'      => 'nullable|boolean',
        ]);

        // Handle remove_image checkbox
        if ($request->boolean('remove_image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = null;
        }

        // Handle image: uploaded file takes priority over URL
        if ($request->hasFile('image')) {
            // Delete old stored image if it was a file (not a URL)
            if ($blog->image && !filter_var($blog->image, FILTER_VALIDATE_URL)
                && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        } elseif ($request->filled('image_url') && !$request->hasFile('image')) {
            $validated['image'] = $request->image_url;
        }

        // Update slug if title changed
        if ($blog->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $original = $slug;
            $count = 1;
            while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $original . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_published'] = $request->boolean('is_published');

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully! ✅');
    }

    public function destroy(Blog $blog)
    {
        // Delete image from storage
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    public function toggle(Blog $blog)
    {
        $blog->update(['is_published' => !$blog->is_published]);
        $status = $blog->is_published ? 'published' : 'unpublished';
        return back()->with('success', "Blog post {$status} successfully!");
    }
}