<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(15);
        return view('superadmin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.students.create');
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
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone_number' => 'required|string|max:20',
            'partner_institution' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('superadmin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('superadmin.students.edit', compact('student'));
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
        $student = Student::findOrFail($id);
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone_number' => 'required|string|max:20',
            'partner_institution' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    /**
     * Show the bulk upload form.
     *
     * @return \Illuminate\Http\Response
     */
    public function bulkUpload()
    {
        return view('superadmin.students.bulk-upload');
    }

    /**
     * Process the bulk upload CSV file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processBulkUpload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        
        // Remove header row
        $header = array_shift($data);
        
        $successCount = 0;
        $errorCount = 0;
        $errors = [];

        foreach ($data as $index => $row) {
            try {
                // Skip empty rows
                if (empty(array_filter($row))) {
                    continue;
                }

                // Map CSV columns to database fields
                $studentData = [
                    'full_name' => $row[0] ?? '',
                    'email' => $row[1] ?? '',
                    'date_of_birth' => $row[2] ?? '',
                    'gender' => $row[3] ?? '',
                    'phone_number' => $row[4] ?? '',
                    'partner_institution' => $row[5] ?? null,
                    'status' => $row[6] ?? 'active'
                ];

                // Validate required fields
                if (empty($studentData['full_name']) || empty($studentData['email']) || 
                    empty($studentData['date_of_birth']) || empty($studentData['gender']) || 
                    empty($studentData['phone_number'])) {
                    $errors[] = "Row " . ($index + 2) . ": Missing required fields";
                    $errorCount++;
                    continue;
                }

                // Check if email already exists
                if (Student::where('email', $studentData['email'])->exists()) {
                    $errors[] = "Row " . ($index + 2) . ": Email {$studentData['email']} already exists";
                    $errorCount++;
                    continue;
                }

                // Validate gender
                if (!in_array($studentData['gender'], ['male', 'female', 'other'])) {
                    $errors[] = "Row " . ($index + 2) . ": Invalid gender value";
                    $errorCount++;
                    continue;
                }

                // Validate status
                if (!in_array($studentData['status'], ['active', 'inactive'])) {
                    $studentData['status'] = 'active'; // Default to active
                }

                Student::create($studentData);
                $successCount++;

            } catch (\Exception $e) {
                $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                $errorCount++;
            }
        }

        $message = "Bulk upload completed. {$successCount} students imported successfully.";
        if ($errorCount > 0) {
            $message .= " {$errorCount} rows had errors.";
        }

        return redirect()->route('students.bulk-upload')
                        ->with('success', $message)
                        ->with('errors', $errors);
    }

    /**
     * Download CSV template for bulk upload.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="student_upload_template.csv"',
        ];

        $columns = [
            'Full Name',
            'Email',
            'Date of Birth (YYYY-MM-DD)',
            'Gender (male/female/other)',
            'Phone Number',
            'Partner Institution (Optional)',
            'Status (active/inactive)'
        ];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            // Add sample data
            fputcsv($file, [
                'John Doe',
                'john.doe@example.com',
                '1995-05-15',
                'male',
                '+1234567890',
                'ABC University',
                'active'
            ]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
