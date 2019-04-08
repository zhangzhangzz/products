@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@section('content')
    <div class="main" > 

        <form class="layui-form form" action="">
            <input type="text" name="shopName" required lay-verify="required" placeholder="店铺名称" autocomplete="off" class="layui-input">
            <input type="text" name="perrson" required lay-verify="required" placeholder="负责人" autocomplete="off" class="layui-input">
            <input type="text" name="phone" required lay-verify="required" placeholder="联系电话" autocomplete="off" class="layui-input">
            <input type="text" name="type" required lay-verify="required" placeholder="主营类目" autocomplete="off" class="layui-input">
            <button class="layui-btn" lay-submit lay-filter="formDemo">筛选</button>
        </form>
        
    <div class="layui-tab bigbox">
            <ul class="layui-tab-title">
                <li class="layui-this">待审核</li>
                <li>驳回</li>
                <li>通过</li>
                <li>经营中</li>
                <li>审核中</li>
                <li>已停业</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <table id="demo" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table id="demo2" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table id="demo3" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table id="demo4" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table id="demo5" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table id="demo6" lay-filter="test"></table>
                </div>
            </div>
        </div>
 

    </div>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="" style="margin-top: 14px;" href="/admin/shop/check">审核</a>
    </script>

    <!-- 审核状态 -->
    <script type="text/html" id="barDemo1">
        @{{#  if(d.check == 1){ }}
            <div style="color:green">通过</div>
        @{{#  } else if(d.check == -1){ }}
        <div style="color:red">驳回</div>
        @{{#  } else if(d.check == 0){ }}
        <div >待审核</div>
        @{{#  } }}
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
            url:"{{url('admin/shop/index')}}",
            type:"POST",
            dataType:"json",
            data:{"_token":"{{csrf_token()}}"},
            success:function (data) {
                console.log(data)
                if(data.status == 1){
                    var data = data.data;
                    //第一个实例
                    table.render({
                        elem: '#demo'
                        ,limit:999999
                        ,width:1189
                        ,cols: [[ //表头
                            {field: 'shop_name', title: '店铺名称', width:150,  fixed: 'left' , align:'center'}
                            ,{field: 'company_name', title: '公司名称' , width:150 , align:'center'}
                            ,{field: 'functionary', title: '负责人' , width:150 , align:'center'}
                            ,{field: 'phone', title: '联系电话', width:130 , align:'center'}
                            ,{field: 'goods_type_name', title: '主营类目', width: 140 , align:'center'}
                            ,{field: 'audit_status', title: '审核状态', width: 140,  align:'center'  , templet: function(d){
                                if(d.audit_status=="1"){
                                    return '待审核';
                                }else if(d.audit_status=="2"){
                                    return '驳回';
                                }else if(d.audit_status=="3"){
                                    return '通过';
                                }
                            }}
                            ,{field: 'manage_status', title: '经营状态', width: 140,  align:'center' , templet: function(d){
                                if(d.manage_status=="1"){
                                    return '经营中';
                                }else if(d.manage_status=="2"){
                                    return '审核中';
                                }else if(d.manage_status=="3"){
                                    return '已停业';
                                }
                            }}
                            ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
                        ]]
                        ,data:data
                    });
                }
            },
            error:function (data) {
                console.log("错误");
            }
        });



        //第二个实例
        table.render({
            elem: '#demo2'
            ,limit:999999
            ,width:1189
            ,cols: [[ //表头
            {field: 'shopName', title: '店铺名称', width:150,  fixed: 'left' , align:'center'}
            ,{field: 'companyName', title: '公司名称' , width:150 , align:'center'}
            ,{field: 'person', title: '负责人' , width:150 , align:'center'}
            ,{field: 'phone', title: '联系电话', width:130 , align:'center'} 
            ,{field: 'maintype', title: '主营类目', width: 140 , align:'center'}
            ,{field: 'check', title: '审核状态', width: 140,  align:'center' ,toolbar: '#barDemo1'}
            ,{field: 'status', title: '经营状态', width: 140,  align:'center' , toolbar: '#barDemo2'}
            ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
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

            // #数据删除

            if(layEvent === 'del'){ //删除
                layer.confirm('真的删除行么', function(index){
                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                layer.close(index);
                //向服务端发送删除指令
                console.log("删除");

                $.post("",{
                        id:id
                    },function(data){

                    });

                });
            } else if(layEvent === 'edit'){
                window.location.href="/admin/admin/add"; 
            }
        });
    
    });
</script>
@endsection
