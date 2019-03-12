<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 13:53
 */

namespace App\Http\Controllers;

class IndexController extends Controller{


    /**
     * 后台首页
     * 陈绪
     */
    public function index(){

        return view("index");

    }

}