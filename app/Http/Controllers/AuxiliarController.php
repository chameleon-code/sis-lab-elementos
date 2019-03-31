<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Auxiliar;
use App\Role;

class AuxiliarController extends Controller
{
    public function index(){
        return view('components.contents.auxiliar.index');
    }
    
    public function register(){
        return view('components.contents.admin.registerAuxiliar');
    }

    public function store(Request $request){

        $this->validate($request, [
            'names' => 'required|max:255',
            'first_name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:5|confirmed',
        ]);

        $new = User::create([
            'role_id' => \App\Role::AUXILIAR,
            'names' => $request['names'],
            'first_name' => $request['first_name'],
            'second_name' => $request['second_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        Auxiliar::create([
            'user_id' => $new['id'],
        ]);

        return redirect('/admin/auxiliars');
    }
}
