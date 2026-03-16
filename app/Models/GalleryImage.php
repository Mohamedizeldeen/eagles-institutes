<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    protected $fillable = [
        'gallery_category_id',
        'image',
        'caption',
        'caption_en',
        'sort_order',
        'show_on_home',
    ];

    protected function casts(): array
    {
        return [
            'show_on_home' => 'boolean',
        ];
    }

    public function getLocalizedCaptionAttribute(): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->caption_en)) {
            return $this->caption_en;
        }
        return $this->caption;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function scopeHomeFeatured($query)
    {
        return $query->where('show_on_home', true);
    }
}
