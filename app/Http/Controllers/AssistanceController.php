<?php

namespace App\Http\Controllers;

use App\Block;
use App\BlockSchedule;
use App\Group;
use App\Student;
use App\User;
use App\StudentSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\ScheduleRecord;
use Illuminate\Console\Scheduling\Schedule;
use App\Laboratory;

class AssistanceController extends Controller
{
    public function index()
    {
        $students = Student::getAllStudents();
        //$user_id = $student->user_id;
        //$user = User::findOrFail($user_id);
        $labs = Laboratory::all();
        $block_schedules = BlockSchedule::all();
        //return $block_schedules;
        $data = ['students' => $students,
            'labs' => $labs,
            'block_schedules' => $block_schedules,
        ];
        return view('components.contents.auxiliar.assistance', $data)->withTitle('Perfil de Estudiante');
    }
    public static function getStudentsByBlock(Request $request, $id){
        $block_schedules = BlockSchedule::where('block_id', $id)->get();
        $students = collect();
        $block_schedules->each(function($item) use ($students){
            if($item->students->isNotEmpty()){
                foreach($item->students as $student){}                
                $students->push($student);
            }
        });
        if($request->ajax()){
            $array = array();
            foreach($students as $s){
                $student = new \stdClass();
                $student->Codigo_Sis = $s->user->code_sis;
                $student->Apellidos = $s->user->first_name ." ". $s->user->second_name;
                $student->Nombres = $s->user->names;
                $student->Asistencia = (object)[
                    'student' => $s->user,
                    'schedule_id' => $s->id
                ];
                array_push($array, $student);
            }
            return response()->json($array);
        }
        return $students;
    } 
    //muestra contenido block_schedules
    public function bloque_schedules()
    {
        $students = Student::getAllBlocks();
        $block_schedules = BlockSchedule::all();
        $blocks = Block::all();
        $data = [
            'block_schedules' => $students,
            'title' => 'block_schedules',
            'block_schedules' => $block_schedules,
            'blocks' => $blocks,
        ];

        return view('components.contents.auxiliar.assistance', $data);
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        $user_id = $student->user_id;
        $user = User::findOrFail($user_id);

        $data = ['student' => $student,
            'user' => $user
        ];

        return view('components.contents.student.profile')->withTitle('Perfil de Estudiante')->with($data);
    }



    public function confirm(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', '=', $user->id)->get()->first();
        $student->block_id = $request->block_id;
        $student->group_id = $request->group_id;
        $group = Group::find($request->group_id);
        $dir = Block::find($request->block_id)->block_path.'/'.$group->name.'/'.base64_encode($user->code_sis);
        $student->student_path = $dir;
        $student->save();
        Storage::makeDirectory($dir);
        return redirect('/home');
    }




   /* public function rememberNav(){
        $tmp = 0.05;
        Cache::put('professor_nav', '', $tmp);
        Cache::put('auxiliar_nav', '', $tmp);
        Cache::put('student_nav', ' show', $tmp);
        Cache::put('management_nav', '', $tmp);
        Cache::put('subject_matter_nav', '', $tmp);
        Cache::put('group_nav', '', $tmp);
        Cache::put('block_nav', '', $tmp);
    }*/
}
