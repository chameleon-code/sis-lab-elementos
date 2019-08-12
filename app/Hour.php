<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Hour extends Model
{
    use ValidationTrait;
    protected $fillable = ['start','end'];

    const START_HOURS = ['06:45:00', '08:15:00', '09:45:00', '11:15:00', '12:45:00', '14:15:00', '15:45:00', '17:15:00', '18:45:00', '20:15:00', '06:45:00'];
    const END_HOURS = ['08:15:00', '09:45:00', '11:15:00', '12:45:00', '14:15:00', '15:45:00', '17:15:00', '18:45:00', '20:15:00', '21:45:00', '21:45:00'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'star' => 'required|time',
        'end' => 'required|time',
    ];

    public static function getAllHours(){
        return self::all();
    }
}
