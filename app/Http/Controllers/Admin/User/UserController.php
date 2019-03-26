<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
   
    /**
     * 会员显示
     * 陈绪
     */
    public function index(Request $request){

        if($request->isMethod("post")){
            $users = DB::table("account")->where("status","<>",0)->get();
            return json_encode(array("users"=>$users),JSON_UNESCAPED_UNICODE);
        }

        return view("admin.user.index");

    }


    /**
     * 会员显示
     * 陈绪
     */
    public function look(){

        return view("admin.user.look");

    }

    /**
     * 会员添加
     * 陈绪
     */
    public function add(){

        return view("admin.user.add");

    }

    
 
}
