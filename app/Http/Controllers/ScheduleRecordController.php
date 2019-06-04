<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hour;
use App\Day;
use App\Laboratory;
use App\ScheduleRecord;
use App\BlockSchedule;
use App\Block;
use App\BlockGroup;

class ScheduleRecordController extends Controller
{
    public function index(){
        $managements=Management::getAllManagements();
        $data=[
            'managements'=>$managements
        ];
        return view('components.contents.management.index',$data);
    }

    public function create($block_id){
        //$block_id=$request->block_id;
        //dd($block_id);
        //$scheduleRecords = ScheduleRecord::getSchedulesByLaboratory($laboratory_id);
        //$blockGroups = BlockGroup::getAllBlockIdGroups($block_id);
        $block = Block::findOrFail($block_id);
        $groups = $block->groups;

        //dd($groups->first()->subject->name);
        //dd($blockGroups);
        
        $laboratorys=Laboratory::getAllLaboratory();
        $days=Day::getAllDays();
        $hours=Hour::getAllHours();
        $data=[
            //'scheduleRecords' => $scheduleRecords,
            'groups'     => $groups,
            'laboratories'    => $laboratorys,
            'days'            => $days,
            'hours'           => $hours,
            'block_id'        => $block_id
        ];
        return view('components.contents.scheduler.index',$data);
    }

    public function store(Request $request){
        
        if($request->ajax()){
            $id=ScheduleRecord::create([
                'laboratory_id' => $request->laboratory_id,
                'day_id' => $request->day_id,
                'hour_id' => $request->hour_id,
                'color' => $request->color
            ])->id;
            BlockSchedule::create([
                'schedule_id' => $id,
                'block_id' => $request->block_id
            ]);
            //ScheduleRecord::create($request->all());
            return response()->json([
                'id'        => $id,
                "success"   => $request->all()
            ]);
        }
        // $input = $request->all();
        // $scheduleRecords = new ScheduleRecord();
        // $blockSchedule = new BlockSchedule();
        // if($scheduleRecords->validate($input)){
            Session::flash('status_message','Gestión añadida!');
            
        //     return redirect('/admin/managements');
        // }
        //     return redirect('/admin/management/create')->withInput()->withErrors($managements->errors);
    }

    public function getRecords($laboratory_id){
        return ScheduleRecord::getSchedulesByLaboratory($laboratory_id);
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

    public function destroy($id,Request $request){
        
        try{
            $scheduleRecords = ScheduleRecord::findOrFail($id);
            $scheduleRecords->delete();
            $status_message = 'Horario eliminada correctamente';
            if($request->ajax()){
                return response()->json([
                    'status_message'=>$status_message
                ]);
            }

        }catch(ModelNotFoundException $e){
            $status_message = 'no schedule with tha id';
        }

        Session::flash('status_message',$status_message);
        //return redirect('/admin/managements');
    }
}
