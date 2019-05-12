<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Block extends Model
{
    use ValidationTrait;

    protected $fillable = ['management_id', 'name', 'block_path'];

    protected $rules = [
        'management_id' => 'required',
        'groups_id.*' => 'required|distinct'
    ];
    public static function getAllBlocks(){
        return self::all();
    }
    public function groups(){
        return $this->belongsToMany('App\Group');
    }
}
