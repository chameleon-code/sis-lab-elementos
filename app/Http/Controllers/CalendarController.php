<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Calendar;

class CalendarController extends Controller
{
    public function getAllEvents(Request $request){
        $user = auth()->user();
        if($request->ajax()){
            return response()->json($user->calendars);
        }
        return $user->calendars;
    }
    public function store(){
        $info = \request('info');
    	$data = [];
        parse_str($info, $data);
        try{
            $calendar = new Calendar();
            $calendar-> user_id = auth()->user()->id;
            $calendar->start = $data['start'];
            $calendar->hour = $data['hour'];
            $calendar->description = $data['description'];
            $calendar->save();
            $success = true;
        }
        catch (\Exception $exception) {
    		$success = false;
	    }
        return response()->json(['res' => $success]);
    }
}
