<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class YashodarshiOtp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'yashodarshi_id',
        'otp',
        'expires_at',
        'is_used'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the yashodarshi that owns the OTP.
     */
    public function yashodarshi()
    {
        return $this->belongsTo(Yashodarshi::class);
    }

    /**
     * Check if the OTP is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return Carbon::now()->isAfter($this->expires_at);
    }

    /**
     * Check if the OTP is valid (not used and not expired).
     *
     * @return bool
     */
    public function isValid()
    {
        return !$this->is_used && !$this->isExpired();
    }

    /**
     * Mark the OTP as used.
     *
     * @return bool
     */
    public function markAsUsed()
    {
        $this->is_used = true;
        return $this->save();
    }

    /**
     * Generate a random 6-digit OTP.
     *
     * @return string
     */
    public static function generateOtp()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new OTP for a yashodarshi.
     *
     * @param int $yashodarshiId
     * @param int $expiryMinutes
     * @return YashodarshiOtp
     */
    public static function createForYashodarshi($yashodarshiId, $expiryMinutes = 10)
    {
        return self::create([
            'yashodarshi_id' => $yashodarshiId,
            'otp' => self::generateOtp(),
            'expires_at' => Carbon::now()->addMinutes($expiryMinutes),
            'is_used' => false
        ]);
    }
}
