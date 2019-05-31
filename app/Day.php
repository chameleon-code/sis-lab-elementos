<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Day extends Model
{
    use ValidationTrait;
    protected $fillable = ['name'];
    protected $hidden = ['created_at','update_at'];
    protected $rules = [
        'name' => 'unique:name|required|max:10|min:1'
    ];

    public static function getAllDays(){
        return self::all();
    }
}
