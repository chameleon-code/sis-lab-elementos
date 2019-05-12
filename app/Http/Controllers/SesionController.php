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
        $sesions = Sesion::all();
        $tasks = Task::all();
        $sesion_max = Sesion::max('number_sesion');
        $blockGroup = Professor::getBlockProfessor();
        $block = Block::find($blockGroup->block_id);
        $group = Group::find($blockGroup->group_id);
        $subject_matter = SubjectMatter::where('id', '=', $group->subject_matter_id)->get()->first();

        $data = [
            'sesions' => $sesions,
            'tasks' => $tasks,
            'blockGroup' => $blockGroup,
            'sesion_max' => $sesion_max,
            'block' => $block,
            'group' => $group,
            'subject_matter' => $subject_matter,
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
