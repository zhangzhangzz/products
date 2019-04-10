<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 9:06
 */

use OSS\OssClient;
use OSS\Core\OssException;

if(!function_exists("ajax_success")){

    function ajax_success($msg = '提交成功',$data=array()){
        $return = array('status'=>'1');
        $return['info'] = $msg;
        $return['data'] = $data;
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

}


if(!function_exists("ajax_error")){

    function ajax_error($msg = '服务器错误，可刷新页面重试',$data=array()){
        $return = array('status'=>'0');
        $return['info'] = $msg;
        $return['data'] = $data;
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

}


//oss 图片上传
if(!function_exists("ImagesUrl")){

    function ImagesUrl($images_url){

        $str_name = strrchr($images_url["name"],".");
        // 存储空间名称
        // 文件名称
        // 文件内容
        $filePath = $images_url["name"];
        $allow_type = ['.jpg', '.jpeg', '.gif', '.bmp', '.png'];
        if (! in_array($str_name, $allow_type)) {
            exit("文件格式不在允许范围内哦");
        }

        try{
            $ossClient = new OssClient(accessKeyId, accessKeySecret, endpoint);
            $result = $ossClient->uploadFile(bucket, "uploads"."/".$filePath,$images_url['tmp_name']);
            $arr = [
                'oss_url' => $result['info']['url'],  //上传资源地址
            ];
        } catch (OssException $url) {
            $images_url = $url->getMessage();
        }
        $images_url_name = substr(strrchr($arr["oss_url"],"/"),1);
        return $images_url_name;

    }

}



//oss图片删除
if(!function_exists("ImagesDelete")){

    function ImagesDelete($images_url){

        try{
            $ossClient = new OssClient(accessKeyId, accessKeySecret, endpoint);
            $bool = $ossClient->deleteObject(bucket, $images_url);
        } catch(OssException $e) {
            $bool = $e->getMessage();
        }
        return true;

    }

}



if(!function_exists("_tree_hTree")){

    /**
     * 横向分类树
     */
    function _tree_hTree($arr,$pid=0){
        foreach($arr as $k => $v){
            if($v['pid']==$pid){
                $data[$v['id']]=$v;
                $data[$v['id']]['sub']=_tree_hTree($arr,$v['id']);
            }
        }
        return isset($data)?$data:array();
    }

}


if(!function_exists("_tree_sort")){

    /**
     * 分类排序（降序）
     */
    function _tree_sort($arr,$cols){
        //子分类排序
        foreach ($arr as $k => &$v) 
        {
            if(!empty($v['sub'])){
                $v['sub']=_tree_sort($v['sub'],$cols);
            }
            $sort[$k]=$v[$cols];
        }
        dd($arr);
        if(isset($sort))
            array_multisort($sort,SORT_ASC,$arr);
        return $arr;
    }

}

if(!function_exists("getSelectList")){

    function getSelectList($table , $pid = 0 ,&$result = [] , $spac = -4){
        $spac += 4;
        $list = DB::table($table)->where("pid",$pid)->get(['id','name','pid'])->toArray();     //传递条件数组
        foreach($list as $value){
            $value["name"] = str_repeat("&nbsp;",$spac).$value["name"];
            $result[] = $value;
            getSelectList($table , $value["id"] , $result , $spac);
        }
        return $result;
    }

}




if(!function_exists("genTree")){

    function genTree($items,$id='id',$pid='pid',$son = 'children'){
        $tree = array(); //格式化的树
        $tmpMap = array();  //临时扁平数据

        foreach ($items as $item) {
            $tmpMap[$item[$id]] = $item;
        }

        foreach ($items as $item) {
            if (isset($tmpMap[$item[$pid]])) {
                $tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
            } else {
                $tree[] = &$tmpMap[$item[$id]];
            }
        }
        unset($tmpMap);
        return $tree;
    }

}






