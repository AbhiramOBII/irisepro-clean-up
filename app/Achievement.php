<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain',
        'title',
        'threshold',
        'image'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'threshold' => 'integer',
    ];

    /**
     * Get the available domains for achievements.
     *
     * @return array
     */
    public static function getDomains()
    {
        return ['attitude', 'aptitude', 'communication', 'execution', 'aace', 'leadership'];
    }

    /**
     * Scope a query to only include achievements of a given domain.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $domain
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDomain($query, $domain)
    {
        return $query->where('domain', $domain);
    }

    /**
     * Scope a query to only include achievements with threshold less than or equal to given value.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $threshold
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithinThreshold($query, $threshold)
    {
        return $query->where('threshold', '<=', $threshold);
    }

    /**
     * The students that have unlocked this achievement.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_achievement')
                    ->withPivot('unlocked_at')
                    ->withTimestamps();
    }
}
