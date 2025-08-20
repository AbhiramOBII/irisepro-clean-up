<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'full_name',
        'email_id',
        'phone_number',
        'date_of_birth',
        'gender',
        'educational_level',
        'goals',
        'batch_selected',
        'challenge_id',
        'payment_status',
        'razorpay_order_id',
        'razorpay_payment_id'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Automatically generate UUID when creating.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Use uuid for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

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
