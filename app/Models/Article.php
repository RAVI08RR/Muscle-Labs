<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'featured_image_path',
        'featured_image_disk',
        'short_description',
        'body',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'published',
        'published_at',
    ];

    protected $casts = [
        'published'    => 'boolean',
        'published_at' => 'datetime',
    ];

    // ─── Scopes ──────────────────────────────────────────────

    /**
     * Only published articles that are live (published_at <= now).
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true)
                     ->where(function ($q) {
                         $q->whereNull('published_at')
                           ->orWhere('published_at', '<=', now());
                     });
    }

    /**
     * Order articles newest first.
     */
    public function scopeLatest(Builder $query, string $column = 'published_at'): Builder
    {
        return $query->orderByDesc($column);
    }

    // ─── Accessors ───────────────────────────────────────────

    /**
     * SEO title falls back to article title.
     */
    public function getSeoTitleAttribute(?string $value): string
    {
        return $value ?? $this->title;
    }

    /**
     * SEO description falls back to short description.
     */
    public function getSeoDescriptionAttribute(?string $value): ?string
    {
        return $value ?? $this->short_description;
    }
}
