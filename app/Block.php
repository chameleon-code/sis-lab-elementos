<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Block extends Model
{
    protected $rules = [
        'name' => 'required|max:255|min:3',
        'groups_id' => 'required|max:255'
    ];
    public $errors;
    public function validate($date){
        $v = Validator::make($date, $this->rules);
        if($v->fails()){
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }
    public static function getAllBlocks(){
        return self::all();
    }
    public function groups(){
        return $this->belongsToMany('App\Group');
    }
}
