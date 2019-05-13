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
class StudentController extends Controller
{
    public function index()
    {
        $students = Student::getAllStudents();

        $data = ['students' => $students,
            'title' => 'Estudiantes'];
        return view('components.contents.student.index', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $user = new User();
        if ($user->validate($input)) {
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
                'code_sis' => $request->code_sis,
            ]);
            Student::create([
                'user_id' => $newStudent->id,
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
                return redirect('/register')->withInput($input)->withErrors($user->errors);
            }else{
                return redirect('/admin/student/create')->withInput($input)->withErrors($user->errors);
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
        if ($student->validate($input)) {
            $user->names = $request->names;
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->code_sis = $request->code_sis;
            $user->save();
            $student->ci = $request->ci;
            $student->save();
            Session::flash('status_message', 'Estudiante Editado!');
            return redirect('/admin/students');
        }
        return back()->withInput($input)->withErrors($student->errors);
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
        $groups = Group::all();
        $data=[ 'blocks' => $blocks,
                'groups' => $groups,
                'managements' =>$managements,
            ];
        return view('components.contents.student.registration', $data);
    }

    public function confirm(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', '=', $user->id)->get()->first();
        $student->block_id = $request->block_id;
        $student->group_id = $request->group_id;
        $dir = Block::find($request->block_id)->block_path.'/'.base64_encode($user->code_sis);
        $student->student_path = $dir;
        $student->save();
        Storage::makeDirectory($dir);
        $sesions = Sesion::where('block_id', '=', $request->block_id)->get();
        
        foreach($sesions as $sesion)
        {
            $sesion_path = 'sesion-'.$sesion->number_sesion;
            Storage::makeDirectory($dir.'/'.$sesion_path);
        }

        return redirect('/home');
    }
    

    public function create()
    {
        return view('components.contents.student.create');
    }
}
