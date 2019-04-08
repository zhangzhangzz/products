<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 14:02
 */
namespace App\Http\Controllers\Admin\Goods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;



class CategoryController extends Controller{



    /**
     * 商品分类显示
     * 陈绪
     */
    public function index(Request $request){

        $category = DB::table("goods_type")->get()->toArray();
        $category_list = _tree_hTree(_tree_sort($category,"sort_number"));
        $page = $request->page ?: 1;
        //每页的条数
        $perPage = 5;
        //计算每页分页的初始位置
        $offset = ($page * $perPage) - $perPage;
        //实例化LengthAwarePaginator类，并传入对应的参数
        $category_list = new LengthAwarePaginator(array_slice($category_list, $offset, $perPage, true), count($category_list), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]);

        return view("admin.goods.category_index",["category_list"=>$category_list]);

    }



    /**
     * 商品分类添加
     * 陈绪
     */
    public function add($pid = 0){

        $category_list = [];
        if($pid == 0){
            $category_list = getSelectList("goods_type");
        }
        return view("admin.goods.category_add",["category_list"=>$category_list]);

    }



    /**
     * 商品分类入库
     * 陈绪
     */
    public function save(Request $request){

        $category = $request->all();
        unset($category["_token"]);
        $images = $_FILES["images"];
        $images_url = imagesUrl($images);
        $category["images"] = $images_url;
        $bool = DB::table("goods_type")->insert($category);
        if($bool){
            return redirect("admin/category/index")->with("message","添加成功");
        }else{
            return redirect("admin/category/index")->with("message","添加失败");
        }

    }


    /**
     * 商品分类修改
     * 陈绪
     */
    public function edit($id){

        $category = DB::table("goods_type")->where("id",$id)->get();
        $category_list = getSelectList("goods_type");

        return view("admin.goods.category_edit",["category_list"=>$category_list,"category"=>$category]);

    }


    /**
     * 商品分类更新
     * 陈绪
     */
    public function updata(Request $request){

        $category = $request->all();
        unset($category["_token"]);
        $images = $_FILES["images"];
        $images_url = ImagesUrl($images);
        $category["images"] = $images_url;
        $bool = DB::table("goods_type")->where("id",$category["id"])->update($category);
        if($bool){
            return redirect("admin/category/index")->with("message","修改成功");
        }else{
            return redirect("admin/category/index")->with("message","修改失败");
        }

    }


    /**
     * 商品分类删除
     * 陈绪
     */
    public function del(Request $request){

        if($request->isMethod("post")){
            $id = $request->id;
            $pid = DB::table("goods_type")->where("id",$id)->get()->toArray();
            if($pid[0]["pid"] == 0){
                $category_pid = DB::table("goods_type")->where("pid",$pid[0]["id"])->get()->toArray();
                if(count($category_pid) > 1){
                    exit(json_encode(array("status"=>3,"info"=>"请删除子分类"),JSON_UNESCAPED_UNICODE));
                }else{
                    $bool = DB::table("goods_type")->where("id",$id)->delete();
                    if($bool){
                        return ajax_success("删除成功");
                    }else{
                        return ajax_error("删除失败");
                    }
                }
            }else{
                $category_bool = DB::table("goods_type")->where("id",$id)->delete();
                if($category_bool){
                    return ajax_success("删除成功");
                }else{
                    return ajax_error("删除失败");
                }
            }
        }
    }



    /**
     * 图片删除
     * 陈绪
     */
    public function images(Request $request){

        if($request->isMethod("post")){
            $id = $request->id;
            $category_images = DB::table("goods_type")->where("id",$id)->value("images");
            $bool = ImagesDelete("uploads"."/".$category_images);
            if($bool){
                DB::table("goods_type")->where("id",$id)->update(["images"=>null]);
                return ajax_success("删除成功",$bool);
            }else{
                return ajax_success("删除失败",$bool);
            }
        }
    }
}
