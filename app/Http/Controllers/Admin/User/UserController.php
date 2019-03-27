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
            $users = DB::table("account")->where("status",1)->get()->toArray();
            foreach ($users as $key => $value) {
                $users[$key]["create_time"] = date("Y-m-d", $value["create_time"]);
            }
            return ajax_success("获取成功", $users);
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
     * 会员禁用
     * 陈绪
     */
    public function status(Request $request){

        if($request->isMethod("post")){
            $id = $request->id;
            $bool = DB::table("account")->where("id",$id)->update(["status"=>0]);
            if($bool){
                return ajax_success("修改成功");
            }else{
                return ajax_error("修改失败");
            }
        }

    }


    /**
     * 会用禁用显示
     * 陈绪
     */
    public function status_index(Request $request){

        if($request->isMethod("post")){
            $users = DB::table("account")->where("status",0)->get()->toArray();
            foreach ($users as $key => $value) {
                $users[$key]["create_time"] = date("Y-m-d", $value["create_time"]);
            }
            return ajax_success("获取成功", $users);
        }
        return view("admin.user.index");

    }

    
 
}
