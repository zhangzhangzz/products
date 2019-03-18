<!DOCTYPE html>

<html>
    <?php echo $__env->make("admin.template._meta", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/adduser.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<body class="layui-layout-body">
    <?php echo $__env->make("admin.template._header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make("admin.template._menu", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="layui-body">
        <!-- 内容主体区域 -->
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
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © layui.com - 底部固定区域
    </div>
</div>
    <?php echo $__env->make("admin.template._footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
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
            var uname = $(".username").val();
            var realname = $(".realname").val();
            var pwd = $(".pwd1").val();
            var mobile = $(".mobile").val();
            var right = $("#right").val();
            // console.log(uname+"--"+realname+"--"+pwd+"--"+mobile+"--"+right);
            // return false;
            //BUG???
            $.post("",{
                uname:uname,
                realname:realname,
                pwd:pwd,
                mobile:mobile,
                right:right
            },function(data){

            });
        });
        
        
    
    });
    
   
</script>
</html>
