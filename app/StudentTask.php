<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;
use App\Student;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\AuxiliarController;

class StudentTask extends Model
{
    protected $fillable = [
        'student_id',
        'task_id',
        'description',
        'score',
        'observation',
        'task_path',
        'task_name',
        'in_time'
    ];
    protected $appends = [
        'student', 'task'
    ];
    protected $table = 'student_tasks';
    public function getStudentAttribute(){
        return Student::find($this->student_id);
    }
    public function getTaskAttribute(){
        return Task::findOrFail($this->task_id);
    }
    public static function inHour($time, $scheduleId){
        $res = false;
        $schedule = ScheduleRecord::find($scheduleId);
        $hourId = $schedule->hour_id;
        $hour = Hour::find($hourId);
        $hourStart = Carbon::createFromTimeString($hour->start);
        $hourEnd = Carbon::createFromTimeString($hour->end);
        $reTime = Carbon::createFromTimeString($time);
        if($reTime->between($hourStart,$hourEnd)){
            $res = true;
        }
        return $res;
    }
     public static function inDay($scheduleId){
        $schedule = ScheduleRecord::find($scheduleId);
        $ctrl = new AuxiliarController();
        return $ctrl->compareDay($schedule->day_id);
     }
    
}

