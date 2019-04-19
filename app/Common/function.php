<?php

/**
 * 对象转数组自定义方法
 * 苏鹏
 */
function arr($data)
{
    return json_decode(json_encode($data), true);
}
/**
 * 打印数组
 * 苏鹏
 */
function di($data)
{
    echo "<pre>";
    if(is_array($data))
    {
        print_r($data);
    }else{
        print_r(arr($data));
    }
    die;
}
/**
 * 将数据集转换成树
 * 苏鹏
 *
 * 将返回的数据集转换成树
 * @param  array   $list  数据集
 * @param  string  $pk    主键
 * @param  string  $pid   父节点名称
 * @param  string  $child 子节点名称
 * @param  integer $root  根节点ID
 * @return array          转换后的树
 */
function arr2($list, $pk = 'id', $boss = 'boss', $child = 'child', $root=0) {
    $tree = array();// 创建Tree
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }

        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$boss];
            if ($root == $parentId) {
                $tree[$data[$pk]] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 遍历左导航栏
 * 苏鹏
 */
function menu()
{
    $sql = "select * from action order by concat(path, id)";
    $menu = \Illuminate\Support\Facades\DB::select($sql);
    return $menu;
}



