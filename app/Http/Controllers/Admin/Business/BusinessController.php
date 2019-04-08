<?php

namespace App\Http\Controllers\Admin\Business;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class BusinessController extends Controller{


    /**
     * 交易管理显示
     * 苏鹏
     */
    public function index()
    {
        return view("admin.business.index"); 
    }


    /**
     * 交易管理订单详情
     * 苏鹏
     */ 
    public function order()
    {
        return view("admin.business.order");
    }

    /**
     * 交易管理发货管理
     * 苏鹏
     */ 
    public function send()
    {
        return view("admin.business.send");
    }


    /**
     * 交易管理评价
     */
    public function assess(){
        return view("admin.business.assess");

    }




}