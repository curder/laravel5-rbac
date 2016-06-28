<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware'=>'web','prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/home', ['as'=>'admin.index','uses'=>'IndexController@index']); // 首页






});
