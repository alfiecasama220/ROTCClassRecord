<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Student;
use App\Models\Attendance;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';
    protected $fillable = ['student_id', 'batch_id',
        'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10',
        'A11', 'A12', 'A13', 'A14', 'A15', 'prelim', 'midterm', 'final', 'merit',
        'final_grade', 'maxPrelimValue', 'maxMidtermValue', 'maxFinalValue', 'user_id'];

    // Define the relationship with student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Automatically calculate final grade after updating attendance
    protected static function boot()
{
    parent::boot();

    static::updated(function ($attendance) {
        $attendance->updateFinalGrade();
    });
}

public function updateFinalGrade()
{
    $attendanceColumns = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10', 'A11', 'A12', 'A13', 'A14', 'A15'];

    // Sum all column values
    $attendanceTotal = collect($attendanceColumns)
        ->sum(fn($column) => $this->$column);

    $totalDays = count($attendanceColumns);
    $maxPossibleValue = $totalDays * 2;

    $attendancePercentage = ($attendanceTotal / $maxPossibleValue) * 100;

    $attendanceWeight = 0.3; // 20% weight for attendance

    $attendanceContribution = ($attendancePercentage * $attendanceWeight);

    $nonAttendanceGrade = 0;
    $finalGrade = $nonAttendanceGrade + $attendanceContribution;

    // // Calculate final grade based on attendance percentage and weight
    // $finalGrade = ($nonAttendanceGrade * (1 - $attendanceWeight)) + ($attendancePercentage * $attendanceWeight);

    // Update the final_grade column
    // $this->updateQuietly(['final_grade' => $finalGrade]);

    // CALCULATE EXAM

    $exam = ['prelim', 'midterm', 'final', 'batch_id'];

    // $totalExamValue = collect($exam)
    //     ->sum(fn($column) => $this->$column);

    $examValues = collect($exam)
    ->mapWithKeys(function ($column) {
        return [$column => $this->$column]; // Retrieve the value for each column
    });

    $MaxValue = Batch::where('id', $examValues['batch_id'])->first();

    $weight = 0.1333;

    $maxPrelimValue = $MaxValue->maxPrelimValue;

    $prelim = $examValues['prelim'];
    $prelimPercentage = ($prelim / $maxPrelimValue) * 100; 
    $prelimContribution = ($prelimPercentage * $weight);

    

    // MIDTERM

    $maxMidtermValue = $MaxValue->maxMidtermValue;;

    $midterm = $examValues['midterm'];
    $midtermPercentage = ($midterm / $maxMidtermValue) * 100;
    $midtermContribution = ($midtermPercentage * $weight);
   

    // FINALS

    $maxFinalValue = $MaxValue->maxFinalValue;;

    $final = $examValues['final'];
    $finalPercentage = ($final / $maxFinalValue) * 100;
    $finalContribution = ($finalPercentage * $weight);

    $finalExamValue = $prelimContribution + $midtermContribution + $finalContribution;
    // $this->updateQuietly(['final_grade' => $MaxValue->maxMidtermValue]);

    // $this->updateQuietly(['final_grade' => $finalValue]);

    // CALCULATE MERIT

    $merit = ['merit'];

    $totalMeritValue = collect($merit)
        ->sum(fn($column) => $this->$column);

    $totalMerit = count($merit);
    $meritMaxValue = $totalMerit * 100;

    $meritPercentage = ($totalMeritValue / $meritMaxValue) * 100;
    $meritWeight = 0.3;

    $meritContribution = ($meritPercentage * $meritWeight);

    $finalMeritGrade = $nonAttendanceGrade + $meritContribution;

    // Overall final grade

    $finalGrade = $attendanceContribution + $finalExamValue + $meritContribution;

    // $this->updateQuietly(['final_grade' => $finalGrade]);
    $this->updateQuietly(['final_grade' => $finalGrade]);

    // return response().json(['success' => true]);

}


}

