<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessorSubjectMatter extends Model
{
    protected $table = 'professor_subject_matter';

    public static function getAllProfessors($id){
        return self::select('professor_id')->where('subject_matter_id', $id)->get();
    }
}
