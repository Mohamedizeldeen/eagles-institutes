<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'id_number',
        'gender',
        'date_of_birth',
        'address',
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
