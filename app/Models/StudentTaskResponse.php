<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTaskResponse extends Model
{
    protected $fillable = [
        'batch_id',
        'student_id', 
        'challenge_id',
        'task_id',
        'submission_response',
        'submission_multimedia',
        'started_at',
        'submitted_at',
        'status',
        'datestamp',
        'score',
        'feedback',
        'attribute_scores',
        'evaluated_at',
        'evaluated_by'
    ];

    protected $casts = [
        'submission_multimedia' => 'array',
        'attribute_scores' => 'array',
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
        'evaluated_at' => 'datetime',
        'datestamp' => 'date'
    ];

    // Relationships
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Scopes
    public function scopeSubmitted($query)
    {
        return $query->where('status', 'submitted');
    }

    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    public function scopeNotSubmitted($query)
    {
        return $query->where('status', 'not-submitted');
    }

    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopeForBatch($query, $batchId)
    {
        return $query->where('batch_id', $batchId);
    }

    public function scopeForChallenge($query, $challengeId)
    {
        return $query->where('challenge_id', $challengeId);
    }

    public function yashodarshiEvaluationResult()
    {
        return $this->hasOne(YashodarshiEvaluationResult::class, 'student_id', 'student_id')
                    ->where('batch_id', $this->batch_id)
                    ->where('task_id', $this->task_id);
    }
}
