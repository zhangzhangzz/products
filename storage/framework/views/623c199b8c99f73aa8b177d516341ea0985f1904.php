<link rel="stylesheet" href="<?php echo e(asset('css/shop.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main" > 

        <form class="layui-form form" action="">
            <input type="text" name="shop_name"  placeholder="店铺名称" autocomplete="off" class="layui-input">
            <input type="text" name="functionary" placeholder="负责人" autocomplete="off" class="layui-input">
            <input type="text" name="phone" placeholder="联系电话" autocomplete="off" class="layui-input">
            <input type="text" name="goods_type_name" placeholder="主营类目" autocomplete="off" class="layui-input" lay-verify="item">
            <button class="layui-btn" lay-filter="formDemo" lay-submit>筛选</button>
        </form>
        
    <div class="layui-tab bigbox">
            <ul class="layui-tab-title">
                <li class="layui-this dBox" data-item="0">全部</li>
                <li class="dBox" data-item="1">待审核</li>
                <li class="dBox" data-item="2">驳回</li>
                <li class="dBox" data-item="3">通过</li>
                <li class="dBox" data-item="4">经营中</li>
                <li class="dBox" data-item="5">审核中</li>
                <li class="dBox" data-item="6">已停业</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show table1">
                    <table class="demo0"  lay-filter="test" ></table>
                </div>
                <div class="layui-tab-item layui-show">
                    <table class="demo1"  lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table  class="demo2" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table class="demo3" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table class="demo4" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table class="demo5" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">
                    <table class="demo6" lay-filter="test"></table>
                </div>
            </div>
        </div>
 

    </div>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="" style="margin-top: 14px;" href="/admin/shop/check">审核</a>
    </script>

    <!-- 审核状态 -->
    <script type="text/html" id="barDemo1">
        {{#  if(d.check == 1){ }}
            <div style="color:green">通过</div>
        {{#  } else if(d.check == -1){ }}
        <div style="color:red">驳回</div>
        {{#  } else if(d.check == 0){ }}
        <div >待审核</div>
        {{#  } }}
    </script>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['table','form','element'], function(){
        var element = layui.element
            table = layui.table
            form = layui.form
            $ = layui.$;



        $.ajax({
            url:"<?php echo e(url('admin/shop/index')); ?>",
            type:"POST",
            dataType:"json",
            data:{"_token":"<?php echo e(csrf_token()); ?>"},
            success:function (data) {
                console.log(data)
                if(data.status == 1){
                    var data = data.data;
                    //第一个实例
                    table.render({
                        elem: '.demo1'
                        ,limit:10
                        ,width:1189
                        ,id:'tableOne'
                        ,page: true
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
                            ,{field: 'action', title: '操作', width: 180 , align:'center' , templet: function(d){
                                return `<a class="layui-btn layui-btn-xs" lay-event="" style="margin-top: 14px;" href="/admin/shop/audit/${d.id}" >审核</a> `;
                            }}
                        ]]
                        ,data:data
                    });
                }
            },
            error:function (data) {
                console.log("错误");
            }
        });


        $(".dBox").click(function () {
            var index = $(this).attr("data-item");
            $.ajax({
                url:"<?php echo e(url('admin/shop/show')); ?>",
                type:"POST",
                dataType:"json",
                data:{"_token":"<?php echo e(csrf_token()); ?>","index":index},
                success:function (data) {
                    console.log(data)
                    if(data.status == 1){
                        var data = data.data;
                        //第一个实例
                        table.render({
                            elem: `.demo${index}`
                            ,limit:10
                            ,page: true
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
                                ,{field: 'action', title: '操作', width: 180 , align:'center' , templet: function(d){
                                    return `<a class="layui-btn layui-btn-xs" lay-event="" style="margin-top: 14px;" href="/admin/shop/audit/${d.id}" >审核</a>`;
                                }}
                            ]]
                            ,data:data
                        });

                    }
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

        form.verify({
            item:function (value,item) {
                var ret = /^[\u4E00-\u9FA5]{2,}$/;
                console.log(ret.test(value));
                if(value!="" && !ret.test(value)){
                    return '至少输入两个汉字';
                }
            }
        });

        //监听提交
        form.on('submit(formDemo)', function(data){
            var shop_name = data.field.shop_name;
            var functionary = data.field.functionary;
            var phone = data.field.phone;
            var goods_type_name = data.field.goods_type_name;
            table.reload('tableOne', {
                url:'<?php echo e(url('admin/shop/search')); ?>',
                method: 'post'
                , where: {
                    "_token":"<?php echo e(csrf_token()); ?>",
                    "shop_name":shop_name,
                    "functionary":functionary,
                    "phone":phone,
                    "goods_type_name":goods_type_name
                }

            });
            return false;

        });
    
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>