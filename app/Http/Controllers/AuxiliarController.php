<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auxiliar;

class AuxiliarController extends Controller
{
    public function index(){
        return view('components.contents.auxiliar.index');
    }

    public function create(){
        $auxiliars = Auxiliar::getAllAuxiliars();
        $data=['auxiliars'=>$auxiliars];
        return view('components.contents.admin.registerAuxiliar', $data);
    }
}
