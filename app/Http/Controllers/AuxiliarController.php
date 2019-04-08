<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Auxiliar;
use App\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailController2;
use Illuminate\Support\Facades\Session;

class AuxiliarController extends Controller
{
    public function index(){
        $auxiliars = Auxiliar::getAllAuxiliars();
        
        $data=['auxiliars' => $auxiliars,
                'title' => 'Auxiliars Title'];
        return view('components.contents.auxiliar.index', $data);
    }
    
    public function create(){
        return view('components.contents.auxiliar.registerAuxiliar');
    }

    public function store(Request $request){
        
        $input = $request->all();
        $auxiliar = new Auxiliar();
        
        if($auxiliar->validate($input)){
            $data = array(
                'names' => $request->names,
                'first_name'=> $request->first_name,
                'second_name'=> $request->second_name,
                'email' => $request->email,
                'password' => $request->password
            );
            $newAuxiliar = User::create([
                'role_id' => \App\Role::AUXILIAR,
                'names' => $request['names'],
                'first_name' => $request['first_name'],
                'second_name' => $request['second_name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            Auxiliar::create([
                'user_id' => $newAuxiliar['id'],
            ]);
            Mail::to($request->email)->send(new MailController2($data));
            return redirect('/admin/auxiliars');
        } else {
            return redirect('admin/auxiliars/register')->withInput()->withErrors($auxiliar->errors);
        }
    }

    public function destroy($id){
        $auxiliar = Auxiliar::findOrFail($id);
        $user_id = $auxiliar->user_id;
        $auxiliar->delete();

        $user = User::findOrFail($user_id);
        $user->delete();
        
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
            $user->password = $request->password;
            $user->save();

            Session::flash('status_message', 'Auxiliar Editado!');
            return redirect('/admin/auxiliars');
        }
        return black()->withInput($input)->withErrors($user->errors);
    }
}
