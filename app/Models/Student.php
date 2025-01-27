<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use app\Models\Batch;
use App\Models\Attendance;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = ['first_name', 'last_name', 'middle_name' , 'course', 'user_id'];
    
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
