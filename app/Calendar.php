<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = [
        'start', 'end', 'description'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
