<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    public static function getAllAuxiliars(){
        return self::all();
    }
}
