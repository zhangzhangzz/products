@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/goodsmanage.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="topBox">
                <div class="layui-form-item">
                    <label class="layui-form-label iBox">店产品名称/标题 ：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="account" lay-verify="required" placeholder="" autocomplete="off" class="layui-input account">
                    </div>
                </div>
                <button class="layui-btn layui-btn-sm selectBtn" style="margin:20px 30px;">查询</button>                    
            </div>



            <div class="mainBox">
                <button class="layui-btn addgoods" >发布新商品</button> 

                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this dBox" data-item="1" lay-id="1">出售中</li>
                        <li class="dBox" data-item="2" lay-id="2">已售罄</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <table id="demo1" lay-filter="test"  class="tableBox"></table>
                        </div>
                        <div class="layui-tab-item">
                            <table id="demo2" lay-filter="test" class="tableBox"></table>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>  

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >编辑</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="del">推广</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>



    

@endsection

@section('js')
<script>
    layui.use(['table','element'], function(){
        var table = layui.table
        ,element = layui.element
        ,$ = layui.$;



        $(".addgoods").click(function(){
            window.location.href="/admin/goods/add";

        });
        var img = "<?php echo ImagesOssUrl; ?>";
        var list = <?php
            if(empty(arr($list)))
            {
                echo 0;
            }else{
                echo $list;
            }
            ?>;
        var data = [];
        if(list.length == 1)
        {
            for(var i in  list)
            {
                data = [list[i]];
            }
        }else{
            for(var i in  list)
            {
                 data.push(list[i]);
            }
        }

        //第一个实例
        table.render({
            elem: '#demo1'
            ,limit:999999
            ,cols: [[ //表头
            {field: 'pic', title: '图片',   align:'center' ,  templet:function(d){
                if(d.pic!=""){
                    return `<img src="${img}/${d.pic}">`;
                }
            }}
            ,{field: 'goodsname', title: '标题' ,  align:'center'}
            ,{field: 'price', title: '价格' ,  align:'center'}
            ,{field: 'num', title: '库存' ,  align:'center'}
            ,{field: 'total_num', title: '总销量' ,  align:'center'}
            ,{field: 'month_num', title: '月销量' ,  align:'center'}
            ,{field: 'time', title: '创建时间' ,  align:'center' ,templet : "<div>@{{layui.util.toDateString(d.time*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
            ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
            ]]
            ,data:data
        });

        $(".dBox").click(function () {
            var index = $(this).attr("data-item");
            var url = "{{url('admin/manage/show')}}"+ "/" + index;
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
                            {field: 'pic', title: '图片',   align:'center' ,  templet:function(d){
                                if(d.pic!=""){
                                    return `<img src="${img}/${d.pic}">`;
                                }
                            }}
                            ,{field: 'goodsname', title: '标题' ,  align:'center'}
                            ,{field: 'price', title: '价格' ,  align:'center'}
                            ,{field: 'num', title: '库存' ,  align:'center'}
                            ,{field: 'total_num', title: '总销量' ,  align:'center'}
                            ,{field: 'month_num', title: '月销量' ,  align:'center'}
                            ,{field: 'time', title: '创建时间' ,  align:'center' ,templet : "<div>@{{layui.util.toDateString(d.time*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
                            ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
                        ]]
                        ,id:`idTest${index}`
                        ,data:data
                    });
                },
                error:function (data) {
                    console.log("错误");
                }
            });
        })
        // #table操作事件
        table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
        let tdata = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的DOM对象

        // #数据删除

        if(layEvent === 'del'){ //删除
            layer.confirm('真的删除行么', function(index){
            obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
            layer.close(index);
            //向服务端发送删除指令

            $.get("",{
                
                },function(data){

                });

            });
        } else if(layEvent === 'edit'){
            window.location.href="/admin/menu/edit";
        }
        });
    });
</script>
@endsection