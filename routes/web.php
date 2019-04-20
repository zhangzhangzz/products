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
Route::group(['prefix' => 'admin','namespace'=>'admin'] ,function (){

    /*TODO:后台登录*/
    Route::any('login','Login\LoginController@index');
    Route::any('login/doLogin','Login\LoginController@doLogin');
    Route::any('login/logout','Login\LoginController@logout');

});

Route::group(['prefix' => 'admin','namespace'=>'admin', 'permissions'=>['admin.validate', 'admin.index'],'middleware'=> 'role'] ,function (){


    /*TODO:后台首页*/
    Route::any('/','AdminController@index');


    /*TODO:账号管理*/
    Route::any('admin_user/index','Admin_User\Admin_UserController@index');
    Route::any('admin_user/save','Admin_User\Admin_UserController@save');
    Route::any('admin_user/insert','Admin_User\Admin_UserController@insert');
    Route::any('admin_user/edit/{id}','Admin_User\Admin_UserController@edit');
    Route::any('admin_user/del/{id}','Admin_User\Admin_UserController@del');
    Route::any('admin_user/update/{id}','Admin_User\Admin_UserController@update');
    Route::any('admin_user/regular','Admin_User\Admin_UserController@regular');
    Route::any('admin_user/state/{id}/{state}','Admin_User\Admin_UserController@state');


    /*TODO:角色管理*/
    Route::any('role/index','Role\RoleController@index');
    Route::any('role/save','Role\RoleController@save');
    Route::any('role/insert','Role\RoleController@insert');
    Route::any('role/edit/{id}','Role\RoleController@edit');
    Route::any('role/update/{id}','Role\RoleController@update');
    Route::any('role/del/{id}','Role\RoleController@del');
    Route::any('role/regular','Role\RoleController@regular');
    Route::any('role/state/{id}/{state}','Role\RoleController@state');

 
    /*TODO:菜单管理*/
    Route::any('menu/index','Menu\MenuController@index');
    Route::any('menu/save','Menu\MenuController@save');
    Route::any('menu/insert','Menu\MenuController@insert');
    Route::any('menu/edit/{id}','Menu\MenuController@edit');
    Route::any('menu/update/{id}','Menu\MenuController@update');
    Route::any('menu/del/{id}','Menu\MenuController@del');
    Route::any('menu/regular','Menu\MenuController@regular');


    /*TODO:会员管理*/
    Route::any('user/index','User\UserController@index');
    Route::any('user/status','User\UserController@status');
    Route::any('user/look/{id}','User\UserController@look');
    Route::any('user/disabled','User\UserController@disabled');
    Route::any('user/search','User\UserController@search');


    /*TODO:店铺管理*/
    Route::any('shop/index','Shop\ShopController@index');
    Route::any('shop/audit/{id}','Shop\ShopController@audit');
    Route::any('shop/opinion','Shop\ShopController@opinion');
    Route::any('shop/search','Shop\ShopController@search');
    Route::any('shop/show','Shop\ShopController@show');
    Route::any('shop/opinion_pass','Shop\ShopController@opinion_pass');



    /*TODO:商品*/
    Route::any('goods/index','Goods\GoodsController@index');
    Route::any('goods/add','Goods\GoodsController@add');


    Route::any('goods/addclass','Goods\GoodsController@addclass');
    Route::any('goods/manage','Goods\GoodsController@manage'); 
    Route::any('goods/recycle','Goods\GoodsController@recycle');


    /*TODO:平台设置*/
    Route::any('setting/index','Setting\SettingController@index');



    /*TODO:商品分类*/
    Route::any('category/index','Goods\CategoryController@index');
    Route::any('category/add','Goods\CategoryController@add');
    Route::any('category/save','Goods\CategoryController@save');
    Route::any('category/edit/{id}','Goods\CategoryController@edit');
    Route::any('category/del','Goods\CategoryController@del');
    Route::any('category/updata','Goods\CategoryController@updata');
    Route::any('category/images','Goods\CategoryController@images');


    /*TODO:交易管理*/
    Route::any('business/index','Business\BusinessController@index');
    Route::any('business/send/{search?}','Business\BusinessController@send');
    Route::any('business/order','Business\BusinessController@order');
    Route::any('business/assess','Business\BusinessController@assess');
    Route::any('business/search','Business\BusinessController@search');
    Route::any('business/show/{show}','Business\BusinessController@show');
    Route::any('business/reply','Business\BusinessController@reply');
    Route::any('business/delivery','Business\BusinessController@delivery');
    /*营销中心*/
    Route::any('marketing/seconds','Marketing\MarketingController@seconds');
    Route::any('marketing/seconds_save','Marketing\MarketingController@seconds_save');
    Route::any('marketing/farmhouse','Marketing\MarketingController@farmhouse');
    Route::any('marketing/farmhouse_save','Marketing\MarketingController@farmhouse_save');
    Route::any('marketing/group','Marketing\MarketingController@group');
    Route::any('marketing/group_save','Marketing\MarketingController@group_save');
    Route::any('marketing/nutrition','Marketing\MarketingController@nutrition');
    Route::any('marketing/nutrition_save','Marketing\MarketingController@nutrition_save');
    /*TODO:售后*/
    Route::any('after/index','After\AfterController@index');



});
