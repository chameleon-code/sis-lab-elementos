<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sesion;
use App\ScheduleRecord;
use App\BlockSchedule;
use App\Student;
use App\StudentSchedule;
use App\Laboratory;
use App\Task;
use App\StudentTask;
use Illuminate\Foundation\Auth\User;

class AuxiliarTaskController extends Controller
{
    public function index(){
        $schedules = ScheduleRecord::schedulesNow();
        $list=[];
        foreach ($schedules as $item) {
            $blockSchedule = BlockSchedule::where('schedule_id','=',$item->schedule_id)->get()->first();
            $studentsSchedules= StudentSchedule::where('block_schedule_id','=',$blockSchedule->id)->get()->all();
            $students = [];
            $sesionID = Sesion::getSesionIdToDayByBlock($blockSchedule->block_id, $item->schedule_id);
            $tasks = Task::where('sesion_id','=',$sesionID)->get()->all();
            foreach ($studentsSchedules as $studentSchedule) {
                $studentID = $studentSchedule->student_id;
                $student = Student::find($studentID);
                $user = User::find($student->user_id);
                $studentTasks = Array();
                foreach ($tasks as $task) {
                    $studentTask = StudentTask::where('task_id','=',$task->id)->where('student_id','=',$studentID)->get()->first();
                    if($studentTask!=null){
                        $studentTask['title'] = $task->title;
                    }
                    array_push($studentTasks,$studentTask);
                }
                
                if($studentTasks!=[] && $studentTasks[0]!=null){
                    $data = [
                        'student'=> $user,
                        'studentTasks'=> $studentTasks
                    ];
                    array_push($students,(Object)$data);
                }
            }
            $laboratory = Laboratory::find($item->laboratory_id);
            $studentData =[
                'students' => $students,
                'schedule' => $item,
                'laboratory' => $laboratory
            ];
            array_push($list,(Object)$studentData);
        }
        $data = [
            'list' => $list
        ];
        // dd($data);
        return view('components.contents.auxiliar.controlTaskS',$data);
    }
}
