@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/menuedit.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单名称</label>
                    <div class="layui-input-inline">
                    <input type="text" name="text" required lay-verify="required" placeholder="请输入菜单名称" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">URL</label>
                    <div class="layui-input-inline">
                    <input type="text" name="text" required lay-verify="required" placeholder="请输入URL" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">上级名称</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="city" lay-verify="required">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-inline">
                    <input type="text" name="text" required lay-verify="required" placeholder="请输入上级名称" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="city" lay-verify="required">
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
    var form = layui.form;
    
    //监听提交
    form.on('submit(formDemo)', function(data){
        layer.msg(JSON.stringify(data.field));
        return false;
    });
    });
    </script>
@endsection