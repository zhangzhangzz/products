<link rel="stylesheet" href="<?php echo e(asset('css/adduser.css')); ?>">
<?php $__env->startSection('content'); ?>
<div class="main" > 
            <div class="tree">
                <img src="<?php echo e(asset('image/1.jpg')); ?>" alt=""> 
            </div>
            
            <form class="layui-form layui-form-pane fmain" action="">
                
                <div class="layui-form-item">
                    <label class="layui-form-label iBox">用户名：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input username">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label iBox">真实姓名：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="realname" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input realname">
                    </div>
                </div>
            
                <div class="layui-form-item">
                    <label class="layui-form-label iBox">输入密码：</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input pwd1">
                    </div>
                    <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label iBox">确认密码：</label>
                    <div class="layui-input-inline">
                    <input type="password" name="password" placeholder="请输入密码" lay-verify="pass2" autocomplete="off" class="layui-input pwd2">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label iBox">联系电话：</label>
                    <div class="layui-input-inline ">
                        <input type="tel" name="phone" lay-verify="required|phone" autocomplete="off" class="layui-input mobile">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label iBox">权限</label>
                    <div class="layui-input-block rootList">
                        <select name="interest" lay-filter="aihao" id="right">
                            <option value=""></option>
                            <option value="0">管理员</option>
                            <option value="1" selected="">开启</option>
                            <option value="2">关闭</option>
                        </select>
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <button class="layui-btn adduser" lay-submit="" lay-filter="formDemo" style="width:300px;border-radius:5px;">跳转式提交</button>
                </div>
            </form>

            

        <!-- <iframe src="__HTML_ADMIN__/view/index/main1.html" frameborder="0"></iframe> -->
        </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    layui.use(['form'], function(){
        var form = layui.form,
         $ = layui.$ //重点处
        ,layer = layui.layer;
        
        //自定义验证规则
        form.verify({
            title: function(value){
            if(value.length < 5){
                return '标题至少得5个字符啊';
            }
            }
            ,pass: [
            /^[\S]{6,12}$/
            ,'密码必须6到12位，且不能出现空格'
            ]
            ,pass2:function(value){
                var pwd1 = $(".pwd1").val();
                if(value!=pwd1){
                    return '两次密码不一致，请重新输入';
                }
            }
            
        });
               
        
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>