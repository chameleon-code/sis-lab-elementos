<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;
use Carbon\Carbon;

class Management extends Model
{
    use ValidationTrait;
    protected $fillable = ['semester','managements','start_management','end_management', 'enable_inscription', 'management_path', 'enable_inscription'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'semester' => 'unique:managements|required|max:4|min:1',
        'managements' => 'required|max:5|min:1',
        'start_management' => 'required|date_format:Y-m-d',
        'end_management' => 'required|date_format:Y-m-d|after:start_management',
    ];

    public static function getAllManagements(){
        return self::all();
    }
    public function blocks(){
        return $this->hasMany('App\Block');
    }

    public static function getActualManagement(){
        $managements = Management::all();
        $today = Carbon::now()->format('Y-m-d');
        $actual_management = null;
        foreach($managements as $management){
            if($today > $management->start_management && $today < $management->end_management) {
                $actual_management = $management;
            }
        }
        return $actual_management;
    }

    public static function getMonth($date){
        $resp;
        switch(substr($date, 5, 2)){
            case '01':
                $resp = "Enero";
                break;
            case '02':
                $resp = "Febrero";
                break;
            case '03':
                $resp = "Marzo";
                break;
            case '04':
                $resp = "Abril";
                break;
            case '05':
                $resp = "Mayo";
                break;
            case '06':
                $resp = "Junio";
                break;
            case '07':
                $resp = "Julio";
                break;
            case '08':
                $resp = "Agosto";
                break;
            case '09':
                $resp = "Septiembre";
                break;
            case '10':
                $resp = "Octubre";
                break;
            case '11':
                $resp = "Noviembre";
                break;
            case '12':
                $resp = "Diciembre";
                break;
        }
        return $resp;
    }
}