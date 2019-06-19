<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\BlockGroup;
use App\ScheduleRecord;
use App\Student;
use App\StudentSchedule;
use App\BlockSchedule;
use App\Group;
use App\Block;

class StudentScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'group_id.required' => 'No puede inscribirse al grupo de la materia seleccionada. ',
        ];
        $this->validate($request, [
            'group_id' => 'required'
        ], $messages);

        $user = Auth::user();
        $student = Student::where('user_id', '=', $user->id)->get()->first();
        $block_schedule_id = BlockSchedule::find($request->block_schedule_id);
        $group = Group::find($request->group_id);
        $dir = Block::find($block_schedule_id->block_id)->block_path.'/'.$group->name.'/'.$user->code_sis;//base64_encode($user->code_sis);
        
        StudentSchedule::create([
            'student_id' => $student->id,
            'block_schedule_id' => $request->block_schedule_id,
            'group_id' => $request->group_id,
            'student_path' => $dir,
        ]);
        
        //Storage::makeDirectory($dir);

        return redirect('/students/registration');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $student_schedule = StudentSchedule::findOrFail($id);
        // $messages = [
        //     'group_id.required' => 'No puede inscribirse al grupo de la materia seleccionada. ',
        // ];
        // $this->validate($request, [
        //     'group_id' => 'required'
        // ], $messages);

        $user = Auth::user();
        $student = Student::where('user_id', '=', $user->id)->get()->first();
        $block_schedule_id = BlockSchedule::find($request->block_schedule_id);
        $group = Group::find($request->group_id);
        $dir = Block::find($block_schedule_id->block_id)->block_path.'/'.$group->name.'/'.base64_encode($user->code_sis);
        
        $student_schedule->student_id = $student->id;
        $student_schedule->block_schedule_id = $request->block_schedule_id;
        $student_schedule->group_id = $request->group_id;
        $student_schedule->student_path = $dir;
        $student_schedule->save();
        
        Storage::makeDirectory($dir);

        return redirect('/students/registration');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_schedule = StudentSchedule::findOrFail($id);
        $student_schedule->delete();

        return redirect('/students/registration');
    }
}
