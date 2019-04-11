<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SubjectMatter extends Model
{
    
    protected $fillable = ['managements_id','name'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'name' => 'required|max:255|min:1',
        'managements_id' => 'required|max:255'
    ];

    public $errors;
    public function validate($date){
        $v = Validator::make($date, $this->rules);
        if($v->fails()){
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }

    public static function getAllSubjectMatters(){
        return self::all();
    }
    public function groups(){
        return $this->hasMany('App\Group');
    }
    public function management(){
        return $this->belongsTo('App\Management','managements_id');
    }
    public function professors(){
        return $this->belongsToMany('App\Professor', 'groups', 'subject_matter_id', 'professor_id');
    }
    public static function getProfessors($id){
        return self::professors()->where('professor_id', $id)->get();
    }
}
