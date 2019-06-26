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
use App\BlockGroup;
use App\BlockSchedule;
use App\ScheduleRecord;
use App\StudentSchedule;
use App\Professor;

class StudentController extends Controller
{
    public function index()
    {
        self::rememberNav();

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
        $management = Management::getActualManagement();
        $blocks = Block::getAllBlocks();
        $subjectMatters = SubjectMatter::all();
        $subjectMatters = SubjectMatter::getActualSubjectMatters($management->id);
        $groups = Group::getGroupBlocks();
        $data=[ 'blocks' => $blocks,
                'groups' => $groups,
                'management' =>$management,
                'subjectMatters' => $subjectMatters,
            ];
        return view('components.contents.student.registration', $data);
    }

    public function create()
    {
        self::rememberNav();
        return view('components.contents.student.create');
    }

    public function getScheduleStudent(){
        $student = Student::where('user_id', '=', Auth::user()->id)->get()->first();
        //$student = Student::where('user_id', '=', $id)->get()->first();
        $groups = Group::all();
        $professors = Professor::join('users', 'user_id', '=', 'users.id')->select('professors.id AS professor_id', 'users.names', 'users.first_name', 'users.second_name')->get();
        $professors->each(function ($item){
            $item->setAppends([]);
        });
        $shcedule_student = StudentSchedule::join('groups','group_id','=','groups.id')->select('groups.id AS group_id', 'groups.name', 'groups.subject_matter_id', 'groups.professor_id', 'student_schedules.id', 'student_schedules.student_id', 'student_schedules.block_schedule_id', 'student_schedules.student_path')->where('student_schedules.student_id', '=', $student->id)->get();
        $shcedule_student->each(function ($item){
            $item->setAppends([]);
        });
        $subject_matters = SubjectMatter::all();
        $block_schedules = BlockSchedule::all();

        $response = [
            'groups' => $groups,
            'professors' => $professors,
            'schedule_student' => $shcedule_student,
            'subject_matters' => $subject_matters,
            'block_schedules' => $block_schedules,
        ];

        //return $shcedule_student;
        return $response;
    }

    public function rememberNav(){
        $tmp = 0.05;
        Cache::put('professor_nav', '', $tmp);
        Cache::put('auxiliar_nav', '', $tmp);
        Cache::put('student_nav', ' show', $tmp);
        Cache::put('management_nav', '', $tmp);
        Cache::put('subject_matter_nav', '', $tmp);
        Cache::put('group_nav', '', $tmp);
        Cache::put('block_nav', '', $tmp);
    }
}
