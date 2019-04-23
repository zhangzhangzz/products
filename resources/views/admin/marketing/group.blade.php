@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/action.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                    <button class="layui-btn addUser" onclick="addRole();">添加拼团商品</button>
                </div>
                <div class="topBox">
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">产品名称或ID ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="shopname" lay-verify="required" required  placeholder="" autocomplete="off" class="layui-input account">
                        </div>
                    </div>
        
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">店铺名称 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="phone" lay-verify="required" required placeholder="" autocomplete="off" class="layui-input phone">
                        </div>
                    </div>
                    <button class="layui-btn layui-btn-sm" style="margin:20px 30px;" lay-filter="formDemo">查询</button>                    
                </div>

                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this" lay-id="1">待审核</li>
                        <li lay-id="2">上架中</li>
                        <li lay-id="3">已失效</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <table id="demo1" lay-filter="test"></table>
                        </div>
                        <div class="layui-tab-item">
                            <table id="demo2" lay-filter="test"></table>
                        </div>
                        <div class="layui-tab-item">
                            <table id="demo3" lay-filter="test"></table>
                        </div>
                    </div>        
                </div>
                <!-- -------------------------------------------------- -->
                

        </div>      
      
@endsection

@section('js')
 <script>

     function addRole(){
         window.location.href="/admin/marketing/group_save";
     }


     layui.use(['table','form','element'], function(){
        var table = layui.table
        ,element = layui.element
        ,form = layui.form
        ,$ = layui.$;


        

        $(".dBox").click(function () {
                var index = $(this).attr("lay-id");
                var url = "{{url('admin/business/send')}}"+ "/" + index;
                $.ajax({
                    url:url,
                    type:"POST",
                    dataType:"json",
                    data:{"_token":"{{csrf_token()}}"},
                    success:function (data) {
                        //第一个实例
                        table.render({
                            elem: `#demo${index}`
                            ,limit:999999
                            ,cols: [[ //表头
                                {field: 'shopname', title: '店铺名称' ,  align:'center'}
                                ,{field: 'pic', title: '图片',  align:'center'}
                                ,{field: 'title', title: '标题',  align:'center'}
                                ,{field: 'firPrice', title: '原价',  align:'center'}
                                ,{field: 'unit', title: '库存',  align:'center'}
                                ,{field: 'starttime', title: '开始时间',  align:'center'}
                                ,{field: 'endtime', title: '结束时间',  align:'center'}
                                ,{field: 'killPrice', title: '秒杀价',  align:'center'}
                                ,{field: 'time', title: '创建时间', sort: true , align:'center' ,templet : "<div>@{{layui.util.toDateString(d.time*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
                                ,{field: 'status', title: '商品状态',  align:'center'}
                                ,{field: 'up', title: '是否上架',  align:'center' , templet: function(d){
                                    if(d.up==1){
                                        return `<div class="layui-form-item">
                                                    <div class="layui-input-block swichBtn" >
                                                    <input type="checkbox" checked lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                                                    </div>
                                                </div>`;
                                    }else{
                                        return `<div class="layui-form-item">
                                                    <div class="layui-input-block swichBtn" >
                                                    <input type="checkbox" lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                                                    </div>
                                                </div>`;
                                    }
                                }}
                                ,{field: 'action', title: '操作',  align:'center' , templet: function(d){
                                    return `<a class="layui-btn  layui-btn-xs layui-btn-primary" lay-event="look">查看</a>
                                            <a class="layui-btn layui-btn-xs " lay-event="edit">编辑</a>
                                            <a class="layui-btn  layui-btn-danger layui-btn-xs" lay-event="del">删除</a>`;
                                }}
                            ]]
                            ,data:data
                        });
                    },
                    error:function (data) {
                        console.log("错误");
                    }
                });

            })

        // #登录权限事件
        
        form.on('switch(filter)', function(data){
            var flag = data.elem.checked;
            var id =$(data.elem).data("id");
            if(flag){
                var btnTag = 1;
            }else{
                var btnTag = 0;
            }
            $.get("/admin/admin_user/state/"+ id + "/" + btnTag,{
            },function(res){
                if(res==1)
                {
                    data.elem.checked = !flag;
                }else{
                    data.elem.checked = !flag;
                    form.render();
                }
            }); 

        }); 

        //查询
        form.on('switch(formDemo)', function(data){
            if(data.field.select1_input=="" && data.field.gname=="" && data.field.date==""){
                    layer.msg('至少输入一个查询条件');
                    return false;
                }
                var field = data.field;

                element.tabChange('demo', field.state);
                var url = "{{url('admin/business/search')}}";
                $.ajax({
                    url:url,
                    type:"POST",
                    dataType:"json",
                    data:{"_token":"{{csrf_token()}}","data":field},
                    success:function (data) {
                        console.log(data);
                        //第一个实例
                        table.render({
                            elem: `#demo${field.state}`
                            ,limit:999999
                            ,cols: [[ //表头
                                {field: 'shopname', title: '店铺名称' ,  align:'center'}
                                ,{field: 'pic', title: '图片',  align:'center'}
                                ,{field: 'title', title: '标题',  align:'center'}
                                ,{field: 'firPrice', title: '原价',  align:'center'}
                                ,{field: 'unit', title: '库存',  align:'center'}
                                ,{field: 'starttime', title: '开始时间',  align:'center' ,templet : "<div>@{{layui.util.toDateString(d.starttime*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
                                ,{field: 'endtime', title: '结束时间',  align:'center' ,templet : "<div>@{{layui.util.toDateString(d.endtime*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
                                ,{field: 'ptPrice', title: '拼团价',  align:'center'}
                                ,{field: 'time', title: '创建时间', sort: true , align:'center' ,templet : "<div>@{{layui.util.toDateString(d.time*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
                                ,{field: 'status', title: '商品状态',  align:'center' , templet: function(d){
                                    if(d.status==1){
                                        return `<div style="color=green">上架中</div>`;
                                    }else if(d.status==2){
                                        return `<div style="color=red">待审核</div>`;
                                    }else if(d.status==3){
                                        return `<div style="color=red">已失效</div>`;
                                    }
                                    
                                }}
                                ,{field: 'status', title: '拼团人数',  align:'center'}
                                ,{field: 'up', title: '是否上架',  align:'center' , templet: function(d){
                                    if(d.up==1){
                                        return `<div class="layui-form-item">
                                                    <div class="layui-input-block swichBtn" >
                                                    <input type="checkbox" checked lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                                                    </div>
                                                </div>`;
                                    }else{
                                        return `<div class="layui-form-item">
                                                    <div class="layui-input-block swichBtn" >
                                                    <input type="checkbox" lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                                                    </div>
                                                </div>`;
                                    }
                                }}
                                ,{field: 'action', title: '操作',  align:'center' , templet: function(d){
                                    return `<a class="layui-btn  layui-btn-xs layui-btn-primary" lay-event="look">查看</a>
                                            <a class="layui-btn layui-btn-xs " lay-event="edit">编辑</a>
                                            <a class="layui-btn  layui-btn-danger layui-btn-xs" lay-event="del">删除</a>`;
                                }}
                            ]]
                            ,data:data
                        });
                    },
                    error:function (data) {
                        console.log("错误");
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        }); 


       
            table.render({
                    elem: '#demo1'
                    ,limit:999999
                    ,cols: [[ //表头
                        {field: 'shopname', title: '店铺名称' ,  align:'center'}
                        ,{field: 'pic', title: '图片',  align:'center'}
                        ,{field: 'title', title: '标题',  align:'center'}
                        ,{field: 'firPrice', title: '原价',  align:'center'}
                        ,{field: 'unit', title: '库存',  align:'center'}
                        ,{field: 'starttime', title: '开始时间',  align:'center'}
                        ,{field: 'endtime', title: '结束时间',  align:'center'}
                        ,{field: 'killPrice', title: '秒杀价',  align:'center'}
                        ,{field: 'time', title: '创建时间', sort: true , align:'center' ,templet : "<div>@{{layui.util.toDateString(d.time*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
                        ,{field: 'status', title: '商品状态',  align:'center'}
                        ,{field: 'up', title: '是否上架',  align:'center' , templet: function(d){
                            if(d.up==1){
                                return `<div class="layui-form-item">
                                            <div class="layui-input-block swichBtn" >
                                            <input type="checkbox" checked lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                                            </div>
                                        </div>`;
                            }else{
                                return `<div class="layui-form-item">
                                            <div class="layui-input-block swichBtn" >
                                            <input type="checkbox" lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                                            </div>
                                        </div>`;
                            }
                        }}
                        ,{field: 'action', title: '操作',  align:'center' , templet: function(d){
                            return `<a class="layui-btn  layui-btn-xs layui-btn-primary" lay-event="look">查看</a>
                                    <a class="layui-btn layui-btn-xs " lay-event="edit">编辑</a>
                                    <a class="layui-btn  layui-btn-danger layui-btn-xs" lay-event="del">删除</a>`;
                        }}
                    ]]
                    ,data:data
                });



        // #table操作事件
        table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            let tdata = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象
            console.log(tdata);
            da = obj.data;
            if(layEvent === 'del'){ //删除
                layer.confirm('真的删除行么', function(index){
                    //向服务端发送删除指令
                    $.get("/admin/admin_user/del/"+tdata.id,{

                    },function(data){
                        if(data == 1)
                        {
                            obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        }else{
                            alert("删除失败");
                        }

                        layer.close(index);
                    });

               
                });
            }else if(layEvent === 'edit'){
                window.location.href="/admin/admin_user/edit/"+tdata.id;
            }else if(layEvent == 'look'){
                window.location.href="/admin/admin_user/edit/"+tdata.id;
            }
        });
        
    });

   

    
 </script>
@endsection