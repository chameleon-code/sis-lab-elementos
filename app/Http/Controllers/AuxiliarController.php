<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Auxiliar;
use App\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuxiliarMailController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AuxiliarController extends Controller
{
    public function index(){
        $auxiliars = Auxiliar::getAllAuxiliars();
        
        $data=['auxiliars' => $auxiliars,
                'title' => 'Auxiliars Title'];
        return view('components.contents.auxiliar.index', $data);
    }
    
    public function create(){
        return view('components.contents.auxiliar.create');
    }

    public function store(Request $request){
        
        $input = $request->all();
        $auxiliar = new Auxiliar();
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
            $newAuxiliar = User::create([
                'role_id' => \App\Role::AUXILIAR,
                'names' => $request['names'],
                'first_name' => $request['first_name'],
                'second_name' => $request['second_name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'code_sis' => $request['code_sis']
            ]);
            Auxiliar::create([
                'user_id' => $newAuxiliar['id'],
            ]);
            Mail::to($request->email)->send(new AuxiliarMailController($data, 'register'));
            return redirect('/admin/auxiliars');
        } else {
            return redirect('admin/auxiliars/create')->withInput()->withErrors($user->errors);
        }
    }

    public function destroy($id){
        $auxiliar = Auxiliar::findOrFail($id);
        $user_id = $auxiliar->user_id;
        $auxiliar->delete();

        $user = User::findOrFail($user_id);
        $user->delete();
        Session::flash('status_message', 'Auxiliar eliminad@ correctamente');
        return redirect('/admin/auxiliars');
    }

    public function edit($id){
        $auxiliar = Auxiliar::findOrFail($id);
        $user_id=$auxiliar->user_id;
        $user = User::findOrFail($user_id);
        
        $data=['auxiliar' => $auxiliar,
            'user' => $user
        ];
        
        return view('components.contents.auxiliar.edit')->withTitle('Editar Auxiliar')->with($data);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $input = $request->all();

        if($user->validate($input)){
            $user->names = $request->names;
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            Session::flash('status_message', 'Auxiliar Editado!');
            return redirect('/admin/auxiliars');
        }
        return black()->withInput($input)->withErrors($user->errors);
    }

    public function show($id){
        $auxiliar = Auxiliar::findOrFail($id);
        $user_id=$auxiliar->user_id;
        $user = User::findOrFail($user_id);
        $data=['auxiliar' => $auxiliar,
            'user' => $user
        ];
        
        return view('components.contents.auxiliar.profile')->withTitle('Perfil de Auxiliar')->with($data);
    }
}
