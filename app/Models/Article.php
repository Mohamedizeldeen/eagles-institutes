<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'excerpt',
        'excerpt_en',
        'content',
        'content_en',
        'image',
        'created_by',
        'is_published',
        'published_at',
    ];

    /**
     * Get the localized article title based on current locale.
     */
    public function getLocalizedTitleAttribute(): string
    {
        if (app()->getLocale() === 'en' && !empty($this->title_en)) {
            return $this->title_en;
        }
        return $this->title;
    }

    /**
     * Get the localized article excerpt based on current locale.
     */
    public function getLocalizedExcerptAttribute(): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->excerpt_en)) {
            return $this->excerpt_en;
        }
        return $this->excerpt;
    }

    /**
     * Get the localized article content based on current locale.
     */
    public function getLocalizedContentAttribute(): string
    {
        if (app()->getLocale() === 'en' && !empty($this->content_en)) {
            return $this->content_en;
        }
        return $this->content;
    }

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title) ?: Str::random(8);
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
    }
}
