<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;
use Faker\Provider\cs_CZ\DateTime;
use Carbon\Carbon;

class Sesion extends Model
{
    use ValidationTrait;
    protected $fillable = [
        'block_id',
        'number_sesion',
        'date_start',
        'date_end'
    ];
    protected $rules = [
        'date_start' => 'required|date_format:Y-m-d',
        'date_end' => 'required|date_format:Y-m-d|after:date_start',
    ];
    protected $appends = [
        'block'
    ];
    public static function autodate($start,$end){
        $dates = array();
        $current = strtotime( $start );
        $last = strtotime( $end );
        while( $current <= $last ) {
            $dates[] = date( 'Y-m-d', $current );
            $current = strtotime( '+1 week', $current );
        }
        array_push($dates,$end);
        $index=count($dates);
        $count=0;
        $segmented=array();
        $dates=array_unique($dates);

        while($count<$index-2){ //cambiar 2 a 1 en caso de incendio 
            $date=[
                'start'=>$dates[$count],
                'end'=>$dates[$count+1]
            ];
            array_push($segmented,$date);
            $count++;
        }
        return $segmented;
    }
    public function getBlockAttribute(){
        return Block::findOrFail($this->block_id);
    }
    public function tasks(){
        return $this->hasMany('App\Task');
    }
    public static function getSesionIdToDayByBlock($block_id, $schedule_id){
        $date = date('Y-m-d');
        $sesions = self::where('block_id',$block_id)->get()->all();
        $n = -1;
        $pastSesion=-1;
        foreach ($sesions as $index => $sesion) {
            $dateStart = date_format(date_create($sesion->date_start),'Y-m-d');
            $dateEnd = date_format(date_create($sesion->date_end),'Y-m-d');
            $data = self::getSesionDayReal($schedule_id);
            if($index != 0){
                $date = $data['date'];
            }
            $date = date_format(date_create($date),'Y-m-d');
            if($date >= $dateStart && $date < $dateEnd){
                $n = $sesion->id;
                $hour = $data['hour'];
                $hour = strtotime($hour);
                $hournow = date('H:i:s');
                $hournow = strtotime($hournow);
                if($data['same'] && $hournow<$hour){
                    return $pastSesion;
                }
                return $n;
            } 
            $pastSesion = $sesion->id;
        }
        return $n;
    }
    public static function getSesionDayReal($schedule_id){
        $schedule = ScheduleRecord::find($schedule_id);
        $scheduleDay = Day::find($schedule->day_id)->name;
        $scheduleHour = Hour::find($schedule->hour_id)->start;
        $date = Carbon::now()->format('Y-m-d');
        $data = [
            'date'=>$date,
            'same'=> true,
            'hour'=>$scheduleHour
        ];
        if(Carbon::now()->englishDayOfWeek != self::returnEnglishDay($scheduleDay)) { 
            $date = new Carbon('last '.self::returnEnglishDay($scheduleDay));
            $date = $date->format('Y-m-d');
            $data['date'] = $date;
            $data['same']= false;
        }
        return $data;
    }
    public static function returnEnglishDay($day){
        $res= '';
        switch ($day) {
            case 'Lunes':
                $res = 'Monday';
                break;
            case 'Martes':
                $res = 'Tuesday';
                break;
            case 'Miércoles':
                $res = 'Wednesday';
                break;
            case 'Jueves':
                $res = 'Thursday';
                break;
            case 'Viernes':
                $res = 'Friday';
                break;
            case 'Sabado':
                $res = 'Saturday';
                break;
            case 'Domingo':
                $res = 'Sunday';
                break;
        }
        return $res;
    }
}
