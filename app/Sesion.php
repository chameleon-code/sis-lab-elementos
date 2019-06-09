<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;
use Faker\Provider\cs_CZ\DateTime;

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
    public static function getSesionIdToDayByBlock($block_id){
        $date = date('Y-m-d');
        $sesions = self::where('block_id',$block_id)->get()->all();
        $n = -1;
        foreach ($sesions as $sesion) {
            $dateStart = date_format(date_create($sesion->date_start),'Y-m-d');
            $dateEnd = date_format(date_create($sesion->date_end),'Y-m-d');
            if($date>=$dateStart && $date<$dateEnd){
                $n = $sesion->id;
                return $n;
            } 
        }
        return $n;
    }
}
