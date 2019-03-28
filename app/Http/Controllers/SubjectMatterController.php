<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubjectMatter;

class SubjectMatterController extends Controller
{
    public function index(){
        $subjectMatters = SubjectMatter::getAllSubjectMatters();
        $data=['subjectMatters' => $subjectMatters,
                'title' => 'Subject-Matters Title'];
        return view('components.contents.subjectMatter.index',$data);
    }

    public function create(){
        return view('components.contents.subjectMatter.create');
    }

    public function store(Request $request){
        $input =$request->all();

        $subjectMatters = new SubjectMatter();
        if($subjectMatters->validate($input)){
            SubjectMatter::create($input);
            Session::flash('status_message','Subject-Matter añadido!');
            
            return redirect('/subjectmatters');
        }
            return redirect('/subjectmatter/create')->withInput()->withErrors($subjectMatters->errors);
    }
}
