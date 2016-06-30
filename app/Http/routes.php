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

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/home', ['as'=>'admin.index','uses'=>'IndexController@index']); // 后台首页

    Route::get('user/index',['as'=>'user.index','uses'=>'UserController@index']);
    Route::match(['get','post'],'user/create',['as'=>'user.create','uses'=>'UserController@create']);
    Route::match(['get','post'],'user/{user}/edit',['as'=>'user.edit','uses'=>'UserController@edit']);

    Route::get('role/index',['as'=>'role.index','uses'=>'RoleController@index']);
    Route::match(['get','post'],'role/create',['as'=>'role.create','uses'=>'RoleController@create']);
    Route::match(['get','post'],'role/{role}/edit',['as'=>'role.edit','uses'=>'RoleController@edit']);


    Route::get('permission/index',['as'=>'permission.index','uses'=>'PermissionController@index']);
    Route::match(['get','post'],'permission/create',['as'=>'permission.create','uses'=>'PermissionController@create']);
    Route::match(['get','post'],'permission/{role}/edit',['as'=>'permission.edit','uses'=>'PermissionController@edit']);

});
