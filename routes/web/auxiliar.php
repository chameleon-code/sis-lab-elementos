<?php

use Illuminate\Support\Facades\Route;

Route::get('/auxiliar/assistance', 'AssistanceController@index')->middleware('auth','auxiliar');
Route::get('/professor/registerAssistance', 'ProfessorController@registro')->middleware('auth','auxiliar');
Route::get('/auxiliar/getStudentsByBlock/{id}', 'AssistanceController@getStudentsByBlock')->middleware('auth','auxiliar');
Route::get('/auxiliar/getStudentList/{id}', 'AuxiliarController@getStudentList')->middleware('auth','auxiliar');
Route::post('/auxiliar/assistance' , 'AssistanceController@store')->middleware('auth','auxiliar');

//horarios
Route::get('/auxiliar/schedule','ScheduleRecordController@getHorarios')->middleware('auth','auxiliar');

//TaskControl
Route::get('/auxiliar/taskControl','AuxiliarTaskController@index')->middleware('auth','auxiliar');
Route::post('/auxiliar/activities/update','StudentTaskController@updateAuxiliar')->middleware('auth','auxiliar');
