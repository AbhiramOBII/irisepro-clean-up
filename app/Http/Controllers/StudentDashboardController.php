<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Batch;
use App\Models\Challenge;

class StudentDashboardController extends Controller
{
    /**
     * Check student status based on batch assignment and payment
     * Status 1 = Sappe (No batch assigned yet to the student)
     * Status 2 = Super (Batch Assigned but payment status == unpaid)
     * Status 3 = Duper (batch assigned, payment made, but batch has not started yet)
     * Status 4 = running (batch assigned, payment made, batch tasks have started)
     */
    public function checkStudentStatus($studentId)
    {
        $student = Student::find($studentId);

        if (!$student) {
            return [
                'status' => 0,
                'status_name' => 'invalid',
                'message' => 'Student not found'
            ];
        }

        // Get student data for header
        $mobileController = new MobileStudentController();
        $studentData = $mobileController->getStudentData();

        // Check if student has a batch assigned
        $batchStudent = DB::table('batch_student')
            ->where('student_id', $studentId)
            ->first();
        // Status 1: Sappe - No batch assigned yet
        if (!$batchStudent) {
            return [
                'status' => 1,
                'status_name' => 'sappe',
                'message' => 'No batch assigned yet to the student',
                'student' => $student
            ];
        }

        // Get batch details
        $batch = Batch::find($batchStudent->batch_id);

        if (!$batch) {
            return [
                'status' => 1,
                'status_name' => 'sappe',
                'message' => 'Batch not found',
                'student' => $student
            ];
        }


        // Status 2: Super - Batch assigned but payment status == unpaid
        if ($batchStudent->payment_status !== 'paid') {

            // Get challenge pricing for payment amount
            $challengePrice = 0;
            if (isset($batch->challenge_id)) {
                $challenge = Challenge::where('id', $batch->challenge_id)
                    ->select('selling_price', 'cost_price', 'special_price')
                    ->first();
                $challengePrice = $challenge->amount;
            }

            return [
                'status' => 2,
                'status_name' => 'super',
                'message' => 'Batch assigned but payment status is unpaid',
                'student' => $student,
                'batch' => $batch,
                'payment' => $batchStudent->amount,
                'payment_details' => [
                    'amount' => $challengePrice,
                    'due_date' => $batch->payment_due_date ?? null
                ]
            ];
        }

        // Check if batch has started (based on start_date)
        $currentDate = Carbon::now();
        $batchStartDate = Carbon::parse($batch->start_date);

        // Status 3: Duper - batch assigned, payment made, but batch has not started yet
        if ($currentDate->lt($batchStartDate) && $batchStudent->payment_status === 'paid') {


            return [
                'status' => 3,
                'status_name' => 'duper',
                'message' => 'Batch assigned, payment made, but batch has not started yet',
                'student' => $student,
                'batch' => $batch,
                'payment' => $batchStudent->amount,
                'days_to_start' => $currentDate->diffInDays($batchStartDate)
            ];
        }

        // Check if there are any tasks assigned to this batch's challenge
        $challengeTasks = DB::table('challenge_task')
            ->where('challenge_id', $batch->challenge_id)
            ->exists();

        // Status 4: Running - batch assigned, payment made, batch tasks have started
        if ($challengeTasks) {

            $this->getCurrentTask($student->id);


            return [
                'status' => 4,
                'status_name' => 'running',
                'message' => 'Batch assigned, payment made, batch tasks have started',
                'student' => $student,
                'batch' => $batch,
                'payment' => $batchStudent->amount
            ];
        }

        // Default to Status 3 if batch has started but no tasks yet
        return [
            'status' => 3,
            'status_name' => 'duper',
            'message' => 'Batch has started but no tasks assigned yet',
            'student' => $student,
            'batch' => $batch,
            'payment' => $batchStudent->amount
        ];
    }

    /**
     * Get student dashboard data based on status
     */
    public function getDashboardData($studentId)
    {
        $statusData = $this->checkStudentStatus($studentId);

        // Get student data for header
        $mobileController = new MobileStudentController();
        $studentData = $mobileController->getStudentData();

        // Add additional data based on status
        switch ($statusData['status']) {
            case 1: // Sappe
                $statusData['available_batches'] = Batch::where('status', 'active')
                    ->where('start_date', '>', Carbon::now())
                    ->orderBy('start_date', 'asc')
                    ->get();
                break;
            case 2: // Super
                // Get challenge pricing for payment amount
                $challengePrice = 0;
                if (isset($statusData['batch']->challenge_id)) {
                    $challenge = Challenge::where('id', $statusData['batch']->challenge_id)
                        ->select('selling_price', 'cost_price', 'special_price')
                        ->first();
                    $challengePrice = $challenge->amount;
                }

                $statusData['payment_details'] = [
                    'amount' => $challengePrice,
                    'due_date' => $statusData['batch']->payment_due_date ?? null
                ];
                break;

            case 3: // Duper
                // Get challenge pricing for payment confirmation
                $challengePrice = 0;
                if (isset($statusData['batch']->challenge_id)) {
                    $challenge = Challenge::where('id', $statusData['batch']->challenge_id)
                        ->select('selling_price', 'cost_price', 'special_price')
                        ->first();
                    $challengePrice = $challenge->amount;
                }

                $statusData['batch_info'] = [
                    'start_date' => $statusData['batch']->start_date,
                    'duration' => $statusData['batch']->duration ?? null,
                    'description' => $statusData['batch']->description ?? null
                ];
                $statusData['payment_details'] = [
                    'amount' => $challengePrice,
                    'status' => 'paid',
                    'payment_date' => $statusData['payment']->created_at ?? null
                ];
                break;

            case 4:

                // Running - Get current task using sequential delivery system
                $currentTaskData = $this->getCurrentTask($studentId);

                $statusData['current_task'] = $currentTaskData;

                // Get student habits
                $statusData['student_habits'] = $this->getStudentHabits($studentId);
                break;
        }


        // Add available batches for all status types (for challenges section)
        $statusData['available_batches'] = $this->getAvailableBatches($studentId);

        // Add available challenges (separate from batches)
        return array_merge($statusData, [
            'available_challenges' => $this->getAvailableChallenges($studentId),
            'student_data' => $studentData
        ]);
    }

    /**
     * Get available batches for student to join
     */
    private function getAvailableBatches($studentId)
    {
        // Get batches that student hasn't joined yet and are open for enrollment
        $joinedBatchIds = DB::table('batch_student')
            ->where('student_id', $studentId)
            ->pluck('batch_id')
            ->toArray();

        return DB::table('batches')
            ->whereNotIn('id', $joinedBatchIds)
            ->where('status', 'open') // Assuming batches have status field
            ->where('start_date', '>', Carbon::now()) // Future batches only
            ->orderBy('start_date', 'asc')
            ->limit(3) // Show max 3 available challenges
            ->get();
    }

    /**
     * Get available challenges for dashboard display
     */
    private function getAvailableChallenges($studentId)
    {
        // Get challenges that student hasn't joined yet
        $joinedChallengeIds = DB::table('batch_student')
            ->where('student_id', $studentId)
            ->pluck('batch_id')
            ->toArray();

        // Join batches with challenges to get cost from challenges table
        $availableChallenges = DB::table('batches')
            ->join('challenges', 'batches.challenge_id', '=', 'challenges.id')
            ->select(
                'batches.*',
                'challenges.title as challenge_title',
                'challenges.description as challenge_description',
                'challenges.cost_price as cost',
                'challenges.selling_price as selling_cost'
            )
            ->where('batches.status', 'active')
            ->where('batches.start_date', '>', Carbon::now()->addDays(2))
            ->whereNotIn('batches.id', $joinedChallengeIds)
            ->orderBy('batches.start_date', 'asc')
            ->limit(3)
            ->get();

        // Debug: Log the actual cost values being fetched
        foreach ($availableChallenges as $challenge) {
            \Log::info('Challenge cost debug:', [
                'challenge_id' => $challenge->id,
                'challenge_title' => $challenge->challenge_title,
                'cost_price' => $challenge->cost,
                'raw_data' => (array) $challenge
            ]);
        }

        return $availableChallenges;
    }

    /**
     * Get current available task for student based on sequential completion
     * Tasks are delivered one at a time in serial order
     */
    public function getCurrentTask($studentId)
    {
        // Get student's batch information
        $batchStudent = DB::table('batch_student')
            ->where('student_id', $studentId)
            ->first();

        if (!$batchStudent) {
            return null;
        }

        $challenge = Challenge::with(['tasks.taskScore'])->find($batchStudent->challenge_id);

        if (!$challenge || $challenge->tasks->isEmpty()) {
            return null;
        }

        // Get completed tasks for this student in this batch
        $completedTaskIds = DB::table('student_task_responses')
            ->where('student_id', $batchStudent->student_id)
            ->where('batch_id', $batchStudent->batch_id)
            ->where('status', 'submitted')
            ->pluck('task_id')
            ->toArray();

        // Find the next task to be completed
        foreach ($challenge->tasks as $task) {
            if (!in_array($task->id, $completedTaskIds)) {
                // This is the next task to complete
                $retobject =  [
                    'task' => $task,
                    'batch_id' => $batchStudent->batch_id,
                    'batch' => $batchStudent->batch_id,
                    'progress' =>  [
                        'completed_count' => count($completedTaskIds),
                        'total_count' => $challenge->tasks->count(),
                        'percentage' => round((count($completedTaskIds) / $challenge->tasks->count()) * 100, 2),
                        'current_position' => count($completedTaskIds) + 1
                    ]
                ];

                return $retobject;
            }
        }

        // All tasks completed
        return [
            'task' => null,
            'batch_id' => $batchStudent->batch_id,
            'batch' => $batchStudent->batch_id,
            'progress' => [
                'completed_count' => count($completedTaskIds),
                'total_count' => $challenge->tasks->count(),
                'percentage' => 100,
                'current_position' => $challenge->tasks->count(),
                'all_completed' => true
            ]
        ];
    }

    /**
     * Get student's selected habits with completion status
     */
    public function getStudentHabits($studentId)
    {
        $habits = DB::table('habit_student')
            ->join('habits', 'habit_student.habit_id', '=', 'habits.id')
            ->where('habit_student.student_id', $studentId)
            ->select('habits.*')
            ->get();

        // Check completion status for each habit
        foreach ($habits as $habit) {
            $habit->completed_today = $this->isHabitCompletedToday($studentId, $habit->id);
            $habit->can_submit = $this->canSubmitHabit($studentId, $habit->id);
            $habit->next_available = $this->getNextAvailableTime($studentId, $habit->id);
        }

        return $habits;
    }

    /**
     * Check if habit was completed today (within last 18 hours)
     */
    private function isHabitCompletedToday($studentId, $habitId)
    {
        $lastSubmission = DB::table('habit_student_submissions')
            ->where('student_id', $studentId)
            ->where('habit_id', $habitId)
            ->where('datestamp', '>=', Carbon::now()->subHours(18))
            ->orderBy('datestamp', 'desc')
            ->first();

        return $lastSubmission !== null;
    }

    /**
     * Check if student can submit habit (18-hour cooldown)
     */
    private function canSubmitHabit($studentId, $habitId)
    {
        $lastSubmission = DB::table('habit_student_submissions')
            ->where('student_id', $studentId)
            ->where('habit_id', $habitId)
            ->orderBy('datestamp', 'desc')
            ->first();

        if (!$lastSubmission) {
            return true; // No previous submission
        }

        $lastSubmissionTime = Carbon::parse($lastSubmission->datestamp);
        return Carbon::now()->diffInHours($lastSubmissionTime) >= 18;
    }

    /**
     * Get next available time for habit submission
     */
    private function getNextAvailableTime($studentId, $habitId)
    {
        $lastSubmission = DB::table('habit_student_submissions')
            ->where('student_id', $studentId)
            ->where('habit_id', $habitId)
            ->orderBy('datestamp', 'desc')
            ->first();

        if (!$lastSubmission) {
            return null; // Can submit now
        }

        $lastSubmissionTime = Carbon::parse($lastSubmission->datestamp);
        return $lastSubmissionTime->addHours(18);
    }
}
