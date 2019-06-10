<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Block extends Model
{
    use ValidationTrait;

    protected $fillable = ['management_id', 'name', 'block_path'];

    protected $rules = [
        'management_id' => 'required',
        'groups_id.*' => 'required|distinct'
    ];
    protected $casts = [
        'available' => 'boolean'
    ];
    protected $appends = ['schedule'];
    public static function getAllBlocks(){
        return self::all();
    }
    public function groups(){
        return $this->belongsToMany('App\Group');
    }
    /*public static function getBlocksBySubjects($id){
        $blocks = self::where();
    }*/
    public function scheduleRecords(){
        return $this->belongsToMany('App\ScheduleRecord','block_schedules','block_id','schedule_id');
    }
    public function getScheduleAttribute(){
        return $this->scheduleRecords()->get();
    }
}
