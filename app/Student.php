<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

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

    protected $rules = [
        'names' => 'required|max:100',
        'first_name' => 'required|max:100',
        'second_name' => 'required|max:100',
        'email' => 'email|required|max:150',
        'code_sis' => 'required|max:10|min:8',
        'ci' => 'required|max:9|min:6',
        'password' => 'required|min:8'
    ];

}
