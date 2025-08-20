<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Many-to-many relationship with batches (as student)
    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_student', 'student_id', 'batch_id')->withTimestamps();
    }

    // One-to-many relationship with batches (as yashodarshi)
    public function managedBatches()
    {
        return $this->hasMany(Batch::class, 'yashodarshi_id');
    }
}
