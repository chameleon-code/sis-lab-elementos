<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Laboratory extends Model
{
    use ValidationTrait;
    protected $fillable = ['name'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'name' => 'unique:name|required|max:20|min:1'
    ];
}
