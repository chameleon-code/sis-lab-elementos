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
        'created_at',
        'updated_at',
    ];

    //protected $hidden = ['created_at', 'updated_at'];

    protected $rules = [
        'title' => 'required|max:100|min:1',
    ];
}
