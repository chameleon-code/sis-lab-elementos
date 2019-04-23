<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementController;

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

Route::get('auxiliar', function () {
    return view('components.sections.auxiliarSection');
});

//child roles
Route::get('admin/lista', function () {
    return view('components.contents.admin.adminContent');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

//Materias
Route::get('/admin/subjectmatters','SubjectMatterController@index');

Route::get('/admin/subjectmatter/create','SubjectMatterController@create');
Route::post('/admin/subjectmatter/create','SubjectMatterController@store')->name('subjectmatters.store');

Route::get('/admin/subjectmatter/{id}/edit','SubjectMatterController@edit');
Route::post('/admin/subjectmatter/{id}/edit','SubjectMatterController@update')->name('subjectmatters.update');
Route::delete('/admin/subjectmatter/{id}','SubjectMatterController@destroy')->name('subjectmatters.destroy');

//Gestiones
Route::get('/admin/gestiones','ManagementController@index');

 //Grupos
Route::resource('/admin/groups', 'GroupController');
Route::get('/admin/groups/getCount/{id}', 'GroupController@getCountSubjects');
Route::get('/admin/groups/getProfessors/{id}', 'GroupController@getProfessors');
Route::get('/admin/groups/getGroupsName/{id}', 'GroupController@getGroupsNameBySubjects');

//Auxiliares
Route::get('/admin/auxiliars','AuxiliarController@index');
Route::get('/admin/auxiliars/create', 'AuxiliarController@create');
Route::post('/admin/auxiliars/store','AuxiliarController@store');
Route::delete('/admin/auxiliars/{id}','AuxiliarController@destroy')->name('auxiliar.destroy');
Route::get('/admin/auxiliars/{id}/edit','AuxiliarController@edit');
Route::post('/admin/auxiliars/{id}/update','AuxiliarController@update')->name('auxiliar.update');
Route::get('/admin/auxiliars/profile/{id}', 'AuxiliarController@show');

//Admin
Route::get('/admin/show/{id}', 'AdminController@show');

//Bloques
Route::resource('/admin/blocks', 'BlockController');
Route::get('/admin/blocks/getGroups/{id}', 'BlockController@getGroups');
Route::get('/admin/blocks/getGroupsId', 'BlockGroupController@getAllBlockGroups');

//Gestion
Route::get('/admin/managements','ManagementController@index');
Route::get('/admin/management/create','ManagementController@create');
Route::post('/admin/management/create','ManagementController@store')->name('managements.store');
Route::get('/admin/management/{id}/edit','ManagementController@edit');
Route::post('/admin/management/{id}/edit','ManagementController@update')->name('managements.update');
Route::delete('/admin/management/{id}','ManagementController@destroy')->name('managements.destroy');