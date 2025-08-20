<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'issue_type',
        'description',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the student that owns the help request.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the issue type in a human-readable format.
     */
    public function getIssueTypeDisplayAttribute()
    {
        $types = [
            'technical_issue' => 'Technical Issue',
            'content_issue' => 'Content Issue',
            'evaluator_issue' => 'Evaluator Issue',
            'other' => 'Other'
        ];

        return $types[$this->issue_type] ?? 'Unknown';
    }

    /**
     * Get the status in a human-readable format.
     */
    public function getStatusDisplayAttribute()
    {
        $statuses = [
            'pending' => 'Pending',
            'in_progress' => 'In Progress',
            'resolved' => 'Resolved',
            'closed' => 'Closed'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
}
