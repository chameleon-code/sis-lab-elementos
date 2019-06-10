<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/auxiliar/assistance', 'AssistanceController@index');
<<<<<<< HEAD
Route::get('/auxiliar/getStudentList/{id}', 'AuxiliarController@getStudentList');
=======
//horarios
Route::get('/auxiliar/schedule','ScheduleRecordController@getHorarios');
>>>>>>> 385ca53a74a7ec107aed2ff919055659a13ac5ad
