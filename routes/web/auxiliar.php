<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/auxiliar/assistance', 'AssistanceController@index');
//horarios
Route::get('/auxiliar/schedule','ScheduleRecordController@getHorarios');