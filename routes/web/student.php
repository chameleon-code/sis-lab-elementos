<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Inscripción

Route::get('/students/registration', 'StudentController@registration');
Route::post('/students/registration/confirm', 'StudentController@confirm')->name('student.reg.confirm');
Route::get('/students/registration/getBlocksBySubjects/{id}', 'BlockController@getBlocksBySubjects');
Route::get('/students/registration/getGroups/{id}', 'BlockController@getGroupsByBlocks');

// Tareas

Route::post('/student/activities',['uses' => 'StudentTaskController@store']);
Route::get('student/{id}', 'StudentController@show');