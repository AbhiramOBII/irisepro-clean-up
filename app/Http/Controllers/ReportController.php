<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Batch;
use App\Models\YashodarshiEvaluationResult;
use App\Models\StudentTaskResponse;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard
     */
    public function index()
    {
        $batches = Batch::with('students')->get();
        $totalStudents = Student::count();
        $totalBatches = Batch::count();
        $totalEvaluations = YashodarshiEvaluationResult::count();
        

        return view('superadmin.reports.index', compact(
            'batches', 
            'totalStudents', 
            'totalBatches', 
            'totalEvaluations'
        ));
    }

    /**
     * Display student scores by batch
     */
    public function studentScores(Request $request)
    {
        $batchId = $request->get('batch_id');
        $batches = Batch::all();
        
        // Get batch title if batch ID is provided
        $batchtitle = $batchId ? Batch::find($batchId)?->batch_name : null;
        
        $query = Student::with(['yashodarshiEvaluationResults.task', 'batches'])
            ->whereHas('batches');
            
        if ($batchId) {
            $query->whereHas('batches', function($q) use ($batchId) {
                $q->where('batches.id', $batchId);
            });
        }
        
        $students = $query->get();
        
        // Calculate performance metrics for each student
        $studentsData = $students->map(function($student) {
            $evaluations = $student->yashodarshiEvaluationResults;
            
            $totalScore = $evaluations->sum('total_score');
            $aptitudeScore = $evaluations->sum('aptitude_score');
            $attitudeScore = $evaluations->sum('attitude_score');
            $communicationScore = $evaluations->sum('communication_score');
            $executionScore = $evaluations->sum('execution_score');
            $completedTasks = $evaluations->count();
            
            // Get average scores
            $avgTotal = $completedTasks > 0 ? round($totalScore / $completedTasks, 2) : 0;
            $avgAptitude = $completedTasks > 0 ? round($aptitudeScore / $completedTasks, 2) : 0;
            $avgAttitude = $completedTasks > 0 ? round($attitudeScore / $completedTasks, 2) : 0;
            $avgCommunication = $completedTasks > 0 ? round($communicationScore / $completedTasks, 2) : 0;
            $avgExecution = $completedTasks > 0 ? round($executionScore / $completedTasks, 2) : 0;
            
            return [
                'student' => $student,
                'total_score' => $totalScore,
                'avg_total' => $avgTotal,
                'aptitude_score' => $aptitudeScore,
                'avg_aptitude' => $avgAptitude,
                'attitude_score' => $attitudeScore,
                'avg_attitude' => $avgAttitude,
                'communication_score' => $communicationScore,
                'avg_communication' => $avgCommunication,
                'execution_score' => $executionScore,
                'avg_execution' => $avgExecution,
                'completed_tasks' => $completedTasks,
                
            ];
        });
        
        return view('superadmin.reports.student-scores', compact(
            'studentsData', 
            'batches', 
            'batchId',
            'batchtitle'
        ));
    }

    /**
     * Display batch comparison report
     */
    public function batchComparison()
    {
        $batches = Batch::with(['students.yashodarshiEvaluationResults'])->get();
        
        $batchData = $batches->map(function($batch) {
            $allEvaluations = collect();
            
            foreach($batch->students as $student) {
                $allEvaluations = $allEvaluations->merge($student->yashodarshiEvaluationResults);
            }
            
            $studentCount = $batch->students->count();
            $totalEvaluations = $allEvaluations->count();
            
            if ($totalEvaluations > 0) {
                $avgTotal = round($allEvaluations->avg('total_score'), 2);
                $avgAptitude = round($allEvaluations->avg('aptitude_score'), 2);
                $avgAttitude = round($allEvaluations->avg('attitude_score'), 2);
                $avgCommunication = round($allEvaluations->avg('communication_score'), 2);
                $avgExecution = round($allEvaluations->avg('execution_score'), 2);
            } else {
                $avgTotal = $avgAptitude = $avgAttitude = $avgCommunication = $avgExecution = 0;
            }
            
            return [
                'batch' => $batch,
                'student_count' => $studentCount,
                'total_evaluations' => $totalEvaluations,
                'avg_total' => $avgTotal,
                'avg_aptitude' => $avgAptitude,
                'avg_attitude' => $avgAttitude,
                'avg_communication' => $avgCommunication,
                'avg_execution' => $avgExecution,
                'avg_tasks_per_student' => $studentCount > 0 ? round($totalEvaluations / $studentCount, 2) : 0
            ];
        });
        
        return view('superadmin.reports.batch-comparison', compact('batchData'));
    }

    /**
     * Export student scores to CSV
     */
    public function exportStudentScores(Request $request)
    {
        $batchId = $request->get('batch_id');
        
        $query = Student::with(['yashodarshiEvaluationResults.task', 'batches'])
            ->whereHas('batches');
            
        if ($batchId) {
            $query->whereHas('batches', function($q) use ($batchId) {
                $q->where('batches.id', $batchId);
            });
        }
        
        $students = $query->get();
        
        $filename = 'student_scores_' . ($batchId ? 'batch_' . $batchId . '_' : '') . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($file, [
                'Student ID',
                'Student Name',
                'Email',
                'Batch(es)',
                'Completed Tasks',
                'Total Score',
                'Avg Total Score',
                'Aptitude Score',
                'Avg Aptitude',
                'Attitude Score',
                'Avg Attitude',
                'Communication Score',
                'Avg Communication',
                'Execution Score',
                'Avg Execution'
            ]);
            
            foreach ($students as $student) {
                $evaluations = $student->yashodarshiEvaluationResults;
                
                $totalScore = $evaluations->sum('total_score');
                $aptitudeScore = $evaluations->sum('aptitude_score');
                $attitudeScore = $evaluations->sum('attitude_score');
                $communicationScore = $evaluations->sum('communication_score');
                $executionScore = $evaluations->sum('execution_score');
                $completedTasks = $evaluations->count();
                
                $avgTotal = $completedTasks > 0 ? round($totalScore / $completedTasks, 2) : 0;
                $avgAptitude = $completedTasks > 0 ? round($aptitudeScore / $completedTasks, 2) : 0;
                $avgAttitude = $completedTasks > 0 ? round($attitudeScore / $completedTasks, 2) : 0;
                $avgCommunication = $completedTasks > 0 ? round($communicationScore / $completedTasks, 2) : 0;
                $avgExecution = $completedTasks > 0 ? round($executionScore / $completedTasks, 2) : 0;
                
                fputcsv($file, [
                    $student->id,
                    $student->full_name,
                    $student->email,
                    $student->batches->pluck('batch_name')->join(', '),
                    $completedTasks,
                    $totalScore,
                    $avgTotal,
                    $aptitudeScore,
                    $avgAptitude,
                    $attitudeScore,
                    $avgAttitude,
                    $communicationScore,
                    $avgCommunication,
                    $executionScore,
                    $avgExecution
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function allbatchdata()
    {
        $batches = Batch::with(['students', 'challenge'])->get();
        
        // Calculate statistics for each batch
        $batchData = $batches->map(function($batch) {
            $students = $batch->students;
            $totalStudents = $students->count();

           
            
            // Calculate payment statistics
            $paidStudents = $students->where('pivot.payment_status', 'paid')->count();
            $pendingPayments = $students->where('pivot.payment_status', 'pending')->count();
            $totalRevenue = $students->sum('pivot.amount');
            
            // Calculate evaluation statistics
            $totalEvaluations = YashodarshiEvaluationResult::where('batch_id', $batch->id)->count();
            $avgScore = YashodarshiEvaluationResult::where('batch_id', $batch->id)->avg('total_score') ?? 0;
            
            return [
                'batch' => $batch,
                'total_students' => $totalStudents,
                'paid_students' => $paidStudents,
                'pending_payments' => $pendingPayments,
                'total_revenue' => $totalRevenue,
                'total_evaluations' => $totalEvaluations,
                'avg_score' => round($avgScore, 2),
                'payment_completion_rate' => $totalStudents > 0 ? round(($paidStudents / $totalStudents) * 100, 1) : 0
            ];
        });

        return view('superadmin.reports.allbatchdata', compact('batchData'));
    }
}
