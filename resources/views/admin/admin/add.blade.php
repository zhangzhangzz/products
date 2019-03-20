@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/addadmin.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form class="layui-form form" action="" > 
                <div class="layui-form-item">
                    <label class="layui-form-label">账号</label>
                    <div class="layui-input-inline">
                    <input type="text" name="account" required lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">店铺名称</label>
                    <div class="layui-input-inline">
                    <input type="text" name="storeName" required lay-verify="required" placeholder="请输入店铺名称" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">部门</label>
                    <div class="layui-input-inline">
                    <input type="text" name="partment" required lay-verify="required" placeholder="请输入部门" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">姓名</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                    <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input password">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">确认密码</label>
                    <div class="layui-input-inline">
                    <input type="password" name="surepwd" required lay-verify="surepwd" placeholder="请输入密码" autocomplete="off" class="layui-input surepwd">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">角色</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="role" lay-verify="required">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">登录权限</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="access" lay-verify="required">
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

        

        

   

    
    
      
@endsection

@section('js')
    <script>
    //Demo
    layui.use('form', function(){
    var form = layui.form
        $= layui.jquery;

    form.verify({
        surepwd: function(value, item){ //value：表单的值、item：表单的DOM对象
            var pwd = $(".password").val();
            if(value!= pwd){
                return '两次输入密码不一致，请重新输入';
            }
        }
        });  
    
    //监听提交
    form.on('submit(formDemo)', function(data){
        layer.msg(JSON.stringify(data.field));
        console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
        console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
        console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
        
        return false;
    });


    });
    </script>
@endsection