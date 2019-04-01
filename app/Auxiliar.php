<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public static function getAllAuxiliars(){
        return Auxiliar::join('users','user_id','=','users.id')->get();
    }
}
