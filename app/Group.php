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
        'professor_id' => 'required',
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
        return SubjectMatter::findOrFail($this->subject_matter_id);
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

    public static function getGroupBlocks(){
        return Group::join('block_group', 'groups.id', '=', 'block_group.group_id')->select('groups.id', 'groups.name', 'groups.subject_matter_id', 'groups.professor_id','block_group.block_id')->get();
    }
    public static function getSubjectById($id){
        return SubjectMatter::find(self::find($id)->subject_matter_id);
    }
    public function blockSchedule(){
        return $this->belongsToMany('App\BlockSchedule','student_schedules','group_id','block_schedule_id');
    }
    public function studentSchedules(){
        return $this->hasMany('App\StudentSchedule');
    }

    public static function quantityStudentsByGroup() {
        $id_groups = array();
        $block_groups = BlockGroup::all();
        for($i=0 ; $i<sizeof($block_groups) ; $i++) {
            array_push($id_groups, $block_groups[$i]->group_id);
        }

        $block_schedules = BlockSchedule::all();
        $group_registered = [];
        for($i=0 ; $i<sizeof($id_groups) ; $i++) {
            $group_registered[$id_groups[$i]] = 0;
        }

        $student_schedules = StudentSchedule::all();
        for($i=0 ; $i<sizeof($id_groups) ; $i++) {
            for($j=0 ; $j<sizeof($student_schedules) ; $j++) {
                if($id_groups[$i] == $student_schedules[$j]->group_id) {
                    $group_registered[$id_groups[$i]]++;
                }
            }
        }
        return $group_registered;
    }
}
