<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Calendar;

class CalendarController extends Controller
{
    public function getAllEvents(Request $request){
        $calendars = auth()->user()->calendars;
        $send = array();
        foreach ($calendars as $calendar){
            $resp = new \stdClass();
            $resp->start = $calendar->start;
            $resp->end = $calendar->start;
            $resp->summary = $calendar->description . " " . $calendar->hour;
            $resp->mask = true;
            array_push($send, $resp);
        }
        //dd(json_encode($send));
        //{"start": '2019-06-21', "end": '2019-06-22', "summary": "Event #2", "mask": true}
        if($request->ajax()){
            return response()->json($send);
        }
        return json_encode($send);
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
