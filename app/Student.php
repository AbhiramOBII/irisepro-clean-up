<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'date_of_birth',
        'gender',
        'phone_number',
        'partner_institution',
        'status',
        'email_verified_at',
        'has_seen_welcome',
        'B2C'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'email_verified_at' => 'datetime',
        'has_seen_welcome' => 'boolean',
        'B2C' => 'boolean'
    ];

    /**
     * The habits that belong to the student.
     */
    public function habits()
    {
        return $this->belongsToMany(Habit::class)->withPivot('datestamp')->withTimestamps();
    }

    /**
     * The achievements that belong to the student.
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'student_achievement')
                    ->withPivot('unlocked_at')
                    ->withTimestamps();
    }
}
