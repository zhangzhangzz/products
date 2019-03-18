<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   
    /**
     * 会员显示
     * 陈绪
     */
    public function index(){

        return view("admin.user.index");

    }


    /**
     * 会员显示
     * 陈绪
     */
    public function look(){

        return view("admin.user.look");

    }

    
 
}
