<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Student;
use App\Models\Attendance;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batch';

    protected $fillable = ['batch_name', 'yearFrom', 'yearTo', 'user_id'];

    protected $primaryKey = 'maxExamId';

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
