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
use Illuminate\Support\Facades\Validator;
use App\SubjectMatter;
use Illuminate\Support\Facades\Cache;
use App\BlockGroup;
use App\BlockSchedule;
use App\ScheduleRecord;
use App\StudentSchedule;
use App\Professor;
use App\StudentTask;
use App\Task;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::getAllStudents();
        $data = [
            'students' => $students,
            'title' => 'Estudiantes'];
        return view('components.contents.student.index', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $user = new User();
        $rules_guest =  [
            'names' => 'required|max:100',
            'first_name' => 'max:100',
            'second_name' => 'max:100',
            'email' => 'unique:users|email|required|max:150',
            'password' => 'required|min:8',
            'code_sis' => 'unique:users|required|max:10|min:8',
            'ci' => 'unique:students|max:9|min:6',
            'g-recaptcha-response' => 'required',
        ];
        $rules_admin =  [
            'names' => 'required|max:100',
            'first_name' => 'max:100',
            'second_name' => 'max:100',
            'email' => 'unique:users|email|required|max:150',
            'password' => 'required|min:8',
            'code_sis' => 'unique:users|required|max:10|min:8',
            'ci' => 'unique:students|max:9|min:6',
        ];
        if(Auth::user()){
            $rules = (Auth::user()->role_id==1) ? $rules_admin : $rules_guest;
        } else {
            $rules = $rules_guest;
        }
        $validator = Validator::make($input, $rules);
        if ( !$validator->fails() ) {
            $data = array(
                'names' => $request->names,
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'email' => $request->email,
                'code_sis' => $request->code_sis,
                'ci' => $request->ci,
                'password' => $request->password
            );
            Mail::to($request->email)->send(new StudentMailController($data,'register'));
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
            if($request->mode=='register'){
                return redirect('/');
            }else{
                return redirect('/admin/students');
            }
        } else {
            $errors = $validator->messages();
            if($request->mode=='register'){
                return redirect('/register')->withInput($input)->withErrors($errors);
            }else{
                return redirect('/admin/student/create')->withInput($input)->withErrors($errors);
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
        $data = [
            'student' => $student,
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
        $data = [
            'student' => $student,
            'user' => $user
        ];
        return view('components.contents.student.profile')->withTitle('Perfil de Estudiante')->with($data);
    }

    public function registration()
    {
        $actual_management = Management::getActualManagement();
        $subjectMatters = SubjectMatter::getActualSubjectMatters($actual_management->id);
        $groups = Group::join('block_group', 'groups.id', '=', 'block_group.group_id')
                       ->join('blocks', 'block_group.block_id', '=', 'blocks.id')
                       ->join('managements', 'blocks.management_id', '=', 'managements.id')
                       ->where('managements.id', '=', $actual_management->id)
                       ->select('groups.*', 'blocks.id as block_id', 'blocks.id as block_id', 'managements.id as management_id')
                       ->orderby('name')
                       ->get();
        $subject_ids = [];
        for($i=0 ; $i<sizeof($groups) ; $i++) {
            array_push($subject_ids, $groups[$i]->subject->id);
        }
        $subject_ids = array_unique($subject_ids);
        $subjects = [];
        for($i=0 ; $i<sizeof($subject_ids) ; $i++) {
            array_push( $subjects, SubjectMatter::find($subject_ids[$i]) );
        }
        $user = User::join('students', 'users.id', '=', 'students.user_id')
                    ->where('users.id', '=', Auth::user()->id)
                    ->select('users.*', 'students.id as student_id')
                    ->get()
                    ->first();
        $student_schedules = BlockSchedule::join('student_schedules', 'block_schedules.id', '=', 'student_schedules.block_schedule_id')
                                          ->join('blocks', 'block_schedules.block_id', '=', 'blocks.id')
                                          ->join('managements', 'blocks.management_id', '=', 'managements.id')
                                          ->join('groups', 'student_schedules.group_id', '=', 'groups.id')
                                          ->join('subject_matters', 'groups.subject_matter_id', '=', 'subject_matters.id')
                                          ->join('professors', 'groups.professor_id', '=', 'professors.id')
                                          ->join('users', 'professors.user_id', '=', 'users.id')
                                          ->where('student_schedules.student_id', '=', $user->student_id)
                                          ->where('managements.id', '=', $actual_management->id)
                                          ->select('block_schedules.*', 'subject_matters.id as subject_matter_id', 'subject_matters.name as subject_matter_name', 'groups.id as group_id', 'groups.name as group_name', 'users.names as professor_names', 'users.first_name as professor_first_name', 'users.second_name as professor_second_name', 'student_schedules.id as student_schedule_id')
                                          ->get();
        $data = [
            'groups' => $groups,
            'subjects' => $subjects,
            'subjectMatters' => $subjectMatters,
            'student_schedules' => $student_schedules
        ];
        return view('components.contents.student.registration', $data);
    }

    public function create()
    {
        return view('components.contents.student.create');
    }

    public function getScheduleStudent(){
        $student = Student::where('user_id', '=', Auth::user()->id)->get()->first();
        $groups = Group::all();
        $professors = Professor::join('users', 'user_id', '=', 'users.id')
                               ->select('professors.id AS professor_id', 'users.names', 'users.first_name', 'users.second_name')
                               ->get();
        $professors->each(function ($item){
            $item->setAppends([]);
        });
        $shcedule_student = StudentSchedule::join('groups','group_id','=','groups.id')
                                           ->select('groups.id AS group_id', 'groups.name', 'groups.subject_matter_id', 'groups.professor_id', 'student_schedules.id', 'student_schedules.student_id', 'student_schedules.block_schedule_id', 'student_schedules.student_path')
                                           ->where('student_schedules.student_id', '=', $student->id)
                                           ->get();
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
        return $response;
    }

    public function getStudentsByGroup($group_id, $block_id, $management_id, $sesion_id) {
        $students = Student::join('student_schedules', 'students.id', '=', 'student_schedules.student_id')
                           ->join('users', 'students.user_id', '=', 'users.id')
                           ->join('groups', 'student_schedules.group_id', '=', 'groups.id')
                           ->join('block_group', 'groups.id', '=', 'block_group.group_id')
                           ->join('blocks', 'block_group.block_id', '=', 'blocks.id')
                           ->join('managements', 'blocks.management_id', '=', 'managements.id')
                           ->join('block_schedules', 'student_schedules.block_schedule_id', '=', 'block_schedules.id')
                           ->where('managements.id', '=', $management_id)
                           ->where('block_schedules.block_id', '=', $block_id)
                           ->where('student_schedules.group_id', '=', $group_id)
                           ->select('users.*', 'students.id as student_id', 'groups.id as group_id', 'blocks.id as block_id', 'managements.id as management_id')
                           ->orderby('first_name')
                           ->get();
        $students_with_task = Student::join('student_tasks', 'students.id', '=', 'student_tasks.student_id')
                                     ->join('tasks', 'student_tasks.task_id', '=', 'tasks.id')
                                     ->join('sesions', 'tasks.sesion_id', '=', 'sesions.id')
                                     ->join('student_schedules', 'students.id', '=', 'student_schedules.student_id')
                                     ->join('block_schedules', 'student_schedules.block_schedule_id', '=', 'block_schedules.id')
                                     ->join('users', 'students.user_id', '=', 'users.id')
                                     ->where('block_schedules.block_id', '=', $block_id)
                                     ->where('student_schedules.group_id', '=', $group_id)
                                     ->where('tasks.sesion_id', '=', $sesion_id)
                                     ->select('tasks.*', 'block_schedules.block_id as block_id', 'student_schedules.group_id as group_id','students.id as student_id', 'users.first_name as student_first_name')
                                     ->orderby('student_first_name')
                                     ->get();
        $students_with_task_ids = [];
        for($i=0 ; $i<sizeof($students_with_task) ; $i++) {
            array_push($students_with_task_ids, $students_with_task[$i]->student_id);
        }
        $students_status_task = [];
        for($i=0 ; $i<sizeof($students) ; $i++) {
            array_push( $students_status_task, false );
        }
        for($i=0 ; $i<sizeof($students) ; $i++) {
            if( in_array($students[$i]->student_id, $students_with_task_ids) ) {
                $students_status_task[$i] = true;
            }
        }
        $data = [
            'students' => $students,
            'students_status_task' => $students_status_task,
            'students_with_task_ids' => array_unique($students_with_task_ids)
        ];
        return $data;
    }
}
