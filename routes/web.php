<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Laboratory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.home');
});
Route::get('error', function () {
    return view('errors.404');
});
Route::get('register', function () {
    return view('layouts.register');
});

//roles
Route::get('admin', function () {
    return view('components.sections.adminSection');
});
Route::get('student', function () {
    return view('components.contents.student.studentSection');
});
Route::get('professor', function () {
    return view('components.sections.professorSection');
});


//Docente
Route::get('/admin/professors','ProfessorController@index');
Route::get('/admin/professors/create', ['uses'=> 'ProfessorController@create']);
Route::post('/admin/professors/create', ['uses'=> 'ProfessorController@store']);
Route::get('/admin/professors/{id}/edit','ProfessorController@edit');
Route::post('/admin/professors/{id}/update','ProfessorController@update')->name('professor.update');
Route::delete('/admin/professors/{id}','ProfessorController@destroy')->name('professor.destroy');
Route::get('/admin/professors/profile/{id}', 'ProfessorController@show');

//Estudiante
Route::post('/student/activities',['uses' => 'StudentTaskController@store']);
Route::get('student', ['uses' => 'StudentController@index']);
Route::get('/admin/student/create', ['uses' => 'StudentController@create']);
Route::post('/admin/student/create', ['uses' => 'StudentController@store']);

Route::get('/admin/students/profile/{id}', 'StudentController@show');
Route::get('/admin/students', 'StudentController@index');
Route::get('/admin/student/create', 'StudentController@create');
Route::post('student/register', 'StudentController@store')->name('student.register');
Route::get('student/{id}', 'StudentController@show');
Route::get('admin/students/{id}/edit', 'StudentController@edit');
Route::post('student/{id}/update', 'StudentController@update')->name('student.update');
Route::delete('student/{id}', 'StudentController@destroy')->name('student.destroy');


Route::get('/professor/students/profile/{id}', 'ProfessorController@profileStudent');
Route::get('/professor/students/list', 'ProfessorController@studentList');
Route::get('/professor/studentSesions/{id}', 'SesionController@showStudentSesions');
Route::get('/professor/student/{idStudent}/task/{idTask}', 'TaskController@showStudentTask');


Route::get('/students/registration', 'StudentController@registration');
Route::post('/students/registration/confirm', 'StudentController@confirm')->name('student.reg.confirm');
Route::get('/students/registration/getBlocksBySubjects/{id}', 'BlockController@getBlocksBySubjects');
Route::get('/students/registration/getGroups/{id}', 'BlockController@getGroupsByBlocks');
Route::get('/students/registration/getGroup/{id}', 'GroupController@getBlockByGroupId');
Auth::routes();

Route::get('/home', 'HomeController@index');

// child roles

Route::get('admin/lista', function () {
    return view('components.contents.admin.adminContent');
});

// Secciones

Route::get('auxiliar', function () {
    return view('components.sections.auxiliarSection');
});

// Horario

Route::get('scheduler', function () {
    $labs = Laboratory::all();
    $data = ['labs' => $labs];
    return view('components.contents.scheduler.scheduler', $data);
});
Route::get('scheduler/{id}', 'EventController@loadScheduler');
Route::get('scheduler2/{id}', 'EventController@loadScheduler2');


/*Run
php composer update
php artisan config:clear
*/

Route::resource('/admin/groups', 'GroupController');
Route::resource('/admin/blocks', 'BlockController');