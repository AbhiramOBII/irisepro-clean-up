<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentOtp extends Model
{
    protected $fillable = [
        'student_id',
        'email',
        'otp',
        'expires_at',
        'is_used'
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'expires_at' => 'datetime'
    ];

    /**
     * Get the student that owns the OTP.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
