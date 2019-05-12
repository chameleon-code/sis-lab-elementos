<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Management extends Model
{
    use ValidationTrait;
    protected $fillable = ['semester','managements','start_management','end_management', 'management_path'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'semester' => 'unique:managements|required|max:4|min:1',
        'managements' => 'required|max:5|min:1',
        'start_management' => 'required|date_format:Y-m-d',
        'end_management' => 'required|date_format:Y-m-d|after:start_management'
    ];

    public static function getAllManagements(){
        return self::all();
    }
}