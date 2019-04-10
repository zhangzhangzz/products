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
                    <input type="text" name="account" value="{{ $list -> account }}"  placeholder="请输入账号" autocomplete="off" class="layui-input account">
                    </div>
                    <span class="error erac">由8-16位数字、字母、下划线组成！</span>
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
                    <input type="text" name="partment" value="{{ $list -> partment }}"  placeholder="请输入部门" autocomplete="off" class="layui-input partment">
                    </div>
                    <span class="error erpa">数字、字母、下划线、汉字都可以</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">姓名</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="{{ $list -> name }}" placeholder="请输入姓名" autocomplete="off" class="layui-input name">
                    </div>
                    <span class="error erna">汉字组成</span>
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
    
    $(function () {
        var account = $(".account").val();
        var partment = $(".partment").val();
        var name = $(".name").val();
        if(!(/^[A-Za-z0-9_]{8,16}$/.test(account))){
            $(".erac").css({color:"red"});
            $(".erac").html("由8-16位数字、字母、下划线组成！");
        }
        if(!(/^[\u4E00-\u9FA5]+$/.test(name))){
            $(".erna").css({color:"red"});
            $(".erna").html("必须由汉字组成！");
        }
        if(partment==""){
            $(".erpa").css({color:"red"});
            $(".erpa").html("请填写部门！");
        }
    })

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

//    form.verify({
//        spass: function(value, item){ //value：表单的值、item：表单的DOM对象
//            var pwd = $(".password").val();
//            if(value!= pwd){
//                return '两次输入密码不一致，请重新输入';
//            }
//        }
//        });

        var aflag = false,nflag = false;
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

            var name = $(".name").val();
            if(/^[\u4E00-\u9FA5]+$/.test(name)){
                nflag = true;
            }


            if(item=="partment"){
                if(value=""){
                    $(error).css({color:"red"});
                    $(error).html("请输入部门");
                }else{
                    $(error).html("");
                }
            }
            if(aflag && nflag && partment!=""){
                $(".getBtn").attr("class","layui-btn getBtn");
            }else{
                $(".getBtn").attr("class","layui-btn layui-btn-disabled getBtn");
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