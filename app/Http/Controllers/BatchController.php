<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\Challenge;
use App\User;
use App\Yashodarshi;
use App\Student;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::with(['challenge', 'yashodarshi', 'students'])->paginate(10);
        return view('superadmin.batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $challenges = Challenge::all();
        $users = User::all();
        $yashodarshis = Yashodarshi::all();
        $students = Student::all();
        return view('superadmin.batches.create', compact('challenges', 'users', 'yashodarshis', 'students'));
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
            'description' => 'nullable|string',
            'challenge_id' => 'required|exists:challenges,id',
            'yashodarshi_id' => 'required|exists:yashodarshis,id',
            'start_date' => 'required|date',
            'time' => 'required',
            'status' => 'required|in:active,inactive',
            'students' => 'array',
            'students.*' => 'exists:students,id'
        ]);

        $batch = Batch::create($request->only([
            'title', 'description', 'challenge_id', 'yashodarshi_id', 
            'start_date', 'time', 'status'
        ]));

        if ($request->has('students')) {
            $challenge = Challenge::findOrFail($request->challenge_id);
            $studentData = [];
            foreach ($request->students as $studentId) {
                $studentData[$studentId] = [
                    'challenge_id' => $request->challenge_id,
                    'amount' => $challenge->selling_price,
                    'payment_status' => 'unpaid',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            $batch->students()->attach($studentData);
        }

        return redirect()->route('batches.index')->with('success', 'Batch created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batch = Batch::with(['challenge', 'yashodarshi', 'students'])->findOrFail($id);
        return view('superadmin.batches.show', compact('batch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $batch = Batch::with(['students' => function($query) {
            $query->withPivot('payment_status');
        }])->findOrFail($id);
        $challenges = Challenge::all();
        $users = User::all();
        $yashodarshis = Yashodarshi::all();
        $students = Student::all();
        
        // Get paid student IDs for frontend
        $paidStudentIds = $batch->students()
            ->wherePivot('payment_status', 'paid')
            ->pluck('students.id')
            ->toArray();
            
        return view('superadmin.batches.edit', compact('batch', 'challenges', 'users', 'yashodarshis', 'students', 'paidStudentIds'));
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
        $batch = Batch::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'challenge_id' => 'required|exists:challenges,id',
            'yashodarshi_id' => 'required|exists:yashodarshis,id',
            'start_date' => 'required|date',
            'time' => 'required',
            'status' => 'required|in:active,inactive',
            'students' => 'array',
            'students.*' => 'exists:students,id'
        ]);

        $batch->update($request->only([
            'title', 'description', 'challenge_id', 'yashodarshi_id', 
            'start_date', 'time', 'status'
        ]));

        if ($request->has('students')) {
            // Get students with paid status - these should not be removed
            $paidStudents = $batch->students()
                ->wherePivot('payment_status', 'paid')
                ->pluck('students.id')
                ->toArray();
            
            // Detach only unpaid students
            $batch->students()
                ->wherePivot('payment_status', '!=', 'paid')
                ->detach();
            
            $challenge = Challenge::findOrFail($request->challenge_id);
            $studentData = [];
            
            foreach ($request->students as $studentId) {
                // Skip if student already has paid status
                if (in_array($studentId, $paidStudents)) {
                    continue;
                }
                
                $studentData[$studentId] = [
                    'challenge_id' => $request->challenge_id,
                    'amount' => $challenge->selling_price,
                    'payment_status' => 'unpaid',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            
            if (!empty($studentData)) {
                $batch->students()->attach($studentData);
            }
        } else {
            // Only detach unpaid students, keep paid ones
            $batch->students()
                ->wherePivot('payment_status', '!=', 'paid')
                ->detach();
        }

        return redirect()->route('batches.index')->with('success', 'Batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->students()->detach();
        $batch->delete();

        return redirect()->route('batches.index')->with('success', 'Batch deleted successfully.');
    }

    /**
     * Update payment information for a student in a batch.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $batchId
     * @param  int  $studentId
     * @return \Illuminate\Http\Response
     */
    public function updatePayment(Request $request, $batchId, $studentId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:paid,unpaid',
            'payment_comments' => 'nullable|string'
        ]);

        $batch = Batch::findOrFail($batchId);
        $student = Student::findOrFail($studentId);

        $updateData = [
            'amount' => $request->amount,
            'payment_status' => $request->payment_status,
            'payment_comments' => $request->payment_comments
        ];

        // Add payment_time if status is being set to paid
        if ($request->payment_status === 'paid') {
            $updateData['payment_time'] = now();
        } else {
            $updateData['payment_time'] = null;
        }

        $batch->students()->updateExistingPivot($studentId, $updateData);

        return redirect()->route('batches.show', $batchId)->with('success', 'Payment information updated successfully.');
    }
}
