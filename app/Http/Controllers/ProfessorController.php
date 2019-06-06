<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\Role;
use App\User;
use App\Student;
use App\Mail\ProfessorMailController;
use Illuminate\Support\Facades\Mail;
use App\SubjectMatter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\BlockGroup;
use App\Group;
use Illuminate\Support\Facades\Cache;
use App\Mail\StudentMailController;
use App\StudentSchedule;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        self::rememberNav();

        $professors = Professor::getAllProfessors();
        if(Auth::user()->role_id==Role::ADMIN){
            $data = ['professors' => $professors,
            'title' => 'Docentes',
            'view'  =>  'adminSection',
            ];
        }else{
            $data = ['professors' => $professors,
            'title' => 'Docentes',
            'view'  =>  'professorSection',
            ];
        }
        return view('components.contents.professor.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::rememberNav();

        $subjectMatters = SubjectMatter::getAllSubjectMatters();
        $data=['subjectMatters'=>$subjectMatters];
        return view('components.contents.professor.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input =$request->all();
        $professor = new Professor();
        $user = new User();
        if($user->validate($input)){
            $data = array(
                'names' => $request->names,
                'first_name'=> $request->first_name,
                'second_name'=> $request->second_name,
                'email' => $request->email,
                'password' => $request->password,
                'code_sis' => $request->code_sis
            );
            $newProfessor = User::create( [
                'role_id'=> Role::PROFESSOR,
                'names' => $request->names,
                'first_name'=> $request->first_name,
                'second_name'=> $request->second_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'code_sis' => $request->code_sis
            ]);
            $professor->user_id = $newProfessor->id;
            $professor->save();
            Mail::to($request->email)->send(new ProfessorMailController($data,'register'));
            return redirect('/admin/professors');
        }else{
            return redirect('/admin/professors/create')->withInput()->withErrors($user->errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professor = Professor::findOrFail($id);
        $user_id=$professor->user_id;
        $user = User::findOrFail($user_id);
        $data=['professor' => $professor,
            'user' => $user
        ];
        return view('components.contents.professor.profile')->withTitle('Perfil de Docente')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professor = Professor::findOrFail($id);
        $user_id=$professor->user_id;
        $user = User::findOrFail($user_id); 
        $data=['professor' => $professor,
            'user' => $user
        ];
        return view('components.contents.professor.edit')->withTitle('Editar Docente')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $professor = new Professor();
        $input = $request->all();
        if($professor->validate($input)){
            $user->names = $request->names;
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->code_sis = $request->code_sis;
            $user->save();
            Session::flash('status_message', 'Docente '.$user->names.' editado correctamente!');
            return redirect('/admin/professors');
        }
        return back()->withInput($input)->withErrors($professor->errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $user_id = $professor->user_id;
        $professor->delete();
        $user = User::findOrFail($user_id);
        $user->delete();
        Session::flash('status_message', 'Docente eliminad@ correctamente');
        return redirect('/admin/professors');   
    }

    //Obtiene la lista de estudiantes en base a grupo
    public function studentList(){
        $professor = Professor::where('user_id', auth()->user()->id)->first();
        $groups = Group::where('professor_id', $professor->id)->get();
        $groupID = StudentSchedule::all();
        $groupID->search(function ($item, $key) use ($groups){
            foreach($groups as $group){
                if($group->id == $item->group->id)
                return true;
            }
        });
        //dd($groupID->first());
        $schedules = $this->studentListBySubject(new Request, $groupID->first()->group_id);
        $data = [
                    'schedules' => $schedules,
                    'groups' => $groups,
                    'groupID' => $groupID->first(),
                    'title' => 'Estudiantes'
                ];
            return view('components.contents.professor.studentList', $data);
    }
    public function studentListBySubject(Request $request, $id){
        $schedules = StudentSchedule::all();
        $schedules2 = $schedules->reject(function($item, $key) use ($id){
            if($item->group_id != $id)
                return true;
        });
        if($request->ajax()){
            return response()->json($schedules2);
        }
        //dd($schedules);
        return $schedules2;
    }

    public function profileStudent($id)
    {
        $student = Student::findOrFail($id);
        $user_id = $student->user_id;
        $user = User::findOrFail($user_id);

        $data = ['student' => $student,
            'user' => $user
        ];

        return view('components.contents.professor.profileStudent')->withTitle('Perfil de Estudiante')->with($data);
    }

    public function rememberNav(){
        $tmp = 0.05;
        Cache::put('professor_nav', ' show', $tmp);
        Cache::put('auxiliar_nav', '', $tmp);
        Cache::put('student_nav', '', $tmp);
        Cache::put('management_nav', '', $tmp);
        Cache::put('subject_matter_nav', '', $tmp);
        Cache::put('group_nav', '', $tmp);
        Cache::put('block_nav', '', $tmp);
    }
}
