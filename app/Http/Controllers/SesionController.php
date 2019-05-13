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

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sesions = Sesion::all();
        // $tasks = Task::all();
        // $sesion_max = Sesion::max('number_sesion');
        // $blockGroup = Professor::getBlockProfessor();

        // $data = [
        //     'sesions' => $sesions,
        //     'tasks' => $tasks,
        //     'blockGroup' => $blockGroup,
        //     'sesion_max' => $sesion_max,
        // ];
        $blockGroup = Professor::getBlockProfessor();
        $blockGroupId = Professor::getBlockProfessor()->block_id;
        $sesions = Sesion::where('block_id','=',$blockGroupId)->get();
        $tasks = Task::all();
        $validTasks=[];
        foreach ($tasks as $task) {
            foreach($sesions as $sesion){
                if($task->sesion_id==$sesion->id && $sesion->block_id==$blockGroupId){
                    array_push($validTasks,$task);
                }
            }
        }
        $sesion_max = $sesions->count();
        $data = [
            'sesion_max'=>$sesion_max,
            'sesions'=>$sesions,
            'blockGroup'=>$blockGroup,
            'tasks'=>$validTasks,
        ];
        return view('components.contents.professor.sesions', $data);
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
        Sesion::create([
            'block_id' => $request->block_id,
            'number_sesion' => $request->number_sesion,
        ]);

        $students = Student::where('block_id', '=', $request->block_id)->get();

        foreach($students as $student)
        {
            Storage::makeDirectory($student->student_path.'/sesion-'.$request->number_sesion);
        }

        return redirect('/sesions');
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
        $student = Student::find($id);
        $user = User::where('id', '=', $student->user_id)->get()->first();
        $sesions = Sesion::all();
        $tasks = Task::all();
        $sesion_max = Sesion::max('number_sesion');
        $group = Group::find($student->group_id);
        $subjectMatter = SubjectMatter::where('id', '=', $group->subject_matter_id)->get()->first();
        $blockGroup = Professor::getBlockProfessor();

        $data = [
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
