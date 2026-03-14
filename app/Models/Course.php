<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'description',
        'description_en',
        'image',
        'level',
        'price',
        'duration_hours',
        'max_students',
        'start_date',
        'end_date',
        'is_active',
        'show_on_website',
    ];

    /**
     * Get the localized course name based on current locale.
     */
    public function getLocalizedNameAttribute(): string
    {
        if (app()->getLocale() === 'en' && !empty($this->name_en)) {
            return $this->name_en;
        }
        return $this->name;
    }

    /**
     * Get the localized course description based on current locale.
     */
    public function getLocalizedDescriptionAttribute(): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->description_en)) {
            return $this->description_en;
        }
        return $this->description;
    }

    /**
     * Get the localized level name.
     */
    public function getLocalizedLevelAttribute(): string
    {
        $levels = [
            'مبتدئ' => __('messages.courses.beginner'),
            'متوسط' => __('messages.courses.intermediate'),
            'متقدم' => __('messages.courses.advanced'),
        ];
        return $levels[$this->level] ?? $this->level;
    }

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
            'show_on_website' => 'boolean',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function activeEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class)->where('status', 'مسجل');
    }

    public function completedEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class)->where('status', 'مكتمل');
    }

    public function enrolledStudentsCount(): int
    {
        return $this->enrollments()->whereIn('status', ['مسجل', 'مكتمل'])->count();
    }

    public function totalRevenue(): float
    {
        return (float) $this->enrollments()->sum('amount_paid');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVisibleOnWebsite($query)
    {
        return $query->where('show_on_website', true);
    }
}
