<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Inscripción

Route::get('/students/registration', 'StudentController@registration');
Route::post('/students/registration/store', 'StudentScheduleController@store')->name('student.reg.store');
Route::get('/students/registration/getBlocksBySubjects/{id}', 'BlockController@getBlocksBySubjects');
Route::get('/students/registration/getGroups/{id}', 'BlockController@getGroupsByBlocks');
Route::get('/students/registration/getGroupSchedules/{id}', 'BlockController@getGroupSchedules');
Route::get('/students/registration/getScheduleStudent', 'StudentController@getScheduleStudent');

// Tareas

Route::post('/student/activities',['uses' => 'StudentTaskController@store']);
Route::get('student/{id}', 'StudentController@show');