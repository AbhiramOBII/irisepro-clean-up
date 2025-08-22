<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Batch;

class Student extends Authenticatable
{
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'date_of_birth',
        'gender',
        'partner_institution',
        'status',
        'email_verified_at',
        'has_seen_welcome',
        'B2C',
        'profile_picture'
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
     * The help requests that belong to the student.
     */
    public function helpRequests()
    {
        return $this->hasMany(HelpRequest::class);
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

    /**
     * Get the batches that the student belongs to.
     */
    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_student', 'student_id', 'batch_id')
                    ->withPivot('challenge_id', 'amount', 'payment_status', 'payment_time', 'payment_comments')
                    ->withTimestamps();
    }
}
