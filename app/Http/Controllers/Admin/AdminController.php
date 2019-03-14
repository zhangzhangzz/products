<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 13:53
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class AdminController extends Controller{


    /**
     * 后台首页
     * 陈绪
     */
    public function index(){

        return view("admin.index");

    }

}