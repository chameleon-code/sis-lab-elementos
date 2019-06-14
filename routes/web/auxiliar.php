<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/auxiliar/assistance', 'AssistanceController@index');
Route::get('/auxiliar/getStudentsByBlock/{id}', 'AssistanceController@getStudentsByBlock');