<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{

    public function index(){
        $events = new Event();

        return response()->json([
            "data" => $events->all()
        ]);
    }

    /*public function index(){
        $events = Event::getAllEvents();
        $data = ['events' => $events,
            'title' => 'Events'];
        return view('components.contents.scheduler.scheduler', $data);
    }*/

    /*public function index(){
        $events = new Event();

        $data = response()->json([
            "data" => $events->all()
        ]);

        return view('components.contents.scheduler.scheduler', $data);
    }*/
}