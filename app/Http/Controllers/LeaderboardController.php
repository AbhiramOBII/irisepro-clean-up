<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\YashodarshiEvaluationResult;
use App\Models\Batch;
use App\Models\TaskScore;
use Carbon\Carbon;
use App\Http\Controllers\MobileStudentController;

class LeaderboardController extends Controller
{
    /**
     * Show the leaderboard page.
     */
    public function index(Request $request)
    {
        if (!Auth::guard('student')->check()) {
            return redirect()->route('mobile.login');
        }

        $student = Auth::guard('student')->user();

        // Get time period filter (default to 14 days)
        $timePeriod = $request->get('period', '14days');

        // Get leaderboard data
        $leaderboardData = $this->fetchLeaderboardData($student->id, $timePeriod);

        // Get student data for header
        $studentData = app(MobileStudentController::class)->getStudentData();

        return view('frontendapp.leaderboard', compact('student', 'leaderboardData', 'studentData', 'timePeriod'));
    }

    /**
     * Get leaderboard data based on time period.
     */
    private function fetchLeaderboardData($studentId, $timePeriod)
    {
        // Determine date range based on time period
        $startDate = null;
        switch ($timePeriod) {
            case '7days':
                $startDate = Carbon::now()->subDays(7);
                break;
            case '14days':
                $startDate = Carbon::now()->subDays(14);
                break;
            case 'alltime':
                $startDate = Carbon::now()->subYears(10); // Effectively all time
                break;
            default:
                $startDate = Carbon::now()->subDays(14); // Default to 14 days
        }

        // Get current student with ongoing batch information
        $currentStudent = Student::with(['batches' => function($query) {
            $query->where('status', 'ongoing');
        }])->find($studentId);

        // Get all active students with their batch information
        $students = Student::with(['batches' => function($query) {
            $query->where('status', 'ongoing'); // Only get ongoing batches
        }])
            ->where('status', 'active')
            ->get();

        // Filter out students who don't have any ongoing batches
        $students = $students->filter(function($student) {
            return $student->batches->isNotEmpty();
        });

        // Get all batches for reference
        $batches = Batch::all()->keyBy('id');

        // Get evaluation results for all students in real-time
        // Get student IDs from filtered students (only those in ongoing batches)
        $studentIds = $students->pluck('id')->toArray();

        $evaluationResults = YashodarshiEvaluationResult::where('evaluated_at', '>=', $startDate)
            ->whereIn('student_id', $studentIds) // Only include students in ongoing batches
            ->get()
            ->groupBy('student_id');

        // Calculate scores for each student
        $leaderboardEntries = [];
        $currentUserRank = 0;
        $currentUserData = null;

        foreach ($students as $student) {
            $studentResults = $evaluationResults->get($student->id, collect());

            if ($studentResults->isEmpty()) {
                continue; // Skip students with no results
            }

            // Calculate total scores and AACE scores
            $totalScore = $studentResults->sum('total_score');

            // Get task scores for percentage calculation
            $taskScores = TaskScore::whereIn('task_id', $studentResults->pluck('task_id')->toArray())->get();
            $maxPossibleScore = $taskScores->sum('total_score');

            // Calculate percentage based on total_score from task_scores table
            $scorePercentage = $maxPossibleScore > 0 ? round(($totalScore / $maxPossibleScore) * 100, 1) : 0;

            // Calculate AACE scores
            $aptitudeScore = $studentResults->sum('aptitude_score');
            $attitudeScore = $studentResults->sum('attitude_score');
            $communicationScore = $studentResults->sum('communication_score');
            $executionScore = $studentResults->sum('execution_score');

            $maxAACEPerTask = 25; // Assuming each AACE component is out of 25
            $maxAACETotal = $studentResults->count() * $maxAACEPerTask;

            $aptitudePercentage = $maxAACETotal > 0 ? round(($aptitudeScore / $maxAACETotal) * 100, 1) : 0;
            $attitudePercentage = $maxAACETotal > 0 ? round(($attitudeScore / $maxAACETotal) * 100, 1) : 0;
            $communicationPercentage = $maxAACETotal > 0 ? round(($communicationScore / $maxAACETotal) * 100, 1) : 0;
            $executionPercentage = $maxAACETotal > 0 ? round(($executionScore / $maxAACETotal) * 100, 1) : 0;

            // Calculate change based on recent performance trend
            $recentResults = $studentResults->sortBy('evaluated_at');
            $changeDirection = 'same';
            $changePercentage = 0;
            
            if ($recentResults->count() >= 2) {
                // Compare first half vs second half of results
                $halfPoint = ceil($recentResults->count() / 2);
                $firstHalf = $recentResults->take($halfPoint);
                $secondHalf = $recentResults->skip($halfPoint);
                
                $firstHalfAvg = $firstHalf->avg('total_score');
                $secondHalfAvg = $secondHalf->avg('total_score');
                
                if ($secondHalfAvg > $firstHalfAvg) {
                    $changeDirection = 'up';
                    $changePercentage = round((($secondHalfAvg - $firstHalfAvg) / max($firstHalfAvg, 1)) * 100, 1);
                } elseif ($secondHalfAvg < $firstHalfAvg) {
                    $changeDirection = 'down';
                    $changePercentage = round((($firstHalfAvg - $secondHalfAvg) / max($firstHalfAvg, 1)) * 100, 1);
                }
            }

            // Get batch information for this student (using first batch if available)
            $currentBatch = $student->batches->first();
            $batchName = $currentBatch ? $currentBatch->title : 'No Batch';
            $batchId = $currentBatch ? $currentBatch->id : null;

            // Create entry with batch information
            $entry = [
                'student_id' => $student->id,
                'name' => $student->full_name,
                'initials' => $this->getInitials($student->full_name),
                'score_percentage' => $scorePercentage,
                'change_percentage' => abs($changePercentage),
                'change_direction' => $changeDirection,
                'joined_date' => $student->created_at->format('F Y'),
                'profile_picture' => $student->profile_picture,
                'batch_id' => $batchId,
                'batch_name' => $batchName,
                'aace_scores' => [
                    'aptitude' => $aptitudePercentage,
                    'attitude' => $attitudePercentage,
                    'communication' => $communicationPercentage,
                    'execution' => $executionPercentage
                ],
                'is_current_user' => ($student->id == $studentId)
            ];

            $leaderboardEntries[] = $entry;
        }

        // Sort by score percentage (descending)
        usort($leaderboardEntries, function($a, $b) {
            return $b['score_percentage'] <=> $a['score_percentage'];
        });

        // Get previous rankings for comparison
        $previousRankings = $this->getPreviousRankings($studentIds, $timePeriod);

        // Assign ranks and calculate rank changes
        $rank = 1;
        foreach ($leaderboardEntries as &$entry) {
            $entry['rank'] = $rank;
            
            // Calculate rank change
            $previousRank = $previousRankings[$entry['student_id']] ?? null;
            if ($previousRank !== null) {
                $rankChange = $previousRank - $rank; // Positive = moved up, Negative = moved down
                $entry['rank_change'] = $rankChange;
                $entry['rank_change_direction'] = $rankChange > 0 ? 'up' : ($rankChange < 0 ? 'down' : 'same');
                $entry['rank_change_value'] = abs($rankChange);
            } else {
                $entry['rank_change'] = 0;
                $entry['rank_change_direction'] = 'new';
                $entry['rank_change_value'] = 0;
            }

            if ($entry['is_current_user']) {
                $currentUserRank = $rank;
                $currentUserData = $entry;
            }

            $rank++;
        }

        // Get top 3 performers
        $topPerformers = array_slice($leaderboardEntries, 0, 3);

        // Get AACE ranks for current user
        $aaceRanks = [
            'aptitude' => $this->getAACERank($leaderboardEntries, $studentId, 'aptitude'),
            'attitude' => $this->getAACERank($leaderboardEntries, $studentId, 'attitude'),
            'communication' => $this->getAACERank($leaderboardEntries, $studentId, 'communication'),
            'execution' => $this->getAACERank($leaderboardEntries, $studentId, 'execution')
        ];

        // Calculate streak based on consecutive days with submissions
        $streak = $this->calculateStudentStreak($studentId);

        // Calculate weekly improvement based on real data
        $weeklyImprovement = $this->calculateWeeklyImprovement($studentId);

        // Get batch information for the current student (using first batch if available)
        $currentStudentBatch = $currentStudent->batches->first();

        return [
            'entries' => $leaderboardEntries,
            'top_performers' => $topPerformers,
            'current_user' => [
                'rank' => $currentUserRank,
                'data' => $currentUserData,
                'aace_ranks' => $aaceRanks,
                'streak' => $streak,
                'weekly_improvement' => $weeklyImprovement,
                'batch_id' => $currentStudentBatch ? $currentStudentBatch->id : null,
                'batch_name' => $currentStudentBatch ? $currentStudentBatch->title : 'No Batch'
            ],
            'time_period' => $timePeriod,
            'total_participants' => count($leaderboardEntries),
            'batches' => $batches->map(function($batch) {
                return [
                    'id' => $batch->id,
                    'name' => $batch->title
                ];
            })->values()->toArray()
        ];
    }

    /**
     * Get AACE rank for a specific component.
     */
    private function getAACERank($entries, $studentId, $component)
    {
        // Sort entries by the specific AACE component score
        $sortedEntries = collect($entries)->sortByDesc(function($entry) use ($component) {
            return $entry['aace_scores'][$component];
        })->values()->toArray();

        $rank = 1;
        $previousRank = 1;
        $previousScore = -1;
        $changeDirection = 'same';
        $changeValue = 0;

        foreach ($sortedEntries as $index => $entry) {
            if ($entry['aace_scores'][$component] != $previousScore) {
                $previousRank = $index + 1;
                $previousScore = $entry['aace_scores'][$component];
            }

            if ($entry['student_id'] == $studentId) {
                $rank = $previousRank;
                
                // Calculate AACE component rank change based on previous period
                $previousAACERankings = $this->getPreviousAACERankings(collect($entries)->pluck('student_id')->toArray(), $component);
                $previousRank = $previousAACERankings[$studentId] ?? null;
                
                if ($previousRank !== null) {
                    $rankChange = $previousRank - $rank; // Positive = moved up, Negative = moved down
                    $changeDirection = $rankChange > 0 ? 'up' : ($rankChange < 0 ? 'down' : 'same');
                    $changeValue = abs($rankChange);
                } else {
                    $changeDirection = 'new';
                    $changeValue = 0;
                }
                break;
            }
        }

        return [
            'rank' => $rank,
            'change_direction' => $changeDirection,
            'change_value' => $changeValue
        ];
    }

    /**
     * Get previous AACE rankings for a specific component
     */
    private function getPreviousAACERankings($studentIds, $component)
    {
        // This would use similar logic to getPreviousRankings but for AACE components
        // For now, return empty array to avoid errors
        return [];
    }

    /**
     * Get previous rankings for comparison
     */
    private function getPreviousRankings($studentIds, $timePeriod)
    {
        // Calculate previous period dates
        $previousStartDate = null;
        $previousEndDate = null;
        
        switch ($timePeriod) {
            case '7days':
                $previousStartDate = Carbon::now()->subDays(14);
                $previousEndDate = Carbon::now()->subDays(7);
                break;
            case '14days':
                $previousStartDate = Carbon::now()->subDays(28);
                $previousEndDate = Carbon::now()->subDays(14);
                break;
            case 'alltime':
                // For all-time, compare with last month
                $previousStartDate = Carbon::now()->subMonths(2);
                $previousEndDate = Carbon::now()->subMonth();
                break;
            default:
                $previousStartDate = Carbon::now()->subDays(28);
                $previousEndDate = Carbon::now()->subDays(14);
        }

        // Get evaluation results for previous period
        $previousEvaluationResults = YashodarshiEvaluationResult::where('evaluated_at', '>=', $previousStartDate)
            ->where('evaluated_at', '<', $previousEndDate)
            ->whereIn('student_id', $studentIds)
            ->get()
            ->groupBy('student_id');

        $previousEntries = [];

        // Calculate previous period scores
        foreach ($studentIds as $studentId) {
            $studentResults = $previousEvaluationResults->get($studentId, collect());
            
            if ($studentResults->isEmpty()) {
                continue;
            }

            $totalScore = $studentResults->sum('total_score');
            $taskScores = TaskScore::whereIn('task_id', $studentResults->pluck('task_id')->toArray())->get();
            $maxPossibleScore = $taskScores->sum('total_score');
            $scorePercentage = $maxPossibleScore > 0 ? round(($totalScore / $maxPossibleScore) * 100, 1) : 0;

            $previousEntries[] = [
                'student_id' => $studentId,
                'score_percentage' => $scorePercentage
            ];
        }

        // Sort previous entries by score
        usort($previousEntries, function($a, $b) {
            return $b['score_percentage'] <=> $a['score_percentage'];
        });

        // Create rank mapping
        $previousRankings = [];
        $rank = 1;
        foreach ($previousEntries as $entry) {
            $previousRankings[$entry['student_id']] = $rank;
            $rank++;
        }

        return $previousRankings;
    }

    /**
     * Generate initials from name.
     */
    private function getInitials($name)
    {
        $nameParts = explode(' ', trim($name ?? ''));
        $initials = '';
        foreach ($nameParts as $part) {
            if (!empty($part)) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
        }
        return $initials ?: 'U';
    }

    /**
     * Calculate student streak based on consecutive days with submissions
     */
    private function calculateStudentStreak($studentId)
    {
        // Get student task submissions ordered by date
        $submissions = DB::table('student_task_responses')
            ->where('student_id', $studentId)
            ->where('status', 'submitted')
            ->orderBy('submitted_at', 'desc')
            ->get();

        if ($submissions->isEmpty()) {
            return 0;
        }

        // Check for consecutive days
        $streak = 1;
        $lastDate = Carbon::parse($submissions->first()->submitted_at)->startOfDay();
        $previousDate = $lastDate->copy()->subDay();

        foreach ($submissions->skip(1) as $submission) {
            $submissionDate = Carbon::parse($submission->submitted_at)->startOfDay();

            // If this submission was on the previous day, increase streak
            if ($submissionDate->equalTo($previousDate)) {
                $streak++;
                $previousDate = $submissionDate->copy()->subDay();
            }
            // If submission was on same day as last one, just move to next submission
            elseif ($submissionDate->equalTo($lastDate)) {
                continue;
            }
            // If there's a gap, streak is broken
            else {
                break;
            }

            $lastDate = $submissionDate;
        }

        return $streak;
    }

    /**
     * Calculate weekly improvement percentage based on real data
     */
    private function calculateWeeklyImprovement($studentId)
    {
        // Get current week's evaluation results
        $currentWeekResults = YashodarshiEvaluationResult::where('student_id', $studentId)
            ->where('evaluated_at', '>=', Carbon::now()->startOfWeek())
            ->get();

        // Get previous week's evaluation results
        $previousWeekResults = YashodarshiEvaluationResult::where('student_id', $studentId)
            ->where('evaluated_at', '>=', Carbon::now()->subWeek()->startOfWeek())
            ->where('evaluated_at', '<', Carbon::now()->startOfWeek())
            ->get();

        // Calculate current week's average score
        $currentWeekTotal = $currentWeekResults->sum('total_score');
        $currentWeekCount = $currentWeekResults->count();
        $currentWeekAvg = $currentWeekCount > 0 ? $currentWeekTotal / ($currentWeekCount * 100) * 100 : 0;

        // Calculate previous week's average score
        $previousWeekTotal = $previousWeekResults->sum('total_score');
        $previousWeekCount = $previousWeekResults->count();
        $previousWeekAvg = $previousWeekCount > 0 ? $previousWeekTotal / ($previousWeekCount * 100) * 100 : 0;

        // Calculate improvement percentage
        if ($previousWeekAvg > 0) {
            $improvement = round((($currentWeekAvg - $previousWeekAvg) / $previousWeekAvg) * 100, 1);
        } else if ($currentWeekAvg > 0) {
            // If no previous week data but current week has data, consider it 100% improvement
            $improvement = 100;
        } else {
            // No data for either week
            $improvement = 0;
        }

        return max(0, $improvement); // Return positive improvement or 0
    }

    /**
     * API endpoint to get leaderboard data.
     */
    public function getLeaderboardDataApi(Request $request, $period = '14days')
    {
        // Check if request has student_id parameter or get from session
        $studentId = $request->get('student_id', Auth::guard('student')->user()->id);

        if (!$studentId) {
            return response()->json([
                'success' => false,
                'message' => 'Student ID not provided'
            ], 400);
        }

        // Verify student exists and has ongoing batches
        $student = Student::with(['batches' => function($query) {
            $query->where('status', 'ongoing');
        }])->find($studentId);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        if ($student->batches->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Student is not enrolled in any ongoing batches'
            ], 400);
        }

        // Get leaderboard data (already filtered for ongoing batches in fetchLeaderboardData)
        $leaderboardData = $this->fetchLeaderboardData($studentId, $period);

        return response()->json([
            'success' => true,
            'data' => $leaderboardData
        ]);
    }
}
