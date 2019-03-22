<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 14:02
 */
namespace App\Http\Controllers\Admin\Goods;
use App\Http\Controllers\Controller;


class CategoryController extends Controller{



    /**
     * 商品分类显示
     * 陈绪
     */
    public function index(){

        return view("admin.goods.category_index");

    }



    /**
     * 商品分类添加
     * 陈绪
     */
    public function add(){

        return view("admin.goods.category_add");

    }



    /**
     * 商品分类入库
     * 陈绪
     */
    public function save(){



    }


    /**
     * 商品分类修改
     * 陈绪
     */
    public function edit(){

        return view("admin.goods,category_edit");

    }


    /**
     * 商品分类更新
     * 陈绪
     */
    public function updata(){



    }


    /**
     * 商品分类删除
     * 陈绪
     */
    public function del(){



    }
}
