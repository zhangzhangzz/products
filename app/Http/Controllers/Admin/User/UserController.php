<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
    public function disabled(Request $request){

        if($request->isMethod("post")){
            $users = DB::table("account")->where("status",0)->get()->toArray();
            foreach ($users as $key => $value) {
                $users[$key]["create_time"] = date("Y-m-d", $value["create_time"]);
            }
            return ajax_success("获取成功", $users);
        }
        return view("admin.user.index");

    }



    /**
     * 查询
     * 陈绪
     */
    public function search(Request $request){

        if($request->isMethod("post")){

            $name = Input::get("name") ? Input::get("name") : "%";
            $weixin_qq = Input::get("weixin_qq") ? Input::get("weixin_qq") : "";
            $phone = Input::get("phone") ? Input::get("phone") : "";
            $address = Input::get("address") ? Input::get("address") : "";
            $where = [];
            if(!empty($name) && empty($weixin_qq) && empty($phone) && empty($address)){
                $where[] = ["name","like","%".$name."%"];
            }
            if(!empty($weixin_qq) && empty($phone) && empty($address) && empty($name)){
                $where[] = ["weixin_qq","like","%".$weixin_qq."%"];
            }
            if(!empty($phone) && empty($name) && empty($weixin_qq) && empty($address)){
                $where[] = ["phone","like","%".$phone."%"];
            }
            if(empty($phone) && empty($name) && empty($weixin_qq) && !empty($address)){
                $where[] = ["address","like","%".$address."%"];
            }
            if(!empty($phone) && !empty($name) && empty($weixin_qq) && empty($address)){
                $where[] = ["phone","like","%".$phone."%"];
                $where[] = ["name","like","%".$name."%"];
            }
            if(!empty($phone) && !empty($name) && !empty($weixin_qq) && empty($address)){
                $where[] = ["phone","like","%".$phone."%"];
                $where[] = ["name","like","%".$name."%"];
                $where[] = ["weixin_qq","like","%".$weixin_qq."%"];
            }
            if(!empty($phone) && !empty($name) && !empty($weixin_qq) && !empty($address)){
                $where[] = ["phone","like","%".$phone."%"];
                $where[] = ["name","like","%".$name."%"];
                $where[] = ["weixin_qq","like","%".$weixin_qq."%"];
                $where[] = ["address","like","%".$address."%"];
            }
            if(empty($phone) && !empty($name) && !empty($weixin_qq) && empty($address)){
                $where[] = ["name","like","%".$name."%"];
                $where[] = ["weixin_qq","like","%".$weixin_qq."%"];
            }
            if(empty($phone) && !empty($name) && empty($weixin_qq) && !empty($address)){
                $where[] = ["name","like","%".$name."%"];
                $where[] = ["address","like","%".$address."%"];
            }
            if(empty($phone) && !empty($name) && !empty($weixin_qq) && !empty($address)){
                $where[] = ["name","like","%".$name."%"];
                $where[] = ["address","like","%".$address."%"];
                $where[] = ["weixin_qq","like","%".$weixin_qq."%"];
            }
            if(empty($phone) && empty($name) && !empty($weixin_qq) && !empty($address)){
                $where[] = ["address","like","%".$address."%"];
                $where[] = ["weixin_qq","like","%".$weixin_qq."%"];
            }
            if(!empty($phone) && empty($name) && empty($weixin_qq) && !empty($address)){
                $where[] = ["phone","like","%".$phone."%"];
                $where[] = ["address","like","%".$address."%"];
            }
            $users = DB::table("account")->where($where)->get()->toArray();
            foreach ($users as $key => $value) {
                $users[$key]["create_time"] = date("Y-m-d", $value["create_time"]);
            }
            return ajax_success("获取成功",$users);

        }

    }

    
 
}
