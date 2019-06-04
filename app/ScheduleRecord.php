<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class ScheduleRecord extends Model
{
    use ValidationTrait;
    //protected $table= 'schedules_record';
    protected $fillable = ['laboratory_id','day_id','hour_id','color'];
    protected $hidden = ['created_at','update_at'];
    protected $rules = [
        'laboratory_id' => 'required',
        'day_id'        => 'required',
        'hour_id'       => 'required',
        'color'         => 'required'
    ];

    public static function getSchedulesByLaboratory($id){
        return self::where('laboratory_id', $id)->orderBy('day_id')->get();
    }
}