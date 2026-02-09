<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
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
