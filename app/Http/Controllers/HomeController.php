<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Batch;
use App\Models\Student;
use App\Models\Attendance;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::where('user_id', Auth::user()->id)->get();
        return view('admin.pages.home', compact('batches'));
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
        $validator = Validator::make($request->all(), [
            'batchName' => 'required',
            'yearFrom' => 'required',
            'yearTo' => 'required',
        ]);

        $customId = 'BATCH-' . now()->year . '-' . str_pad(Batch::count() + 1, 3, '0', STR_PAD_LEFT);

        if($validator->passes()) {
            $batch = new Batch();
            $batch->batch_name = $request->batchName;
            $batch->yearFrom = $request->yearFrom;
            $batch->yearTo = $request->yearTo;
            $batch->user_id = Auth::user()->id;
            $batch->save();

            return redirect()->back()->with('success', 'Batch created successfully');
        } else {
            return redirect()->back()->with('error', 'Data not valid');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with('batch', 'student')
        ->join('students', 'attendance.student_id', '=', 'students.id')
        ->where('attendance.batch_id', $id) // Filter by batch ID
        ->where('attendance.user_id', Auth::user()->id) // Filter by authenticated user
        ->orderBy('students.last_name', 'asc') // Sort by the last_name column in students
        ->select('attendance.*') // Select only attendance fields
        ->get();
        $batchId = $id;
        $batchName = Batch::where('id', $id)->first();
        return view('admin.pages.index', compact('attendance', 'batchId', 'batchName'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'prelim' => 'required',
            'midterm' => 'required',
            'final' => 'required'
        ]);

        // $batch = Batch::where('id', $id)->first();

        if($validator->passes()) {
            
            $Attendance = Batch::where('id', $id)->update([
                'maxPrelimValue' => $request->prelim,
                'maxMidtermValue' => $request->midterm,
                'maxFinalValue' => $request->final,
            ]);
            return redirect()->back()->with('success', 'Exam limit edited successfully');

        } else {
            return redirect()->back()->with('error', 'Exam limit not edited');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
