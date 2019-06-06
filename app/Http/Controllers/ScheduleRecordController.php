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
    }

    public function create($block_id){
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
                'day_id'        => $request->day_id,
                'hour_id'       => $request->hour_id,
                'professor'     => $request->professor,
                'subject'       => $request->subject,
                'color'         => $request->color
            ])->id;
            //dd($request->subject);
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

    public function getRecords(Request $request, $laboratory_id){
        // $schedule = ScheduleRecord::getSchedulesByLaboratory($laboratory_id);
        //dd($schedule);
        // if($request->ajax()){
        //     return response()->json([
        //         'schedule'=>$schedule
        //     ]);
        // }
        return ScheduleRecord::getSchedulesByLaboratory($laboratory_id);

    }

    public function edit($id){
    }

    public function update(Request $request, $id){
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
