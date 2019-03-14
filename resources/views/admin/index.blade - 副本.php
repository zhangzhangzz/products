<!DOCTYPE html>

<html>
    @include("admin.template._meta")
    <link rel="stylesheet" href="{{ asset('css/adduser.css') }}">
<body class="layui-layout-body">
    @include("admin.template._header")

    @include("admin.template._menu")

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div class="main" > 
            <div class="tree">
                <img src="{{ asset('image/1.jpg') }}" alt=""> 
            </div>
            
            <form class="layui-form layui-form-pane fmain" action="">
                
                <div class="layui-form-item">
                    <label class="layui-form-label iBox">用户名：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label iBox">真实姓名：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
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
                    <input type="password" name="password" placeholder="请输入密码" lay-verify="pass2" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label iBox">联系电话：</label>
                    <div class="layui-input-inline ">
                        <input type="tel" name="phone" lay-verify="required|phone" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label iBox">权限</label>
                    <div class="layui-input-block rootList">
                        <select name="interest" lay-filter="aihao">
                            <option value=""></option>
                            <option value="0">管理员</option>
                            <option value="1" selected="">开启</option>
                            <option value="2">关闭</option>
                        </select>
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <button class="layui-btn" lay-submit="" lay-filter="demo1" style="width:300px;border-radius:5px;">跳转式提交</button>
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
    @include("admin.template._footer")
</body>
<script>

    


    layui.use(['form', 'layedit', 'laydate'], function(){
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
            ,content: function(value){
            layedit.sync(editIndex);
            }
        });
        
        //监听指定开关
        form.on('switch(switchTest)', function(data){
            layer.msg('开关checked：'+ (this.checked ? 'true' : 'false'), {
            offset: '6px'
            });
            layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
        });
        
        //监听提交
        form.on('submit(demo1)', function(data){
            layer.alert(JSON.stringify(data.field), {
            title: '最终的提交信息'
            })
            return false;
        });
        
        //表单初始赋值
        form.val('example', {
            "username": "贤心" // "name": "value"
            ,"password": "123456"
            ,"interest": 1
            ,"like[write]": true //复选框选中状态
            ,"close": true //开关状态
            ,"sex": "女"
            ,"desc": "我爱 layui"
        });

        $(function(){
            
        });
    
    });
    
   
</script>
</html>
