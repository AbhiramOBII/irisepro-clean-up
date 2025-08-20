<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskScore;
use App\Models\Attribute;
use App\Models\SubAttribute;
use Illuminate\Http\Request;

class TaskScoreController extends Controller
{
    /**
     * Display a listing of task scores.
     */
    public function index()
    {
        $taskScores = TaskScore::with('task')->latest()->paginate(10);
        return view('superadmin.task-scores.index', compact('taskScores'));
    }

    /**
     * Show the form for creating a new task score.
     */
    public function create(Task $task)
    {
        $attributes = Attribute::with('subAttributes')->where('status', 'active')->get();
        return view('superadmin.task-scores.create', compact('task', 'attributes'));
    }

    /**
     * Store a newly created task score in storage.
     */
    public function store(Request $request)
    {
        // Debug: Log the incoming request
        \Log::info('TaskScore Store Request:', $request->all());

        $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);

        // Build attribute_score array from individual inputs
        $attributeScore = [];
        $attributes = ['aptitude', 'attitude', 'communication', 'execution'];
        
        foreach ($attributes as $attribute) {
            $attributeScore[$attribute] = [];
            foreach ($request->all() as $key => $value) {
                if (strpos($key, $attribute . '_') === 0 && is_numeric($value)) {
                    $subAttributeName = str_replace($attribute . '_', '', $key);
                    $attributeScore[$attribute][$subAttributeName] = (float) $value;
                }
            }
        }

        // Calculate category scores
        $categoryScores = $this->calculateCategoryScores($attributeScore);

        $taskScore = TaskScore::create([
            'task_id' => $request->task_id,
            'attribute_score' => $attributeScore,
            'total_score' => $categoryScores['total'],
            'aptitude_score' => $categoryScores['aptitude'],
            'attitude_score' => $categoryScores['attitude'],
            'communication_score' => $categoryScores['communication'],
            'execution_score' => $categoryScores['execution'],
        ]);

        \Log::info('TaskScore Created:', $taskScore->toArray());

        return redirect()->route('superadmin.task-scores.index')
                        ->with('success', 'Task score created successfully.');
    }

    /**
     * Display the specified task score.
     */
    public function show(TaskScore $taskScore)
    {
        return view('superadmin.task-scores.show', compact('taskScore'));
    }

    /**
     * Show the form for editing the specified task score.
     */
    public function edit(TaskScore $taskScore)
    {
        $attributes = Attribute::with('subAttributes')->where('status', 'active')->get();
        return view('superadmin.task-scores.edit', compact('taskScore', 'attributes'));
    }

    /**
     * Update the specified task score in storage.
     */
    public function update(Request $request, TaskScore $taskScore)
    {
        $request->validate([
            'attribute_score' => 'required|array',
            'total_score' => 'nullable|numeric|min:0|max:100',
            'aptitude_score' => 'nullable|numeric|min:0|max:100',
            'attitude_score' => 'nullable|numeric|min:0|max:100',
            'communication_score' => 'nullable|numeric|min:0|max:100',
            'execution_score' => 'nullable|numeric|min:0|max:100',
        ]);

        // Calculate category scores if not provided
        $attributeScore = $request->attribute_score;
        $categoryScores = $this->calculateCategoryScores($attributeScore);

        $taskScore->update([
            'attribute_score' => $attributeScore,
            'total_score' => $request->total_score ?? $categoryScores['total'],
            'aptitude_score' => $request->aptitude_score ?? $categoryScores['aptitude'],
            'attitude_score' => $request->attitude_score ?? $categoryScores['attitude'],
            'communication_score' => $request->communication_score ?? $categoryScores['communication'],
            'execution_score' => $request->execution_score ?? $categoryScores['execution'],
        ]);

        return redirect()->route('superadmin.task-scores.index')
                        ->with('success', 'Task score updated successfully.');
    }

    /**
     * Remove the specified task score from storage.
     */
    public function destroy(TaskScore $taskScore)
    {
        $taskScore->delete();

        return redirect()->route('superadmin.task-scores.index')
                        ->with('success', 'Task score deleted successfully.');
    }

    /**
     * Calculate category scores from attribute scores.
     */
    private function calculateCategoryScores($attributeScore)
    {
        $categoryScores = [
            'aptitude' => 0,
            'attitude' => 0,
            'communication' => 0,
            'execution' => 0,
        ];

        foreach ($attributeScore as $category => $scores) {
            if (isset($categoryScores[$category])) {
                $categoryScores[$category] = count($scores) > 0 ? array_sum($scores) / count($scores) : 0;
            }
        }

        $categoryScores['total'] = array_sum($categoryScores) / 4;

        return $categoryScores;
    }
}
