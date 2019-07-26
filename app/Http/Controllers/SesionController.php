<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sesion;
use App\Task;
use App\Block;
use App\BlockGroup;
use App\Professor;
use App\Management;
use App\StudentSchedule;
use App\StudentTask;
use App\BlockSchedule;
use App\Group;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blockGroups = Professor::getBlocksProfessor();
        $sesionsBlocks=[];
        $dateStart = '';
        $dateEnd = '';
        $subjectNames=[];
        if($blockGroups!=null){
            foreach ($blockGroups as $blockGroup) {
                $blockId = $blockGroup->block_id;
                $subjectName = Professor::getSubjectByBlockGroup($blockGroup->id);
                array_push($sesionsBlocks, Sesion::where('block_id','=',$blockId)->get());
                $management_id = Block::where('id','=',$blockId)->get()->first()->management_id;
                $dateStart = Management::where('id','=',$management_id)->get()->first()->start_management;
                $dateEnd = Management::where('id','=',$management_id)->get()->first()->end_management;
                array_push($subjectNames, $subjectName);
            }
            $block_schedules = BlockSchedule::all();
            $block_registered = 0;
            foreach($block_schedules as $block_schedule) {
                if($block_schedule->block_id == $blockId){
                    $block_registered = $block_registered + $block_schedule->registered;
                }
            }
            
            $tasks_by_sesion[] = [];
            $student_tasks = StudentTask::all();
            for($i=0 ; $i<sizeof($sesionsBlocks[0]) ; $i++){
                $tasks_by_sesion[$i] = 0;
            }
            $sesions = $sesionsBlocks[0];
            $i = 0;
            foreach($sesions as $sesion) {
                foreach($student_tasks as $student_task) {
                    if($student_task->task->sesion_id == $sesion->id) {
                        $tasks_by_sesion[$i]++;
                    }
                }
                $i++;
            }
            $data = [
                'blocks' => $blockGroups,
                'sesions' => $sesionsBlocks,
                'tasks_by_sesion' => $tasks_by_sesion,
                'start' => $dateStart,
                'end' => $dateEnd,
                'subjects' => $subjectNames,
                'block_registered' => $block_registered
            ];
            return view('components.contents.professor.sesions', $data);
        }else{
            $data = [
                'blocks'=>[],
                'sesions' => [],
            ];
            return view('components.contents.professor.sesions', $data);
        }
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
        $input = $request->all();
        $sesion = new Sesion();
        if($sesion->validate($input)){
            $start = $request->date_start;
            $end = $request->date_end;
            $sesions = Sesion::autodate($start,$end);
            $numberOfSesions = count($sesions);

            $existentSesions = Sesion::where('block_id','=',$request->block_id)->get();
            $indexSession=count($existentSesions);
            $index=1;
            if(($indexSession < $numberOfSesions) && $indexSession!=0){
               $endDate = $existentSesions[$indexSession-1]->date_end;
               $index = $existentSesions[$indexSession-1]->number_sesion;
               $index ++;
               $sesions = Sesion::autodate($endDate,$end);
            }else if($indexSession == $numberOfSesions){
                return back()->withInput()->withErrors(['errors'=>['Ya tiene sesiones generadas automáticamente']]);
            }else if($numberOfSesions < $indexSession){
                return back()->withInput()->withErrors(['errors'=>['Ya tiene sesiones generadas automáticamente']]);
            }
            foreach ($sesions as $value) {
                Sesion::create([
                    'number_sesion' => $index,
                    'block_id' => $request->block_id,
                    'date_start'=> $value['start'],
                    'date_end'=> $value['end'],
                ]);
                $index++;
            }
            return back();
        }else{
            return back()->withInput()->withErrors($sesion->errors);
        }
        
        // Sesion::create([
        //     'block_id' => $request->block_id,
        //     'number_sesion' => $request->number_sesion,
        // ]);

        // $students = Student::where('block_id', '=', $request->block_id)->get();

        // foreach($students as $student)
        // {
        //     Storage::makeDirectory($student->student_path.'/sesion-'.$request->number_sesion);
        // }
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
        //
    }

    public function showStudentSesions($id)
    {
        $schedule = StudentSchedule::findOrFail($id);
        $sesions = Sesion::where('block_id', $schedule->getGroupAttribute()->blocks->first()->id)->get();
        $tasks = Task::all()->reject(function($item, $key) use ($schedule){
            if($item->getSesionAttribute()->block_id != $schedule->group->blocks->first()->id){
                return true;
            }
        })->values()->all();
        $sesion_max = Sesion::max('number_sesion');
        $student_tasks = StudentTask::where('student_id', $schedule->getStudentAttribute()->id)->get();
        $sesions_with_tasks = $schedule->getStudentAttribute()->tasks->count();
        $tasks_finisheds = array();
        if($student_tasks->isNotEmpty()){
            foreach($sesions as $sesion){
                $class = new \stdClass;
                $class->sesion_id = $sesion->id;
                $class->tasks = 0;
                $class->assist = 0;
                foreach($schedule->getStudentAttribute()->tasks as $task){
                    if($task->sesion_id == $sesion->id){
                        $class->tasks += 1;
                    }
                    foreach($schedule->getStudentAttribute()->assistances as $ass){
                        if($ass->sesion_id == $sesion->id){
                            $class->assist = 1;
                        }
                    }
                } 
                array_push($tasks_finisheds, $class);
            }
        }
        $student_tasks_ids = array_pluck($student_tasks->toArray(), 'task_id');
        $blockGroup = Professor::getBlockProfessor();
        $data = [
            'tasks_finisheds' => $tasks_finisheds,
            'student_tasks' => $student_tasks,
            'student_tasks_ids' => $student_tasks_ids,
            'schedule'=>$schedule,
            'sesions' => $sesions,
            'tasks' => $tasks,
            'blockGroup' => $blockGroup,
            'sesion_max' => $sesion_max,
        ];
        return view('components.contents.professor.studentSesions', $data);
    }
}
