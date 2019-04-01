<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Management;

class ManagementController extends Controller
{
    public function index(){
        echo 'hola';
        $a=Management::all();
        Management::create(['semester' => '1',
        'managements'=> 2019]);
        dd($a);
        return view('components.contents.management.index');
    }
}
