<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Professor extends Model
{
    public function validations(Request $request){
        $this -> validate($request,[
            'names' => 'required',
            'lastnames' => 'required',
            'email' => 'email|required',
            'password' => 'required'
        ]);
        return $request->all();
    }
}
