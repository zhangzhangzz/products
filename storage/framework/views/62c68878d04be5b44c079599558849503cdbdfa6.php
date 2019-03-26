<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
    <!-- <link rel="stylesheet" href="./static/admin/layui/css/layui.css"> -->
    <link rel="stylesheet" href="<?php echo e(asset('static/admin/layui/css/layui.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="<?php echo e(asset('static/admin/layui/layui.js')); ?>"></script>
    <style>
        .errors{
            width: 100%;
            color:white;
            text-align: center;
            font-size: 15px;
            background-color: red;
            border: 1px solid red;
        }
    </style>
    <script>
        $(function () {
            $(".errors").fadeToggle(10000);
        });
    </script>
</head>
<?php echo $__env->yieldContent('css'); ?>
<body class="layui-layout-body">
<?php echo $__env->make("admin.template._header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make("admin.template._menu", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="layui-body">
    <!-- 内容主体区域 -->
    <div>

    <?php echo $__env->yieldContent('content'); ?>


    <!-- <iframe src="__HTML_ADMIN__/view/index/main1.html" frameborder="0"></iframe> -->
    </div>
</div>

</div>
<?php echo $__env->make("admin.template._footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
<?php echo $__env->yieldContent('js'); ?>
</html>
