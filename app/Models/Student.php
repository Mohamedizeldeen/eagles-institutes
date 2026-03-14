<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'email',
        'phone',
        'id_number',
        'gender',
        'date_of_birth',
        'address',
        'address_en',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the localized name based on current locale
     */
    public function getLocalizedNameAttribute(): string
    {
        if (app()->getLocale() === 'en' && $this->name_en) {
            return $this->name_en;
        }
        return $this->name;
    }

    /**
     * Get the localized address based on current locale
     */
    public function getLocalizedAddressAttribute(): ?string
    {
        if (app()->getLocale() === 'en' && $this->address_en) {
            return $this->address_en;
        }
        return $this->address;
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

    public function completedCourses(): HasMany
    {
        return $this->hasMany(Enrollment::class)->where('status', 'مكتمل');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
