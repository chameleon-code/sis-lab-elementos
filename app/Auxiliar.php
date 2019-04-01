<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public static function getAllAuxiliars(){
        return Auxiliar::join('users','user_id','=','users.id')->select('users.role_id', 'users.names', 'users.first_name', 'users.second_name', 'users.email', 'users.password', 'users.img_path', 'users.remember_token', 'users.created_at', 'users.updated_at', 'auxiliars.id')->get();
    }
}
