@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/menuedit.css') }}">
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form id="formmy" class="layui-form" action="{{url('admin/menu/update/'.$list -> id)}}" method="post" lay-filter="example">
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
                    <label class="layui-form-label">菜单名称</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="{{ $list -> name  }}" placeholder="请输入菜单名称" autocomplete="off" class="layui-input name" lay-verify="name">
                    </div>
                    <span class="error name">请填写汉字</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">URL</label>
                    <div class="layui-input-inline">
                    <input type="text" name="url" value="{{ $list -> url  }}" placeholder="请输入URL" autocomplete="off" class="layui-input url" lay-verify="url">
                    </div>
                    <span class="error urlerr"></span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">上级名称</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="boss"  value="{{ $list -> boss  }}"  lay-filter="filter" class="boss">
                        <option value="0">/</option>
                        @foreach ($data as $v)
                            <?php $nbsp = str_repeat("&nbsp;", substr_count($v -> path, ",")*5); ?>
                       <option value="{{ $v -> id }}">{{$nbsp}}|--{{ $v -> name }}</option>
                        @endforeach
                    </select>
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
        $ = layui.$;

        $(function () {
            var name = $(".name").val();
            var boss = $(".boss").val();
            var url = $(".url").val();
            if(/^[\u4E00-\u9FA5]+$/.test(name) && boss==0 || /^[\u4E00-\u9FA5]+$/.test(name) && boss!=0 && url!=""){
                $(".getBtn").attr("class","layui-btn getBtn");
            }else{
                $(".getBtn").attr("class","layui-btn layui-btn-disabled getBtn");
            }
        });

        form.val("example",{
            "state":{{ $list -> state  }},
            "boss":{{ $list -> boss  }}
        });
        
        //监听提交
        form.on('submit(formDemo)', function(data){
    //        layer.msg(JSON.stringify(data.field));
    //        return false;
            var boss = $(".boss").val();
            var url = $(".url").val();
            var ret = /^[\u4E00-\u9FA5]+$/.test(name);
<<<<<<< HEAD
            if(boss!=0 && url=="" || !ret){
=======
            console.log(!ret);
            if(boss!=0 && url=="" || ret){
>>>>>>> 69fbb80c0d6d5ababe6c8c3af23a368ca11c768b
                $(".getBtn").attr("class","layui-btn layui-btn-disabled getBtn");
                return false;
            }
            $("#formmy").submit();
        });


        var nflag = false,uflag=false;
        $(".layui-input").change(function(){
            var item = $(this).attr("name");
            var value = $(this).val();
            var error = $($(this).parent()).next();
            var boss = $(".boss").val();
            var name = $(".name").val();
            var url = $(".url").val();
            if(item=="name"){
                var ret = /^[\u4E00-\u9FA5]+$/;
                nflag = ret.test(value);
                if(nflag){
                    $(error).css({color:"green"});
                    $(error).html("√可以使用");
                }else{
                    $(error).css({color:"red"});
                    $(error).html("请填写汉字");
                }
            }
            if(item=="url" && value=="" && boss!=0){
                $(error).css({color:"red"});
                $(error).html("请填写");
            }else if(item=="url" && value!="" && boss!=0 || item=="url" && value=="" && boss==0 || item=="url" && value!="" && boss==0){
                $(error).html("");
                uflag = true;
            }

            if(/^[\u4E00-\u9FA5]+$/.test(name)){
                nflag = true;
            }

            if(boss==0 && url=="" || boss!=0 && url!="" || boss==0 && url!=""){
                uflag = true;
            }

            if(nflag && uflag){
                $(".getBtn").attr("class","layui-btn getBtn");
            }else{
                $(".getBtn").attr("class","layui-btn layui-btn-disabled getBtn");
            }


        });

            form.on('select(filter)', function(data){
                var error = $(".urlerr");
                var name = $(".name").val();
                var url = $(".url").val();
                if(/^[\u4E00-\u9FA5]+$/.test(name)){
                    nflag = true;
                }
                if(data.value!=0 && url ==""){
                    $(error).css({color:"red"});
                    $(error).html("请填写");
                }else{
                    $(error).html("");
                    uflag = true;
                }

                if(nflag && uflag){
                    $(".getBtn").attr("class","layui-btn getBtn");
                }else{
                    $(".getBtn").attr("class","layui-btn layui-btn-disabled getBtn");
                }
            });

            form.verify({
                name:[
                    /^[\u4E00-\u9FA5]+$/
                    ,'请使用汉字'
                ] 
                ,url:function(value,item){
                    var boss = $(".boss").val();
                    if(boss!=0 && value==""){
                        return "URL不能为空";
                    }
                }
            });



    });







    </script>
@endsection