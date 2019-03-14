<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
    <!-- <link rel="stylesheet" href="./static/admin/layui/css/layui.css"> -->
    <link rel="stylesheet" href="<?php echo e(asset('static/admin/layui/css/layui.css')); ?>">
    <script src="<?php echo e(asset('static/admin/layui/layui.js')); ?>"></script>
</head>
<body class="layui-layout-body">
<?php echo $__env->make("template._header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make("template._menu", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">

    <?php echo $__env->yieldContent('content'); ?>


    <!-- <iframe src="__HTML_ADMIN__/view/index/main1.html" frameborder="0"></iframe> -->
    </div>
</div>

<div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
</div>
</div>
<?php echo $__env->make("template._footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
