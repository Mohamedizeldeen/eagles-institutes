<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'enrollment_id',
        'certificate_number',
        'issued_at',
        'grade',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
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

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public static function generateNumber(): string
    {
        $year = date('Y');
        $lastCert = static::whereYear('created_at', $year)->orderByDesc('id')->first();
        $nextNum = $lastCert ? ((int) substr($lastCert->certificate_number, -4)) + 1 : 1;
        return 'CERT-' . $year . '-' . str_pad($nextNum, 4, '0', STR_PAD_LEFT);
    }
}
