<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class BlockSchedule extends Model
{
    use ValidationTrait;
    protected $fillable = ['schedule_id','block_id'];
    protected $hidden = ['created_at','update_at'];
    protected $rules = [
        'schedule_id' => 'required',
        'block_id'    => 'required'
    ];

    protected $appends = ['block' , 'schedule'];

    public function getBlockAttribute()
    {
        return Block::findOrFail($this->block_id);
    }
    public function students(){
        return $this->belongsToMany('App\Student', 'student_schedules', 'block_schedule_id', 'student_id')
        ->withPivot('group_id', 'student_path');
    }
    public function getScheduleAttribute(){
        return ScheduleRecord::find($this->schedule_id);
    }
    public function getStudentsByGroup($id){
        return $this->belongsToMany('App\Student', 'student_schedules', 'block_schedule_id', 'student_id')
        ->wherePivotIn('group_id', $id);
    }
}
