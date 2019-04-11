@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/addadmin.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form class="layui-form form" action="{{ url('admin/admin_user/insert')  }}" method="post">
                {{ csrf_field()  }}
                @if(session('errors'))
                    <div class="errors">
                        <h3>警告</h3>
                        <br/>
                        {{ session('errors') }}
                        <br/>
                    </div>
                @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">账号</label>
                    <div class="layui-input-inline">
                    <input type="text" name="account" style="color: #555!important;" value="{{ old('account') }}" placeholder="请输入账号" autocomplete="off" class="layui-input" lay-verify="account">
                    </div>
                    <span class="error account" >由8-16位数字、字母、下划线组成！</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" style="color: #555!important;"  name="password" value="{{ old('password') }}" placeholder="请输入密码" autocomplete="off" class="layui-input password" lay-verify="password">
                    </div>
                    <span class="error password">由8-16位数字、字母、下划线组成！</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="spass" value="{{ old('spass') }}"  placeholder="请输入密码" autocomplete="off" class="layui-input surepwd" lay-verify="surepwd">
                    </div>
                    <span class="error spass">请确认密码</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">部门</label>
                    <div class="layui-input-inline">
                    <input type="text" name="partment" style="color: #555!important;"  value="{{ old('partment') }}"  placeholder="请输入部门" autocomplete="off" class="layui-input partment" lay-verify="partment">
                    </div>
                    <span class="error partment">数字、字母、下划线、汉字都可以</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">姓名</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="{{ old('name') }}"  placeholder="请输入姓名" autocomplete="off" class="layui-input name" lay-verify="name">
                    </div>
                    <span class="error name">汉字组成</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">角色</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="role_id" lay-verify="required">
                        @foreach ($list as $v)
                        <option value="{{ $v -> id  }}|{{ $v -> name  }}">{{ $v -> name  }}</option>
                         @endforeach
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
                    <button class="layui-btn layui-btn-disabled getBtn" lay-submit lay-filter="formDemo">立即提交</button>
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

        var aflag = false,nflag = false,psflag = false,spflag=false;
        $(".layui-input").change(function(){
            var item = $(this).attr("name");
            var value = $(this).val();
            var partment = $(".partment").val();
            var error = $($(this).parent()).next();
            if(item=="account"){
                var ret = /^[A-Za-z0-9_]{8,16}$/;
                aflag = ret.test(value);
                if(aflag){
                    $(error).css({color:"green"});
                    $(error).html("√可以使用");
                }else{
                    $(error).css({color:"red"});
                    $(error).html("由8-16位数字、字母、下划线组成！");
                }
            }
            if(item=="name"){
                var ret = /^[\u4E00-\u9FA5]+$/;
                nflag = ret.test(value);
                if(nflag){
                    $(error).css({color:"green"});
                    $(error).html("√可以使用");
                }else{
                    $(error).css({color:"red"});
                    $(error).html("汉字组成");
                }
            }
            if(item=="password"){
                var ret = /^[A-Za-z0-9_]{8,16}$/;
                psflag = ret.test(value);
                if(psflag){
                    $(error).css({color:"green"});
                    $(error).html("√可以使用");
                }else{
                    $(error).css({color:"red"});
                    $(error).html("由8-16位数字、字母、下划线组成！");
                }
            }

            if(item=="spass"){
                if(value!=$(".password").val()){
                    $(error).css({color:"red"});
                    $(error).html("两次密码不一致");
                }else if(value==""){
                    $(error).css({color:"red"});
                    $(error).html("请确认密码");
                }else{
                    $(error).css({color:"green"});
                    $(error).html("√密码一致");
                    spflag = true;
                }
            }

            if(item=="partment"){
                if(value=""){
                    $(error).css({color:"red"});
                    $(error).html("请输入部门");
                }else{
                    $(error).html("");
                }
            }

            if(aflag && nflag && psflag && spflag && partment!=""){
                $(".getBtn").attr("class","layui-btn getBtn");
            }else{
                $(".getBtn").attr("class","layui-btn layui-btn-disabled getBtn");
            }
        });


        form.verify({
            name: function(value, item){ //value：表单的值、item：表单的DOM对象
            var ret = /^[\u4E00-\u9FA5]+$/;
                if(!ret.test(value)){
                    return '请使用汉字';
                }
            }
            ,account:function(value,item){
                var ret = /^[A-Za-z0-9_]{8,16}$/;
                if(!ret.test(value)){
                    return "由8-16位数字、字母、下划线组成！";
                }
            }
            ,password:function(value,item){
                var ret = /^[A-Za-z0-9_]{8,16}$/;
                if(!ret.test(value)){
                    return "由8-16位数字、字母、下划线组成！";
                } 
            }
            ,surepwd:function(value,item){
                var pass = $(".password").val();
                if(value==""){
                    return "请确认密码";
                }else if(value!= pass){
                    return "两次密码不一致";
                }
            }
            ,partment:function(value,item){
                if(value==""){
                    return "请输入部门";
                }
            }
        });     

        
    //监听提交
    form.on('submit(formDemo)', function(data){
        if($(".getBtn").hasClass("layui-btn-disabled")){
            return false;
        }
    });


    });
    </script>
@endsection