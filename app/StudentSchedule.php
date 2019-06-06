<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    protected $fillable = [
        'student_id', 'block_schedule_id', 'group_id','student_path',
    ];
    protected $appends = [
        'student', 'group', 'blockschedule'
    ];
    public function getStudentAttribute() {
        $student = Student::findOrFail($this->student_id);
        return User::findOrFail($student->user_id);
    }
    public function getGroupAttribute() {
        return Group::findOrFail($this->group_id);
    }
    public function getBlockscheduleAttribute(){
        return BlockSchedule::findOrFail($this->block_schedule_id);
    }
}
