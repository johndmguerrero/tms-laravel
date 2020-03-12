<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// list of Tasks
Route::get('tasks','TaskController@index');

// Single task
Route::get('task/{task}','TaskController@show');

// Create new Task
Route::post('task','TaskController@store');

// Update Task
Route::put('task','TaskController@store');

// Delete Task
// Route::delete('task/{task}','TaskController@destroy');
Route::delete('task/{task}','TaskController@destroy');