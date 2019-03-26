<link rel="stylesheet" href="<?php echo e(asset('css/menuedit.css')); ?>">
<script src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"></script>
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form id="formmy" class="layui-form" action="<?php echo e(url('admin/menu/update/'.$list -> id)); ?>" method="post" lay-filter="example">
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
                    <input type="text" name="name" value="<?php echo e($list -> name); ?>" required lay-verify="required" placeholder="请输入菜单名称" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">URL</label>
                    <div class="layui-input-inline">
                    <input type="text" name="url" value="<?php echo e($list -> url); ?>" placeholder="请输入URL" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">上级名称</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="boss"  value="<?php echo e($list -> boss); ?>" lay-verify="required">
                        <option value="0">/</option>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $nbsp = str_repeat("&nbsp;", substr_count($v -> path, ",")*5); ?>
                       <option value="<?php echo e($v -> id); ?>"><?php echo e($nbsp); ?>|--<?php echo e($v -> name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-inline">
                    <input type="text" name="sort" value="<?php echo e($list -> sort); ?>" placeholder="请输入上级名称" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="state"  lay-verify="required">
                        <option value="0">禁用</option>
                        <option value="1">开启</option>
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

    form.val("example",{
        "state":<?php echo e($list -> state); ?>,
        "boss":<?php echo e($list -> boss); ?>

    });
    
    //监听提交
    form.on('submit(formDemo)', function(data){
//        layer.msg(JSON.stringify(data.field));
//        return false;
        $("#formmy").submit();
    });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>