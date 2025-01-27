<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use App\Models\Batch;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceDataHandler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
    }

    public function handler(Request $request) {
        $studentId = $request->input('student_id');
        $column = $request->input('column');
        $value = $request->input('value');
        
        // Log inputs to check the request data
        \Log::info('Request Data:', ['studentId' => $studentId, 'column' => $column, 'value' => $value]);
        
        try {
            // Update the specific attendance column
            DB::table('attendance')
                ->where('student_id', $studentId)
                ->update([$column => $value]);
            
            // Manually trigger the update of the final grade
            $attendance = Attendance::where('student_id', $studentId)->first();
            

                if ($attendance || $value > 3) {
                    \Log::info('Attendance record found, updating final grade for student_id: ' . $studentId);
                    $attendance->updateFinalGrade(); // This will calculate and update the final grade
                    \Log::info('Final grade updated for student_id: ' . $studentId);
                } else {
                    \Log::warning('Attendance record not found for student_id: ' . $studentId);
                    return response()->json(['success' => false, 'message' => 'Attendance record not found']);
                }

                // return redirect()->back()->with('success', 'Attendance updated successfully');
            
            
            return response()->json(['success' => true, 'message' => 'Attendance updated successfully']);
            

        } catch (\Exception $e) {
            // Log full exception details
            \Log::error('Error in handler:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function search(Request $request, string $id) {
        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        $search = $request->search;

        $batchId = $id;
        $batchName = Batch::where('id', $id)->first();

        if($validator->passes()) {

            $attendance = Attendance::with('student')->where('user_id', Auth::user()->id)->where('batch_id', $id)->whereHas('student', function ($query) use ($search) {
                $query->where('last_name', 'like', '%' . $search . '%');
            })->get();

            return view('admin.pages.index', compact('attendance', 'batchName', 'batchId', 'search'));
        }
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
