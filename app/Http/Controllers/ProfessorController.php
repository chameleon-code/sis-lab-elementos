<?php

namespace App\Http\Controllers;

use App\Group;
use App\Laboratory;
use App\Mail\ProfessorMailController;
use App\Professor;
use App\Role;
use App\Student;
use App\StudentSchedule;
use App\StudentTask;
use App\SubjectMatter;
use App\User;
use App\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Block;
use App\BlockSchedule;
use App\Management;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if( !Auth::user() ) { return redirect('/'); }
        $professors = Professor::getAllProfessors();
        if(Auth::user()->role_id==Role::ADMIN){
            $data = [
                'professors' => $professors,
                'title' => 'Docentes',
                'view'  =>  'adminSection',
            ];
        }else{
            $data = [
                'professors' => $professors,
                'title' => 'Docentes',
                'view'  =>  'professorSection',
            ];
        }
        return view('components.contents.professor.index',$data);
    }

    public function registro()
    {
        $professor = Professor::where('user_id', auth()->user()->id)->first();
        $groups = Group::where('professor_id', $professor->id)->get()->reject(function ($item, $key){
            if(is_null($item->blocks->first())){
                return true;
            }
        }); 
        if($groups->isNotEmpty()){
            $schedules = $this->studentListByGroup(new Request, $groups->first()->id);
            $sesions = $groups->first()->blocks()->first()->sesions;
        }
        else{
            $schedules = collect();
            $sesions = collect();
        }
        $data = [
            'schedules' => $schedules,
            'groups' => $groups,
            'sesions' => $sesions,
            'title' => 'Estudiantes'
        ];
        return view('components.contents.professor.registerAssistance', $data)->withTitle('Perfil de Estudiante');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectMatters = SubjectMatter::getAllSubjectMatters();
        $data = ['subjectMatters' => $subjectMatters];
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
        $data = [
            'professor' => $professor,
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
        $data = [
            'professor' => $professor,
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
        if( !Auth::user() ) { return redirect('/'); }
        $blockGroups = Professor::getBlockGroupsProfessor();
        $groups=Professor::where('user_id', '=', Auth::user()->id)->get()->first()->groups;
        $sesion = Sesion::getActualSesion($groups->first()->blocks[0]->id);
        $actual_sesion=0;
        try {
            if($sesion != null){
                $actual_sesion = $sesion->number_sesion;
            }
            // throw new \App\Exceptions\NotFoundmonException('not_found');
        } catch (Exception $e) {
            report($e); 
            // if an exception happened in the try block above 
        }
        $data = [
            //'schedules' => $schedules,
            'blockGroups'   => $blockGroups,
            'groups'        => $groups,
            'blocks'        => $groups->first()->blocks,
            'sesions'       => $groups->first()->blocks[0]->sesions,
            'title'         => 'Estudiantes',
            'actual_sesion' => $actual_sesion
        ];
        return view('components.contents.professor.studentList', $data);
    }

    public function studentListByGroup(Request $request, $id){
        $schedules = StudentSchedule::all();
        $schedules2 = $schedules->reject(function($item, $key) use ($id){
            if($item->group_id != $id)
                return true;
        });
        if($request->ajax()){
            $array = array();
            foreach($schedules2->values()->all() as $schedule){
                $student = new \stdClass();
                $student->Codigo_Sis = $schedule->getUserAttribute()->code_sis;
                $student->Apellidos = $schedule->getUserAttribute()->first_name ." ". $schedule->getUserAttribute()->second_name;
                $student->Nombres = $schedule->getUserAttribute()->names;
                $student->Acciones = (object)[
                    'student' => $schedule->getUserAttribute(),
                    'schedule_id' => $schedule->id
                ];
                array_push($array, $student);
            }
            return response()->json($array);
        }
        return $schedules2->values()->all();
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
    
    public function downloadPortflies(){
        $professor = Professor::where('user_id', auth()->user()->id)->first();
        $groups = Group::where('professor_id', $professor->id)->get()->reject(function ($item, $key){
            if(is_null($item->blocks->first())){
                return true;
            }
        }); 
        $data = [
            'groups' => $groups,
            'title' => 'Portafolios en base a grupos'
        ];
        return view('components.contents.professor.portflies', $data);
    }

    public function statisticsByGroup() {
        if( !Auth::user() ) { return redirect('/'); }
        $professor = Professor::join('users', 'professors.user_id', '=', 'users.id')
                              ->where('users.id', '=', Auth::user()->id)
                              ->select('users.*', 'professors.id as professor_id')
                              ->get()
                              ->first();
        $groups = Group::join('block_group', 'groups.id', '=', 'block_group.group_id')
                       ->join('blocks', 'block_group.block_id', '=', 'blocks.id')
                       ->join('managements', 'blocks.management_id', '=', 'managements.id')
                       ->select('groups.*', 'block_group.id as block_group_id', 'blocks.id as block_id', 'blocks.name as block_name','managements.id as management_id')
                       ->where('groups.professor_id', '=', $professor->professor_id)
                       ->get();
        $data = [
            'managements' => Management::all()->reverse(),
            'groups' => $groups
        ];
        return view('components.contents.professor.statisticsByGroup', $data);
    }

    public function statisticsByBlock() {///
        if( !Auth::user() ) { return redirect('/'); }
        $professor = Professor::join('users', 'professors.user_id', '=', 'users.id')
                              ->where('users.id', '=', Auth::user()->id)
                              ->select('users.*', 'professors.id as professor_id')
                              ->get()
                              ->first();
        $groups = Group::join('block_group', 'groups.id', '=', 'block_group.group_id')
                       ->join('blocks', 'block_group.block_id', '=', 'blocks.id')
                       ->join('managements', 'blocks.management_id', '=', 'managements.id')
                       ->select('groups.*', 'block_group.id as block_group_id', 'blocks.id as block_id', 'blocks.name as block_name','managements.id as management_id')
                       ->where('groups.professor_id', '=', $professor->professor_id)
                       ->get();
        $data = [
            'managements' => Management::all()->reverse(),
            'groups' => $groups
        ];
        return view('components.contents.professor.statisticsByBlock', $data);
    }
}

