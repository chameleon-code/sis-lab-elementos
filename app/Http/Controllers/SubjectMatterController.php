<?php

namespace App\Http\Controllers;

use App\Management;
use App\SubjectMatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubjectMatterController extends Controller
{
    public function index(){
        $subjectMatters = SubjectMatter::getAllSubjectMatters();
        
        
        $data=['subjectMatters' => $subjectMatters,
                'title' => 'Materias'];
        return view('components.contents.subjectMatter.index', $data);
    }

    public function create(){
        return view('components.contents.subjectMatter.create');
    }

    public function store(Request $request){
        $input =$request->all();
        $subjectMatters = new SubjectMatter();
        if($subjectMatters->validate($input)){
            SubjectMatter::create($input);
            Session::flash('status_message','Materia añadida!');
            
            return redirect('/admin/subjectmatters');
        }
            return redirect('/admin/subjectmatter/create')->withInput()->withErrors($subjectMatters->errors);
    }

    public function edit($id){
        
        $subjectMatter = SubjectMatter::findOrFail($id);
        $data=['subjectMatter' => $subjectMatter
        ];
        
        return view('components.contents.subjectMatter.edit')->withTitle('Editar la Materia')->with($data);
    }

    public function update(Request $request, $id){
        $subjectMatter = SubjectMatter::find($id);
        $input = $request->all();

        if($subjectMatter->validate($input)){
            $subjectMatter->name = $request->name;
            $subjectMatter->save();

            Session::flash('status_message', 'Materia Editada!');
            return redirect('/admin/subjectmatters');
        }
        return back()->withInput($input)->withErrors($subjectMatter->errors);
    }

    public function destroy($id){
        try{
            $subjectMatter = SubjectMatter::findOrFail($id);
            $subjectMatter->delete();
            $status_message = 'Materia eliminada correctamente';
        }catch(ModelNotFoundException $e){
            $status_message = 'no Subject-matter with tha id';
        }

        Session::flash('status_message',$status_message);
        return redirect('/admin/subjectmatters');
    }
}
