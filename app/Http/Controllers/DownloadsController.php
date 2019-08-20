<?php

namespace App\Http\Controllers;

use App\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadsController extends Controller
{
    public function practiceDowload($any){
        //dd($any);
        try {
            if(Auth::User()){
                $filePath = storage_path('app').'/'.$any;
                //dd(storage_path('app'));
                return response()->download( $filePath);
            }
        } catch (Exception $e) {
            return back();
        }
    }
    public function taskDownload($any){
        try {
            $user = Auth::user();
            switch ($user->role_id) {
                case Role::STUDENT:
                    $code = $user->names.'-'.$user->code_sis;
                    if(strpos($any,$code)){
                        $filePath = storage_path('app').'/public/'.$any;
                        return response()->download($filePath);
                    }else{
                        return back();
                    }
                    break;
                default:
                    $filePath = storage_path('app').'/public/'.$any;
                    return response()->download( $filePath);
                    break;
            }
        } catch (Exception $e) {
            return back();
        }
    }
    
}
