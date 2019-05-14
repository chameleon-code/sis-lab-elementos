<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\ValidationTrait;

class User extends Authenticatable
{
    use ValidationTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'names', 'first_name', 'second_name', 'email', 'password','code_sis',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $rules = [
        'names' => 'required|max:100',
        'first_name' => 'required|max:100',
        'second_name' => 'required|max:100',
        'email' => 'unique:users|email|required|max:150',
        'password' => 'required|min:8',
        'code_sis' => 'unique:users|required|max:10|min:8',
        'ci' => 'unique:students|max:9|min:6',
    ];
}
