@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/nutrition.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                <button class="layui-btn addUser" onclick="addRole();">添加新营养搭配</button>
            </div>
            <div>
                <div class="pBox">
                    <div>《营养搭配01》</div>
                    <div>
                        <button class="layui-btn layui-btn-sm">编辑</button>
                        <button class="layui-btn layui-btn-danger layui-btn-sm">删除</button>
                    </div>
                </div>
                <div class="pBox">
                    <div>《营养搭配02》</div>
                    <div>
                        <button class="layui-btn edit layui-btn-sm">编辑</button>
                        <button class="layui-btn layui-btn-danger del layui-btn-sm">删除</button>
                    </div>
                </div>
            </div> 
        </div>      
      
@endsection

@section('js')
 <script>

     function addRole(){
         window.location.href="/admin/marketing/nutrition_save";
     }


     layui.use('layer', function(){
        var layer = layui.layer
        ,$ = layui.$;


        $(".edit").click(function(){
            window.location.href="/admin/marketing/nutrition_edit";
        });

        $(".del").click(function(){
            layer.confirm('确定要删除此营养搭配方案吗', {
                btn: ['确定', '取消'] //可以无限个按钮
                }, function(index, layero){
                    console.log("sure");
                }, function(index){
                    console.log("cancle");
            });
        });
        
        
    });

   

    
 </script>
@endsection