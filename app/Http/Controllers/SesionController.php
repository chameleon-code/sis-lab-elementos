<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sesion;
use App\Task;
use App\Student;
use App\Block;
use Illuminate\Support\Facades\Storage;

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

        $data = [
            'sesions' => $sesions,
            'tasks' => $tasks,
            'sesion_max' => $sesion_max,
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
}
