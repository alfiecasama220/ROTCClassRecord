<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $attendance = Attendance::with('student')
        ->join('students', 'attendance.student_id', '=' , 'students.id')
        ->orderBy('students.last_name', 'asc')
        ->select('attendance.*')
        ->get();
        return view('admin.pages.index', compact('attendance', 'batchName'));
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
