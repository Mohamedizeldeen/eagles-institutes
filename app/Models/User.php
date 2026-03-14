<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'name_en',
        'email',
        'password',
        'is_admin',
        'role',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
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

    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->is_admin;
    }

    public function isReceptionist(): bool
    {
        return $this->role === 'receptionist';
    }

    /**
     * Check if user is staff (admin or receptionist)
     */
    public function isStaff(): bool
    {
        return in_array($this->role, ['admin', 'receptionist']);
    }

    /**
     * Get the display role name
     */
    public function getRoleNameAttribute(): string
    {
        $locale = app()->getLocale();
        $roles = [
            'admin' => $locale === 'ar' ? 'مدير النظام' : 'Admin',
            'receptionist' => $locale === 'ar' ? 'موظف استقبال' : 'Receptionist',
        ];
        return $roles[$this->role] ?? $this->role;
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'created_by');
    }
}
