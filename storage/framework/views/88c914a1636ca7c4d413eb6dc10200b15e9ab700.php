<link rel="stylesheet" href="<?php echo e(asset('css/addadmin.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form class="layui-form form" action="<?php echo e(url('admin/admin_user/insert')); ?>" method="post">
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
                    <label class="layui-form-label">账号</label>
                    <div class="layui-input-inline">
                    <input type="text" name="account" style="color: #555!important;" value="<?php echo e(old('account')); ?>" required lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error account" >由8-16位数字、字母、下划线组成！</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" style="color: #555!important;"  name="password" value="<?php echo e(old('password')); ?>" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input password">
                    </div>
                    <span class="error password">由8-16位数字、字母、下划线组成！</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="spass" value="<?php echo e(old('spass')); ?>" required lay-verify="surepwd" placeholder="请输入密码" autocomplete="off" class="layui-input surepwd">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">部门</label>
                    <div class="layui-input-inline">
                    <input type="text" name="partment" style="color: #555!important;"  value="<?php echo e(old('partment')); ?>" required lay-verify="required" placeholder="请输入部门" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error partment">数字、字母、下划线、汉字都可以</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">姓名</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error name">汉字组成</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">角色</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="role_id" lay-verify="required">
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($v -> id); ?>|<?php echo e($v -> name); ?>"><?php echo e($v -> name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">登录权限</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="login" lay-verify="required">
                        <option value="1">开启</option>
                        <option value="0">禁用</option>
                    </select>
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <div class="layui-input-block">
                    <button class="layui-btn getBtn" lay-submit lay-filter="formDemo">立即提交</button>
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
    var form = layui.form
        $= layui.jquery;

    form.verify({
        spass: function(value, item){ //value：表单的值、item：表单的DOM对象
            var pwd = $(".password").val();
            if(value!= pwd){
                return '两次输入密码不一致，请重新输入';
            }
        }
        });
        $("input").blur(function(){
            var name = $(this).prop("name");
            var data = $(this).val();
            $.ajax({
                url: '<?php echo e(url("admin/admin_user/regular")); ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {"_token":"<?php echo e(csrf_token()); ?>" , "name":name , "data":data},
                success: function (data)
                {

                    if(data)
                    {
                        $("."+name).css("color","red");
                        $("."+name).html(data);
                        $(".getBtn").attr("class","layui-btn layui-btn-disabled getBtn");
                    }else{
                        $("."+name).css("color","green");
                        $("."+name).html("√可以使用");
                        var actext = $(".account").css("color");
                        var pstext = $(".password").css("color");
                        var patext = $(".partment").css("color");
                        var ntext = $(".name").css("color");
                        console.log(actext+"-"+pstext+"-"+patext+"-"+ntext);
                        if(actext=="green" || pstext=="green" || patext=="green" || ntext=="green"){
                            console.log("111111");
                            $(".getBtn").attr("class","layui-btn getBtn");
                        }

                    }
                }
            });
        });
    //监听提交
    form.on('submit(formDemo)', function(data){
        if($(".getBtn").hasClass("layui-btn-disabled")){
            return false;
        }
    });


    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>