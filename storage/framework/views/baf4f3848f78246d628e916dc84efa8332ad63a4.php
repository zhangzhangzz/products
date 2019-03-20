<link rel="stylesheet" href="<?php echo e(asset('css/addrole.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">

　　<script src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div class="bigbox">

            <div class="input-group">
                <div class="warn">*</div>
                <span class="input-group-addon">账&emsp;&emsp;号：</span>
                <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">店铺名称：</span>
                <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group">
                <div class="warn">*</div>
                <span class="input-group-addon" id="basic-addon1">部&emsp;&emsp;门：</span>
                <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group">
                <div class="warn">*</div>
                <span class="input-group-addon" id="basic-addon1">姓&emsp;&emsp;名：</span>
                <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group">
                <div class="warn">*</div>
                <span class="input-group-addon" id="basic-addon1">密&emsp;&emsp;码：</span>
                <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group">
                <div class="warn">*</div>
                <span class="input-group-addon" id="basic-addon1">确认密码：</span>
                <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group">
                <div class="warn">*</div>
                <span class="input-group-addon" id="basic-addon1">角&emsp;&emsp;色：</span>
                <select class="addRole" style="height:30px;margin:4px 0;">
                    <option value ="1">1</option>
                    <option value ="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="input-group">
                <div class="warn">*</div>
                <span class="input-group-addon" id="basic-addon1">登录权限：</span>
                <select class="addRoot" style="height:30px;margin:4px 0;">
                    <option value ="1">启用</option>
                    <option value ="0">禁用</option>
                </select>
            </div>

            <div class="btnBox">
                <button type="button" class="btn btn-info pl">提交</button>
                <button type="button" class="btn btn-default pr">重置</button>
            </div>
           

        </div>
    </div>
<?php $__env->stopSection(); ?>
   

<?php $__env->startSection('js'); ?>
    <script>
        layui.use('form', function(id=""){
            var form = layui.form;
        });
    
    </script>
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>