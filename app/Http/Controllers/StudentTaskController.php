<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\StudentSchedule;
use Carbon\Carbon;
use App\Sesion;
use App\Task;

class StudentTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $student = Student::where('user_id','=',$user->id)->first();
        //test for day and hours 
        //$testDate = Carbon::create(2019,6,6,17,15,0); 
        //Carbon::setTestNow($testDate);
        // end test 
        $hour = Carbon::now()->format('H:i:s');
        $schedules = StudentSchedule::getDateTimeStudentSchedulesByStudentId($student->id);
        $message = '';
        if($schedules != []){
            foreach ($schedules as $schedule) {
                $sesion = Sesion::getSesionIdToDayByBlock($schedule['block_id']);
                if($sesion == -1){
                    $message = 'No te encuentras inscrito a ninguna materia aún';
                }
            }
        }
        $sesionWeek = Sesion::where('id',$sesion)->get()->first();
        $tasks = Task::where('sesion_id',$sesion)->get()->all();
        $data = [
            'student' => $student,
            'user' => $user,
            'sesion' => $sesion
        ];
        return view('components.contents.student.activities')->with($data);
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
        if($request->hasFile('practice')){
            $file = $request->file('practice');
            $extension = $file->getClientOriginalExtension();
            if($extension=='rar'||$extension=='zip'||$extension=='tar.gz'){
                $user = Auth::user();
                $student = Student::where('user_id','=',$user->id)->first();
                if($student->student_path!=null){
                    $name = $file->getClientOriginalName();
                    $file -> move(public_path().'/storage/'.$student->student_path,$name);
                }
            }
            return back();
        }
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
    public function edit($id)
    {
        //
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
        //
    }
}
