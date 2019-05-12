<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hour;
use App\Day;
use App\Laboratory;

class ScheduleRecordController extends Controller
{
    public function index(){
        $managements=Management::getAllManagements();
        $data=[
            'managements'=>$managements
        ];
        return view('components.contents.management.index',$data);
    }

    public function create(){
        $laboratorys=Laboratory::getAllLaboratory();
        $days=Day::getAllDays();
        $hours=Hour::getAllHours();
        $data=[
            'laboratories'   => $laboratorys,
            'days'          => $days,
            'hours'         => $hours
        ];
        return view('components.contents.scheduler.index',$data);
    }

    public function store(Request $request){
        $input = $request->all();
        $managements = new Management();
        if($managements->validate($input)){
            $dir = 'folders/'.$request->managements.'-'.$request->semester;
            //$input->management_path = $dir;
            //dd($input);

            Management::create([
                'semester' => $request->semester,
                'managements' => $request->managements,
                'start_management' => $request->start_management,
                'end_management' => $request->end_management,
                'management_path' => $dir,
            ]);
            Session::flash('status_message','Gestión añadida!');

            Storage::makeDirectory($dir);
            
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
            $management->start_management = $request->start_management;
            $management->end_management = $request->end_management;
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
