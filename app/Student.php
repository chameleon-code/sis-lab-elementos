<?php

namespace App;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use ValidationTrait;
    protected $fillable = [
        'id',
        'user_id',
        'ci'
    ];

    public static function getAllStudents()
    {
        return Student::join('users', 'user_id', '=', 'users.id')->select('users.role_id', 'users.names', 'users.first_name', 'users.second_name', 'users.email', 'users.password', 'users.img_path', 'users.remember_token', 'users.created_at', 'users.updated_at', 'students.id', 'users.code_sis', 'ci')->get();
    }

    public static function getAllBlocks()
    {
        return Block::all();
    }

    protected $rules = [
        'names' => 'required|max:100',
        'first_name' => 'required|max:100',
        'second_name' => 'required|max:100',
        'email' => 'email|required|max:150',
        'code_sis' => 'required|max:10|min:8',
        'ci' => 'required|max:9|min:6',
        'password' => 'required|min:8'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function tasks(){
        return $this->belongsToMany('App\Task', 'student_tasks');
    }
    public function blockschedules(){
        return $this->belongsToMany('App\BlockSchedules', 'student_schedules', 'student_id', 'block_schedule_id')
        ->withPivot('group_id', 'student_path');
    }
    public function assistances(){
        return $this->hasMany('App\Assistance');
    }
    public function studentTasks(){
        return $this->hasMany('App\StudentTask');
    }
}
