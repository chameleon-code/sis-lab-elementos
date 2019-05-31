<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = [
        'start', 'end', 'description'
    ];
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
