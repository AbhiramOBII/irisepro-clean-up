<?php

namespace App\Http\Controllers;

use App\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achievements = Achievement::paginate(10);
        return view('superadmin.achievements.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $domains = Achievement::getDomains();
        return view('superadmin.achievements.create', compact('domains'));
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
            'domain' => 'required|in:attitude,aptitude,communication,execution,aace,leadership',
            'title' => 'required|string|max:150',
            'threshold' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $achievement = new Achievement();
        $achievement->domain = $request->domain;
        $achievement->title = $request->title;
        $achievement->threshold = $request->threshold;

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/achievements'), $filename);
            $achievement->image = 'uploads/achievements/' . $filename;
        }

        $achievement->save();

        return redirect()->route('achievements.index')->with('success', 'Achievement created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $achievement = Achievement::with('students')->findOrFail($id);
        return view('superadmin.achievements.show', compact('achievement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $achievement = Achievement::findOrFail($id);
        $domains = Achievement::getDomains();
        return view('superadmin.achievements.edit', compact('achievement', 'domains'));
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
        $achievement = Achievement::findOrFail($id);

        $request->validate([
            'domain' => 'required|in:attitude,aptitude,communication,execution,aace,leadership',
            'title' => 'required|string|max:150',
            'threshold' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $achievement->domain = $request->domain;
        $achievement->title = $request->title;
        $achievement->threshold = $request->threshold;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($achievement->image && file_exists(public_path($achievement->image))) {
                unlink(public_path($achievement->image));
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/achievements'), $filename);
            $achievement->image = 'uploads/achievements/' . $filename;
        }

        $achievement->save();

        return redirect()->route('achievements.index')->with('success', 'Achievement updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);
        
        // Delete image if exists
        if ($achievement->image && file_exists(public_path($achievement->image))) {
            unlink(public_path($achievement->image));
        }
        
        $achievement->delete();
        
        return redirect()->route('achievements.index')->with('success', 'Achievement deleted successfully!');
    }
}
