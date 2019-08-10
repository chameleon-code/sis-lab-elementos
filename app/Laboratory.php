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

    CONST LABS = ['casa'];
    CONST CAPS = [10000];

    public static function getAllLaboratory(){
        return self::all();
    }
}
