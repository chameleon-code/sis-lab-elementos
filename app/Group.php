<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Group extends Model
{
    protected $fillable = ['name', 'subject_matters_id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $rules = [
        'name' => 'required|max:255|min:5',
        'subject_matters_id' => 'required|max:255'
    ];

    public $errors;
    public function validate($date)
    {
        $v = Validator::make($date, $this->rules);
        if($v->fails()){
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }

    public static function getAllGroups()
    {
        return self::all();
    }
    public function subjectMatter()
    {
        return $this->belongsTo('App\SubjectMatter', 'subject_matters_id');
    }
    
}
