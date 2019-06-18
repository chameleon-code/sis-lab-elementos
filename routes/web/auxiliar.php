<?php

use Illuminate\Support\Facades\Route;

Route::get('/auxiliar/assistance', 'AssistanceController@index');
Route::get('/professor/registerAssistance', 'ProfessorController@registro');
Route::get('/auxiliar/getStudentsByBlock/{id}', 'AssistanceController@getStudentsByBlock');
Route::get('/auxiliar/getStudentList/{id}', 'AuxiliarController@getStudentList');
Route::post('/auxiliar/assistance' , 'AssistanceController@store');

//horarios
Route::get('/auxiliar/schedule','ScheduleRecordController@getHorarios');

//TaskControl
Route::get('/auxiliar/taskControl','AuxiliarTaskController@index');
