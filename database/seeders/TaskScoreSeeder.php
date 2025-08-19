<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\TaskScore;
use App\Student;
use App\Task;

class TaskScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = Task::all();

        if ($tasks->isEmpty()) {
            return;
        }

        $taskScores = [];
        
        foreach ($tasks->take(5) as $task) {
            $aptitudeScore = rand(70, 95) + (rand(0, 99) / 100);
            $attitudeScore = rand(65, 90) + (rand(0, 99) / 100);
            $communicationScore = rand(75, 95) + (rand(0, 99) / 100);
            $executionScore = rand(80, 100) + (rand(0, 99) / 100);
            $totalScore = ($aptitudeScore + $attitudeScore + $communicationScore + $executionScore) / 4;
            
            $taskScores[] = [
                'task_id' => $task->id,
                'attribute_score' => json_encode([
                    'aptitude' => $aptitudeScore,
                    'attitude' => $attitudeScore,
                    'communication' => $communicationScore,
                    'execution' => $executionScore
                ]),
                'total_score' => round($totalScore, 2),
                'aptitude_score' => round($aptitudeScore, 2),
                'attitude_score' => round($attitudeScore, 2),
                'communication_score' => round($communicationScore, 2),
                'execution_score' => round($executionScore, 2),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        TaskScore::insert($taskScores);
    }
}
