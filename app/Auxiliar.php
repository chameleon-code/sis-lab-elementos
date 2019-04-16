<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Auxiliar extends Model
{
    use ValidationTrait;
    protected $fillable = [
        'user_id',
    ];

    public static function getAllAuxiliars(){
        return Auxiliar::join('users','user_id','=','users.id')->select('users.role_id', 'users.names', 'users.first_name', 'users.second_name', 'users.email', 'users.password', 'users.img_path', 'users.remember_token', 'users.created_at', 'users.updated_at', 'auxiliars.id')->get();
    }

    protected $rules = [
        'names' => 'required|max:100',
        'first_name' => 'required|max:100',
        'second_name' => 'required|max:100',
        'email' => 'email|required|max:150',
        'password' => 'required|min:8'
    ];

}
