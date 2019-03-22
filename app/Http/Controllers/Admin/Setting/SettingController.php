<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    /**
     * 设置管理显示
     * 苏鹏
     */
    public function index()
    {
        return view("admin.Setting.index");
    }

       

    
}