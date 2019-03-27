<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectMatterController extends Controller
{
    public function index(){
        echo 'hola';
        return view('components.contents.subjectMatter.index');
    }
}
