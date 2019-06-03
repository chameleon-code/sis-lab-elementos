<?php

namespace App\Http\Controllers;

use App\Mail\StudentMailController;
use App\Student;
use App\User;
use App\Management;
use App\Block;
use \App\Role;
use App\Group;
use App\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\SubjectMatter;
use Illuminate\Support\Facades\Cache;

class AssistanceController extends Controller
{
    public function index()
    {
        //self::rememberNav();

        $students = Student::getAllStudents();
        $data = ['students' => $students,
            'title' => 'Estudiantes'];
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
