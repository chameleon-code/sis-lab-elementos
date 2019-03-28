<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function home(){
        return view('components.sections.professorSection');
    }
}
