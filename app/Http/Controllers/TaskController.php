<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Attribute;
use App\Models\SubAttribute;
use App\Models\TaskScore;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('taskScore')->latest()->paginate(10);
        return view('superadmin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = Attribute::with('subAttributes')->where('status', 'active')->get();
        
        // Structure AACE framework data for the form
        $aaceFramework = [];
        foreach ($attributes as $attribute) {
            $attributeKey = strtolower($attribute->name);
            $aaceFramework[$attributeKey] = [
                'display_name' => $attribute->name,
                'sub_attributes' => []
            ];
            
            foreach ($attribute->subAttributes as $subAttribute) {
                $subAttributeKey = strtolower(str_replace(' ', '_', $subAttribute->subattribute_name));
                $aaceFramework[$attributeKey]['sub_attributes'][] = [
                    'name' => $subAttributeKey,
                    'display_name' => $subAttribute->subattribute_name
                ];
            }
        }
        
        return view('superadmin.tasks.create', compact('aaceFramework'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required|string|max:255',
            'task_description' => 'nullable|string',
            'task_instructions' => 'nullable|string',
            'task_multimedia' => 'nullable|url',
            'status' => 'required|in:active,inactive'
        ]);

        // Create the task
        $task = Task::create([
            'task_title' => $request->task_title,
            'task_description' => $request->task_description,
            'task_instructions' => $request->task_instructions,
            'task_multimedia' => $request->task_multimedia,
            'status' => $request->status
        ]);

        // Process AACE framework weights and create initial task score
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

        // Calculate category scores (these are the weights/max points for this task)
        $categoryScores = [];
        foreach ($attributeScore as $category => $scores) {
            $categoryScores[$category] = count($scores) > 0 ? array_sum($scores) : 0;
        }
        $categoryScores['total'] = array_sum($categoryScores);

        // Create task score record with the weights
        TaskScore::create([
            'task_id' => $task->id,
            'attribute_score' => $attributeScore,
            'total_score' => $categoryScores['total'],
            'aptitude_score' => $categoryScores['aptitude'],
            'attitude_score' => $categoryScores['attitude'],
            'communication_score' => $categoryScores['communication'],
            'execution_score' => $categoryScores['execution'],
        ]);

        return redirect()->route('superadmin.tasks.index')
                        ->with('success', 'Task and scoring framework created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('superadmin.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $attributes = Attribute::with('subAttributes')->where('status', 'active')->get();
        
        // Get existing task score data
        $taskScore = TaskScore::where('task_id', $task->id)->first();
        $existingScores = $taskScore ? $taskScore->attribute_score : [];
        
        // Structure AACE framework data for the form
        $aaceFramework = [];
        foreach ($attributes as $attribute) {
            $attributeKey = strtolower($attribute->name);
            $aaceFramework[$attributeKey] = [
                'display_name' => $attribute->name,
                'sub_attributes' => []
            ];
            
            foreach ($attribute->subAttributes as $subAttribute) {
                $subAttributeKey = strtolower(str_replace(' ', '_', $subAttribute->subattribute_name));
                $aaceFramework[$attributeKey]['sub_attributes'][] = [
                    'name' => $subAttributeKey,
                    'display_name' => $subAttribute->subattribute_name
                ];
            }
        }
        
        return view('superadmin.tasks.edit', compact('task', 'aaceFramework', 'existingScores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_title' => 'required|string|max:255',
            'task_description' => 'nullable|string',
            'task_instructions' => 'nullable|string',
            'task_multimedia' => 'nullable|url',
            'status' => 'required|in:active,inactive'
        ]);

        // Update the task
        $task->update([
            'task_title' => $request->task_title,
            'task_description' => $request->task_description,
            'task_instructions' => $request->task_instructions,
            'task_multimedia' => $request->task_multimedia,
            'status' => $request->status
        ]);

        // Update or create task score with new weights
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

        // Calculate category scores (these are the weights/max points for this task)
        $categoryScores = [];
        foreach ($attributeScore as $category => $scores) {
            $categoryScores[$category] = count($scores) > 0 ? array_sum($scores) : 0;
        }
        $categoryScores['total'] = array_sum($categoryScores);

        // Update or create task score record
        TaskScore::updateOrCreate(
            ['task_id' => $task->id],
            [
                'attribute_score' => $attributeScore,
                'total_score' => $categoryScores['total'],
                'aptitude_score' => $categoryScores['aptitude'],
                'attitude_score' => $categoryScores['attitude'],
                'communication_score' => $categoryScores['communication'],
                'execution_score' => $categoryScores['execution'],
            ]
        );

        return redirect()->route('superadmin.tasks.index')
                        ->with('success', 'Task and scoring framework updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('superadmin.tasks.index')
                        ->with('success', 'Task deleted successfully.');
    }

    /**
     * Show the form for scoring a task.
     */
    public function score(Task $task)
    {
        $attributes = Attribute::with('subAttributes')->where('status', 'active')->get();
        
        // Get existing task score framework (weights)
        $taskScore = TaskScore::where('task_id', $task->id)->first();
        $taskWeights = $taskScore ? $taskScore->attribute_score : [];
        
        // Get category totals from database
        $categoryTotals = [];
        if ($taskScore) {
            $categoryTotals['aptitude'] = $taskScore->aptitude_score ?? 0;
            $categoryTotals['attitude'] = $taskScore->attitude_score ?? 0;
            $categoryTotals['communication'] = $taskScore->communication_score ?? 0;
            $categoryTotals['execution'] = $taskScore->execution_score ?? 0;
        }
        
        return view('superadmin.tasks.score', compact('task', 'attributes', 'taskWeights', 'categoryTotals'));
    }
}
