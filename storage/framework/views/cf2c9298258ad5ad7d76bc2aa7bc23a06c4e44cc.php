<link rel="stylesheet" href="<?php echo e(asset('css/bussiness.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main" >
        <div style="padding:30px;">
            <form class="layui-form form" action="">
                <div class="bigForm">
                    <div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">订单搜索：</label>
                            <div class="layui-input-block ibox">
                                <select name="select1" class="select1">
                                    <option value="1">订单编号</option>
                                    <option value="2">物流单号</option>
                                    <option value="3">收货人姓名</option>
                                    <option value="4">收货人手机号</option>
                                </select>
                            </div>
                            <div class="layui-input-inline" style="padding-left: 4px;">
                                <input type="text" name="select1_input" placeholder="" autocomplete="off" class="layui-input select1_input">
                            </div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">商品名称：</label>
                            <div class="layui-input-inline">
                                <input type="text" name="gname" placeholder="" autocomplete="off" class="layui-input gname">
                            </div>
                        </div>
                    </div>

                    <div style="padding-top: 0;">

                        <div class="layui-form-item" >
                            <label class="layui-form-label">日期搜索：</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" name="date" id="test6" placeholder=" - ">
                            </div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">订单状态：</label>
                            <div class="layui-input-block ibox">
                                <select name="state" class="select2">
                                    <option value="3">未发货</option>
                                    <option value="4">已发货</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="btnBox">
                        <button class="layui-btn" lay-submit  lay-filter="formDemo" style="width: 100px">查询</button>
                    </div>
                </div>




            </form>

            <div class="layui-tab" lay-filter="demo">
                <ul class="layui-tab-title">
                    <li class="layui-this dBox" data-item="3" lay-id="3">未发货</li>
                    <li class="dBox" data-item="4" lay-id="4">已发货</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <table id="demo3" lay-filter="test"></table>
                    </div>
                    <div class="layui-tab-item">
                        <table id="demo4" lay-filter="test"></table>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['laydate','form','element','table','layer'], function(){
            var laydate = layui.laydate
            ,form = layui. form
            ,table = layui.table
            ,element = layui.element
            ,$ = layui.$
            ,layer = layui.layer;

            //触发事件
            $('.site-demo-active').on('click', function(){
                var othis = $(this), type = othis.data('type');
                active[type] ? active[type].call(this, othis) : '';
            });

            $(".dBox").click(function () {
                var index = $(this).attr("data-item");
                var url = "<?php echo e(url('admin/business/send')); ?>"+ "/" + index;
                $.ajax({
                    url:url,
                    type:"POST",
                    dataType:"json",
                    data:{"_token":"<?php echo e(csrf_token()); ?>"},
                    success:function (data) {
                        //第一个实例
                        table.render({
                            elem: `#demo${index}`
                            ,cols: [[ //表头
                                {field: 'orderid', title: '订单编号',  sort: true, fixed: 'left', align:'center'}
                                ,{field: 'goodsname', title: '商品名称', align:'center' }
                                ,{field: 'price', title: '单价',  sort: true, align:'center'}
                                ,{field: 'count', title: '数量', align:'center' }
                                ,{field: 'realpay', title: '实付金额', align:'center'}
                                ,{field: 'time', title: '下单时间', align:'center'}
                                ,{field: 'status', title: '订单状态', align:'center', templet : function(d){
                                    return `<div class="status${d.status}" style="color:${d.status.color}">${d.status.name}</div>`;
                                }}
                                ,{field: 'ems', title: '物流单号', align:'center'}
                                ,{field: 'name', title: '收货人姓名', align:'center'}
                                ,{field: 'phone', title: '收货人手机号', align:'center'}
                                ,{field: 'address', title: '收货人地址', align:'center'}
                                ,{field: 'action', title: '操作' , align:'center', templet : function(d){
                                    if(d.status.name == "已发货")
                                    {
                                        return '<button class="layui-btn layui-btn-disabled">已发货</button>';
                                    }else{
                                        return `<button class="layui-btn" style="background-color: red" onclick="gosend(${d.id});">去发货</button>`;
                                    }
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

            //日期
            laydate.render({
                elem: '#test6'
                ,range: true
                ,done: function(value, date, endDate){
//                    console.log(value); //得到日期生成的值，如：2017-08-18
//                    console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
//                    console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
                    return value;
                }
            });

            form.on('submit(formDemo)', function(data){
//                console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
                if(data.field.select1_input=="" && data.field.gname=="" && data.field.date==""){
                    layer.msg('至少输入一个查询条件');
                    return false;
                }
                var field = data.field;

                element.tabChange('demo', field.state);
                var url = "<?php echo e(url('admin/business/search')); ?>";
                $.ajax({
                    url:url,
                    type:"POST",
                    dataType:"json",
                    data:{"_token":"<?php echo e(csrf_token()); ?>","data":field},
                    success:function (data) {
                        console.log(data);
                        //第一个实例
                        table.render({
                            elem: `#demo${field.state}`
                            ,cols: [[ //表头
                                {field: 'orderid', title: '订单编号',  sort: true, fixed: 'left', align:'center'}
                                ,{field: 'goodsname', title: '商品名称', align:'center' }
                                ,{field: 'price', title: '单价',  sort: true, align:'center'}
                                ,{field: 'count', title: '数量', align:'center' }
                                ,{field: 'realpay', title: '实付金额', align:'center'}
                                ,{field: 'time', title: '下单时间', align:'center' ,templet : "<div>{{layui.util.toDateString(d.time*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
                                ,{field: 'status', title: '订单状态', align:'center', templet : function(d){
                                    return `<div class="status${d.status}" style="color:${d.status.color}">${d.status.name}</div>`;
                                }}
                                ,{field: 'ems', title: '物流单号', align:'center'}
                                ,{field: 'name', title: '收货人姓名', align:'center'}
                                ,{field: 'phone', title: '收货人手机号', align:'center'}
                                ,{field: 'address', title: '收货人地址', align:'center'}
                                ,{field: 'action', title: '操作' , align:'center', templet : function(d){
                                    if(d.status.name == "已发货")
                                    {
                                        return '<button class="layui-btn layui-btn-disabled">已发货</button>';
                                    }else{
                                        return `<button class="layui-btn" style="background-color: red" onclick="gosend(${d.id});">去发货</button>`;
                                    }
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
                elem: '#demo2'
                ,cols: [[ //表头
                {field: 'orderid', title: '订单编号',  sort: true, fixed: 'left', align:'center'}
                ,{field: 'goodsname', title: '商品名称', align:'center' }
                ,{field: 'price', title: '单价',  sort: true, align:'center'}
                ,{field: 'count', title: '数量', align:'center' }
                ,{field: 'realpay', title: '实付金额', align:'center'}
                ,{field: 'time', title: '下单时间', align:'center'}
                ,{field: 'status', title: '订单状态', align:'center', templet : function(d){
                        return `<div class="status${d.status}" style="color:${d.status.color}">${d.status.name}</div>`;
                    }}
                ,{field: 'ems', title: '物流单号', align:'center'}
                ,{field: 'name', title: '收货人姓名', align:'center'}
                ,{field: 'phone', title: '收货人手机号', align:'center'}
                ,{field: 'address', title: '收货人地址', align:'center'}
                ,{field: 'action', title: '操作' , align:'center', templet : function(d){
                            return `<button class="layui-btn" style="background-color: red" onclick="gosend(${d.id});">去发货</button>`;
                        }}
                ]]
                ,data:data
            });




            window.gosend = function(id) {
                layer.open({
                    title: false,
                    type: 1,
                    content: `<div style="padding:30px 15px 0 15px;">
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">快递公司：</label>
                                    <div class="layui-input-block ibox">
                                        <select name="emsName" class="emsName" style="padding: 8px;border-color: #e6e6e6;border-radius:   2px;">
                                            <option value="圆通快递">圆通快递</option>
                                            <option value="韵达快递">韵达快递</option>
                                            <option value="中通快递">中通快递</option>
                                            <option value="申通快递">申通快递</option>
                                            <option value="EMS">EMS</option>
                                            <option value="优速快递">优速快递</option>
                                            <option value="天天快递">天天快递</option>
                                            <option value="百世快递">百世快递</option>
                                            <option value="宅急送">宅急送</option>
                                            <option value="邮政包裹">邮政包裹</option>
                                            <option value="全峰快递">全峰快递</option>
                                            <option value="德邦物流">德邦物流</option>
                                            <option value="华宇物流">华宇物流</option>
                                            <option value="龙邦物流">龙邦物流</option>
                                            <option value="优速物流">优速物流</option>
                                            <option value="中邮物流">中邮物流</option>
                                            <option value="申通物流">申通物流</option>
                                            <option value="传喜物流">传喜物流</option>
                                            <option value="中铁物流">中铁物流</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="layui-form-item" style="margin-bottom:0;">
                                    <label class="layui-form-label">快递单号：</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="emsID" placeholder="" autocomplete="off" class="layui-input emsID">
                                    </div>
                                </div>
                            </div>`,
                    btn: ['发货', '取消']
                    ,yes: function(index, layero){
                        //按钮【按钮一】的回调
                        var emsID = $(".emsID").val();
                        var emsName = $(".emsName").val();
                        if(emsName==""){
                            layer.msg('请输入快递公司');
                            return false;
                        }else if(emsID==""){
                            layer.msg('请输入快递单号');
                            return false;
                        }
                        $.ajax({
                            url:"/admin/business/delivery",
                            type:"POST",
                            dataType:"json",
                            data:{"_token":"<?php echo e(csrf_token()); ?>","id":id, "emsID":emsID,"emsName":emsName},
                            success:function (data) {
                                if(data)
                                {
                                    $(".dBox").click();
                                }else{
                                    alert("发货失败");
                                }
                            },
                            error:function (data) {
                                console.log("错误");
                            }
                        });

                        //回调成功后关闭窗口
                        layer.close(index);

                        //此处写ajax
                    }
                    ,btn2: function(index, layero){
                        //按钮【按钮二】的回调
                        console.log("取消");
                        //return false 开启该代码可禁止点击该按钮关闭
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>