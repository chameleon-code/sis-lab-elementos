<?php

use Illuminate\Support\Facades\Route;

Route::get('/auxiliar/assistance', 'AssistanceController@index');
Route::get('/auxiliar/registerAssistance', 'AssistanceController@registro');
Route::get('/auxiliar/getStudentsByBlock/{id}', 'AssistanceController@getStudentsByBlock');
Route::get('/auxiliar/getStudentList/{id}', 'AuxiliarController@getStudentList');
Route::post('/auxiliar/assistance' , 'AssistanceController@store');

//horarios
Route::get('/auxiliar/schedule','ScheduleRecordController@getHorarios');