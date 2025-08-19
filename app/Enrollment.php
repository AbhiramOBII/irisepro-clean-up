<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email_id',
        'phone_number',
        'date_of_birth',
        'gender',
        'educational_level',
        'goals',
        'batch_selected',
        'challenge_id',
        'payment_status'
    ];

    protected $dates = [
        'date_of_birth'
    ];

    /**
     * Get the challenge that owns the enrollment.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * Get the batch that owns the enrollment.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_selected');
    }
}
