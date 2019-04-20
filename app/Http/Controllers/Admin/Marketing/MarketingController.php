<?php

namespace App\Http\Controllers\Admin\Marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketingController extends Controller
{
    /**
     * 营销中心秒杀首页
     * 苏鹏
     */
    public function seconds()
    {
        return view("admin.marketing.seconds");
    }
    /**
     * 营销中心秒杀添加
     * 苏鹏
     */
    public function seconds_save()
    {
        return view("admin.marketing.seconds_save");
    }
    /**
     * 营销中心农家院首页
     * 苏鹏
     */
    public function farmhouse()
    {
        return view("admin.marketing.farmhouse");
    }
    /**
     * 营销中心农家院添加
     * 苏鹏
     */
    public function farmhouse_save()
    {
        return view("admin.marketing.farmhouse_save");
    }
    /**
     * 营销中心拼团首页
     * 苏鹏
     */
    public function group()
    {
        return view("admin.marketing.group");
    }
    /**
     * 营销中心拼团添加
     * 苏鹏
     */
    public function group_save()
    {
        return view("admin.marketing.group_save");
    }
    /**
     * 营销中心营养搭配首页
     * 苏鹏
     */
    public function nutrition()
    {
        return view("admin.marketing.nutrition");
    }
    /**
     * 营销中心营养搭配添加
     * 苏鹏
     */
    public function nutrition_save()
    {
        return view("admin.marketing.nutrition_save");
    }
    /**
     * 营销中心修改页面
     * 苏鹏
     */
    public function edit()
    {
        return view("admin.marketing.edit");
    }
}
