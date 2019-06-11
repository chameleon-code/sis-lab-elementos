<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudentSchedule extends Model
{
    protected $fillable = [
        'student_id', 'block_schedule_id', 'group_id','student_path', 'user'
    ];
    protected $appends = [
        'student', 'group', 'blockschedule', 'user'
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
    public static function getDateTimeStudentSchedulesByStudentId($idStudent)
    {    
        $studentSchedules = StudentSchedule::where('student_id',$idStudent)->get()->all();
        $schedules=[];
        foreach ($studentSchedules as $student) {
            $blockSchedule = BlockSchedule::where('id',$student->block_schedule_id)->get()->first();
            $date = ScheduleRecord::getDayAndHourFormatWithId($blockSchedule->schedule_id);
            $date['group_id'] = $student->group_id;
            $date['block_id'] = $blockSchedule->block_id;
            $date['schedule_id'] = $blockSchedule->schedule_id;
            array_push($schedules,$date);
        }
        return $schedules;
    }
}
