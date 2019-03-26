<link rel="stylesheet" href="<?php echo e(asset('css/menuedit.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form id="formmy" class="layui-form" action="<?php echo e(url('admin/menu/insert')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <?php if(session('errors')): ?>
                    <div class="errors">
                        <h3>警告</h3>
                        <br/>
                        <?php echo e(session('errors')); ?>

                        <br/>
                    </div>
                <?php endif; ?>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单名称</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required lay-verify="required" placeholder="请输入菜单名称" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error name">请填写汉子</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">URL</label>
                    <div class="layui-input-inline">
                    <input type="text" name="url" value="<?php echo e(old('url')); ?>" placeholder="请输入URL" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">上级名称</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="boss" lay-verify="required">
                        <option value="0">/</option>
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $nbsp = str_repeat("&nbsp;", substr_count($v -> path, ",")*5);
                            ?>
                            <option value="<?php echo e($v -> id); ?>"><?php echo e($nbsp); ?>|--<?php echo e($v -> name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-inline">
                    <input type="text" name="sort" value="<?php echo e(old('sort')); ?>" placeholder="请输入上级名称" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error sort">请填写数字</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="state" lay-verify="required">
                        <option value="1">开启</option>
                        <option value="0">禁用</option>
                    </select>
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
 


        </div>
                

    </div>  

        

        

   

    
    
      
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
    //Demo
    layui.use('form', function(){
    var form = layui.form;
    
    //监听提交
    form.on('submit(formDemo)', function(data){
//        layer.msg(JSON.stringify(data.field));
//        return false;
        $("#formmy").submit();
    });
    });
    $("input").blur(function(){
        var name = $(this).prop("name");
        var data = $(this).val();
        $.ajax({
            url: '<?php echo e(url("admin/menu/regular")); ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {"_token":"<?php echo e(csrf_token()); ?>" , "name":name , "data":data},
            success: function (data)
            {

                if(data)
                {
                    $("."+name).css("color","red");
                    $("."+name).html(data);
                }else{
                    $("."+name).css("color","green");
                    $("."+name).html("√可以使用");
                }
            }
        });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>