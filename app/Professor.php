<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
class Professor extends Model
{
    protected $fillable = [
        'user_id',
    ];
    protected $rules = [
        'names' => 'required|max:100',
        'first_name' => 'required|max:100',
        'second_name' => 'required|max:100',
        'email' => 'email|required|max:150',
        'password' => 'required'
    ];
    public $errors;
    public function validate($input){
        $validator = Validator::make($input, $this->rules);
        if($validator->fails()){
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }
    public function subjectMatters(){
        return $this->belongsToMany('App\SubjectMatter', 'professor_subject_matter', 'professor_id', 'subject_matter_id');
    }
    public static function getAllProfessors(){
        return Professor::join('users','user_id','=','users.id')->select('users.role_id', 'users.names', 'users.first_name', 'users.second_name', 'users.email', 'users.password', 'users.img_path', 'users.remember_token', 'users.created_at', 'users.updated_at', 'professors.id')->get();
    }
}
