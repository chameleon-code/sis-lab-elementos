<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Laboratory extends Model
{
    use ValidationTrait;
    // protected $table='laboratory';
    protected $fillable = ['name'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'name' => 'unique:name|required|max:20|min:1'
    ];

    CONST LABS = ['1', '2', '3', '4'];
    CONST CAPS = [60, 40, 50, 50];

    public static function getAllLaboratory(){
        return self::all();
    }
}
