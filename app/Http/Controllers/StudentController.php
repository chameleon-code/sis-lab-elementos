<?php

namespace App\Http\Controllers;

use App\Mail\MailController2;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::getAllStudents();

        $data = ['students' => $students,
            'title' => 'Students Title'];
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
                'password' => $request->password
            );
            $newStudent = User::create([
                'role_id' => \App\Role::STUDENT,
                'names' => $request['names'],
                'first_name' => $request['first_name'],
                'second_name' => $request['second_name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            Student::create([
                'user_id' => $newStudent['id'],
            ]);
            Mail::to($request->email)->send(new MailController2($data));
            return redirect('/admin/students');
        } else {
            return redirect('admin/students/register')->withInput()->withErrors($student->errors);
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
        $user = User::find($id);
        $input = $request->all();

        if ($user->validate($input)) {
            $user->names = $request->names;
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

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
}
