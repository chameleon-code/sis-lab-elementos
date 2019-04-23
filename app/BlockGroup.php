<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockGroup extends Model
{
    protected $table = 'block_group';

    public static function getAllBlockGroups(){
        dd('Hi');
        return self::select('group_id')->get();
    }
}
