@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/action.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                    <button class="layui-btn addUser" onclick="addRole();">添加</button>
                </div>
                <div class="topBox">
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">店铺名称 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="account" lay-verify="required" required  placeholder="" autocomplete="off" class="layui-input account">
                        </div>
                    </div>
        
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">手机号 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="phone" lay-verify="required" required placeholder="" autocomplete="off" class="layui-input phone">
                        </div>
                    </div>
                    <button class="layui-btn layui-btn-sm selectBtn" style="margin:20px 30px;" lay-filter="formDemo">查询</button>                    
                </div>

                <table id="demo" lay-filter="test"></table>

        </div>  

        

        

        <script type="text/html" id="titleTpl">
            @{{#  if(d.login ==1 ){ }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                    <input type="checkbox" checked lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                    </div>
                </div>
            @{{#  } else { }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                    <input type="checkbox" lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                    </div>
                </div>
            @{{#  } }}
        </script>


    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

   

    
    
      
@endsection

@section('js')
 <script>

     function addRole(){
         window.location.href="/admin/admin/add"; 
     }


     layui.use(['table','form'], function(id=""){
        var table = layui.table
        ,form = layui.form
        ,$ = layui.$;

        // #登录权限事件
        
        form.on('switch(filter)', function(data){
            var flag = data.elem.checked;
            var id = $(data.elem).data("id");
                console.log(data.elem.checked); //开关是否开启，true或者false
                console.log(data.elem); //得到checkbox原始DOM对象
                console.log($(data.elem).data("id"));
                if(flag){
                    var btnTag = 1;
                }else{
                    var btnTag = 0;
                }
                
                

            }); 

            var data = [
            {id:1,account:88888888,shopName:'桂香私厨',name:'香香1',partment:'入驻商',role:'管理员',creatdate:'2019-01-01',login:1,action:'-'},
            {id:2,account:88888888,shopName:'桂香私厨',name:'香香2',partment:'入驻商',role:'管理员',creatdate:'2019-01-01',login:0,action:'-'}
                ];


            table.render({
                    elem: '#demo'
                    ,limit:999999
                    ,width:1120
                    ,cols: [[ //表头
                        {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left' , align:'center'}
                        ,{field: 'account', title: '账号' , width:150 , align:'center'}
                        ,{field: 'shopName', title: '店铺名称' , width:150 , align:'center'}
                        ,{field: 'name', title: '姓名', width:100 , align:'center'}
                        ,{field: 'partment', title: '部门', width: 100 , align:'center'}
                        ,{field: 'role', title: '角色', width: 80 , align:'center'}
                        ,{field: 'creatdate', title: '创建时间', width: 140, sort: true , align:'center'}
                        ,{field: 'login', title: '登录权限', width: 130 , align:'center' , templet: '#titleTpl'}
                        ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
                    ]]
                    ,data:data
                });


                $(".selectBtn").click(function(){
                    var account = $(".account").val();
                    var phone = $(".phone").val();
                    if(account=="" && phone==""){
                        layer.msg('请至少输入一个查询条件');
                        return false; 
                    }

                    var data = [
                        {id:1,account:11111111,shopName:'222222',name:'香香3',partment:'入驻商',role:'管理员',creatdate:'2019-01-01',login:0,action:'-'},
                        {id:2,account:11111111,shopName:'333333',name:'香香4',partment:'入驻商',role:'管理员',creatdate:'2019-01-01',login:0,action:'-'}
                            ];


                    table.render({
                        elem: '#demo'
                        ,limit:999999
                        ,width:1120
                        ,cols: [[ //表头
                            {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left' , align:'center'}
                            ,{field: 'account', title: '账号' , width:150 , align:'center'}
                            ,{field: 'shopName', title: '店铺名称' , width:150 , align:'center'}
                            ,{field: 'name', title: '姓名', width:100 , align:'center'}
                            ,{field: 'partment', title: '部门', width: 100 , align:'center'}
                            ,{field: 'role', title: '角色', width: 80 , align:'center'}
                            ,{field: 'creatdate', title: '创建时间', width: 140, sort: true , align:'center'}
                            ,{field: 'login', title: '登录权限', width: 130 , align:'center' , templet: '#titleTpl'}
                            ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
                        ]]
                        ,data:data
                    });
                });

                $.ajax({
                    url: '{{url("admin/admin/index")}}',
                    type: 'POST',
                    dataType: 'JSON',
                    data:{"_token":"{{csrf_token()}}"},
                    success:function (data) {
                        var data = data.data;
                        console.log(data);
                        //第一个实例
                        

                },
                error:function (data) {
                    console.log("错误")
                }
            })

        



        
        
        // #table操作事件
        table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            let tdata = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象
            console.log(tdata);
            da = obj.data;
            if(layEvent === 'del'){ //删除
                layer.confirm('真的删除行么', function(index){
                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                    layer.close(index);
                    //向服务端发送删除指令
                    console.log("删除");
               
                });
            }else if(layEvent === 'edit'){
                window.location.href="/admin/admin/add"; 
            }
        });
        
    });

   

    
 </script>
@endsection