<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'title',
        'description',
        'challenge_id',
        'yashodarshi_id',
        'start_date',
        'time',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'time' => 'datetime:H:i:s'
    ];

    // Relationship with Challenge
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    // Relationship with Yashodarshi
    public function yashodarshi()
    {
        return $this->belongsTo(Yashodarshi::class, 'yashodarshi_id');
    }

    // Many-to-many relationship with students
    public function students()
    {
        return $this->belongsToMany(Student::class, 'batch_student', 'batch_id', 'student_id')
                    ->withPivot('challenge_id', 'amount', 'payment_status', 'payment_time', 'payment_comments')
                    ->withTimestamps();
    }

    /**
     * Get the calculated status based on start date and current date
     */
    public function getCalculatedStatusAttribute()
    {
        // If manually set to inactive, respect that
        if ($this->status === 'inactive') {
            return 'inactive';
        }

        $now = now();
        $startDate = $this->start_date;
        
        $calculatedStatus = 'active';
        
        // If start date hasn't arrived yet, show as active
        if ($now->lt($startDate)) {
            $calculatedStatus = 'active';
        }
        // Calculate 60 days from start date
        else {
            $endDate = $startDate->copy()->addDays(60);
            
            // If we're within 60 days of start date, show as ongoing
            if ($now->gte($startDate) && $now->lt($endDate)) {
                $calculatedStatus = 'ongoing';
            }
            // If more than 60 days have passed, show as completed
            else {
                $calculatedStatus = 'completed';
            }
        }
        
        // Update database if calculated status differs from stored status
        if ($this->status !== $calculatedStatus && $this->exists) {
            $this->update(['status' => $calculatedStatus]);
        }
        
        return $calculatedStatus;
    }

    /**
     * Get the display status (calculated status)
     */
    public function getDisplayStatusAttribute()
    {
        return $this->calculated_status;
    }
}
