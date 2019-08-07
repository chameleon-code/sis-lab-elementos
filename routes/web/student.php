<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Inscripción

Route::get('/students/registration', 'StudentController@registration')->middleware('auth','student');
Route::post('/students/registration/store', 'StudentScheduleController@store')->name('student.reg.store')->middleware('auth','student');
Route::get('/students/registration/getBlocksBySubjects/{id}', 'BlockController@getBlocksBySubjects')->middleware('auth','student');
Route::get('/students/registration/getGroups/{id}', 'BlockController@getGroupsByBlocks')->middleware('auth','student');
Route::get('/students/registration/getGroupSchedules/{id}', 'BlockController@getGroupSchedules')->middleware('auth','student');
Route::get('/students/registration/getScheduleStudent', 'StudentController@getScheduleStudent')->middleware('auth','student');
Route::get('/student/unregistration/{id}', 'StudentScheduleController@destroy')->middleware('auth','student');
Route::post('/students/registration/edit/{id}', 'StudentScheduleController@edit')->middleware('auth','student');


// Tareas

Route::post('/student/activities',['uses' => 'StudentTaskController@store'])->middleware('auth','student');
Route::post('/student/activities/{id}/update',['uses' => 'StudentTaskController@update'])->name('activity.update')->middleware('auth','student');
Route::get('student/{id}', 'StudentController@show')->middleware('auth','student');