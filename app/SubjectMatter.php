<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectMatter extends Model
{
    
    protected $fillable = ['managements_id','name'];

    protected $hidden = ['created_at','update_at'];

    public static function getAllSubjectMatters(){
        return self::all();
    }
}
