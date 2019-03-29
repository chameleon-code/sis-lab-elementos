<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Professor;
class ProfessorController extends Controller
{
    public function home(){
        return view('components.sections.professorSection');
    }
    public function validations(Request $request){
        $professor= Professor::all();
        $professor->validations($request);
    }   
}
