<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;
use App\Student;
use App\User;

class StudentTask extends Model
{
    protected $fillable = [
        'student_id',
        'task_id',
        'description',
        'score',
        'observation',
        'path_file',
        'file_name'
    ];
    protected $appends = [
        'student', 'task'
    ];
    protected $table = 'student_tasks';
    public function getStudentAttribute(){
        return Student::find($this->student_id);
    }
    public function getTaskAttribute(){
        return Task::findOrFail($this->task_id);
    }
}

