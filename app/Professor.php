<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
class Professor extends Model
{
    protected $rules = [
        'names' => 'required',
        'lastnames' => 'required',
        'email' => 'email|required',
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
