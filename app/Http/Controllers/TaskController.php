<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Professor;
use App\Student;
use App\Sesion;
use App\Task;
use App\Block;
use App\Group;
use App\SubjectMatter;
use App\StudentTask;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blockGroup = Professor::getBlockProfessor();
        if($blockGroup!=null){
            $blockGroupId = $blockGroup->block_id;
            $sesions = Sesion::where('block_id','=',$blockGroupId)->get();
            $tasks = Task::all();
            $validTasks=[];
            foreach ($tasks as $task) {
                foreach($sesions as $sesion){
                    if($task->sesion_id==$sesion->id && $sesion->block_id==$blockGroupId){
                        array_push($validTasks,$task);
                    }
                }
            }
            $sesion_max = $sesions->count();
            $data = [
                'sesion_max'=>$sesion_max,
                'sesions'=>$sesions,
                'blockGroup'=>$blockGroup,
                'tasks'=>$validTasks,
                'blockId' => $blockGroupId,
            ];
            return view('components.contents.professor.publishTasks', $data);
        }else{
            $data = [
                'sesion_max' => 0,
                'sesions' => [],
                'blockGroup' => [],
                'tasks' =>[],
                'blockId' => 0,
            ];
            return view('components.contents.professor.publishTasks', $data);
        }
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
        if($request->title != "") {
            $sesion_number = Sesion::findOrFail($request->sesion_id)->number_sesion;
            $user = Auth::user();
            $blockGroupId = Professor::getBlockProfessor()->block_id;
            $dir = Block::where('id', '=', $blockGroupId)->get()->first()->block_path;
            if($request->file()){
                $file = $request->file('practice');
                $extension = $file->getClientOriginalExtension();
                if($extension=='rar'||$extension=='zip'||$extension=='tar.gz'||$extension=='pdf'){
                    $name = $file->getClientOriginalName();
                   //$semiPath ='/storage/'.$dir.'/practices/sesion-'.$sesion_number.'/';
                    $semiPath = $dir.'/practices/sesion-'.$sesion_number.'/';
                   // $path = public_path().$semiPath;
                    $path = storage_path('app').'/public/'.$semiPath;
                    $file -> move($path,$name);
                    $task = [
                        'title' => $request->title,
                        'published_by' => $user->names.' '.$user->first_name,
                        'description' => $request->description,
                        'sesion_id' => $request->sesion_id,
                        'task_path' => $semiPath,
                        'task_file' => $name,
                    ];
                    $created_task = Task::create($task);
                    return response()->json($created_task);
                } else {
                    return response()->json(['response' => 'error_file']);
                }
            } else {
                $task = [
                    'title' => $request->title,
                    'published_by' => $user->names.' '.$user->first_name,
                    'description' => $request->description,
                    'sesion_id' => $request->sesion_id,
                ];
                $created_task = Task::create($task);
                return response()->json($created_task);
            }
        } else {
            return response()->json(['response' => 'no_title']);
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
    public function edit(Request $request)
    {
        if($request->title != "") {
            $task = Task::findOrFail($request->task_id);
            $sesion_number = Sesion::findOrFail($request->sesion_id)->number_sesion;
            $user = Auth::user();
            $blockGroupId = Professor::getBlockProfessor()->block_id;
            $dir = Block::where('id', '=', $blockGroupId)->get()->first()->block_path;
            if($request->file()){
                $file = $request->file('practice');
                $extension = $file->getClientOriginalExtension();
                if($extension=='rar'||$extension=='zip'||$extension=='tar.gz'||$extension=='pdf'){
                    $file = $request->file('practice');
                    $name = $file->getClientOriginalName();
                    // $semiPath ='/storage/'.$dir.'/practices/sesion-'.$sesion_number.'/';
                    // $path = public_path().$semiPath;
                    $semiPath = $dir.'/practices/sesion-'.$sesion_number.'/';
                    $path = storage_path('app').'/public/'.$semiPath;
                    $file -> move($path,$name);
                    $task->title = $request->title;
                    $task->published_by = $user->names.' '.$user->first_name;
                    $task->description = $request->description;
                    $task->sesion_id = $request->sesion_id;
                    $task->task_path = $semiPath;
                    $task->task_file = $name;
                    $task->save();
                    return response()->json($task);
                } else {
                    return response()->json(['response' => 'error_file']);
                }
            } else {
                $task->title = $request->title;
                $task->published_by = $user->names.' '.$user->first_name;
                $task->description = $request->description;
                $task->sesion_id = $request->sesion_id;
                $task->save();
                return response()->json($task);
            }
        } else {
            return response()->json(['response' => 'no_title']);
        }
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
        $task = Task::findOrFail($id);
        $sesion = Sesion::where('id', '=', $task->sesion_id)->get()->first();
        $task->delete();
        return response()->json(['message' => 'Eliminado correctamente!', 'sesion' => $sesion]);
    }

    public function showStudentTask($idStudent, $idTask)
    {
        $student = Student::find($idStudent);
        $user = User::where('id', '=', $student->user_id)->get()->first();
        $task = Task::find($idTask);
        $group = Group::find($student->first()->group_id);
        $subjectMatter = SubjectMatter::where('id', '=', $group->subject_matter_id)->get()->first();
        $data = [
            'student' => $student,
            'user' => $user,
            'task' => $task,
            'group' => $group,
            'subject_matter' => $subjectMatter,
        ];
        return view('components.contents.professor.studentTask', $data);
    }

    public function getTasksBySesion($id){
        $sesion_id = Sesion::findOrFail($id)->id;
        $tasks = Task::where('sesion_id', '=', $sesion_id)->get();
        return $tasks;
    }

    public function getTaskById($id){
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    public function storeScore(Request $request){
        $student_task = StudentTask::findorFail($request->student_task_id);
        $student_task->score = $request->task_score;
        $student_task->save();
        return response()->json($student_task);
    }

     public function downloadPractice(){
        $zip_file = 'folders.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        //$path = public_path('storage/folders');
        $path = storage_path('app').'/public/folders/';
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();
                // extracting filename with substr/strlen
                $relativePath = 'folders/' . substr($filePath, strlen($path) + 1);
        
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();  
        return response()->download($zip_file);
     }
}
