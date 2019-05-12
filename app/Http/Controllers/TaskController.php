<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\Sesion;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
            'task'=>$validTasks,
        ];
        return view('components.contents.professor.publishTasks', $data);
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
