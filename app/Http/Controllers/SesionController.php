<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sesion;
use App\Task;
use App\Student;
use App\Block;
use App\Professor;
use App\User;
use App\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\SubjectMatter;
use App\Management;
use App\StudentSchedule;

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
            $data = [
                'blocks' => $blockGroups,
                'sesions' => $sesionsBlocks,
                'start' => $dateStart,
                'end' => $dateEnd,
                'subjects'=>$subjectNames
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
        $student = Student::where('user_id',$id)->first();
        //dd($student);
        $schedule = StudentSchedule::all();
        $schedule->reject(function($item, $key) use ($student){
            if($item->student_id =! $student->id){
                return true;
            }
        });
        $user = User::where('id', '=', $student->user_id)->get()->first();
        $group = Group::find($schedule->first()->group_id);
        $sesions = Sesion::where('block_id', $group->blocks->first()->id)->get();
        //dd($group);
        $tasks = Task::all();
        $sesion_max = Sesion::max('number_sesion');
        $subjectMatter = SubjectMatter::where('id', '=', $group->subject_matter_id)->get()->first();
        $blockGroup = Professor::getBlockProfessor();

        $data = [
            'student' => $student,
            'user' => $user,
            'sesions' => $sesions,
            'tasks' => $tasks,
            'blockGroup' => $blockGroup,
            'sesion_max' => $sesion_max,
            'group' => $group,
            'subject_matter' => $subjectMatter,
        ];

        return view('components.contents.professor.studentSesions', $data);
    }
}
