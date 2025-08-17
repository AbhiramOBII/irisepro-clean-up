<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskScore extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id',
        'attribute_score',
        'total_score',
        'aptitude_score',
        'attitude_score',
        'communication_score',
        'execution_score',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attribute_score' => 'array',
        'total_score' => 'decimal:2',
        'aptitude_score' => 'decimal:2',
        'attitude_score' => 'decimal:2',
        'communication_score' => 'decimal:2',
        'execution_score' => 'decimal:2',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the task that owns the task score.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
