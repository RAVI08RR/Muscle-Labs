<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ─── Scopes ──────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // ─── Accessors ───────────────────────────────────────────

    public function getSeoTitleAttribute(?string $value): string
    {
        return $value ?? $this->title;
    }

    public function getSeoDescriptionAttribute(?string $value): ?string
    {
        return $value;
    }
}
