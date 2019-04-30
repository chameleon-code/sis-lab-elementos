<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Block extends Model
{
    use ValidationTrait;

    protected $fillable = ['management_id', 'name', 'block_path'];

    protected $rules = [
        'name' => 'required|max:255|min:3',
        'management_id' => 'required',
        'groups_id' => 'required|max:255'
    ];
    
    public static function getAllBlocks(){
        return self::all();
    }
    public function groups(){
        return $this->belongsToMany('App\Group');
    }
}
