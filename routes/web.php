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
 * 苏鹏
 */

Route::group(['namespace'=>'home'],function (){

    /*TODO:前端首页*/
    Route::any('/','IndexController@index');

});



/**
 * 后端路由
 * 陈绪
 * 苏鹏
 */

Route::group(['prefix' => 'admin','namespace'=>'admin', 'permissions'=>['admin.validate', 'admin.index'],'middleware'=>'role'] ,function (){


    /*TODO:后台首页*/
    Route::any('/','AdminController@index');


    /*TODO:后台登录*/
    Route::any('login/index','Login\LoginController@index');


    /*TODO:账号管理*/
    Route::any('admin/index','Admin\AdminController@index');
    Route::any('admin/save','Admin\AdminController@save');
    Route::any('admin/add','Admin\AdminController@add'); 
    Route::any('admin/edit','Admin\AdminController@edit');
    Route::any('admin/del','Admin\AdminController@del');
    Route::any('admin/status','Admin\AdminController@stauts');
    Route::any('admin/updata','Admin\AdminController@updata');


    /*TODO:角色管理*/
    Route::any('role/index','Role\RoleController@index');
    Route::any('role/save','Role\RoleController@save');
    Route::any('role/insert','Role\RoleController@insert');
    Route::any('role/edit/{id}','Role\RoleController@edit');
    Route::any('role/update/{id}','Role\RoleController@update');
    Route::any('role/del/{id}','Role\RoleController@del');
    Route::any('role/status','Role\RoleController@status');

 
    /*TODO:菜单管理*/
    Route::any('menu/index','Menu\MenuController@index');
    Route::any('menu/save','Menu\MenuController@save');
    Route::any('menu/insert','Menu\MenuController@insert');
    Route::any('menu/edit/{id}','Menu\MenuController@edit');
    Route::any('menu/update/{id}','Menu\MenuController@update');
    Route::any('menu/del/{id}','Menu\MenuController@del');


    /*TODO:会员管理*/
    Route::any('user/index','User\UserController@index');
    Route::any('user/status','User\UserController@status');
    Route::any('user/add','User\UserController@add');
    Route::any('user/look','User\UserController@look');


    /*TODO:店铺管理*/
    Route::any('shop/index','Shop\ShopController@index');
    Route::any('shop/check','Shop\ShopController@check');

    /*TODO:商品*/
    Route::any('goods/index','Goods\GoodsController@index');
    Route::any('goods/add','Goods\GoodsController@add');


    Route::any('goods/addclass','Goods\GoodsController@addclass');
    Route::any('goods/classify','Goods\GoodsController@classify'); 
    Route::any('goods/manage','Goods\GoodsController@manage'); 
    Route::any('goods/recycle','Goods\GoodsController@recycle');

    /*TODO:平台设置*/
    Route::any('setting/index','Setting\SettingController@index');



    /*TODO:商品分类*/
    Route::any('category/index','Goods\CategoryController@index');
    Route::any('category/add','Goods\CategoryController@add');
    Route::any('category/save','Goods\CategoryController@save');
    Route::any('category/edit','Goods\CategoryController@edit');
    Route::any('category/del','Goods\CategoryController@del');
    Route::any('category/updata','Goods\CategoryController@updata');



});
