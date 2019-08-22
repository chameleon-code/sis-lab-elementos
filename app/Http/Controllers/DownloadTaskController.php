<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentSchedule;
use \RecursiveIteratorIterator;
use \RecursiveArrayIterator;
use App\Block;
use App\Group;
use App\Role;
use Illuminate\Support\Facades\Auth;

class DownloadTaskController extends Controller
{
    public function downloadTask(Request $request){
        try {
            $user = Auth::user();
            if($user->role_id!=Role::STUDENT){
                $schedule = StudentSchedule::findOrFail($request->schedule_id);
                $zip_file =  $schedule->getStudentAttribute()->user->first_name.$schedule->getStudentAttribute()->user->code_sis .date("Ymd") .'.zip';
                $zip = new \ZipArchive();
                $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
                //$path = public_path().'/storage/' . $schedule->student_path;
                $path = storage_path('app').'/public/'. $schedule->student_path;
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
                foreach ($files as $name => $file)
                {
                    if (!$file->isDir()) {
                        $filePath     = $file->getRealPath();
                        $relativePath = 'sesiones/' . substr($filePath, strlen($path) + 1);
                        $zip->addFile($filePath, $relativePath);
                    }
                }
                $zip->close();
                return response()->download($zip_file)->deleteFileAfterSend(true);
            }else{
                return back();
            }
        } catch (Exception $e) {
            return back();
        }
        
    }
    public function downloadGroupPortfolies(Request $request){
        try {
            $user = Auth::user();
            if($user->role_id!=Role::STUDENT){
                $group = Group::find($request->group_id);
                $block = $group->blocks()->first();
                $zip_file = 'Grupo '.$group->name .'.zip';
                $zip = new \ZipArchive();
                $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
                //$path = public_path().'/storage/' . $block->block_path .'/'.$group->name;
                $path = storage_path('app').'/public/' . $block->block_path .'/'.$group->name;
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
                foreach ($files as $name => $file)
                {
                    if (!$file->isDir()) {
                        $filePath     = $file->getRealPath();
                        $relativePath = 'estudiantes/' . substr($filePath, strlen($path) + 1);
                        $zip->addFile($filePath, $relativePath);
                    }
                }
                $zip->close();
                return response()->download($zip_file)->deleteFileAfterSend(true);
            }else{
                return back();
            }
        }catch (Exception $e) {
            return back();
        }  
    }
}
