<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Student extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public static function getAllStudents()
    {
        return Student::join('users', 'user_id', '=', 'users.id')->select('users.role_id', 'users.names', 'users.first_name', 'users.second_name', 'users.email', 'users.password', 'users.img_path', 'users.remember_token', 'users.created_at', 'users.updated_at', 'students.id')->get();
    }

    protected $rules = [
        'names' => 'required|max:100',
        'first_name' => 'required|max:100',
        'second_name' => 'required|max:100',
        'email' => 'email|required|max:150',
        'password' => 'required'
    ];

    public $errors;

    public function validate($input)
    {
        $validator = Validator::make($input, $this->rules);
        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }
}
