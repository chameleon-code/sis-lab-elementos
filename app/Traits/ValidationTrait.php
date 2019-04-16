<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

Trait ValidationTrait{
    
    public $errors;
    public function validate($date){
        $v = Validator::make($date, $this->rules);
        if($v->fails()){
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }
}