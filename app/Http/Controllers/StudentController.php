<?php

namespace App\Http\Controllers;

use App\Mail\StudentMailController;
use App\Student;
use App\User;
use App\Management;
use App\Block;
use \App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::getAllStudents();

        $data = ['students' => $students,
            'title' => 'Estudiantes'];
        return view('components.contents.student.index', $data);
    }

    public function create()
    {
        return view('components.contents.student.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $student = new Student();
        if ($student->validate($input)) {
            $data = array(
                'names' => $request->names,
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'email' => $request->email,
                'code_sis' => $request->code_sis,
                'ci' => $request->ci,
                'password' => $request->password
            );
            $newStudent = User::create([
                'role_id' => Role::STUDENT,
                'names' => $request->names,
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            Student::create([
                'user_id' => $newStudent->id,
                'code_sis' => $request->code_sis,
                'ci' => $request->ci,
            ]);
            Mail::to($request->email)->send(new StudentMailController($data,'register'));
            if($request->mode=='register'){
                return redirect('/');
            }else{
                return redirect('/admin/students');
            }
        } else {
            if($request->mode=='register'){
                return redirect('/register')->withInput($input)->withErrors($student->errors);
            }else{
                return redirect('/admin/student/create')->withInput($input)->withErrors($student->errors);
            }
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $user_id = $student->user_id;
        $student->delete();

        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect('/admin/students');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $user_id = $student->user_id;
        $user = User::findOrFail($user_id);
        $data = ['student' => $student,
            'user' => $user
        ];

        return view('components.contents.student.edit')->withTitle('Editar Estudiante')->with($data);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $user_id = $student->user_id;
        $user = User::findOrFail($user_id);
        $input = $request->all();
        if ($user->validate($input)) {
            $user->names = $request->names;
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            $student->code_sis = $request->code_sis;
            $student->ci = $request->ci;
            $student->save();
            Session::flash('status_message', 'Estudiante Editado!');
            return redirect('/admin/students');
        }
        return black()->withInput($input)->withErrors($user->errors);
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

    public function registration()
    {
        $managements = Management::getAllManagements()->reverse();
        $blocks = Block::getAllBlocks();
        $data=[ 'blocks' => $blocks,
                'managements' =>$managements,
            ];
        return view('components.contents.student.registration', $data);
        dd("gg");
    }

    public function confirm(Request $request)
    {
        $user = Auth::user();
        $student = Student::find($user->id);
        $student->block_id = $request->block_id;
        $dir = Block::find($request->block_id)->block_path.'/'.$user->names;
        $student->student_path = $dir;
        $student->save();

        Storage::makeDirectory($dir);

        return redirect('/home');
    }
}
