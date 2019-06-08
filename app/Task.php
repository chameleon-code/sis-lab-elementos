<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'id',
        'sesion_id',
        'title',
        'published_by',
        'description',
        'task_path',
        'task_file',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
