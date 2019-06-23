<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Role;
use App\Management;

class AdminController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);
        $data=[ 'user' => $user ];
        
        return view('components.contents.admin.profile')->withTitle('Perfil de Administrador')->with($data);
    }

    public function registrations(){
        $managements = Management::all();
        $data = ['managements' => $managements];
        return view('components.contents.admin.registrations', $data);
    }
}
