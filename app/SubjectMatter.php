<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidationTrait;

class SubjectMatter extends Model
{
    use ValidationTrait;   
    protected $fillable = ['managements_id','name'];

    //protected $hidden = ['created_at','update_at'];

    protected $rules = [
        'name' => 'unique:subject_matters|required|max:50|min:1'
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

    public static function getActualSubjectMatters($management_id){
        $blocks = Block::join('block_group', 'blocks.id', '=', 'block_group.block_id')->where('management_id', '=', $management_id)->select('blocks.id AS id', 'block_group.group_id', 'blocks.name', 'blocks.block_path')->get();
        $groups = Group::join('subject_matters', 'groups.subject_matter_id', '=', 'subject_matters.id')->select('groups.id AS group_id', 'groups.name', 'groups.professor_id', 'subject_matters.id as subject_matter_id', 'subject_matters.name')->get();
        $actual_groups = array();
        foreach($blocks as $block){
            foreach($groups as $group){
                if($block->group_id == $group->group_id){
                    array_push($actual_groups, $group);
                }
            }
        }
        $actual_subject_matters = array();
        $aux = 0;
        foreach($actual_groups as $actual_group){
            if($actual_group->subject_matter_id != $aux){
                array_push($actual_subject_matters, SubjectMatter::findOrFail($actual_group->subject_matter_id));
                $aux = $actual_group->subject_matter_id;
            }
        }
        return $actual_subject_matters;
    }
}
