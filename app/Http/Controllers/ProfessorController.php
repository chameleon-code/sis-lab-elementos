<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function home(){
        return view('components.sections.professorSection');
    }
    public function validations(Request $request){
        $this -> validate($request,[
            'names' => 'required',
            'lastnames' => 'required',
            'email' => 'email|required',
            'password' => 'required'
        ]);
        return $request->all();
    }
}
