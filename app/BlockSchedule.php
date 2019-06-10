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

    protected $appends = ['block'];

    public function getBlockAttribute()
    {
        return Block::findOrFail($this->schedule_id);
    }
    public function students(){
        return $this->belongsToMany('App\Student', 'student_schedules', 'student_id', 'block_schedule_id')
        ->withPivot('group_id', 'student_path');
    }
}
