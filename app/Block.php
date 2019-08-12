<?php

namespace App;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use ValidationTrait;

    protected $fillable = ['id', 'management_id', 'name', 'block_path'];

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
    public function sesions(){
        return $this->hasMany('App\Sesion');
    }

    public static function quantityStudentsByBlock() {
        $blocks = Block::all();
        $block_schedules = BlockSchedule::all();
        
        $block_registered = [];
        for($i=0 ; $i<sizeof($blocks) ; $i++) {
            $block_registered[$blocks[$i]->id] = 0;
        }

        $student_schedules = StudentSchedule::all();
        for($i=0 ; $i<sizeof($blocks) ; $i++) {
            for($j=0 ; $j<sizeof($student_schedules) ; $j++) {
                if($blocks[$i]->id == $student_schedules[$j]->block_schedule->block_id) {
                    $block_registered[$blocks[$i]->id]++;
                }
            }
        }
        return $block_registered;
    }
}
