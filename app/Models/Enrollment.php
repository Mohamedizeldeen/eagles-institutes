<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'amount_paid',
        'discount',
        'payment_status',
        'status',
        'enrolled_at',
        'completed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount_paid' => 'decimal:2',
            'discount' => 'decimal:2',
            'enrolled_at' => 'date',
            'completed_at' => 'date',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }

    public function netAmount(): float
    {
        return (float) ($this->amount_paid - $this->discount);
    }
}
