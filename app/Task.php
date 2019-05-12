<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'id',
        'sesion_id',
        'title',
        'description',
        'star',
        'end',
        'task_path'
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
