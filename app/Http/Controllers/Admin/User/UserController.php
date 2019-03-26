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

            $users = DB::table("account")->where("status","<>",0)->get()->toArray();
            foreach ($users as $key=>$value){
                $users[$key]["create_time"] = date("Y-m-d H:i:s",$value["create_time"]);
            }
            return ajax_success("获取成功",$users);

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
