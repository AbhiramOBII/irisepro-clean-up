<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Student;
use App\StudentOtp;
use App\Habit;
use App\Task;
use App\Challenge;
use App\YashodarshiEvaluationResult;
use App\StudentTaskResponse;
use App\Batch;
use App\TaskScore;

class MobileStudentController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('frontendapp.login');
    }

    /**
     * Send OTP to student's email.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        
        // Check if student exists
        $student = Student::where('email', $email)->where('status', 'active')->first();
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found or inactive'
            ], 404);
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Delete any existing OTP for this student
        StudentOtp::where('student_id', $student->id)->delete();
        
        // Create new OTP record
        StudentOtp::create([
            'student_id' => $student->id,
            'email' => $email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10), // OTP expires in 10 minutes
            'is_used' => false
        ]);

        // TODO: Send OTP via email (implement email service)
        // For now, we'll just return success
        // Mail::send('emails.otp', ['otp' => $otp], function($message) use ($email) {
        //     $message->to($email)->subject('iRisePro - Your Login OTP');
        // });

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'otp' => $otp // Remove this in production
        ]);
    }

    /**
     * Verify OTP and login student.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6'
        ]);

        $email = $request->email;
        $otp = $request->otp;

        // Find the OTP record
        $otpRecord = StudentOtp::where('email', $email)
            ->where('otp', $otp)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP'
            ], 400);
        }

        // Mark OTP as used
        $otpRecord->update(['is_used' => true]);

        // Get student
        $student = Student::find($otpRecord->student_id);

        // Create session
        Session::put('student_logged_in', true);
        Session::put('student_id', $student->id);
        Session::put('student_email', $student->email);
        Session::put('student_name', $student->full_name);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'redirect_url' => route('mobile.dashboard')
        ]);
    }

    /**
     * Show OTP verification form.
     */
    public function showOtpVerification(Request $request)
    {
        $email = $request->get('email');
        
        // Get the latest OTP record for this email to calculate remaining time
        $otpRecord = StudentOtp::where('email', $email)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();
        
        $expiresAt = $otpRecord ? $otpRecord->expires_at : null;
        
        return view('frontendapp.otp-verification', compact('email', 'expiresAt'));
    }

    /**
     * Student dashboard.
     */
    public function dashboard()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        $student = Student::find(Session::get('student_id'));
        
        // Check if student has seen welcome screen
        if (!$student->has_seen_welcome) {
            return redirect()->route('mobile.welcome');
        }
        
        // Check if student has selected a habit
        $hasHabit = DB::table('habit_student')->where('student_id', $student->id)->exists();
        if (!$hasHabit) {
            return redirect()->route('mobile.select-habit');
        }
        
        // Get student status using StudentDashboardController
        $dashboardController = new StudentDashboardController();
        $studentStatus = $dashboardController->getDashboardData($student->id);
        
        // Get student data for header
        $studentData = $this->getStudentData();
        
        return view('frontendapp.dashboard', compact('student', 'studentStatus', 'studentData'));
    }

    /**
     * Show welcome screen.
     */
    public function showWelcome()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        $student = Student::find(Session::get('student_id'));
        
        // If already seen welcome, redirect to dashboard
        if ($student->has_seen_welcome) {
            return redirect()->route('mobile.dashboard');
        }
        
        return view('frontendapp.welcome-screen', compact('student'));
    }

    /**
     * Mark welcome screen as seen.
     */
    public function markWelcomeSeen()
    {
        if (!Session::get('student_logged_in')) {
            return response()->json(['success' => false, 'message' => 'Not authenticated'], 401);
        }

        $student = Student::find(Session::get('student_id'));
        $student->update(['has_seen_welcome' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Show habit selection screen.
     */
    public function selectHabit()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        $student = Student::find(Session::get('student_id'));
        
        // Check if student already has a habit selected
        $hasHabit = DB::table('habit_student')->where('student_id', $student->id)->exists();
        if ($hasHabit) {
            return redirect()->route('mobile.dashboard');
        }
        
        // Get all available habits
        $habits = Habit::where('status', 'active')->orderBy('title')->get();
        
        return view('frontendapp.select-habit', compact('student', 'habits'));
    }

    /**
     * Save selected habit.
     */
    public function saveHabit(Request $request)
    {
        if (!Session::get('student_logged_in')) {
            return response()->json(['success' => false, 'message' => 'Not authenticated'], 401);
        }

        $request->validate([
            'habit_id' => 'required|exists:habits,id'
        ]);

        $student = Student::find(Session::get('student_id'));
        
        // Check if student already has a habit selected
        $hasHabit = DB::table('habit_student')->where('student_id', $student->id)->exists();
        if ($hasHabit) {
            return response()->json(['success' => false, 'message' => 'You have already selected a habit']);
        }
        
        // Save the habit selection
        DB::table('habit_student')->insert([
            'student_id' => $student->id,
            'habit_id' => $request->habit_id,
            'datestamp' => now(), // Add the required datestamp field
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Habit selected successfully! Welcome to your journey.'
        ]);
    }

    /**
     * Student profile.
     */
    public function profile()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        $student = Student::find(Session::get('student_id'));
        return view('frontendapp.profile', compact('student'));
    }

    /**
     * Update student profile.
     */
    public function updateProfile(Request $request)
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        $student = Student::find(Session::get('student_id'));
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other'
        ]);

        $student->update($request->only(['full_name', 'phone_number', 'date_of_birth', 'gender']));

        return redirect()->route('mobile.profile')->with('success', 'Profile updated successfully');
    }

    /**
     * Student tasks.
     */
    public function tasks()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        return view('frontendapp.tasks');
    }

    /**
     * Student challenges.
     */
    public function challenges()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        return view('frontendapp.challenges');
    }

    /**
     * Student habits.
     */
    public function habits()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        return view('frontendapp.habits');
    }

    /**
     * Student achievements.
     */
    public function achievements()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        return view('frontendapp.achievements');
    }

    /**
     * Get authenticated student data for views
     */
    public function getStudentData()
    {
        $studentId = Session::get('student_id');
        
        if (!$studentId) {
            return null;
        }

        $student = Student::find($studentId);
        
        if (!$student) {
            return null;
        }

        // Generate initials from full_name
        $nameParts = explode(' ', trim($student->full_name ?? ''));
        $initials = '';
        foreach ($nameParts as $part) {
            if (!empty($part)) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
        }
        
        return [
            'id' => $student->id,
            'name' => $student->full_name,
            'email' => $student->email,
            'phone' => $student->phone_number,
            'profile_picture' => $student->profile_picture ?? null,
            'initials' => $initials ?: 'U'
        ];
    }

    /**
     * Submit habit with image.
     */
    public function submitHabit(Request $request)
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        $request->validate([
            'habit_id' => 'required|exists:habits,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'datestamp' => 'required'
        ]);

        $student = Student::find(Session::get('student_id'));
        
        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $student->id . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('habit_submissions', $imageName, 'public');
        }

        // Insert into habit_student_submissions table
        DB::table('habit_student_submissions')->insert([
            'habit_id' => $request->habit_id,
            'student_id' => $student->id,
            'image' => $imagePath,
            'datestamp' => $request->datestamp,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('mobile.dashboard')->with('success', 'Habit completed successfully!');
    }

    /**
     * Student performance page.
     */
    public function performance()
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        $student = Student::find(Session::get('student_id'));
        

        
        // Get student's reviewed task responses
        $reviewedResponses = StudentTaskResponse::where('student_id', $student->id)
            ->where('status', 'reviewed')
            ->with(['task', 'challenge', 'batch'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get corresponding evaluation results from yashodarshi_evaluation_results
        $evaluationResults = collect();
        foreach ($reviewedResponses as $response) {
            $evaluation = YashodarshiEvaluationResult::where('student_id', $student->id)
                ->where('task_id', $response->task_id)
                ->where('batch_id', $response->batch_id)
                ->where('challenge_id', $response->challenge_id)
                ->with(['task', 'challenge'])
                ->first();
            
            if ($evaluation) {
                $evaluationResults->push($evaluation);
            }
        }
        
        // Get all tasks for the student's challenge/batch
        $allTasks = collect();
        if ($reviewedResponses->isNotEmpty()) {
            $challengeIds = $reviewedResponses->pluck('challenge_id')->unique();
            $allTasks = Task::with(['challenges'])
                ->whereHas('challenges', function($query) use ($challengeIds) {
                    $query->whereIn('challenges.id', $challengeIds);
                })
                ->orderBy('id')
                ->get();
        }
        
        // Calculate performance metrics
        $performanceData = $this->calculatePerformanceMetrics($student, $evaluationResults, $allTasks, $reviewedResponses);
        
        // Get student data for header
        $studentData = $this->getStudentData();
        
        return view('frontendapp.performance', compact('student', 'performanceData', 'studentData','allTasks'));
    }

    /**
     * Calculate performance metrics for the student.
     */
    private function calculatePerformanceMetrics($student, $evaluationResults, $allTasks, $reviewedResponses)
    {
      $submitstatus = StudentTaskResponse::where('student_id', $student->id)
        ->where('status', 'submitted')
        ->get();
       
        // Get task scores for all tasks
        $taskScores = [];
        foreach($allTasks as $task){

            if($task->taskScore) {
                $taskScores[] = [
                    'task_id' => $task->id,
                    'task_title' => $task->task_title,
                    'aptitude_score' => $task->taskScore->aptitude_score ?? 0,
                    'attitude_score' => $task->taskScore->attitude_score ?? 0,
                    'communication_score' => $task->taskScore->communication_score ?? 0,
                    'execution_score' => $task->taskScore->execution_score ?? 0,
                    'total_score' => $task->taskScore->total_score ?? 0
                ];

            }
        }
     
        $alltasktotalscore=[];
        foreach($allTasks as $task){
            if($evaluationResults->where('task_id', $task->id)->first())
            {$alltasktotalscore[$task->id]=[
            'Student_total_score'=>$evaluationResults->where('task_id', $task->id)->first()->total_score ?? 0
                ];    
            }
        }
       

        


     // Get task scores for all completed tasks
     $completedTaskScores = [];
     $totalAptitudeScore = 0;
     $totalAttitudeScore = 0;
     $totalCommunicationScore = 0;
     $totalExecutionScore = 0;  
     $totalScore = 0;
     $studentAptitudeTotal = 0;
     $studentAttitudeTotal = 0;
     $studentCommunicationTotal = 0;
     $studentExecutionTotal = 0;
     $studentTotalScore = 0;    

     foreach($evaluationResults as $evaluation) {
    
         $taskScore = collect($taskScores)->where('task_id', $evaluation->task_id)->first();

         if($taskScore) {
            $totalAptitudeScore += $taskScore['aptitude_score'];
            $totalAttitudeScore += $taskScore['attitude_score'];
            $totalCommunicationScore += $taskScore['communication_score'];
            $totalExecutionScore += $taskScore['execution_score'];
            $totalScore += $taskScore['total_score'];
            $studentAptitudeTotal += $evaluation->aptitude_score;
            $studentAttitudeTotal += $evaluation->attitude_score;
            $studentCommunicationTotal += $evaluation->communication_score;
            $studentExecutionTotal += $evaluation->execution_score;
            $studentTotalScore += $evaluation->total_score; 

             $completedTaskScores[] = [
                 'task_id' => $evaluation->task_id,
                 'task_title' => $taskScore['task_title'],
                 'student_aptitude_score' => $evaluation->aptitude_score,
                 'student_attitude_score' => $evaluation->attitude_score,
                 'student_communication_score' => $evaluation->communication_score,
                 'student_execution_score' => $evaluation->execution_score,
                 'student_total_score' => $evaluation->total_score,
                 'max_aptitude_score' => $taskScore['aptitude_score'],
                 'max_attitude_score' => $taskScore['attitude_score'],
                 'max_communication_score' => $taskScore['communication_score'],
                 'max_execution_score' => $taskScore['execution_score'],
                 'max_total_score' => $taskScore['total_score']
             ];
         }
     }

    
  

        $completedTasks = $evaluationResults->count();
        $totalTasks = $allTasks->count();
        $remainingTasks = $totalTasks - $completedTasks;
        
        // Calculate total scores and percentages
        $studentTotalScore = $evaluationResults->sum('total_score');
        $taskTotalScore = $completedTasks * 100; // Assuming each task is out of 100
        $avgTotal = $taskTotalScore > 0 ? ($studentTotalScore / $taskTotalScore) * 100 : 0;
        
        // Calculate AACE percentages
        $studentAptitudeTotal = $evaluationResults->sum('aptitude_score');
        $studentAttitudeTotal = $evaluationResults->sum('attitude_score');
        $studentCommunicationTotal = $evaluationResults->sum('communication_score');
        $studentExecutionTotal = $evaluationResults->sum('execution_score');
        
        $maxAACEPerTask = 25; // Assuming each AACE component is out of 25
        $maxAACETotal = $completedTasks * $maxAACEPerTask;
        
        $avgAptitude = $maxAACETotal > 0 ? ($studentAptitudeTotal / $maxAACETotal) * 100 : 0;
        $avgAttitude = $maxAACETotal > 0 ? ($studentAttitudeTotal / $maxAACETotal) * 100 : 0;
        $avgCommunication = $maxAACETotal > 0 ? ($studentCommunicationTotal / $maxAACETotal) * 100 : 0;
        $avgExecution = $maxAACETotal > 0 ? ($studentExecutionTotal / $maxAACETotal) * 100 : 0;
        
        // Calculate total possible score and current score
        $maxScorePerTask = 100; // Assuming max score is 100 per task
        $totalPossibleScore = $totalTasks * $maxScorePerTask;
        $currentScore = $evaluationResults->sum('total_score');
        $maxPossibleForCompleted = $completedTasks * $maxScorePerTask;
        
        // Get highest task score and convert to percentage
        $highestScore = $evaluationResults->max('total_score') ?? 0;
        $highestScoreTask = $evaluationResults->where('total_score', $highestScore)->first();
        
        // Find the corresponding task score for the highest scoring task
        $highestTaskScore = collect($taskScores)->where('task_id', $highestScoreTask->task_id ?? 0)->first();
        $highestTaskTotalScore = $highestTaskScore['total_score'] ?? 100;
        
        $highestScorePercentage = round($highestTaskTotalScore > 0 ? ($highestScore / $highestTaskTotalScore) * 100 : 0, 0);
       
        // Calculate leaderboard position (mock data for now)
        $leaderboardPosition = 3; // This would need actual leaderboard calculation
        


        // Add completed tasks
        foreach ($evaluationResults as $result) {
            $taskScorePercentage = ($result->total_score / 100) * 100; // Convert to percentage
            $taskHistory[] = [
                'task_id'=>$result->task_id,
                'task_number' => $this->getTaskNumber($result->task_id, $allTasks),
                'task_title' => $result->task->task_title ?? 'Unknown Task',
                'task_description' => $result->task->task_description ?? '',
                'status' => 'completed',
                'score' => round($taskScorePercentage, 0),
                'submitted_at' => $result->evaluated_at->format('F j, Y \a\t H:i'),
                'border_color' => $this->getScoreBorderColor($taskScorePercentage),
                'total_score'=>$result->task->taskScore->total_score ?? 0
            ];
        }
        
        // Add submitted tasks (pending evaluation)
        foreach ($submitstatus as $submittedTask) {
            // Check if this task is not already in completed tasks
            if (!$evaluationResults->contains('task_id', $submittedTask->task_id)) {
                $taskHistory[] = [
                    'task_number' => $this->getTaskNumber($submittedTask->task_id, $allTasks),
                    'task_title' => $submittedTask->task->task_title ?? 'Unknown Task',
                    'task_description' => $submittedTask->task->task_description ?? '',
                    'status' => 'submitted',
                    'score' => null,
                    'submitted_at' => $submittedTask->submitted_at ? $submittedTask->submitted_at->format('F j, Y \a\t H:i') : 'Recently',
                    'border_color' => null,
                    'total_score'=>$submittedTask->task->taskScore->total_score ?? 0
                ];
            }
        }
        
        // Remove upcoming tasks section - only show attended tasks
        
        // Sort task history by task number
        usort($taskHistory, function($a, $b) {
            return $b['task_number'] - $a['task_number']; // Reverse order (latest first)
        });
        
        return [
            'student_name' => strtoupper($student->full_name ?? 'STUDENT'),
            'completed_tasks' => $completedTasks,
            'total_tasks' => $totalTasks,
            'remaining_tasks' => $remainingTasks,
            'highestScorePercentage' => $highestScorePercentage,
            'avg_score' => round($avgTotal, 0),
            'highest_score' => round($highestScorePercentage, 0),
            'highest_score_task' => $highestScoreTask->task->task_title ?? 'N/A',
            'leaderboard_position' => $leaderboardPosition,
            'current_score' => round($currentScore, 0),
            'total_possible_score' => $totalPossibleScore,
            'max_possible_for_completed' => $maxPossibleForCompleted,
            'progress_percentage' => $totalPossibleScore > 0 ? round(($currentScore / $totalPossibleScore) * 100, 1) : 0,
            'completed_progress_percentage' => $totalTasks > 0 ? round(($maxPossibleForCompleted / $totalPossibleScore) * 100, 1) : 0,
            'taskScores' => $taskScores,
            'completedTaskScores' => $completedTaskScores,
            'aace_scores' => [
                'aptitude' => round($avgAptitude, 0),
                'attitude' => round($avgAttitude, 0),
                'communication' => round($avgCommunication, 0),
                'execution' => round($avgExecution, 0)
            ],
            'task_history' => $taskHistory,
            'total_aptitude_score' => $totalAptitudeScore,
            'total_attitude_score' => $totalAttitudeScore,
            'total_communication_score' => $totalCommunicationScore,
            'total_execution_score' => $totalExecutionScore,
            'total_score' => $totalScore,
            'student_aptitude_total' => $studentAptitudeTotal,
            'student_attitude_total' => $studentAttitudeTotal,
            'student_communication_total' => $studentCommunicationTotal,
            'student_execution_total' => $studentExecutionTotal,
            'student_total_score' => $studentTotalScore,
           'alltasktotalscore'=>$alltasktotalscore
        ];
    }
    
    /**
     * Get task number based on task ID and all tasks.
     */
    private function getTaskNumber($taskId, $allTasks)
    {
        $task = $allTasks->where('id', $taskId)->first();
        if (!$task) return 0;
        
        // Find the position of this task in the ordered list
        $orderedTasks = $allTasks->sortBy('id');
        $position = 1;
        foreach ($orderedTasks as $t) {
            if ($t->id == $taskId) {
                return $position;
            }
            $position++;
        }
        return 0;
    }
    
    /**
     * Get border color based on score.
     */
    private function getScoreBorderColor($score)
    {
        if ($score >= 90) {
            return '#22C55E'; // Green
        } elseif ($score >= 70) {
            return '#FFC107'; // Amber
        } else {
            return '#EF4444'; // Red
        }
    }

    /**
     * Show performance detail for a specific task.
     */
    public function performanceDetail($taskId)
    {
        if (!Session::get('student_logged_in')) {
            return redirect()->route('mobile.login');
        }

        $student = Student::find(Session::get('student_id'));
        
        // Get the specific evaluation result for this task
        $evaluationResult = YashodarshiEvaluationResult::where('student_id', $student->id)
            ->where('task_id', $taskId)
            ->with(['task', 'challenge'])
            ->first();
            
      
        if (!$evaluationResult) {
            return redirect()->route('mobile.performance')->with('error', 'Task performance not found');
        }
        
        // Get task score for maximum scores
        $taskScore = TaskScore::where('task_id', $taskId)->first();
        
        // Get all tasks to determine task number
        $allTasks = Task::with(['challenges'])
            ->whereHas('challenges', function($query) use ($evaluationResult) {
                $query->where('challenges.id', $evaluationResult->challenge_id);
            })
            ->orderBy('id')
            ->get();
        
        // Calculate task number
        $taskNumber = $this->getTaskNumber($taskId, $allTasks);
        
        // Get student data for header
        $studentData = $this->getStudentData();
        
        // Prepare performance detail data
        $performanceDetail = [
            'task_id' => $taskId,
            'task_number' => $taskNumber,
            'task_title' => $evaluationResult->task->task_title ?? 'Unknown Task',
            'task_description' => $evaluationResult->task->task_description ?? 'No description available',
            'evaluated_at' => $evaluationResult->evaluated_at->format('F j, Y'),
            'student_scores' => [
                'aptitude' => $evaluationResult->aptitude_score,
                'attitude' => $evaluationResult->attitude_score,
                'communication' => $evaluationResult->communication_score,
                'execution' => $evaluationResult->execution_score,
                'total' => $evaluationResult->total_score
            ],
            'max_scores' => [
                'aptitude' => $taskScore->aptitude_score ?? 25,
                'attitude' => $taskScore->attitude_score ?? 25,
                'communication' => $taskScore->communication_score ?? 25,
                'execution' => $taskScore->execution_score ?? 25,
                'total' => $taskScore->total_score ?? 100
            ],
            'percentages' => [
                'aptitude' => $taskScore && $taskScore->aptitude_score > 0 ? round(($evaluationResult->aptitude_score / $taskScore->aptitude_score) * 100, 1) : 0,
                'attitude' => $taskScore && $taskScore->attitude_score > 0 ? round(($evaluationResult->attitude_score / $taskScore->attitude_score) * 100, 1) : 0,
                'communication' => $taskScore && $taskScore->communication_score > 0 ? round(($evaluationResult->communication_score / $taskScore->communication_score) * 100, 1) : 0,
                'execution' => $taskScore && $taskScore->execution_score > 0 ? round(($evaluationResult->execution_score / $taskScore->execution_score) * 100, 1) : 0,
                'total' => $taskScore && $taskScore->total_score > 0 ? round(($evaluationResult->total_score / $taskScore->total_score) * 100, 1) : 0
            ],
            'evaluator_comment' => $evaluationResult->evaluator_comment ?? 'No comment available',
            'audio_feedback_url' => $evaluationResult->audio_feedback_url ?? null, 
            'feedback'=>$evaluationResult->feedback,
            'attribute_scores' => $evaluationResult->attribute_scores
           
        ];
        
        return view('frontendapp.performance-detail', compact('student', 'performanceDetail', 'studentData'));
    }

    /**
     * Logout student.
     */
    public function logout()
    {
        Session::forget(['student_logged_in', 'student_id', 'student_email', 'student_name']);
        return redirect()->route('mobile.splash')->with('message', 'Logged out successfully');
    }
}
