<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yashodarshi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'biodata'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the batches assigned to this yashodarshi.
     */
    public function batches()
    {
        return $this->hasMany(Batch::class, 'yashodarshi_id');
    }
}
