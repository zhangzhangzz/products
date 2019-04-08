<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so we do not have to manually load any of
| our application's PHP classes. It just feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

//公共方法函数
require __DIR__ . '/../app/Helps/function.php';

require __DIR__ .'/../bootstrap/aliyun_oss/autoload.php';
define("accessKeyId","LTAIRsBKJalHvCyq");
define("accessKeySecret","RcWiY3ovlLuA1SqXsvCWWlUmjqOGpD");
define("endpoint","http://oss-cn-zhangjiakou.aliyuncs.com");
define("bucket","yizhangou");
define("ImagesOssUrl","http://yizhangou.oss-cn-zhangjiakou.aliyuncs.com/uploads");