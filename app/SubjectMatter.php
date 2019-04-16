<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class SubjectMatter extends Model
{
    use ValidationTrait;   
    protected $fillable = ['managements_id','name'];

    protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'name' => 'required|max:50|min:1'
    ];

    public static function getAllSubjectMatters(){
        return self::all();
    }
    public function groups(){
        return $this->hasMany('App\Group');
    }
    public function professors(){
        return $this->belongsToMany('App\Professor', 'groups', 'subject_matter_id', 'professor_id');
    }
    public static function getProfessors($id){
        return self::professors()->where('professor_id', $id)->get();
    }
}
