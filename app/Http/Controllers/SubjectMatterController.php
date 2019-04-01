<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubjectMatter;
use App\Management;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Session;

class SubjectMatterController extends Controller
{
    public function index(){
        $subjectMatters = SubjectMatter::getAllSubjectMatters();
        
        $data=['subjectMatters' => $subjectMatters,
                'title' => 'Subject-Matters Title'];
        return view('components.contents.subjectMatter.index', $data);
    }

    public function create(){
        $managements = Management::getAllManagements();
        $data=['managements'=>$managements];
        return view('components.contents.subjectMatter.create', $data);

    }

    public function show($id){
        dd($id);
    }

    public function store(Request $request){
        $input =$request->all();
        $subjectMatters = new SubjectMatter();
        if($subjectMatters->validate($input)){
            SubjectMatter::create($input);
            Session::flash('status_message','Subject-Matter añadido!');
            
            return redirect('/admin/subjectmatters');
        }
            return redirect('/admin/subjectmatter/create')->withInput()->withErrors($subjectMatters->errors);
    }

    public function edit($id){
        
        $subjectMatter = SubjectMatter::findOrFail($id);
        $managements_id=$subjectMatter->managements_id;
        $management = Management::findOrFail($managements_id);
        
        $data=['subjectMatter' => $subjectMatter,
            'managements' => $management
        ];
        
        return view('components.contents.subjectMatter.edit')->withTitle('Editar la Materia')->with($data);
    }

    public function update(Request $request, $id){
        $subjectMatter = SubjectMatter::find($id);
        $input = $request->all();

        if($subjectMatter->validate($input)){
            $subjectMatter->name = $request->name;
            $subjectMatter->subject_matters_id = $request->subject_matters_id;
            $subjectMatter->save();

            Session::flash('status_message', 'Subject-Matter Editado!');
            return redirect('/admin/subjectmatters');
        }
        return black()->withInput($input)->withErrors($subjectMatter->errors);
    }

    public function destroy($id){
        try{
            $subjectMatter = SubjectMatter::findOrFail($id);

            $subjectMatter->delete();
            $status_message = 'Subject-matter borrado';
        }catch(ModelNotFoundException $e){
            $status_message = 'no Subject-matter with tha id';
        }

        Session::flash('status_message',$status_message);
        return redirect('/admin/subjectmatters');
    }
}
