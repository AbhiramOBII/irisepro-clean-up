<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_title',
        'task_description',
        'task_instructions',
        'task_multimedia',
        'task_type',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'task_multimedia' => 'array',
    ];

    /**
     * Get the task score for the task.
     */
    public function taskScore()
    {
        return $this->hasOne(TaskScore::class);
    }

    /**
     * Get the challenge that owns the task.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * The challenges that belong to the task.
     */
    public function challenges()
    {
        return $this->belongsToMany(Challenge::class, 'challenge_task', 'task_id', 'challenge_id');
    }
}
