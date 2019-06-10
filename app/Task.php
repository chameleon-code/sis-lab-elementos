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
        //'title' => 'required|max:100|min:1',
    ];
    //protected $hidden = ['created_at', 'updated_at'];
    protected $append = [
        'sesion'
    ];
    public function getSesionAttribute(){
        return Sesion::findOrFail($this->sesion_id);
    }
    public function students(){
        return $this->belongsToMany('App\Student', 'student_tasks');
    }
    public function sesion(){
        return $this->belongsTo('App\Sesion');
    }
}
