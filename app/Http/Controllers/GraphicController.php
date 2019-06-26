<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\Sesion;
use App\Group;
use App\Management;
use App\SubjectMatter;
use App\Professor;
class GraphicController extends Controller
{
    public function index(){
        $subjectMatters=SubjectMatter::getAllSubjectMatters();
        $managements=Management::getAllManagements();
        $groups=Group::getAllGroups();
        //dd($groups->first()->subject);
        $data=[
            'subjectMatters' => $subjectMatters,
            'managements'    => $managements,
            'groups'         => $groups
        ];
        return view('components.contents.graphics.graficos',$data);
    }
    public function getTaskByBlockId($block_id){
        $block_sesions=Block::find($block_id)->sesions()->get();
        $task_student=[];
        foreach($block_sesions as $key => $value){
            $tasks = $value->tasks()->get();
            foreach($tasks as $key => $value){
                $taskStudent=$value->studentTasks()->get()->first();
                array_push ( $task_student , $taskStudent);
            }
            //dd($valor->first()->studentTasks()->get());
        }
        //dd($task_student);
        return $task_student;
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
    }
    public function getTaskByManagemenId($management_id){
        $blocks_managements=Management::find($management_id)->blocks()->get();
        $task_student=[];
        foreach($blocks_managements as $key => $value){
            $block_sesions=$value->sesions()->get();
            //dd($block_sesions);
            foreach($block_sesions as $key => $value){
                $tasks = $value->tasks()->get();
                foreach($tasks as $key => $value){
                    $taskStudent=$value->studentTasks()->get()->first();
                    if($taskStudent != null){
                        array_push ( $task_student , $taskStudent);
                    }
                }
            }
        }
        //dd($task_student);
        return $task_student;
    }
    public function getTaskBySubjectMatterId($subject_id){
        $groups=SubjectMatter::find($subject_id)->groups()->get();
        $tasks_students=[];
        foreach($groups as $key => $value){
            $group_student = $value->studentSchedules()->get();
            foreach($group_student as  $key => $value){
                $student=$value->student()->get()->first();
                $tasks=$student->studentTasks()->get();
                foreach($tasks as $key => $value){
                    array_push($tasks_students,$value);
                }
            }
        }
        //dd($tasks_students);
        return $tasks_students;
    }

    public function indexProfessor(){
        $professor=Auth()->user()->Professor;
        //dd($professor_id);
        $subjectMatters=$professor->subjectMatters()->get();
        $groups=$professor->groups()->get();;
        //dd($groups->first()->subject);
        $data=[
            'subjectMatters' => $subjectMatters,
            'groups'         => $groups
        ];
        return view('components.contents.graphics.graficosProfessor',$data);
    }

}
