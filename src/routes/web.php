<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Hjolfaei\Todo\Http\Controllers'],function(){
    Route::get('/todo','TodoController@index');
});
