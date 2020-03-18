<?php

namespace App\Http\Controllers;

use App\Assistance;
use App\Block;
use App\BlockSchedule;
use App\Group;
use App\Laboratory;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Sesion;

class AssistanceController extends Controller
{
    public function index()
    {
        $students = Student::getAllStudents();
        $labs = Laboratory::all();
        $auxiliarctrl = new AuxiliarController();
        $block_schedules = $auxiliarctrl->getStudentList(new Request, $labs->first()->id);
        $data = [
            'students' => $students,
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

    public function store(Request $request){
        $block_schedule = BlockSchedule::find($request['blockschedule_id']);
        try{
            if($request['status'] == 1){
                $assistance = new Assistance();
                $assistance->blockschedule_id = $block_schedule->id;
                $assistance->student_id = $request['student_id'];
                $assistance->attend = 1;
                $assistance->day = date('Y-m-d');
                $assistance->sesion_id = Sesion::getSesionIdToDayByBlock($block_schedule->block_id, $block_schedule->schedule_id);
                $assistance->save();
                $success = true;
            }
            else {
                $assistance = Assistance::where('blockschedule_id', $block_schedule->id)->get()->last();
                $assistance->delete();
                $success = true;
            }
        } catch (\Exception $exception) {
            $success = false;
        }
        return response()->json(['res' => $success]);
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
}
