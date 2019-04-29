<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class Group extends Model
{
    use ValidationTrait;
    protected $fillable = ['name', 'subject_matter_id', 'management_id', 'professor_id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $rules = [
        'name' => 'required',
        'subject_matter_id' => 'required',
        'management_id' => 'required',
        'professor_id' => 'required'
    ];
    protected $appends = ['subject', 'professor'];

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
    public function blocks(){
        return $this->belongsToMany('App\Block');
    }
    public static function getGroupsNameBySubjects($id){
       return self::where('subject_matter_id', $id)->select('name')->get();
    }
}
