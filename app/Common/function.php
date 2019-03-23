<?php
// 对象转数组自定义方法
function arr($data)
{
    return json_decode(json_encode($data), true);
}
