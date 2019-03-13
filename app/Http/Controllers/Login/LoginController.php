<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 14:05
 */

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;

class LoginController extends Controller{


    /**
     * 后台登录
     * 陈绪
     */
    public function index(){

        return view("login.index");

    }

}
