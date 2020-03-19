<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Management;
use App\SubjectMatter;
use App\Student;
use App\StudentSchedule;
use App\BlockSchedule;
use App\Group;
use App\Block;
use App\Laboratory;
use App\Sesion;
use App\StudentTask;

class StudentScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $block_schedule = BlockSchedule::find($request->block_schedule_id);
        $laboratory = Laboratory::findOrFail($block_schedule->schedule->laboratory_id);
        
        if($block_schedule->registered < $laboratory->capacity){
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->get()->first();
            $group = Group::find($request->group_id);
            $dir = Block::find($block_schedule->block_id)->block_path.'/'.$group->name.'/'.$user->names.'-'.$user->code_sis;//base64_encode($user->code_sis);
            
            $block_schedule->registered++;
            $block_schedule->save();

            StudentSchedule::create([
                'student_id' => $student->id,
                'block_schedule_id' => $request->block_schedule_id,
                'group_id' => $request->group_id,
                'student_path' => $dir,
            ]);
            
            //Storage::makeDirectory($dir);

            return redirect('/students/registration');
        } else {
            $management = Management::getActualManagement();
            $blocks = Block::getAllBlocks();
            $subjectMatters = SubjectMatter::all();
            $subjectMatters = SubjectMatter::getActualSubjectMatters($management->id);
            $groups = Group::getGroupBlocks();
            $data=[ 'blocks' => $blocks,
                    'groups' => $groups,
                    'management' =>$management,
                    'subjectMatters' => $subjectMatters,
                    "error" => "Se alcanzó la capacidad del laboratorio. Seleccione otro."
                ];
            
            return view('components.contents.student.registration', $data);
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
    public function edit($id, Request $request)
    {
        $student_schedule = StudentSchedule::findOrFail($id);
        $old_block_schedule = BlockSchedule::findOrFail($student_schedule->block_schedule_id);
        $old_block_schedule->registered--;
        $old_block_schedule->save();

        $user = Auth::user();
        $student = Student::where('user_id', '=', $user->id)->get()->first();
        $new_block_schedule = BlockSchedule::find($request->block_schedule_id);
        $group = Group::find($request->group_id);
        $dir = Block::find($new_block_schedule->block_id)->block_path.'/'.$group->name.'/'.$user->names.'-'.$user->code_sis;;
        
        $student_schedule->student_id = $student->id;
        $student_schedule->block_schedule_id = $request->block_schedule_id; //nuevo block_schedule
        $student_schedule->group_id = $request->group_id;
        $student_schedule->student_path = $dir;
        $student_schedule->save();

        $new_block_schedule->registered++;
        $new_block_schedule->save();
        
        Storage::makeDirectory($dir);

        return redirect('/students/registration');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_schedule = StudentSchedule::findOrFail($id);
        $block_schedule = BlockSchedule::findOrFail($student_schedule->block_schedule_id);
        $block_schedule->registered--;
        $block_schedule->save();
        $student_schedule->delete();

        return redirect('/students/registration');
    }

    public function getSchedulesByGroup( $groupId, $blockId ) {
        $schedules = StudentSchedule::where('group_id', '=', $groupId)->get();
        //dd($schedules);
        $actualSesion = Sesion::getActualSesion($blockId);
        $studentTasks = StudentTask::join('tasks', 'student_tasks.task_id', 'tasks.id')->join('sesions', 'tasks.sesion_id', 'sesions.id')->where('sesions.id', $actualSesion->id)->get();
        foreach ($schedules as $schedule) {
            $schedule->tarea_sesion = 'No entregada';
            foreach( $studentTasks as $studentTask ) {
                if($schedule->student_id == $studentTask->student_id) {
                    $schedule->tarea_sesion = 'Entregada';
                    break;
                }
            }
        }
        $data = [
            'schedules' => $schedules,
            'actual_sesion' => $actualSesion
        ];
        return $data;
    }
    public function getSesionsByBlockByGroup($group_id,$block_id,$sesion_id){
        $schedules = StudentSchedule::where('group_id', '=', $group_id)->get();
        $actualSesion = Sesion::getActualSesion($block_id);
        $studentTasks = StudentTask::join('tasks', 'student_tasks.task_id', 'tasks.id')->join('sesions', 'tasks.sesion_id', 'sesions.id')->where('sesions.id', $sesion_id)->get();
        foreach ($schedules as $schedule) {
            $schedule->tarea_sesion = 'No entregada';
            foreach( $studentTasks as $studentTask ) {
                if($schedule->student_id == $studentTask->student_id) {
                    $schedule->tarea_sesion = 'Entregada';
                    break;
                }
            }
        }
        $data = [
            'schedules' => $schedules,
        ];
        return $data;
    }
}
