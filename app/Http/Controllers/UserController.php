<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Auxiliar;
use App\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailController2;
use Illuminate\Support\Facades\Session;

class UserrController extends Controller
{
    public function index(){
        //
    }
    
    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function destroy($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('components.contents.user.profile')->withTitle('Perfil de Auxiliar')->with($user);
    }
}
