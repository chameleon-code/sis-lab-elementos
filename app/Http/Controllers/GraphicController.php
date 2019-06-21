<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\Sesion;
use App\Group;
class GraphicController extends Controller
{
    public function index(){
        return view('components.contents.graphics.graficos');
    }
    public function getTaskByBlockId(){
        $block_sesions=Block::find(1)->sesions()->get();
        // $sesions=Sesion::getAllSesionByBlockId($block->id);
        $task_student=[];
        // $valor = $block_sesions[19]->tasks()->get();
        // // dd($valor);
        // $task_student = $valor->first()->studentTasks()->get();
        // dd($task_student);
        // // dd($valor->first()->studentTasks()->get());
        foreach($block_sesions as $key => $value){
            $tasks = $value->tasks()->get();
            foreach($tasks as $key => $value){
                $taskStudent=$value->studentTasks()->get()->first();
                array_push ( $task_student , $taskStudent);
            }
            //dd($valor->first()->studentTasks()->get());
        }
        dd($task_student);
        return view('components.contents.graphics.graficos');
    }
    public function getTaskByGroupID($group_id){
        $group_student = Group::find($group_id)->studentSchedules()->get();
        $tasks_students=[];
        foreach($group_student as  $key => $value){
            $student=$value->student()->get()->first();
            $tasks=$student->studentTasks()->get();
            foreach($tasks as $key => $value){
                array_push($tasks_students,$value);
            }
        }
        //dd($tasks_students);
        return $tasks_students;
        //dd($group_student);
        //dd($group_student->first()->student()->get());
        $student=$group_student->first()->student()->get();
        $student_tasks = $student->first()->studentTasks()->get();
        dd($student_tasks);
        dd($group_student->first()->student()->get());

        $block_sesions=Block::find(2)->sesions()->get();
        // $sesions=Sesion::getAllSesionByBlockId($block->id);
        $task_student=[];
        // $valor = $block_sesions[19]->tasks()->get();
        // // dd($valor);
        // $task_student = $valor->first()->studentTasks()->get();
        // dd($task_student);
        // // dd($valor->first()->studentTasks()->get());
        foreach($block_sesions as $key => $value){
            $tasks = $value->tasks()->get();
            foreach($tasks as $key => $value){
                $taskStudent=$value->studentTasks()->get()->first();
                array_push ( $task_student , $taskStudent);
            }
            //dd($valor->first()->studentTasks()->get());
        }
        dd($task_student);
        return view('components.contents.graphics.graficos');
    }
}
