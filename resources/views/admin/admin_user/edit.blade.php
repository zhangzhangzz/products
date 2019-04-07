@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/addadmin.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form class="layui-form form" action="{{ url('admin/admin_user/update/'.$list -> id)  }}" method="post">
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
                    <input type="text" name="account" value="{{ $list -> account }}" required lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error account">由8-16位数字、字母、下划线组成！</span>
                </div>

                <div class="layui-form-item new pwd">
                    <label class="layui-form-label">新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password" value="{{ old('password') }}" placeholder="请输入新密码" autocomplete="off" class="layui-input password innewpwd">
                    </div>
                </div>

                <div class="layui-form-item firstpwd">
                    <label class="layui-form-label">原密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="ypass" value="{{ old('ypass') }}"  placeholder="请输入原密码" autocomplete="off" class="layui-input password">
                    </div>
                </div>

                <div class="layui-form-item surepwd">
                    <label class="layui-form-label">确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="spass" value="{{ old('spass') }}" placeholder="请输入确认密码" autocomplete="off" class="layui-input surepwd">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">部门</label>
                    <div class="layui-input-inline">
                    <input type="text" name="partment" value="{{ $list -> partment }}" required lay-verify="required" placeholder="请输入部门" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error partment">数字、字母、下划线、汉字都可以</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">姓名</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="{{ $list -> name }}" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error name">汉字组成</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">角色</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="role_id" value="{{ $list -> role_name }}" lay-verify="required">
                        <option value="{{ $list -> role_id }}|{{ $list -> role_name }}">{{ $list -> role_name }}</option>
                    @foreach($role as $v)
                        @if($v -> id != $list -> role_id)
                            <option value="{{ $v -> id }}|{{ $v -> name }}">{{ $v -> name }}</option>
                        @endif
                    @endforeach
                    </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">登录权限</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="login" lay-verify="required">
                        @if($list -> login == 1)
                            <option value="{{ $list -> login }}">开启</option>
                            <option value="0">禁用</option>
                        @else
                            <option value="{{ $list -> login }}">禁用</option>
                            <option value="1">开启</option>
                        @endif
                        </option>
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

      
@endsection

@section('js')
    <script>
    //Demo
    layui.use('form', function(){
    var form = layui.form
        $= layui.jquery;

    $(".innewpwd").click(function (event) {
        event.stopPropagation();
        $(".firstpwd").css({display:"block"});
        $(".surepwd").css({display:"block"});
    })

    $(window).click(function(){
        if ($('.innewpwd').val()=="") {
            $(".firstpwd").css({display:"none"});
            $(".surepwd").css({display:"none"});
        }
    });

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
                url: '{{url("admin/admin_user/regular")}}',
                type: 'POST',
                dataType: 'JSON',
                data: {"_token":"{{csrf_token()}}" , "name":name , "data":data},
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
                        $(".getBtn").attr("class","layui-btn getBtn");
                    }
                }
            });
        });
    //监听提交
    form.on('submit(formDemo)', function(data){

    });


    });
    </script>
@endsection