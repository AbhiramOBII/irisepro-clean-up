<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yashodarshi;
use Illuminate\Support\Facades\Session;

class YashodarshiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yashodarshis = Yashodarshi::paginate(15);
        return view('superadmin.yashodarshis.index', compact('yashodarshis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.yashodarshis.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:yashodarshis,email',
            'status' => 'required|in:active,inactive',
            'biodata' => 'nullable|string'
        ]);

        Yashodarshi::create($request->all());
        return redirect()->route('yashodarshis.index')->with('success', 'Yashodarshi created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $yashodarshi = Yashodarshi::findOrFail($id);
        return view('superadmin.yashodarshis.show', compact('yashodarshi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $yashodarshi = Yashodarshi::findOrFail($id);
        return view('superadmin.yashodarshis.edit', compact('yashodarshi'));
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
        $yashodarshi = Yashodarshi::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:yashodarshis,email,' . $id,
            'status' => 'required|in:active,inactive',
            'biodata' => 'nullable|string'
        ]);

        $yashodarshi->update($request->all());
        return redirect()->route('yashodarshis.index')->with('success', 'Yashodarshi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yashodarshi = Yashodarshi::findOrFail($id);
        $yashodarshi->delete();
        return redirect()->route('yashodarshis.index')->with('success', 'Yashodarshi deleted successfully');
    }

    /**
     * Show the bulk upload form.
     *
     * @return \Illuminate\Http\Response
     */
    public function bulkUpload()
    {
        return view('superadmin.yashodarshis.bulk-upload');
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
                $yashodarshiData = [
                    'name' => $row[0] ?? '',
                    'email' => $row[1] ?? '',
                    'status' => $row[2] ?? 'active',
                    'biodata' => $row[3] ?? null
                ];

                // Validate required fields
                if (empty($yashodarshiData['name']) || empty($yashodarshiData['email'])) {
                    $errors[] = "Row " . ($index + 2) . ": Missing required fields (name, email)";
                    $errorCount++;
                    continue;
                }

                // Check if email already exists
                if (Yashodarshi::where('email', $yashodarshiData['email'])->exists()) {
                    $errors[] = "Row " . ($index + 2) . ": Email {$yashodarshiData['email']} already exists";
                    $errorCount++;
                    continue;
                }

                // Validate status
                if (!in_array($yashodarshiData['status'], ['active', 'inactive'])) {
                    $yashodarshiData['status'] = 'active'; // Default to active
                }

                Yashodarshi::create($yashodarshiData);
                $successCount++;

            } catch (\Exception $e) {
                $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                $errorCount++;
            }
        }

        $message = "Bulk upload completed. {$successCount} yashodarshis imported successfully.";
        if ($errorCount > 0) {
            $message .= " {$errorCount} rows had errors.";
        }

        return redirect()->route('yashodarshis.bulk-upload')
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
            'Content-Disposition' => 'attachment; filename="yashodarshi_upload_template.csv"',
        ];

        $columns = [
            'Name',
            'Email',
            'Status (active/inactive)',
            'Biodata (Optional)'
        ];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            // Add sample data
            fputcsv($file, [
                'John Doe',
                'john.doe@example.com',
                'active',
                'Sample biodata information'
            ]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
