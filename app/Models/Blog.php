<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'short_description', 'content',
        'category_id', 'image', 'is_published', 'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            // If it's already a full URL (from image_url field), return as-is
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            // Otherwise it's a storage path
            if (file_exists(storage_path('app/public/' . $this->image))) {
                return asset('storage/' . $this->image);
            }
        }
        // Return a deterministic placeholder
        return 'https://picsum.photos/seed/' . ($this->id ?? rand(1,999)) . '/800/500';
    }

    public function getReadingTimeAttribute(): string
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = max(1, ceil($wordCount / 200));
        return $minutes . ' min read';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            if (empty($blog->published_at)) {
                $blog->published_at = now()->toDateString();
            }
        });
    }
}