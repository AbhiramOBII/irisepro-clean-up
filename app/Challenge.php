<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'title',
        'description',
        'features',
        'who_is_this_for',
        'thumbnail_image',
        'cost_price',
        'selling_price',
        'special_price',
        'status',
        'number_of_tasks',
        'datestamp'
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'special_price' => 'decimal:2',
        'datestamp' => 'datetime',
    ];

    /**
     * The tasks that belong to the challenge.
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'challenge_task', 'challenge_id', 'task_id');
    }

    /**
     * The batches that belong to the challenge.
     */
    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function getAmountAttribute()
    {
        return $this->special_price ?? $this->selling_price;
    }
}
