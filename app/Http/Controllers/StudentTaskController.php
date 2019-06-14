<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\StudentSchedule;
use Carbon\Carbon;
use App\Sesion;
use App\Task;
use App\Professor;
use App\BlockGroup;
use App\Group;
use App\BlockSchedule;
use App\StudentTask;

class StudentTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $student = Student::where('user_id','=',$user->id)->first();
        //test for day and hours 
        //$testDate = Carbon::create(2019,6,6,17,15,0); 
        //Carbon::setTestNow($testDate);
        // end test 
        $hour = Carbon::now()->format('H:i:s');
        $schedules = StudentSchedule::getDateTimeStudentSchedulesByStudentId($student->id);
        $message = '';
        $sesions = [];
        if($schedules != []){
            foreach ($schedules as $schedule) {
                $sesionId = Sesion::getSesionIdToDayByBlock($schedule['block_id']);
                if($sesionId != -1){
                    $blockGroup = [
                        'sesionId' => $sesionId,
                        'group_id' => $schedule['group_id'],
                        'block_id' => $schedule['block_id'],
                        'schedule_id' => $schedule['schedule_id']
                    ];
                    array_push($sesions,(object)$blockGroup); 
                }
            }
        }else{
            $message = 'No te encuentras inscrito a ninguna materia aún';        
            $data = [
                'student' => $student,
                'sesions' => []
            ];
            return view('components.contents.student.activities')->with($data)->withErrors($message);
        }
        $sesionOfWeek=[];
        foreach ($sesions as $sesion) {
            $sesionWeek = Sesion::find($sesion->sesionId);
            $tasks = Task::where('sesion_id',$sesion->sesionId)->get()->all();
            $taskAll = [];
            $taskDone = null;
            foreach ($tasks as $task) {
                $taskDone = StudentTask::where('task_id',$task->id)->get()->first();
                $taskData = [
                    'task' => $task,
                    'done' => $taskDone
                ]; 
                array_push($taskAll,(object)$taskData);
            }
            //dd($taskDone);
            $totalSesions = count(Sesion::where('block_id',$sesion->block_id)->get()->all());
            $sesionTask = [
               // 'tasks' => $tasks,
                'tasks' => $taskAll,
                'sesion' => $sesionWeek,
                'subject' => Group::getSubjectById($sesion->group_id)->name,
                'block_id' => $sesion->block_id,
                'totalSesion' => $totalSesions,
                'schedule_id' => $sesion->schedule_id,
                'taskDone' => $taskDone
            ];
            array_push($sesionOfWeek,(object)$sesionTask);
        }
        $data = [
            'student' => $student,
            'sesions' => $sesionOfWeek
        ];

        return view('components.contents.student.activities')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('practice')){
            $file = $request->file('practice');
            $extension = $file->getClientOriginalExtension();
            if($extension=='rar'||$extension=='zip'){
                $user = Auth::user();
                $student = Student::where('user_id','=',$user->id)->first();

                $fileName = $file->getClientOriginalName();
                $fileSesion = $request->sesion_number;

                $blockScheduleId = BlockSchedule::where('schedule_id',$request->schedule_id)->where('block_id',$request->block_id)->get()->first()->id;
                $studentSchedule = StudentSchedule::where('student_id',$student->id)->where('block_schedule_id',$blockScheduleId)->get()->first();
                
    
                if($studentSchedule!=[]){
                    $file -> move(public_path().'/storage/'.$studentSchedule->student_path.'/sesion-'.$fileSesion,$fileName);
                    $data = [
                        "description" => $request->description,
                        "task_id" => $request->task_id,
                        "student_id" => $student->id,
                        "task_name" => $fileName,
                        "task_path" => $studentSchedule->student_path.'/sesion-'.$fileSesion
                    ];
                    StudentTask::create($data);
                }
                return back();
            }else{
                return back()->withErrors('Procure enviar archivos formato: .zip .rar');
            }
        }else{
            return back()->withErrors('Archivo con tamaño mayor a 2MB');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->hasFile('practice')){
            $file = $request->file('practice');
            $fileName = $file->getClientOriginalName();
            $studentTask = StudentTask::find($id);
            $studentTask->description = $request->description;
            $studentTask->task_name = $fileName;
            $studentTask->save();
            $file -> move(public_path().'/storage/'.$studentTask->task_path,$fileName);
            return back();
        }else{
            return back()->withErrors('Archivo con tamaño mayor a 2MB');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
