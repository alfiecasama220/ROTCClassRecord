<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Attendance;
use App\Models\Batch;

use Illuminate\Http\Request;

class PrintableController extends Controller
{
    public function print(string $id) {
        $attendance = Attendance::with('batch', 'student')
        ->join('students', 'attendance.student_id', '=', 'students.id')
        ->where('attendance.batch_id', $id) // Filter by batch ID
        ->where('attendance.user_id', Auth::user()->id) // Filter by authenticated user
        ->orderBy('students.last_name', 'asc') // Sort by the last_name column in students
        ->select('attendance.*') // Select only attendance fields
        ->get();
        $batchId = $id;
        $batchName = Batch::where('id', $id)->first();
        return view('admin.pages.print', compact('attendance', 'batchId', 'batchName'));
    }

    public function getData(string $column, $id) {

        $attendance = Attendance::with('batch', 'student')
        ->join('students', 'attendance.student_id', '=', 'students.id')
        ->where('attendance.batch_id', $id) // Filter by batch ID
        ->where('attendance.user_id', Auth::user()->id) // Filter by authenticated user
        ->orderBy('students.last_name', 'asc') // Sort by the last_name column in students
        ->select('attendance.*') // Select only attendance fields
        ->get([$column, 'student_id' , 'first_name', 'middle_name', 'last_name']);
        $batchName = Batch::where('id', $id)->first();
        return view('admin.pages.printData', compact('attendance','batchName', 'column'));

        return $Attendance;
    }
}
