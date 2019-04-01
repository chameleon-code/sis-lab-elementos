<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
class Professor extends Model
{
    protected $rules = [
        'names' => 'required|max:100',
        'lastnames' => 'required|max:100',
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
}