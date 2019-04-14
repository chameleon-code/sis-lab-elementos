<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Group extends Model
{
    protected $fillable = ['name', 'subject_matter_id', 'management_id', 'professor_id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $rules = [
        'name' => 'required|max:255|min:5',
        'subject_matter_id' => 'required|max:255'
    ];
    protected $appends = ['subject', 'professor'];

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
        return self::orderBy('subject_matter_id')->get();
    }
    public static function getGroupsBySubjects($id){
        return self::where('subject_matter_id', $id)->orderBy('name')->get();
    }
    public function getSubjectAttribute()
    {
        return SubjectMatter::findOrFail($this->subject_matter_id)->name;
    }
    public function getProfessorAttribute()
    {
        return Professor::getProfessor($this->professor_id);
    }
}
