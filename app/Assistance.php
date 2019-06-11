<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    protected $fillable = [ 'block_id', 'schedule_id', 'student_id'];
    public $timestamps = true;
}
