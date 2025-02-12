<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Attendance;

use Illuminate\Http\Request;

class StudentController extends Controller
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
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'course' => 'required',
        ]);


        if($validator->passes()) {
            $student = new Student();
            $student->batch_id = $id;
            $student->first_name = $request->firstname;
            $student->middle_name = $request->middlename;
            $student->last_name = $request->lastname;
            $student->course = $request->course;
            $student->user_id = Auth::user()->id;
            $student->save();

            Attendance::create([
                'student_id' => $student->id, // Foreign key reference to the student
                'batch_id' => $id, // Default batch id (you can customize this)
                'a1' => null,  // Default attendance values (0 means absent, you can customize this)
                'a2' => null,
                'a3' => null,
                'a4' => null,
                'a5' => null,
                'a6' => null,
                'a7' => null,
                'a8' => null,
                'a9' => null,
                'a10' => null,
                'a11' => null,
                'a12' => null,
                'a13' => null,
                'a14' => null,
                'a15' => null,
                'user_id' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Data added successfully');
           
        } else {
            return redirect()->back()->with('error', 'Data not valid');
        }
    }

    public function getStudent(string $id, $batch) {
        $student = Student::where('id',$id)->where('batch_id', $batch)->first();

        if(!$student) {
            return response()->json(['error' => 'Data not found']);
        }

        return response()->json(['data' => $student]);
    }

    public function editStudent(Request $request , string $id, $batch) {
        $student  = Student::where('id', $id)->where('batch_id', $batch)->first();

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'course' => 'required',
        ]);
        if($validator->passes()) {
            $student->first_name = $request->firstname;
            $student->middle_name = $request->middlename;
            $student->last_name = $request->lastname;
            $student->course = $request->course;
            $student->save();

            return redirect()->back()->with('success', 'Data edited successfully');
        } else {
            return redirect()->back()->with('error', 'Data not edited'); 
        }
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id)->delete();

        if($student) {
            return redirect()->back()->with('success', 'Record deleted successfully');
        } else {
            return redirect()->back()->with('error', 'No records found');
        }
    }

}
