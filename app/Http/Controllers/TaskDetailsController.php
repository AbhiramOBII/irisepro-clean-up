<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\Challenge;
use App\Models\Batch;
use App\Models\Student;
use App\Models\StudentTaskResponse;
use Illuminate\Support\Facades\Auth;

class TaskDetailsController extends Controller
{
    /**
     * Display task details page
     */
    public function show($batch_id, $task_id)
    {

        // Get student ID from session
        $student = Auth::guard('student')->user();

        // Get student's batch information
        $batch = Batch::find($batch_id);


        if (!$batch) {
            abort(404, 'Batch not found or student not enrolled');
        }

        // Get challenge details
        $challenge = $batch->challenge;


        // Get task progress information
        $completedTaskIds = DB::table('student_task_responses')
            ->where('student_id', $student->id)
            ->where('batch_id', $batch_id)
            ->where('status', 'submitted')
            ->pluck('task_id')
            ->toArray();

        // Get the current task (first incomplete task or first task if none completed)
        $currentTask = null;
        $taskPosition = 1;

        foreach ($challenge->tasks as $index => $challengeTask) {
            if (!in_array($challengeTask->id, $completedTaskIds)) {
                $currentTask = $challengeTask;
                $taskPosition = $index + 1;
                break;
            }
        }

        // If all tasks completed, show the last task
        if (!$currentTask && $challenge->tasks->count() > 0) {
            $currentTask = $challenge->tasks->last();
            $taskPosition = $challenge->tasks->count();
        }

        if (!$currentTask) {
            abort(404, 'No tasks found for this challenge');
        }

        // Load task with related data
        $task = Task::with(['taskScore', 'challenge'])->find($currentTask->id);

        // Check if this task is available (previous tasks completed)
        $isTaskAvailable = $this->isTaskAvailable($task->id, $student->id, $challenge);

        // Check if task is already completed
        $isTaskCompleted = in_array($task->id, $completedTaskIds);

        // Get task submission if exists
        $taskSubmission = DB::table('student_task_responses')
            ->where('student_id', $student->id)
            ->where('task_id', $task->id)
            ->where('batch_id', $batch_id)
            ->first();

        // Get progress data
        $progressData = [
            'completed_count' => count($completedTaskIds),
            'total_count' => $challenge->tasks->count(),
            'percentage' => round((count($completedTaskIds) / $challenge->tasks->count()) * 100, 2),
            'current_position' => $taskPosition
        ];

        return view('frontendapp.task-details', compact(
            'task',
            'student',
            'batch',
            'challenge',
            'progressData',
            'taskPosition',
            'isTaskAvailable',
            'isTaskCompleted',
            'taskSubmission'
        ));
    }

    /**
     * Check if task is available for student (sequential completion)
     */
    private function isTaskAvailable($taskId, $studentId, $challenge)
    {
        // Get student's batch information
        $batchStudent = DB::table('batch_student')
            ->where('student_id', $studentId)
            ->first();

        // Get completed tasks
        $completedTaskIds = DB::table('student_task_responses')
            ->where('student_id', $studentId)
            ->where('batch_id', $batchStudent->batch_id)
            ->where('status', 'submitted')
            ->pluck('task_id')
            ->toArray();

        // Check if all previous tasks are completed
        foreach ($challenge->tasks as $task) {
            if ($task->id == $taskId) {
                return true; // Found the task, all previous are completed
            }

            if (!in_array($task->id, $completedTaskIds)) {
                return false; // Previous task not completed
            }
        }

        return false;
    }

    /**
     * Start task timer
     */
    public function startTask(Request $request, $taskId)
    {
        $studentId = Auth::guard('student')->user()->id;

        if (!$studentId) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        // Get task and verify access
        $task = Task::find($taskId);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        // Get student's batch
        $batchStudent = DB::table('batch_student')
            ->where('student_id', $studentId)
            ->first();

        if (!$batchStudent || $task->challenge_id !== $batchStudent->challenge_id) {
            return response()->json(['error' => 'Task not accessible'], 403);
        }

        // Check if task is available
        $challenge = Challenge::with('tasks')->find($batchStudent->challenge_id);
        if (!$this->isTaskAvailable($taskId, $studentId, $challenge)) {
            return response()->json(['error' => 'Complete previous tasks first'], 403);
        }

        // Create or update task response record
        $existingResponse = DB::table('student_task_responses')
            ->where('student_id', $studentId)
            ->where('task_id', $taskId)
            ->where('batch_id', $batchStudent->batch_id)
            ->first();

        if (!$existingResponse) {
            DB::table('student_task_responses')->insert([
                'student_id' => $studentId,
                'task_id' => $taskId,
                'batch_id' => $batchStudent->batch_id,
                'status' => 'started',
                'started_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } else {
            DB::table('student_task_responses')
                ->where('id', $existingResponse->id)
                ->update([
                    'status' => 'started',
                    'started_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task started successfully',
            'started_at' => Carbon::now()->toISOString()
        ]);
    }

    /**
     * Show task submission page
     */
    public function showSubmission($taskId, $batchId)
    {

        $batch = batch::find($batchId);
        // Get student ID from session
        $student = Auth::guard('student')->user();



        // Get task details with related data
        $task = Task::with(['taskScore', 'challenge'])->find($taskId);

        // Get student's batch information
        $batchStudent = DB::table('batch_student')
            ->where('student_id', $student->id)
            ->where('batch_id', $batchId)
            ->first();

        // Get student data
        $student = Student::find($student->id);

        // Get challenge details
        $challenge =  $batch->challenge;
        $challengeId = $challenge->id;

        // Get task progress information
        $completedTaskIds = DB::table('student_task_responses')
            ->where('student_id', $student->id)
            ->where('batch_id', $batchId)
            ->where('status', 'submitted')
            ->pluck('task_id')
            ->toArray();

        // Calculate task position in challenge
        $taskPosition = 1;
        foreach ($challenge->tasks as $index => $challengeTask) {
            if ($challengeTask->id == $taskId) {
                $taskPosition = $index + 1;
                break;
            }
        }

        // Check if this task is available (previous tasks completed)
        $isTaskAvailable = $this->isTaskAvailable($taskId, $student->id, $challenge);

        // Check if task is already completed
        $isTaskCompleted = in_array($taskId, $completedTaskIds);

        // Get task submission if exists
        $taskSubmission = DB::table('student_task_responses')
            ->where('student_id', $student->id)
            ->where('task_id', $taskId)
            ->where('batch_id', $batchStudent->batch_id)
            ->first();

        return view('frontendapp.task-submission', compact(
            'task',
            'student',
            'challenge',
            'taskPosition',
            'isTaskAvailable',
            'isTaskCompleted',
            'taskSubmission',
            'challengeId',
            'batchId'
        ));
    }

    /**
     * Show task confirmation page
     */
    public function showConfirmation($taskId, $batchId)
    {

        // Get student ID from session
        $student = Auth::guard('student')->user();

        $batch = Batch::find($batchId);
        $challenge = $batch->challenge;
        $challengeId = $challenge->id;


        // Get task details with related data
        $task = Task::find($taskId);


        // Get student's batch information
        $batchStudent = DB::table('batch_student')
            ->where('student_id', $student->id)
            ->where('batch_id', $batchId)
            ->first();

        // Get student data
        $student = Student::find($student->id);



        // Get task progress information
        $completedTaskIds = DB::table('student_task_responses')
            ->where('student_id', $student->id)
            ->where('batch_id', $batchStudent->batch_id)
            ->where('status', 'submitted')
            ->pluck('task_id')
            ->toArray();



        // Calculate task position in challenge
        $taskPosition = 1;
        foreach ($challenge->tasks as $index => $challengeTask) {
            if ($challengeTask->id == $taskId) {
                $taskPosition = $index + 1;
                break;
            }
        }

        // Check if this task is available (previous tasks completed)
        $isTaskAvailable = $this->isTaskAvailable($taskId, $student->id, $challenge);

        // Check if task is already completed
        $isTaskCompleted = in_array($taskId, $completedTaskIds);

        // Get task submission if exists
        $taskSubmission = DB::table('student_task_responses')
            ->where('student_id', $student->id)
            ->where('task_id', $taskId)
            ->where('batch_id', $batchStudent->batch_id)
            ->first();

        return view('frontendapp.task-confirmation', compact(
            'task',
            'student',
            'challenge',
            'taskPosition',
            'isTaskAvailable',
            'isTaskCompleted',
            'taskSubmission',
            'challengeId',
            'batchId'
        ));
    }

    /**
     * Show task success page
     */
    public function showSuccess($taskId, $batchId)
    {
        // Get student ID from session
        $student = Auth::guard('student')->user();

        // Get task details with related data
        $task = Task::with(['taskScore', 'challenge'])->find($taskId);

        // Get student's batch information
        $batchStudent = DB::table('batch_student')
            ->where('student_id', $student->id)
            ->first();

        // Get student data
        $student = Student::find($student->id);

        // Get task submission
        $taskSubmission = DB::table('student_task_responses')
            ->where('student_id', $student->id)
            ->where('task_id', $taskId)
            ->where('batch_id', $batchStudent->batch_id)
            ->where('status', 'submitted')
            ->first();

        // If no submission found, redirect to task details
        if (!$taskSubmission) {
            return redirect()->route('mobile.task.details', $taskId);
        }

        return view('frontendapp.task-success', compact(
            'task',
            'student',
            'taskSubmission'
        ));
    }

    /**
     * Submit task completion
     */
    public function submitTask(Request $request, $taskId, $batchId)
    {
        $batch = Batch::find($batchId);

        $student = Auth::guard('student')->user();

        if (!$student) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        // Validate request
        $request->validate([
            'submission_response' => 'nullable|string',
            'submission_multimedia.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov,pdf,doc,docx|max:256000',
            'started_at' => 'nullable|string',
        ]);





        // Get task and verify access
        $task = Task::find($taskId);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        // Get challenge_id and batch_id from form
        $challengeId = $batch->challenge_id;

        $batchId = $request->batch_id;

        // Verify student is enrolled in the specified batch
        $batchStudent = DB::table('batch_student')
            ->where('student_id', $student->id)
            ->where('batch_id', $batchId)
            ->first();

        if (!$batchStudent) {
            return response()->json(['error' => 'Student not enrolled in specified batch'], 403);
        }

        // Handle file uploads if present
        $filePaths = [];
        if ($request->hasFile('submission_multimedia')) {
            foreach ($request->file('submission_multimedia') as $file) {
                $fileName = time() . '_' . $student->id . '_' . $taskId . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('task_responses', $fileName, 'public');
                $filePaths[] = $filePath;
            }
        }

        //do a simple save using ORM Method--> 
        $studentTaskResponse = new StudentTaskResponse();
        $studentTaskResponse->batch_id = $batchId;
        $studentTaskResponse->student_id = $student->id;
        $studentTaskResponse->challenge_id = $challengeId;
        $studentTaskResponse->task_id = $taskId;
        $studentTaskResponse->submission_response = $request->submission_response;
        $studentTaskResponse->submission_multimedia = json_encode($filePaths);
        $studentTaskResponse->started_at = $request->started_at;
        $studentTaskResponse->submitted_at = Carbon::now();
        $studentTaskResponse->status = 'submitted';
        $studentTaskResponse->save();

        // For traditional form submission, redirect to success page
        return redirect()->route('mobile.task.success', ['taskId' => $taskId, 'batch_id' => $batchId])->with('success', 'Task submitted successfully!');
    }
}
