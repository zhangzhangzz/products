@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@section('content')
    <div class="main" >
        <div class=" bigbox">
            <ul class="layui-tab-title">
                <li class="layui-this">普通用户</li>
                <li>禁用用户</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <form class="layui-form form" action="">
<<<<<<< HEAD
                        <input type="text" name="name" required lay-verify="required" placeholder="昵称" autocomplete="off" class="layui-input">
                        <input type="text" name="phone" required lay-verify="required" placeholder="手机号" autocomplete="off" class="layui-input">
                        <input type="text" name="wxqq" required lay-verify="required" placeholder="微信/QQ" autocomplete="off" class="layui-input">
                        <input type="text" name="address" required lay-verify="required" placeholder="收货地址" autocomplete="off" class="layui-input">
=======
                        <input type="text" name="name"  placeholder="昵称" autocomplete="off" class="layui-input">
                        <input type="text" name="phone" placeholder="手机号" autocomplete="off" class="layui-input">
                        <input type="text" name="wxqq"  placeholder="微信/QQ" autocomplete="off" class="layui-input">
                        <input type="text" name="address"  placeholder="收货地址" autocomplete="off" class="layui-input">
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
                        <button class="layui-btn" lay-submit lay-filter="formDemo1">搜索</button>
                    </form>

                    <table id="demo1" lay-filter="test"></table>

                </div>
                <div class="layui-tab-item">
                    <form class="layui-form form" action="">
<<<<<<< HEAD
                    <input type="text" name="name" required lay-verify="required" placeholder="昵称" autocomplete="off" class="layui-input">
                        <input type="text" name="phone" required lay-verify="required" placeholder="手机号" autocomplete="off" class="layui-input">
                        <input type="text" name="wxqq" required lay-verify="required" placeholder="微信/QQ" autocomplete="off" class="layui-input">
                        <input type="text" name="address" required lay-verify="required" placeholder="收货地址" autocomplete="off" class="layui-input">
=======
                    <input type="text" name="name"  placeholder="昵称" autocomplete="off" class="layui-input">
                        <input type="text" name="phone"  placeholder="手机号" autocomplete="off" class="layui-input">
                        <input type="text" name="wxqq"  placeholder="微信/QQ" autocomplete="off" class="layui-input">
                        <input type="text" name="address"  placeholder="收货地址" autocomplete="off" class="layui-input">
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
                        <button class="layui-btn" lay-submit lay-filter="formDemo2">搜索</button>
                    </form>

                    <table id="demo2" lay-filter="test"></table>

                </div>
            </div>
        </div>


    </div>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" onclick="detail();">详情</a>
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
            form = layui.form
            $ = layui.$;

            window.detail=function(){
                window.location.href="/admin/user/look";
            }

        //监听提交
        form.on('submit(formDemo1)', function(data){
            // layer.msg(JSON.stringify(data.field));
            // return false;

            var data = [
                {headimg:"{{ asset('image/logo.png') }}",name:"111111",phone:'13122223333',wxqq:'123654',address:'黑龙江省齐齐哈尔市龙山区恒大名都2号楼1单元1502',creatdate:'2019-01-01',action:'-'},
                {headimg:"{{ asset('image/1.jpg') }}",name:"1111111",phone:'13122223333',wxqq:'123654',address:'黑龙江省齐齐哈尔市龙山区恒大名都2号楼1单元1502',creatdate:'2019-01-01',action:'-'}
                    ];

            //第一个实例
            table.render({
                elem: '#demo'
                ,limit:999999
                ,cols: [[ //表头
                {field: 'headimg', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
                ,{field: 'name', title: '名称' ,  align:'center'}
                ,{field: 'phone', title: '电话' ,  align:'center'}
                ,{field: 'wxqq', title: '微信/QQ',  align:'center'}
                ,{field: 'address', title: '地址',  align:'center'}
                ,{field: 'creatdate', title: '创建时间', sort: true , align:'center'}
                ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
                ]]
                ,data:data
            });

            return false;


        });

        //监听提交
        form.on('submit(formDemo2)', function(data){
            var data = [
                {headimg:"{{ asset('image/logo.png') }}",name:"22222222",phone:'13122223333',wxqq:'123654',address:'黑龙江省齐齐哈尔市龙山区恒大名都2号楼1单元1502',creatdate:'2019-01-01',action:'-'},
                {headimg:"{{ asset('image/1.jpg') }}",name:"2222222",phone:'13122223333',wxqq:'123654',address:'黑龙江省齐齐哈尔市龙山区恒大名都2号楼1单元1502',creatdate:'2019-01-01',action:'-'}
                    ];
            console.log("???");
            //第一个实例
            table.render({
                elem: '#demo2'
                ,limit:999999
                ,cols: [[ //表头
                {field: 'headimg', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
                ,{field: 'name', title: '名称' ,  align:'center'}
                ,{field: 'phone', title: '电话' ,  align:'center'}
                ,{field: 'wxqq', title: '微信/QQ',  align:'center'}
                ,{field: 'address', title: '地址',  align:'center'}
                ,{field: 'creatdate', title: '创建时间', sort: true , align:'center'}
                ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
                ]]
                ,data:data
            });

            return false;
        });

<<<<<<< HEAD

        var data = [
                {headimg:"{{ asset('image/logo.png') }}",name:"香香1",phone:'13122223333',wxqq:'123654',address:'黑龙江省齐齐哈尔市龙山区恒大名都2号楼1单元1502',creatdate:'2019-01-01',action:'-'},
                {headimg:"{{ asset('image/1.jpg') }}",name:"香香1",phone:'13122223333',wxqq:'123654',address:'黑龙江省齐齐哈尔市龙山区恒大名都2号楼1单元1502',creatdate:'2019-01-01',action:'-'}
                    ];


        //第一个实例
        table.render({
            elem: '#demo'
            ,limit:999999
            ,cols: [[ //表头
            {field: 'headimg', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
            ,{field: 'name', title: '名称' ,  align:'center'}
            ,{field: 'phone', title: '电话' ,  align:'center'}
            ,{field: 'wxqq', title: '微信/QQ',  align:'center'}
            ,{field: 'address', title: '地址',  align:'center'}
            ,{field: 'creatdate', title: '创建时间', sort: true , align:'center'}
            ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
            ]]
            ,data:data
=======
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
                    ,limit:999999
                    ,cols: [[ //表头
                        {field: 'images', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
                        ,{field: 'name', title: '名称' , align:'center'}
                        ,{field: 'phone', title: '电话' ,  align:'center'}
                        ,{field: 'weixin_qq', title: '微信/QQ', align:'center'}
                        ,{field: 'address', title: '地址',  align:'center'}
                        ,{field: 'create_time', title: '创建时间',  sort: true , align:'center'}
                        ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
                    ]]
                    ,data:data
                });
            },
            error:function (data) {
                console.log("错误")
            }
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
        });



        //第二个实例
<<<<<<< HEAD
        table.render({
            elem: '#demo2'
            ,limit:999999
            ,cols: [[ //表头
            {field: 'headimg', title: '头像',   fixed: 'left' , align:'center' ,toolbar : '#headDemo'}
            ,{field: 'name', title: '名称' ,  align:'center'}
            ,{field: 'phone', title: '电话' ,  align:'center'}
            ,{field: 'wxORqq', title: '微信/QQ', align:'center'}
            ,{field: 'address', title: '地址',  align:'center'}
            ,{field: 'creatdate', title: '创建时间',  sort: true , align:'center'}
            ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
            ]]
            ,data:data
=======
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
                        ,limit:999999
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
                            ,limit:999999
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
                            ,limit:999999
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
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
        });


        // #table操作事件
        table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            let tdata = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象
            console.log(tdata.id);

            // #数据删除

            if(layEvent === 'del'){ //删除
                layer.confirm('确定要禁用吗？', function(index){
                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                layer.close(index);
                //向服务端发送删除指令
                    $.ajax({
                        url:"{{url('admin/user/status')}}",
                        type:"POST",
                        dataType:"json",
                        data:{"_token":"{{csrf_token()}}","id":tdata.id},
                        success:function (data) {
                            if(data.status == 1){
                                window.location.href = "{{url('admin/user/index')}}"
                            }
                        },
                        error:function (data) {
                            console.log("错误")
                        }
                    })

                });
            } else if(layEvent === 'edit'){
                window.location.href="/admin/admin/add";
            }
        });

    });

</script>
@endsection
