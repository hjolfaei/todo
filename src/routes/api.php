<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \Hjolfaei\Todo\Http\Controllers\LabelsController;
use \Hjolfaei\Todo\Http\Controllers\TasksController;
use \Hjolfaei\Todo\Http\Controllers\TodoController;
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


Route::group(['prefix' => 'api/v1/todo', 'middleware' => ['auth:custom'] , /*'namespace' => 'Hjolfaei\Todo\Http\Controllers'*/], function() {
    Route::apiResource('/labels',LabelsController::class);
    Route::apiResource('/tasks',TasksController::class);
    Route::get('/fill',[TodoController::class,'fill'])->name('fill');

});

/*Route::group(['prefix' => 'api/v1/todo', 'middleware' => ['auth:custom'] , 'namespace' => ''], function() {
});*/




