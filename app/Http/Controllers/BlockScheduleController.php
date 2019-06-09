<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\BlockSchedule;

class BlockScheduleController extends Controller
{

    ///horarios
    public function index(){
        // $managements=Management::getAllManagements();
        // $data=[
        //     'managements'=>$managements
        // ];
        // return view('components.contents.management.index',$data);
    }

    public function create(){
        $blocks=Block::getAllBlocks();
        dd($blocks);
        $data=[
            'blocks'   => $blocks
        ];
        return view('components.contents.blocks.createSchedule',$data);
    }

    public function store(Request $request){
        $input = $request->all();
        $blockSchedules = new BlockSchedule();
        if($blockSchedules->validate($input)){

            //Session::flash('status_message','Gestión añadida!');
            
            return redirect('/schedule/{block_id}/create/{laboratory_id?}');
        }
            return redirect('/admin/blocks/createSchedule')->withInput()->withErrors($blockSchedules->errors);    
    }

    public function edit($id){
        // $management = Management::findOrFail($id);
        // $semesters=['1','2','3','4'];
        // $data=[
        //     'management' => $management,
        //     'semesters' => $semesters
        // ];
        
        // return view('components.contents.management.edit')->withTitle('Editar la Gestión')->with($data);
    }

    public function update(Request $request, $id){
        // $management = Management::find($id);
        // $input = $request->all();

        // if($management->validate($input)){
        //     $management->semester = $request->semester;
        //     $management->save();

        //     Session::flash('status_message', 'Gestión Editada!');
        //     return redirect('/admin/managements');
        // }
        // return back()->withInput($input)->withErrors($management->errors);
    }

    public function destroy($id){
        // try{
        //     $management = Management::findOrFail($id);
        //     $management->delete();
        //     $status_message = 'Gestión eliminada correctamente';
        // }catch(ModelNotFoundException $e){
        //     $status_message = 'no Subject-matter with tha id';
        // }
        // Session::flash('status_message',$status_message);
        // return redirect('/admin/managements');
    }
}
