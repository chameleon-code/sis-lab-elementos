<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentSchedule;
use \RecursiveIteratorIterator;
use \RecursiveArrayIterator;
use App\Block;
use App\Group;

class DownloadTaskController extends Controller
{
    public function downloadTask(Request $request){
        $schedule = StudentSchedule::findOrFail($request->schedule_id);
        $zip_file =  $schedule->getStudentAttribute()->user->first_name.$schedule->getStudentAttribute()->user->code_sis .date("Ymd") .'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = public_path().'/storage/' . $schedule->student_path;
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
    }
    public function downloadGroupPortfolies(Request $request){
        $group = Group::find($request->group_id);
        $block = $group->blocks()->first();
        $zip_file = 'Grupo '.$group->name .'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = public_path().'/storage/' . $block->block_path .'/'.$group->name;
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
    }
}
