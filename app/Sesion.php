<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $fillable = [
        'block_id',
        'number_sesion',
        'date_start',
        'date_end'
    ];
}
