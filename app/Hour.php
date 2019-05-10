<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Hour extends Model
{
    use ValidationTrait;
    protected $fillable = ['start','end'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'star' => 'required|time',
        'end' => 'required|time',
    ];
}
