<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Task;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = Challenge::with('tasks')->paginate(10);
        return view('superadmin.challenges.index', compact('challenges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks = Task::all();
        return view('superadmin.challenges.create', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'who_is_this_for' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'special_price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive,draft',
            'tasks' => 'array',
            'tasks.*' => 'exists:tasks,id'
        ]);

        $challenge = new Challenge();
        $challenge->title = $request->title;
        $challenge->description = $request->description;
        $challenge->features = $request->features;
        $challenge->who_is_this_for = $request->who_is_this_for;
        $challenge->cost_price = $request->cost_price;
        $challenge->selling_price = $request->selling_price;
        $challenge->special_price = $request->special_price;
        $challenge->status = $request->status;
        $challenge->datestamp = now();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/challenges'), $filename);
            $challenge->thumbnail_image = 'uploads/challenges/' . $filename;
        }

        $challenge->save();

        // Attach selected tasks
        if ($request->has('tasks')) {
            $challenge->tasks()->attach($request->tasks);
            $challenge->number_of_tasks = count($request->tasks);
            $challenge->save();
        }

        return redirect()->route('challenges.index')->with('success', 'Challenge created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $challenge = Challenge::with('tasks')->findOrFail($id);
        return view('superadmin.challenges.show', compact('challenge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $challenge = Challenge::with('tasks')->findOrFail($id);
        $tasks = Task::all();
        return view('superadmin.challenges.edit', compact('challenge', 'tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'who_is_this_for' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'special_price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive,draft',
            'tasks' => 'array',
            'tasks.*' => 'exists:tasks,id'
        ]);

        $challenge->title = $request->title;
        $challenge->description = $request->description;
        $challenge->features = $request->features;
        $challenge->who_is_this_for = $request->who_is_this_for;
        $challenge->cost_price = $request->cost_price;
        $challenge->selling_price = $request->selling_price;
        $challenge->special_price = $request->special_price;
        $challenge->status = $request->status;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail_image')) {
            // Delete old image if exists
            if ($challenge->thumbnail_image && file_exists(public_path($challenge->thumbnail_image))) {
                unlink(public_path($challenge->thumbnail_image));
            }
            
            $file = $request->file('thumbnail_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/challenges'), $filename);
            $challenge->thumbnail_image = 'uploads/challenges/' . $filename;
        }

        $challenge->save();

        // Sync selected tasks
        if ($request->has('tasks')) {
            $challenge->tasks()->sync($request->tasks);
            $challenge->number_of_tasks = count($request->tasks);
        } else {
            $challenge->tasks()->detach();
            $challenge->number_of_tasks = 0;
        }
        $challenge->save();

        return redirect()->route('challenges.index')->with('success', 'Challenge updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);
        
        // Delete thumbnail image if exists
        if ($challenge->thumbnail_image && file_exists(public_path($challenge->thumbnail_image))) {
            unlink(public_path($challenge->thumbnail_image));
        }
        
        $challenge->delete();
        
        return redirect()->route('challenges.index')->with('success', 'Challenge deleted successfully!');
    }
}
