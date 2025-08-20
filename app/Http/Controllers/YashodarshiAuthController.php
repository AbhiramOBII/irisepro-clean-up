<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OtpService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Yashodarshi;
use App\Models\Task;
use App\Models\Batch;
use App\Models\StudentTaskResponse;
use App\Models\YashodarshiEvaluationResult;
use App\Models\TaskScore;

class YashodarshiAuthController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Show the login form
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // If already logged in, redirect to dashboard
        if (Session::get('yashodarshi_logged_in')) {
            return redirect()->route('yashodarshi.dashboard');
        }

        return view('yashodarshi.auth.login');
    }

    /**
     * Send OTP to yashodarshi's email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $result = $this->otpService->sendOtp($request->email);

        if ($result['success']) {
            Session::put('yashodarshi_email', $request->email);
            Session::put('yashodarshi_id', $result['yashodarshi_id']);
            
            return redirect()->route('yashodarshi.verify-otp')
                           ->with('success', $result['message']);
        } else {
            return back()->with('error', $result['message'])->withInput();
        }
    }

    /**
     * Show OTP verification form
     *
     * @return \Illuminate\Http\Response
     */
    public function showOtpForm()
    {
        if (!Session::get('yashodarshi_email')) {
            return redirect()->route('yashodarshi.login')
                           ->with('error', 'Please enter your email first');
        }

        return view('yashodarshi.auth.verify-otp');
    }

    /**
     * Verify OTP and login yashodarshi
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $yashodarshiId = Session::get('yashodarshi_id');
        if (!$yashodarshiId) {
            return redirect()->route('yashodarshi.login')
                           ->with('error', 'Session expired. Please try again.');
        }

        $result = $this->otpService->verifyOtp($yashodarshiId, $request->otp);

        if ($result['success']) {
            // Set session data for logged in yashodarshi
            Session::put('yashodarshi_logged_in', true);
            Session::put('yashodarshi_data', $result['yashodarshi']);
            
            // Clear temporary session data
            Session::forget(['yashodarshi_email', 'yashodarshi_id']);

            return redirect()->route('yashodarshi.dashboard')
                           ->with('success', 'Welcome back, ' . $result['yashodarshi']->name);
        } else {
            return back()->with('error', $result['message']);
        }
    }

    /**
     * Resend OTP
     *
     * @return \Illuminate\Http\Response
     */
    public function resendOtp()
    {
        $email = Session::get('yashodarshi_email');
        if (!$email) {
            return redirect()->route('yashodarshi.login')
                           ->with('error', 'Session expired. Please try again.');
        }

        $result = $this->otpService->sendOtp($email);

        if ($result['success']) {
            Session::put('yashodarshi_id', $result['yashodarshi_id']);
            return back()->with('success', 'OTP resent successfully');
        } else {
            return back()->with('error', $result['message']);
        }
    }

    /**
     * Logout yashodarshi
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Session::forget(['yashodarshi_logged_in', 'yashodarshi_data']);
        return redirect()->route('yashodarshi.login')
                       ->with('success', 'Logged out successfully');
    }

    /**
     * Show yashodarshi dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (!Session::get('yashodarshi_logged_in')) {
            return redirect()->route('yashodarshi.login');
        }

        $yashodarshi = Session::get('yashodarshi_data');
        
        // Get fresh yashodarshi data with batches
        $yashodarshiWithBatches = Yashodarshi::with(['batches.challenge', 'batches.students'])
                                                  ->find($yashodarshi->id);
        
        // Calculate statistics
        $totalBatches = $yashodarshiWithBatches->batches->count();
        $activeBatches = $yashodarshiWithBatches->batches->where('status', 'active')->count();
        $ongoingBatches = $yashodarshiWithBatches->batches->where('status', 'ongoing')->count();
        $totalStudents = $yashodarshiWithBatches->batches->sum(function($batch) {
            return $batch->students->count();
        });

        return view('yashodarshi.dashboard', compact(
            'yashodarshi', 
            'yashodarshiWithBatches', 
            'totalBatches', 
            'activeBatches', 
            'ongoingBatches', 
            'totalStudents'
        ));
    }

    /**
     * View specific batch details for yashodarshi
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewBatch($id)
    {
        if (!Session::get('yashodarshi_logged_in')) {
            return redirect()->route('yashodarshi.login');
        }

        $yashodarshi = Session::get('yashodarshi_data');
        
        // Get batch with all related data, ensuring it belongs to this yashodarshi
        $batch = Batch::with([
            'challenge.tasks',
            'students',
            'yashodarshi'
        ])->where('yashodarshi_id', $yashodarshi->id)
          ->findOrFail($id);

        return view('yashodarshi.batch.view', compact('batch', 'yashodarshi'));
    }

    /**
     * Task evaluation portal for yashodarshi
     *
     * @param  int  $batchId
     * @param  int  $taskId
     * @return \Illuminate\Http\Response
     */
    public function evaluateTask($batchId, $taskId)
    {
        if (!Session::get('yashodarshi_logged_in')) {
            return redirect()->route('yashodarshi.login');
        }
        $task = Task::find($taskId);
        $batch = Batch::find($batchId);
        
       $yashodarshiEvaluationResults = YashodarshiEvaluationResult::where('batch_id', $batchId)
                                                                        ->where('task_id', $taskId)
                                                                        ->get();
                
       $yashodarshi = Session::get('yashodarshi_data');
        
        // Get batch ensuring it belongs to this yashodarshi
        $batch = Batch::where('yashodarshi_id', $yashodarshi->id)
                          ->findOrFail($batchId);

        // Get student submissions for this task and batch with evaluation results
        $submissions = StudentTaskResponse::with(['student', 'yashodarshiEvaluationResult'])
                                               ->where('batch_id', $batchId)
                                               ->where('task_id', $taskId)
                                               ->get();
        
        return view('yashodarshi.task.evaluate', compact('batch', 'task', 'submissions', 'yashodarshi', 'yashodarshiEvaluationResults'));
    }

    /**
     * Submit evaluation for a student task submission
     *
     * @param  int  $submissionId
     * @return \Illuminate\Http\Response
     */
    public function submitEvaluation(Request $request, $submissionId)
    {
        if (!Session::get('yashodarshi_logged_in')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $yashodarshi = Session::get('yashodarshi_data');
        
        // Validate input
        $request->validate([
            'score' => 'required|numeric|min:0',
            'feedback' => 'nullable|string|max:1000',
            'status' => 'required|in:reviewed,submitted'
        ]);

        // Get submission and verify yashodarshi has access to this batch
        $submission = StudentTaskResponse::with('batch')
                                              ->findOrFail($submissionId);
        
        if ($submission->batch->yashodarshi_id != $yashodarshi->id) {
            return response()->json(['error' => 'Unauthorized access to this submission'], 403);
        }

        // Update submission with evaluation
        $submission->update([
            'score' => $request->score,
            'feedback' => $request->feedback,
            'status' => $request->status,
            'evaluated_at' => now(),
            'evaluated_by' => $yashodarshi->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Evaluation saved successfully'
        ]);
    }

    /**
     * Show detailed evaluation form for a submission
     *
     * @param  int  $submissionId
     * @return \Illuminate\Http\Response
     */
    public function evaluateDetail($submissionId)
    {
        if (!Session::get('yashodarshi_logged_in')) {
            return redirect()->route('yashodarshi.login');
        }

        $yashodarshi = Session::get('yashodarshi_data');
        
        // Get submission with all related data
        $submission = StudentTaskResponse::with(['student', 'batch', 'task.taskscore'])
                                              ->findOrFail($submissionId);
        
        // Verify yashodarshi has access to this batch
        if ($submission->batch->yashodarshi_id != $yashodarshi->id) {
            abort(403, 'Unauthorized access to this submission');
        }

        // Get task scoring framework (attribute weights)
        $taskScore = $submission->task->taskscore;
        $attributeWeights = $taskScore ? $taskScore->attribute_score : [];
        $maxScore = $taskScore ? $taskScore->total_score : 0;
      
        return view('yashodarshi.task.evaluate-detail', compact('submission', 'yashodarshi', 'attributeWeights', 'maxScore'));
    }

    /**
     * Submit detailed evaluation with attribute scores
     *
     * @param  Request  $request
     * @param  int  $submissionId
     * @return \Illuminate\Http\Response
     */
    public function submitDetailedEvaluation(Request $request, $submissionId)
    {
        if (!Session::get('yashodarshi_logged_in')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $yashodarshi = Session::get('yashodarshi_data');
        
        // Get submission and task scoring framework first
        $submission = StudentTaskResponse::with(['batch', 'task.taskscore'])
                                              ->findOrFail($submissionId);
        
        if ($submission->batch->yashodarshi_id != $yashodarshi->id) {
            return response()->json(['error' => 'Unauthorized access to this submission'], 403);
        }

        // Get attribute weights for validation
        $taskScore = $submission->task->taskscore;
        $attributeWeights = $taskScore ? $taskScore->attribute_score : [];

        // Build dynamic validation rules based on attribute weights
        $validationRules = [
            'attribute_scores' => 'required|array',
            'feedback' => 'nullable|string|max:2000',
            'status' => 'required|in:reviewed,submitted'
        ];

        // Add specific validation for each attribute with its maximum score
        foreach ($attributeWeights as $mainAttribute => $subAttributes) {
            if (is_array($subAttributes)) {
                // Handle nested attributes
                foreach ($subAttributes as $subAttribute => $maxScore) {
                    $validationRules["attribute_scores.{$mainAttribute}.{$subAttribute}"] = "required|numeric|min:0|max:{$maxScore}";
                }
            } else {
                // Handle direct attributes
                $validationRules["attribute_scores.{$mainAttribute}"] = "required|numeric|min:0|max:{$subAttributes}";
            }
        }

        // Validate input with dynamic rules
        $request->validate($validationRules);

        // Calculate total score from attribute scores (handle nested structure)
        $attributeScores = $request->attribute_scores;
        $totalScore = 0;
        
        foreach ($attributeScores as $mainAttribute => $scores) {
            if (is_array($scores)) {
                // Nested attributes - sum all sub-attribute scores
                $totalScore += array_sum($scores);
            } else {
                // Direct attribute - add the score directly
                $totalScore += $scores;
            }
        }

        // Update submission with detailed evaluation
        $submission->update([
            'attribute_scores' => $attributeScores,
            'score' => $totalScore,
            'feedback' => $request->feedback,
            'status' => $request->status,
            'evaluated_at' => now(),
            'evaluated_by' => $yashodarshi->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Detailed evaluation saved successfully',
            'total_score' => $totalScore
        ]);
    }

    /**
     * Store detailed evaluation results in yashodarshi_evaluation_results table
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $submissionId
     * @return \Illuminate\Http\Response
     */
    public function storeEvaluationResult(Request $request, $submissionId)
    {
     
        // Check yashodarshi authentication
        if (!Session::get('yashodarshi_logged_in')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $yashodarshi = Session::get('yashodarshi_data');
        
        // Get the submission with related data
        $submission = StudentTaskResponse::with(['batch', 'task', 'student'])
                                              ->findOrFail($submissionId);

        // Verify yashodarshi has access to this batch
        $batch = Batch::where('yashodarshi_id', $yashodarshi->id)
                          ->findOrFail($submission->batch_id);

        // Get task scoring framework
        $taskScore = TaskScore::where('task_id', $submission->task_id)->first();
        $attributeWeights = [];
        if ($taskScore) {
            if (is_string($taskScore->attribute_score)) {
                $attributeWeights = json_decode($taskScore->attribute_score, true) ?: [];
            } elseif (is_array($taskScore->attribute_score)) {
                $attributeWeights = $taskScore->attribute_score;
            }
        }

        // Validation rules
        $validationRules = [
            'attribute_scores' => 'required|array',
            'feedback' => 'nullable|string|max:2000',
            'status' => 'required|in:draft,submitted,reviewed'
        ];

        // Add specific validation for each attribute with its maximum score
        foreach ($attributeWeights as $mainAttribute => $subAttributes) {
            if (is_array($subAttributes)) {
                foreach ($subAttributes as $subAttribute => $maxScore) {
                    if ($maxScore > 0) {
                        $validationRules["attribute_scores.{$mainAttribute}.{$subAttribute}"] = "required|numeric|min:0|max:{$maxScore}";
                    }
                }
            } else {
                if ($subAttributes > 0) {
                    $validationRules["attribute_scores.{$mainAttribute}"] = "required|numeric|min:0|max:{$subAttributes}";
                }
            }
        }

        // Validate input
        $request->validate($validationRules);

        // Calculate individual category scores and total
        $attributeScores = $request->attribute_scores;
        $aptitudeScore = 0;
        $attitudeScore = 0;
        $communicationScore = 0;
        $executionScore = 0;
        $totalScore = 0;

        foreach ($attributeScores as $mainAttribute => $scores) {
            $categoryTotal = 0;
            
            if (is_array($scores)) {
                // Nested attributes - sum all sub-attribute scores
                $categoryTotal = array_sum($scores);
            } else {
                // Direct attribute - use the score directly
                $categoryTotal = $scores;
            }

            // Assign to appropriate category
            switch (strtolower($mainAttribute)) {
                case 'aptitude':
                    $aptitudeScore = $categoryTotal;
                    break;
                case 'attitude':
                    $attitudeScore = $categoryTotal;
                    break;
                case 'communication':
                    $communicationScore = $categoryTotal;
                    break;
                case 'execution':
                    $executionScore = $categoryTotal;
                    break;
            }
            
            $totalScore += $categoryTotal;
        }

        // Create or update evaluation result
        $evaluationResult = YashodarshiEvaluationResult::updateOrCreate(
            [
                'batch_id' => $submission->batch_id,
                'task_id' => $submission->task_id,
                'student_id' => $submission->student_id,
                'yashodarshi_id' => $yashodarshi->id
            ],
            [
                'challenge_id' => $submission->challenge_id,
                'attribute_scores' => $attributeScores,
                'aptitude_score' => $aptitudeScore,
                'attitude_score' => $attitudeScore,
                'communication_score' => $communicationScore,
                'execution_score' => $executionScore,
                'total_score' => $totalScore,
                'feedback' => $request->feedback,
                'status' => $request->status,
                'evaluated_at' => now()
            ]
        );

        // Update only the basic fields in the original submission record
        $submission->update([
        
            'status' => 'reviewed'
        ]);

        return redirect()->route('yashodarshi.task.evaluate', [
            'batchId' => $submission->batch_id, 
            'taskId' => $submission->task_id
        ])->with('success', 'Evaluation stored successfully! Total Score: ' . $totalScore . ' (Aptitude: ' . $aptitudeScore . ', Attitude: ' . $attitudeScore . ', Communication: ' . $communicationScore . ', Execution: ' . $executionScore . ')');
    }

    /**
     * View full evaluation score and details for a reviewed submission
     *
     * @param  int  $submissionId
     * @return \Illuminate\Http\Response
     */
    public function viewFullScore($submissionId)
    {
        if (!Session::get('yashodarshi_logged_in')) {
            return redirect()->route('yashodarshi.login');
        }

        $yashodarshi = Session::get('yashodarshi_data');
        
        // Get submission with all related data
        $submission = StudentTaskResponse::with(['student', 'batch', 'task.taskscore'])
                                              ->findOrFail($submissionId);
        
        // Verify yashodarshi has access to this batch
        if ($submission->batch->yashodarshi_id != $yashodarshi->id) {
            abort(403, 'Unauthorized access to this submission');
        }

        // Get the evaluation result
        $evaluationResult = YashodarshiEvaluationResult::where('batch_id', $submission->batch_id)
                                                            ->where('task_id', $submission->task_id)
                                                            ->where('student_id', $submission->student_id)
                                                            ->where('yashodarshi_id', $yashodarshi->id)
                                                            ->first();

        // Get task scoring framework (attribute weights)
        $taskScore = $submission->task->taskscore;
        $attributeWeights = $taskScore ? $taskScore->attribute_score : [];
        $maxScore = $taskScore ? $taskScore->total_score : 0;
      
        return view('yashodarshi.task.view-full-score', compact('submission', 'yashodarshi', 'evaluationResult', 'attributeWeights', 'maxScore'));
    }
}
