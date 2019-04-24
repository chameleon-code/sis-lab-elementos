<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockGroup extends Model
{
    protected $table = 'block_group';

    public static function getAllBlockGroupsId(){
        return array_pluck(self::select('group_id')->get(), 'group_id');
    }
}
