<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class ScheduleRecord extends Model
{
    use ValidationTrait;
    //protected $table= 'schedules_record';
    protected $fillable = ['laboratory_id','day_id','hour_id','professor','subject','color'];
    protected $hidden = ['created_at','update_at'];
    protected $rules = [
        'laboratory_id' => 'required',
        'day_id'        => 'required',
        'hour_id'       => 'required',
        'professor'     => 'required',
        'subject'       => 'required',
        'color'         => 'required'
    ];
    protected $appends = ['blockid'];
    public static function getSchedulesByLaboratory($id){
        return self::where('laboratory_id', $id)->orderBy('day_id')->get();
    }
    public static function getDayAndHourFormatWithId($id){
        $date = self::find($id);
        $day = Day::find($date->day_id)->name;
        $hourStart = Hour::find($date->hour_id)->start;
        $hourEnd = Hour::find($date->hour_id)->end;
        $laboratory = Laboratory::find($date->laboratory_id)->name;
        $data=[
            "start"=>$hourStart,
            "end"=>$hourEnd,
            "day" => $day,
            "laboratory" => $laboratory,
        ];
        return $data;
    }
    public function blocks(){
        return $this->belongsToMany('App\Block','block_schedules','schedule_id','block_id');
    }
    public function getBlockidAttribute(){
        return $this->blocks()->first()->id;
    }
}
