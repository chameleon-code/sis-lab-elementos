<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuxiliarController extends Controller
{
    public function index(){
        return view('components.contents.auxiliar.index');
    }
}
