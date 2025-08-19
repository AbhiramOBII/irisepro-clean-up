<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class YashodarshiEvaluationResult extends Model
{
    protected $table = 'yashodarshi_evaluation_results';

    protected $fillable = [
        'batch_id',
        'challenge_id', 
        'task_id',
        'student_id',
        'yashodarshi_id',
        'attribute_scores',
        'aptitude_score',
        'attitude_score',
        'communication_score',
        'execution_score',
        'total_score',
        'feedback',
        'status',
        'evaluated_at'
    ];

    protected $casts = [
        'attribute_scores' => 'array',
        'aptitude_score' => 'decimal:2',
        'attitude_score' => 'decimal:2',
        'communication_score' => 'decimal:2',
        'execution_score' => 'decimal:2',
        'total_score' => 'decimal:2',
        'evaluated_at' => 'datetime'
    ];

    // Relationships
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function yashodarshi()
    {
        return $this->belongsTo(Yashodarshi::class);
    }

    // Scopes
    public function scopeByBatch($query, $batchId)
    {
        return $query->where('batch_id', $batchId);
    }

    public function scopeByTask($query, $taskId)
    {
        return $query->where('task_id', $taskId);
    }

    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopeByYashodarshi($query, $yashodarshiId)
    {
        return $query->where('yashodarshi_id', $yashodarshiId);
    }

    public function scopeSubmitted($query)
    {
        return $query->where('status', 'submitted');
    }

    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Mutators
    public function setEvaluatedAtAttribute($value)
    {
        $this->attributes['evaluated_at'] = $value ? Carbon::parse($value) : now();
    }

    // Accessors
    public function getFormattedTotalScoreAttribute()
    {
        return number_format($this->total_score, 2);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => 'bg-gray-100 text-gray-800',
            'submitted' => 'bg-blue-100 text-blue-800',
            'reviewed' => 'bg-green-100 text-green-800'
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    // Helper methods
    public function calculateTotalScore()
    {
        return $this->aptitude_score + $this->attitude_score + 
               $this->communication_score + $this->execution_score;
    }

    public function markAsSubmitted()
    {
        $this->update([
            'status' => 'submitted',
            'evaluated_at' => now()
        ]);
    }

    public function markAsReviewed()
    {
        $this->update([
            'status' => 'reviewed'
        ]);
    }
}
