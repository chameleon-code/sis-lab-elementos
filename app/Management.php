<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $fillable = ['semester','managements'];

    //public $timestamps = false;

    public static function getAllManagements(){
        return self::all();
    }
    public function subjectMatters(){
        return $this->hasMany('App\SubjectMatter');
    }
}