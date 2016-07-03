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
Route::pattern('id', '[0-9]+');


Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['prefix'=>'admin','middleware'=>['role.auth','role.menu'],'namespace'=>'Admin'],function(){

    Route::get('/home', [
        'as'=>'admin.index',
        'uses'=>'IndexController@index'
    ]); // 后台首页

    Route::get('user/getGroup/{user}',[
        'as'=>'admin.user.getGroup',
        'uses'=>'UserController@getGroup'
    ]);

    Route::post('user/postGroup/{user}',[
        'as'=>'admin.user.postGroup',
        'uses'=>'UserController@postGroup'
    ]);

    Route::resource('user','UserController');

    Route::post('role/editPersissionToRole/{role}',[
        'as'=>'admin.role.editPersissionToRole',
        'uses'=>'RoleController@editPersissionToRole'
    ]);

    Route::resource('role','RoleController');

    Route::get('permission/create/{id?}',[
        'as'=>'admin.permission.getCreate',
        'uses'=>'PermissionController@create'
    ]);

    Route::get('permission/index/{id?}',[
        'as'=>'admin.permission.getIndex',
        'uses'=>'PermissionController@index',
        'id'=>'{parent_id}'
    ]);

    Route::resource('permission','PermissionController');
});
