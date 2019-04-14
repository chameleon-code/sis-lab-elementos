<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public static function getAllBlocks(){
        return self::all();
    }
}
