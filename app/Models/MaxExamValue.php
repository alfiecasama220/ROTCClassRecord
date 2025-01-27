<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaxExamValue extends Model
{
    use HasFactory;

    protected $table = 'maxexamlimit';

    protected $fillable = [
        'batch_id', 'maxPrelimValue', 'maxMidtermValue', 'maxFinalValue'
    ];
}
