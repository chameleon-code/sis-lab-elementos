<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Administración de Sesiones

Route::get('/sesions','SesionController@index');
Route::post('/sesions/store','SesionController@store');
Route::get('/professor/sesion/{id}/tasks','TaskController@getTasksBySesion');
Route::post('/professor/sesions/tasks/store','TaskController@store');
Route::delete('/professor/task/delete/{id}','TaskController@destroy');

// Monitoreo de Estudiantes

Route::get('/professor/students/profile/{id}', 'ProfessorController@profileStudent');
Route::get('/professor/students/list', 'ProfessorController@studentList');
Route::get('/professor/studentSesions/{id}', 'SesionController@showStudentSesions');
Route::get('/professor/student/{idStudent}/task/{idTask}', 'TaskController@showStudentTask');

// Tareas o Practicas

Route::get('/tasks','TaskController@index');
Route::post('/tasks/create','TaskController@store')->name('tasks.create');