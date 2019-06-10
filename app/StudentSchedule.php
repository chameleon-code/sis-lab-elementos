<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    protected $fillable = [
        'student_id', 'block_schedule_id', 'group_id','student_path', 'user'
    ];
    protected $appends = [
        'student', 'group', 'blockschedule'
    ];
    public function getStudentAttribute() {
        return Student::findOrFail($this->student_id);
    }
    public function getGroupAttribute() {
        return Group::findOrFail($this->group_id);
    }
    public function getBlockscheduleAttribute(){
        return BlockSchedule::findOrFail($this->block_schedule_id);
    }
    public function getUserAttribute(){
        $student = Student::findOrFail($this->student_id);
        return User::findOrFail($student->user_id);
    }
}
