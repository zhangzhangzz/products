<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 9:06
 */

if(!function_exists("ajax_success")){

    function ajax_success($msg = '提交成功',$data=array()){
        $return = array('status'=>'1');
        $return['info'] = $msg;
        $return['data'] = $data;
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

}




