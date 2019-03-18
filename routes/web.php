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

Route::group(['prefix' => 'admin','namespace'=>'admin', 'permissions'=>['admin.validate', 'admin.index']] ,function (){


    /*TODO:后台首页*/
    Route::any('/','AdminController@index');


    /*TODO:后台登录*/
    Route::any('login/index','Login\LoginController@index');


    /*TODO:角色管理*/
    Route::any('role/index','Role\RoleController@index');
    Route::any('role/save','Role\RoleController@save');
    Route::any('role/edit','Role\RoleController@edit');
    Route::any('role/del','Role\RoleController@del');
    Route::any('role/status','Role\RoleController@status');


    /*TODO:菜单管理*/
    Route::any('menu/index','Menu\MenuController@index');
    Route::any('menu/save','Menu\MenuController@save');
    Route::any('menu/edit','Menu\MenuController@edit');
    Route::any('menu/del','Menu\MenuController@del');


    /*TODO:会员管理*/
    Route::any('user/index','User\UserController@index');
    Route::any('user/status','User\UserController@status');
    Route::any('user/look','User\UserController@look');




});
