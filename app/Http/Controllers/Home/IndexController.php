<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/13
 * Time: 10:55
 */
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;

class IndexController extends Controller{


    /**
     * 前端首页
     * 陈绪
     */
    public function index(){

        return view("home.index");

    }

}