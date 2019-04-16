<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Management;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ManagementController extends Controller
{
    public function index(){
        $managements=Management::getAllManagements();
        $data=[
            'managements'=>$managements
        ];
        return view('components.contents.management.index',$data);
    }

    public function create(){
        $semesters=['1','2','3','4'];
        $managements=Carbon::now()->format('Y');
        $data=[
            'semesters' => $semesters,
            'managements' => $managements
        ];
        return view('components.contents.management.create',$data);
    }

    public function store(Request $request){
        $input =$request->all();
        $managements = new Management();
        if($managements->validate($input)){
            Management::create($input);
            Session::flash('status_message','Gestión añadida!');
            
            return redirect('/admin/managements');
        }
            return redirect('/admin/management/create')->withInput()->withErrors($managements->errors);

    }

    public function edit($id){
        $management = Management::findOrFail($id);
        $semesters=['1','2','3','4'];
        $data=[
            'management' => $management,
            'semesters' => $semesters
        ];
        
        return view('components.contents.management.edit')->withTitle('Editar la Gestión')->with($data);
    }

    public function update(Request $request, $id){
        $management = Management::find($id);
        $input = $request->all();

        if($management->validate($input)){
            $management->semester = $request->semester;
            $management->save();

            Session::flash('status_message', 'Gestión Editada!');
            return redirect('/admin/managements');
        }
        return back()->withInput($input)->withErrors($management->errors);
    }

    public function destroy($id){
        try{
            $management = Management::findOrFail($id);
            $management->delete();
            $status_message = 'Gestión eliminada correctamente';
        }catch(ModelNotFoundException $e){
            $status_message = 'no Subject-matter with tha id';
        }

        Session::flash('status_message',$status_message);
        return redirect('/admin/managements');
    }
}
