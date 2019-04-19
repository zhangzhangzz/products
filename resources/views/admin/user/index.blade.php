@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@section('content')
    <div class="main" >
        <div class="layui-tab bigbox">
            <ul class="layui-tab-title">
                <li class="layui-this">普通用户</li>
                <li>禁用用户</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <form class="layui-form form" action="">
                        <input type="text" name="name"  placeholder="昵称" autocomplete="off" class="layui-input">
                        <input type="text" name="phone" placeholder="手机号" autocomplete="off" class="layui-input">
                        <input type="text" name="wxqq"  placeholder="微信/QQ" autocomplete="off" class="layui-input">
                        <input type="text" name="address"  placeholder="收货地址" autocomplete="off" class="layui-input">
                        <button class="layui-btn" lay-submit lay-filter="formDemo1">搜索</button>
                    </form>

                    <table id="demo1" lay-filter="test"></table>

                </div>
                <div class="layui-tab-item">
                    <form class="layui-form form" action="">
                        <input type="text" name="name"  placeholder="昵称" autocomplete="off" class="layui-input">
                        <input type="text" name="phone"  placeholder="手机号" autocomplete="off" class="layui-input">
                        <input type="text" name="wxqq"  placeholder="微信/QQ" autocomplete="off" class="layui-input">
                        <input type="text" name="address"  placeholder="收货地址" autocomplete="off" class="layui-input">
                        <button class="layui-btn" lay-submit lay-filter="formDemo2">搜索</button>
                    </form>

                    <table id="demo2" lay-filter="test"></table>

                </div>
            </div>
        </div>


    </div>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >详情</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">禁用</a>
    </script>

    <script type="text/html" id="headDemo">
        <img src="@{{d.headimg}}" >
    </script>

@endsection
@section('js')
    <script>
        //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
        layui.use(['table','form','element'], function(){
            var element = layui.element
            table = layui.table
            form = layui.form;

            $.ajax({
                url:"{{url('admin/user/index')}}",
                type:"POST",
                dataType:"json",
                data:{"_token":"{{csrf_token()}}"},
                success:function (data) {
                    console.log(data);
                    var data = data.data;
                    table.render({
                        elem: '#demo1'
                        ,limit:10
                        ,page: true
                        ,cols: [[ //表头
                            {field: 'images', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
                            ,{field: 'name', title: '名称' , align:'center'}
                            ,{field: 'phone', title: '电话' ,  align:'center'}
                            ,{field: 'weixin_qq', title: '微信/QQ', align:'center'}
                            ,{field: 'address', title: '地址',  align:'center'}
                            ,{field: 'create_time', title: '创建时间',  sort: true , align:'center'}
                            ,{field: 'action', title: '操作',  align:'center' , templet: function(d){
                                if(d.status==1){
                                    var state = `<a class="layui-btn layui-btn-danger layui-btn-xs acBtn" lay-event="del">禁用</a>`;
                                }else{
                                    var state = `<a class="layui-btn layui-btn-danger layui-btn-xs acBtn" lay-event="del">启用</a>`;
                                }

                                return `<a class="layui-btn layui-btn-xs acBtn" lay-event="edit" >详情</a>`+state;
                            }}
                        ]]
                        ,data:data
                    });
                },
                error:function (data) {
                    console.log("错误")
                }
            });



            //第二个实例
            $.ajax({
                url:"{{url('admin/user/disabled')}}",
                type:"POST",
                dataType:"json",
                data:{"_token":"{{csrf_token()}}"},
                success:function (data) {
                    console.log(data);
                    if(data.status == 1){
                        var data = data.data;
                        table.render({
                            elem: '#demo2'
                            ,limit:10
                            ,page: true
                            ,cols: [[ //表头
                                {field: 'images', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
                                ,{field: 'name', title: '名称' ,  align:'center'}
                                ,{field: 'phone', title: '电话' ,  align:'center'}
                                ,{field: 'weixin_qq', title: '微信/QQ',  align:'center'}
                                ,{field: 'address', title: '地址',  align:'center'}
                                ,{field: 'create_time', title: '创建时间',  sort: true , align:'center' ,templet : "<div>@{{layui.util.toDateString(d.creatdate*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"
                                }
                                ,{field: 'action', title: '操作', align:'center' , templet: function(d){
                                    if(d.status==1){
                                        var state = `<a class="layui-btn layui-btn-danger layui-btn-xs acBtn" lay-event="del">禁用</a>`;
                                    }else{
                                        var state = `<a class="layui-btn layui-btn-danger layui-btn-xs acBtn" lay-event="del">启用</a>`;
                                    }

                                    return `<a class="layui-btn layui-btn-xs acBtn" lay-event="edit" >详情</a>`+state;
                                }}
                            ]]
                            ,data:data
                        });
                    }
                },
                error:function (data) {
                    console.log("错误")
                }
            })


            //普通用户监听提交
            form.on('submit(formDemo1)', function(data){
                if(data.field.name =="" && data.field.phone=="" && data.field.address=="" && data.field.wxqq==""){
                    layer.msg('至少有一个搜索条件');
                    return false;
                }

                console.log(data.field);
                $.ajax({
                    url:"{{url('admin/user/search')}}",
                    type:"POST",
                    dataType:"json",
                    data:{
                        "_token":"{{csrf_token()}}",
                        "name":data.field.name,
                        "phone":data.field.phone,
                        "address":data.field.address,
                        "weixin_qq":data.field.wxqq
                    },
                    success:function (data) {
                        console.log(data);
                        if(data.status == 1){
                            var data = data.data;
                            table.render({
                                elem: '#demo1'
                                ,limit:10
                                ,page: true
                                ,cols: [[ //表头
                                    {field: 'images', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
                                    ,{field: 'name', title: '名称' ,  align:'center'}
                                    ,{field: 'phone', title: '电话' ,  align:'center'}
                                    ,{field: 'weixin_qq', title: '微信/QQ',  align:'center'}
                                    ,{field: 'address', title: '地址',  align:'center'}
                                    ,{field: 'create_time', title: '创建时间',  sort: true , align:'center'}
                                    ,{field: 'action', title: '操作', align:'center' , toolbar: '#barDemo'}
                                ]]
                                ,data:data
                            });
                        }
                    },
                    error:function (data) {
                        console.log("错误")
                    }
                });
                return false;
            });

            //禁用用户监听提交
            form.on('submit(formDemo2)', function(data){
                if(data.field.name =="" && data.field.phone=="" && data.field.address=="" && data.field.wxqq==""){
                    layer.msg('至少有一个搜索条件');
                    return false;
                }
                console.log(data.field);
                $.ajax({
                    url:"{{url('admin/user/search')}}",
                    type:"POST",
                    dataType:"json",
                    data:{
                        "_token":"{{csrf_token()}}",
                        "name":data.field.name,
                        "phone":data.field.phone,
                        "address":data.field.address,
                        "weixin_qq":data.field.wxqq
                    },
                    success:function (data) {
                        console.log(data);
                        if(data.status == 1){
                            var data = data.data;
                            table.render({
                                elem: '#demo2'
                                ,limit:10
                                ,page: true
                                ,cols: [[ //表头
                                    {field: 'images', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
                                    ,{field: 'name', title: '名称' ,  align:'center'}
                                    ,{field: 'phone', title: '电话' ,  align:'center'}
                                    ,{field: 'weixin_qq', title: '微信/QQ',  align:'center'}
                                    ,{field: 'address', title: '地址',  align:'center'}
                                    ,{field: 'create_time', title: '创建时间',  sort: true , align:'center' ,templet : "<div>@{{layui.util.toDateString(d.creatdate*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"
                                    }
                                    ,{field: 'action', title: '操作', align:'center' , toolbar: '#barDemo'}
                                ]]
                                ,data:data
                            });
                        }
                    },
                    error:function (data) {
                        console.log("错误")
                    }
                });
                return false;
            });


            // #table操作事件
            table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                let tdata = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的DOM对象
                console.log(tdata.id);
                var status = tdata.status;
                // #数据删除

                if(layEvent === 'del'){ //删除
                    if(status==1){
                        var text = '确定要禁用吗？';
                    }else{
                        var text = '确定要启用吗？';
                    }
                    layer.confirm(text, function(index){
                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令
                        $.ajax({
                            url:"{{url("admin/user/status")}}",
                            type:"POST",
                            dataType:"json",
                            data:{"_token":"{{csrf_token()}}","id":tdata.id,"status":status},
                            success:function (data) {
                                if(data.status == 1){
                                    console.log(data);
                                    table.render({
                                        elem: '#demo2'
                                        ,limit:10
                                        ,page: true
                                        ,cols: [[ //表头
                                            {field: 'images', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
                                            ,{field: 'name', title: '名称' ,  align:'center'}
                                            ,{field: 'phone', title: '电话' ,  align:'center'}
                                            ,{field: 'weixin_qq', title: '微信/QQ',  align:'center'}
                                            ,{field: 'address', title: '地址',  align:'center'}
                                            ,{field: 'create_time', title: '创建时间',  sort: true , align:'center' ,templet : "<div>@{{layui.util.toDateString(d.creatdate*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"
                                            }
                                            ,{field: 'action', title: '操作', align:'center' , toolbar: '#barDemo'}
                                        ]]
                                        ,data:data.data
                                    });
                                    window.location.href = "{{url('admin/user/index')}}"
                                }
                            },
                            error:function (data) {
                                console.log("错误")
                            }
                        })

                    });
                } else if(layEvent === 'edit'){
                    window.location.href="/admin/user/look/"+tdata.id;
                }
            });

        });

    </script>
@endsection
