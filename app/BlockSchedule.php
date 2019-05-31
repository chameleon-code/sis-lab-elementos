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
        'schudule_id' => 'required',
        'block_id'    => 'required'
    ];
}
