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
        $block_name=$block->name;
        $groups = $block->groups;
        $laboratorys=Laboratory::getAllLaboratory();
        $days=Day::getAllDays();
        $hours=Hour::getAllHours();
        $data=[
            //'scheduleRecords' => $scheduleRecords,
            'groups'     => $groups,
            'laboratories'    => $laboratorys,
            'days'            => $days,
            'hours'           => $hours,
            'block_id'        => $block_id,
            'block_name'      => $block_name
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
    public function createSchedule(){
        $block = Block::findOrFail(1);
        $groups = $block->groups;
        $blocks=Block::getAllBlocks();
        $laboratorys=Laboratory::getAllLaboratory();
        $days=Day::getAllDays();
        $hours=Hour::getAllHours();
        $data = [
            //'scheduleRecords' => $scheduleRecords,
            'groups'          => $groups,
            'blocks'          => $blocks,
            'laboratories'    => $laboratorys,
            'days'            => $days,
            'hours'           => $hours
        ];
        return view('components.contents.scheduler.createSchedule',$data);
    }
    public function getGroups($block_id){
        $block = Block::findOrFail($block_id);
        $groups = $block->groups;
        return $groups;
    }

    public function getHorarios(){
        $laboratorys=Laboratory::getAllLaboratory();
        $days=Day::getAllDays();
        $hours=Hour::getAllHours();
        $data = [
            'laboratories'    => $laboratorys,
            'days'            => $days,
            'hours'           => $hours
        ];
        return view('components.contents.auxiliar.schedule',$data);
    }

    public function getRecordsByBlock($block_id){
        return BlockSchedule::getSchedulesByBlock($block_id);
    }
}