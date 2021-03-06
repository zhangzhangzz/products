<link rel="stylesheet" href="<?php echo e(asset('css/goodsclassify.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
<?php $__env->startSection('content'); ?>
    <?php echo e(session('message')); ?>

    <div class="main">
        <button class="layui-btn add" lay-submit lay-filter="formDemo" style="margin:30px;" >添加</button>
        <div class="layui-form form">
            <table class="layui-table" lay-data="{ page:true, id:'test'}" lay-filter="test">
                <thead>
                    <tr>
                    <th lay-data="{field:'img' , align : 'center'}">图片</th>
                    <th lay-data="{field:'classify' , align : 'center'}">分类名称</th>
                    <th lay-data="{field:'parent' , align : 'center'}">父级ID</th>
                    <th lay-data="{field:'px' , sort: true , align : 'center'}">排序</th>
                    <th lay-data="{field:'action' , align : 'center'}">操作</th>
                    </tr>
                </thead>
            </table>

            <div>
                <ul>
                    <?php $__currentLoopData = $category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="">
                        <div class="parentBox" >
                            <div class="pbFirst">

                                <div><?php if(!empty($value["images"])): ?><img src="<?php echo e(ImagesOssUrl); ?>/<?php echo e(($value['images'])); ?>" alt=""><?php endif; ?></div>

                                <div><?php echo e($value['name']); ?></div>
                                <div><?php echo e($value['pid']); ?></div>
                                <div><?php echo e($value['sort_number']); ?></div>
                            </div>

                            <div class="action" data-value="<?php echo e($value["id"]); ?>">操作</div>
                        </div>
                        <div class="listdd">
                            <?php if(!empty($value['children'])): ?>
                            <?php $__currentLoopData = $value['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <dd >
                                <div><?php if(!empty($val["images"])): ?><img src="<?php echo e(ImagesOssUrl); ?>/<?php echo e($val["images"]); ?>" alt=""><?php endif; ?></div>
                                <div><?php echo e($val['name']); ?></div>
                                <div><?php echo e($val['pid']); ?></div>
                                <div><?php echo e($val['sort_number']); ?></div>
                                <div class="action" data-value="<?php echo e($val["id"]); ?>">操作</div>
                            </dd>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="page">
                <?php echo e($category_list->links()); ?>

            </div>

        </div>
        
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    layui.use('table', function(){
        var table = layui.table
        ,laytpl = layui.laytpl
              $ = layui.$;
  
        //直接解析字符
        laytpl('{{ d.name }}').render({
            name: `<a class="layui-btn layui-btn-xs edit" lay-event="edit" >编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs del" lay-event="del">删除</a>`
        }, function(string){
            $(".action").html(string);
        });

        $(".edit").click(function () {
            var id =$( $(this).parent()).data("value");
            console.log(id);
            window.location.href = '/admin/category/edit/'+id;
        });

        $(".del").click(function () {
            var id =$( $(this).parent()).data("value");
            console.log(id);
            $.ajax({
                url:"<?php echo e(url('admin/category/del')); ?>",
                type:"POST",
                dataType:"json",
                data:{
                    "_token":"<?php echo e(csrf_token()); ?>",
                    "id":id,
                },
                success:function (data) {
                    if(data.status == 1){
                        layer.msg("删除成功",{icon:1},function () {
                            window.location.href = "<?php echo e(url('admin/category/index')); ?>"
                        });
                    }
                    if(data.status == 2){
                        layer.msg("删除失败",{icon:2},function () {
                            window.location.href = "<?php echo e(url('admin/category/index')); ?>"
                        });
                    }
                    if(data.status == 3){
                        layer.msg("请删除子分类",{icon:2},function () {
                            window.location.href = "<?php echo e(url('admin/category/index')); ?>"
                        });
                    }
                }
            })
        });



        $(".pbFirst").click(function(){
            console.log("dddd");
            var listdd = $($(this).parent()).next(".listdd");
            let flag = true;
            listdd.slideToggle();
            
        });

        $(".add").click(function(){
            window.location.href="/admin/category/add";
        });


    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>