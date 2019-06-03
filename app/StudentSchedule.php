<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    protected $fillable = [
        'student_id', 'block_schedule_id', 'group_id','student_path',
    ];
}
