<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    protected $fillable = [
        'student_id', 'block_schedule_id', 'group_id','student_path',
    ];

    public static function getDateTimeStudentSchedulesByStudentId($idStudent)
    {    
        $studentSchedules = StudentSchedule::where('student_id',$idStudent)->get()->all();
        $schedules=[];
        foreach ($studentSchedules as $student) {
            $blockSchedule = BlockSchedule::where('id',$student->block_schedule_id)->get()->first();
            $date = ScheduleRecord::getDayAndHourFormatWithId($blockSchedule->schedule_id);
            $date['group_id'] = $student->group_id; 
            array_push($schedules,$date);
        }
        return $schedules;
    }
}
