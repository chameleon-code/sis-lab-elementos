<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use App\EventLab;
use App\Laboratory;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    private $lab;

    public function index(Request $request){
        $events = Event::all();
        // $from = $request->from;
        // $to = $request->to;
        return response()->json([
            //"data" => $events->where("start_date", "<", $to)->where("end_date", ">=", $from)->get()
            //'data' => $events->where('laboratory_id', '=', $id),
            'data' => $events,
        ]);
    }

    public function store(Request $request){
        $event = new Event();
        $event->text = strip_tags($request->text);
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->save();
        EventLab::create([
            'event_id' => $event->id,
            'laboratory_id' => Cache::get('lab'),
        ]);
        return response()->json([
            "action"=> "inserted",
            "tid" => $event->id
        ]);
    }

    public function update($id, Request $request){
        $event = Event::find($id);
        $event->text = strip_tags($request->text);
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->save();
        return response()->json([
            "action"=> "updated"
        ]);
    }

    public function destroy($id){
        $event = Event::find($id);
        $event->delete();
        return response()->json([
            "action"=> "deleted"
        ]);
    }

    public function loadScheduler($id)
    {
        Cache::put('lab', $id, 30);
        $events = Event::join('event_labs', 'events.id', '=', 'event_labs.event_id')
                       ->select('events.id', 'events.text', 'events.start_date', 'events.end_date', 'event_labs.laboratory_id')
                       ->get();
        $labs = Laboratory::all();
        $data = [
            'events' => $events->where('laboratory_id', '=', $id),
            'labs' => $labs,
            'selected_lab' => $id,
        ];
        return view('components.contents.scheduler.loadScheduler', $data);
    }

    public function loadScheduler2($id)
    {
        $events = Event::join('event_labs', 'events.id', '=', 'event_labs.event_id')
                       ->select('events.id', 'events.text', 'events.start_date', 'events.end_date', 'event_labs.laboratory_id')
                       ->where('laboratory_id', '=', $id)
                       ->get();
        return response()->json([
            'data' => $events,
        ]);
    }
}