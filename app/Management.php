<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;
use Carbon\Carbon;

class Management extends Model
{
    use ValidationTrait;
    protected $fillable = ['semester','managements','start_management','end_management', 'enable_inscription', 'management_path', 'enable_inscription'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'semester' => 'unique:managements|required|max:4|min:1',
        'managements' => 'required|max:5|min:1',
        'start_management' => 'required|date_format:Y-m-d',
        'end_management' => 'required|date_format:Y-m-d|after:start_management',
    ];

    public static function getAllManagements(){
        return self::all();
    }
    public function blocks(){
        return $this->hasMany('App\Block');
    }

    public static function getActualManagement(){
        $managements = Management::all();
        $today = Carbon::now()->format('Y-m-d');
        $actual_management = null;
        foreach($managements as $management){
            if($today > $management->start_management && $today < $management->end_management) {
                $actual_management = $management;
            }
        }
        return $actual_management;
    }
}