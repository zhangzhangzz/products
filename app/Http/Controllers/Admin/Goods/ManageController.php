<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Model\Admin\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageController extends Controller
{
    /**
     * 商品管理展示出售中
     *
     * 苏鹏
     */
    public function index()
    {
        $list = Goods::where("num",">","0") -> get();
        return view("admin.Goods.manage",["list" => $list]);
    }

}
