<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 前端路由
 * 陈绪
 */

Route::group(['namespace'=>'home'],function (){

    /*TODO:前端首页*/
    Route::any('/','IndexController@index');

});



/**
 * 后端路由
 * 陈绪
 */

Route::group(['prefix' => 'admin','namespace'=>'Admin'] ,function (){


    /*TODO:后台首页*/
    Route::any('/','AdminController@index');


    /*TODO:后台登录*/
    Route::any('login','Login\LoginController@index');


    Route::any('role','Role\RoleController@index');


    Route::any('user/create','User\UserController@create');



});
