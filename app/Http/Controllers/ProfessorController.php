<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\Role;
use App\User;
use App\Mail\ProfessorMailController;
use Illuminate\Support\Facades\Mail;
use App\SubjectMatter;
use Illuminate\Support\Facades\Session;
class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $professors = Professor::getAllProfessors();
        $data = ['professors' => $professors,
                'title' => 'Docentes'];
        return view('components.contents.professor.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $user =new User();
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
        $input = $request->all();
        if($user->validate($input)){
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
        return black()->withInput($input)->withErrors($user->errors);
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
}
