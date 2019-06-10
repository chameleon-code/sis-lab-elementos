<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockGroup extends Model
{
    protected $table = 'block_group';

    public static function getAllBlockGroupsId(){
        return array_pluck(self::select('group_id')->get(), 'group_id');
    }

    public static function getAllBlockIdGroups($id){
        return self::where('block_id', $id)->get();
    }
    public static function getBlockByIdGroup($id){
        return self::where('group_id', '=', $id)->get()->first();
    }
}
