<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Admin

Route::get('/admin/show/{id}', 'AdminController@show')->middleware('auth','admin');

// Gestión de Docentes

Route::get('/admin/professors','ProfessorController@index')->middleware('auth','admin');
Route::get('/admin/professors/create', ['uses'=> 'ProfessorController@create'])->middleware('auth','admin');
Route::post('/admin/professors/create', ['uses'=> 'ProfessorController@store'])->middleware('auth','admin');
Route::get('/admin/professors/{id}/edit','ProfessorController@edit')->middleware('auth','admin');
Route::post('/admin/professors/{id}/update','ProfessorController@update')->name('professor.update')->middleware('auth','admin');
Route::delete('/admin/professors/{id}','ProfessorController@destroy')->name('professor.destroy')->middleware('auth','admin');

Route::get('/admin/professors/profile/{id}', 'ProfessorController@show')->middleware('auth','admin');

// gestión de auxiliares

Route::get('/admin/auxiliars','AuxiliarController@index')->middleware('auth','admin');
Route::get('/admin/auxiliars/create', 'AuxiliarController@create')->middleware('auth','admin');
Route::post('/admin/auxiliars/store','AuxiliarController@store')->middleware('auth','admin');
Route::delete('/admin/auxiliars/{id}','AuxiliarController@destroy')->name('auxiliar.destroy')->middleware('auth','admin');
Route::get('/admin/auxiliars/{id}/edit','AuxiliarController@edit')->middleware('auth','admin');
Route::post('/admin/auxiliars/{id}/update','AuxiliarController@update')->name('auxiliar.update')->middleware('auth','admin');
Route::get('/admin/auxiliars/profile/{id}', 'AuxiliarController@show')->middleware('auth','admin');

// Gestión de Estudiantes

Route::get('/admin/student/create', ['uses' => 'StudentController@create'])->middleware('auth','admin');
Route::post('/admin/student/create', ['uses' => 'StudentController@store'])->middleware('auth','admin');
Route::get('/admin/students', 'StudentController@index')->middleware('auth','admin');
Route::get('/admin/student/create', 'StudentController@create')->middleware('auth','admin');
Route::get('admin/students/{id}/edit', 'StudentController@edit')->middleware('auth','admin');
Route::get('/admin/students/profile/{id}', 'StudentController@show')->middleware('auth','admin');

Route::get('student', ['uses' => 'StudentController@index'])->middleware('auth','admin');
Route::post('student/register', 'StudentController@store')->name('student.register')->middleware('auth','admin');
Route::post('student/{id}/update', 'StudentController@update')->name('student.update')->middleware('auth','admin');
Route::delete('student/{id}', 'StudentController@destroy')->name('student.destroy')->middleware('auth','admin');


// Administración de Gestiones

Route::get('/admin/managements','ManagementController@index')->middleware('auth','admin');
Route::get('/admin/management/create','ManagementController@create')->middleware('auth','admin');
Route::post('/admin/management/create','ManagementController@store')->name('managements.store')->middleware('auth','admin');
Route::get('/admin/management/{id}/edit','ManagementController@edit')->middleware('auth','admin');
Route::post('/admin/management/{id}/edit','ManagementController@update')->name('managements.update')->middleware('auth','admin');
Route::delete('/admin/management/{id}','ManagementController@destroy')->name('managements.destroy')->middleware('auth','admin');

Route::get('/admin/gestiones','ManagementController@index')->middleware('auth','admin');

// Gestión de Materias

Route::get('/admin/subjectmatters','SubjectMatterController@index')->middleware('auth','admin');
Route::get('/admin/subjectmatter/create','SubjectMatterController@create')->middleware('auth','admin');
Route::post('/admin/subjectmatter/create','SubjectMatterController@store')->name('subjectmatters.store')->middleware('auth','admin');
Route::get('/admin/subjectmatter/{id}/edit','SubjectMatterController@edit')->middleware('auth','admin');
Route::post('/admin/subjectmatter/{id}/edit','SubjectMatterController@update')->name('subjectmatters.update')->middleware('auth','admin');
Route::delete('/admin/subjectmatter/{id}','SubjectMatterController@destroy')->name('subjectmatters.destroy')->middleware('auth','admin');

// Gestión de Grupos

//Grupos
/*Route::get('/admin/groups','GroupController@index')->name('groups.index');
Route::get('/admin/groups/create', 'GroupController@create')->name('groups.create');
Route::post('/admin/groups','GroupController@store')->name('groups.store');
Route::delete('/admin/groups/{id}','GroupController@destroy')->name('groups.destroy');
Route::get('/admin/groups/{id}/edit','GroupController@edit')->name('groups.edit');
Route::post('/admin/groups/{id}/update','GroupController@update')->name('groups.update');
Route::get('/admin/groups/profile/{id}', 'GroupController@show')->name('groups.show');*/
Route::get('/admin/groups/getCount/{id}', 'GroupController@getCountSubjects')->middleware('auth','admin');
Route::get('/admin/groups/getProfessors/{id}', 'GroupController@getProfessors')->middleware('auth','admin');
Route::get('/admin/groups/getGroupsName/{id}', 'GroupController@getGroupsNameBySubjects')->middleware('auth','admin');

// Gestión de Bloques

Route::get('/admin/blocks/getGroups/{id}', 'BlockController@getGroups')->middleware('auth','admin');
Route::get('/admin/blocks/getGroupsId', 'BlockGroupController@getAllBlockGroups')->middleware('auth','admin');
Route::get('/admin/blocks/setStatus/{id}/{value}', 'BlockController@setStatus')->middleware('auth','admin');

// Inscripciones

Route::get('/admin/inscriptions', 'AdminController@registrations')->middleware('auth','admin');
Route::get('/admin/management/registration/{id}/{value}', 'ManagementController@enableOrDisable')->middleware('auth','admin');