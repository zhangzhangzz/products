<link rel="stylesheet" href="<?php echo e(asset('css/after.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main" >
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">待处理</li>
                <li>已处理</li>
                <li>已完成</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <table id="demo1" lay-filter="test"></table>
                </div>
                <div class="layui-tab-item">内容2</div>
                <div class="layui-tab-item">内容3</div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    layui.use(['element','table'], function(){
        var element = layui.element
        ,table = layui.table;
        

        var data1 = [
            {orderid:1,goodsname:'五常大米',realpay:'8.8',time:'1553654760',status:1,
                custname:'丑八怪',custphone:'13122225555',custaddress:'黑龙江省齐齐哈尔市龙沙区xxxxxxxxxxxxxxxx',refundtype:1,action:'-'},
            {orderid:1,goodsname:'五常大米',realpay:'8.8',time:'1553654760',status:2,
                custname:'丑八怪',custphone:'13122225555',custaddress:'黑龙江省齐齐哈尔市龙沙区xxxxxxxxxxxxxxxx',refundtype:2,action:'-'},
            {orderid:1,goodsname:'五常大米',realpay:'8.8',time:'1553654760',status:3,
                custname:'丑八怪',custphone:'13122225555',custaddress:'黑龙江省齐齐哈尔市龙沙区xxxxxxxxxxxxxxxx',refundtype:3,action:'-'}
        ];

            

        //第一个实例
        table.render({
            elem: '#demo1'
            ,cols: [[ //表头
            {field: 'orderid', title: '订单编号',  sort: true, fixed: 'left', align:'center'}
            ,{field: 'goodsname', title: '商品名称', align:'center' }
            ,{field: 'realpay', title: '实付金额', align:'center'}
            ,{field: 'time', title: '下单时间', align:'center'}
            ,{field: 'status', title: '订单状态', align:'center', templet : function(d){
                        if(d.status==1){
                            return "仅退款";
                        }else if(d.status==2){
                            return "退货退款";
                        }else if(d.status==3){
                            return "仅退货（换）";
                        }
                    }}
            ,{field: 'custname', title: '收货人姓名', align:'center'}
            ,{field: 'custphone', title: '收货人手机号', align:'center'}
            ,{field: 'custaddress', title: '收货人地址', align:'center'}
            ,{field: 'refundtype', title: '退款原因', align:'center' , templet : function(d){
                        if(d.refundtype==1){
                            return "商品质量问题";
                        }else if(d.refundtype==2){
                            return "错拍/多拍/不想要";
                        }else if(d.refundtype==3){
                            return "换货";
                        }
                    }}
            ,{field: 'action', title: '操作' , align:'center', templet : function(d){
                        if(d.status==1){
                            return "<button class='layui-btn layui-btn-primary'>查看详情</button>";
                        }else if(d.status==2){
                            return "<button class='layui-btn layui-btn-primary' style='color:red'>已驳回</button>";
                        }else if(d.status==3){
                            return "<button class='layui-btn layui-btn-primary' style='color:green'>已同意</button>";
                        }
                    }}
            ]]
            ,data:data1
        });
        //…
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>