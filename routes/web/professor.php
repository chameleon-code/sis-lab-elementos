<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Administración de Sesiones

Route::get('/sesions','SesionController@index')->middleware('auth','professor');
Route::post('/sesions/store','SesionController@store')->middleware('auth','professor');
Route::get('/professor/sesion/{id}/tasks','TaskController@getTasksBySesion')->middleware('auth','professor');
Route::get('/professor/task/{id}','TaskController@getTaskById')->middleware('auth','professor');
Route::post('/professor/sesions/tasks/store','TaskController@store')->middleware('auth','professor');
Route::get('/professor/task/delete/{id}','TaskController@destroy')->name('task.delete')->middleware('auth','professor');
Route::post('/professor/sesions/tasks/edit','TaskController@edit')->middleware('auth','professor');

// Monitoreo de Estudiantes

Route::get('/professor/students/profile/{id}', 'ProfessorController@profileStudent')->middleware('auth','professor');
Route::get('/professor/students/list/', 'ProfessorController@studentList')->middleware('auth','professor');
Route::get('/professor/students/listByGroup/{id}', 'ProfessorController@studentListByGroup')->middleware('auth','professor');
Route::get('/professor/studentSesions/{id}', 'SesionController@showStudentSesions')->middleware('auth','professor');
Route::get('/professor/student/{idStudent}/task/{idTask}', 'TaskController@showStudentTask')->middleware('auth','professor');
Route::get('/professor/student/schedules/{groupId}/{blockId}', 'StudentScheduleController@getSchedulesByGroup')->middleware('auth','professor');
Route::get('/professor/students/getTasksStudent/{studentId}/{blockId}', 'StudentTaskController@getTasksStudent')->middleware('auth','professor');

Route::get('/professor/blocks/{groupId}','GroupController@getBlockBygroupId');
Route::get('/professor/students/sesion/{group_id}/{block_id}/{sesion_id}','StudentScheduleController@getSesionsByBlockByGroup');

// Tareas o Practicas

//Route::get('/tasks','TaskController@index');
Route::post('/tasks/create','TaskController@store')->name('tasks.create');
Route::post('/professor/sesions/tasks/store/score','TaskController@storeScore');
Route::get('/professor/practices/download','TaskController@downloadPractice');
Route::get('/professor/practices/info','SesionController@practicesInfo');
Route::get('/professor/sesions/{blockId}','SesionController@getSesionsByBlock');
Route::get('/deliveredTasks','StudentTaskController@studentTasks');
Route::get('/professor/getStudentsByGroup/{group_id}/{block_id}/{management_id}/{sesion_id}','StudentController@getStudentsByGroup');
Route::get('/professor/getStudentTask/{student_id}/{sesion_id}','StudentTaskController@getStudentTask');
Route::get('/professor/actualSesionBlock/{block_id}','SesionController@getActualSesionBlock');