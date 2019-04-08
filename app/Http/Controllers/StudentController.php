<?php

namespace App\Http\Controllers;

use App\Mail\MailController2;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        //return view('components.contents.admin.registerStudent'); //si usamos register dentro de admin, no se sigue standares
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
            return redirect('student'); // analizar si se debe redirigir con user/student
        } else {
            return redirect('student/create')->withInput()->withErrors($auxiliar->errors);
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $user_id = $student->user_id;
        $student->delete();

        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect('students');
    }
}
