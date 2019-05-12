<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLab extends Model
{
    protected $fillable = ['laboratory_id', 'block_id', 'event_id'];
}
