会员详情页面
<link rel="stylesheet" href="<?php echo e(asset('css/user_look.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main" >
        <div style="padding:30px;">
            <div class="titleBox">
                <div>基本信息</div>
            </div>
            <div class="mainBox">
               
                <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;">
                    <legend>收货人信息</legend>
                    <div>
                        <div class="layui-form-item" >
                            <label class="layui-form-label zlabel">收货人姓名：</label>
                            <label class="layui-form-label zlabel">张三</label>
                        </div>
                        <div class="layui-form-item" >
                            <label class="layui-form-label zlabel">收货人手机号：</label>
                            <label class="layui-form-label zlabel">13333333333</label>
                        </div>
                        <div class="layui-form-item" >
                            <label class="layui-form-label zlabel">收货人地址：</label>
                            <label class="layui-form-label zlabel">黑龙江省齐齐哈尔市龙沙区金斗科技园电商楼346</label>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;">
                    <legend>备注信息</legend>
                    <div class="layui-form-item" >
                        <label class="layui-form-label zlabel">买家备注：</label>
                        <label class="layui-form-label zlabel">无</label>
                    </div>
                </fieldset>
                <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;">
                    <legend>商品清单</legend>
                    <div class="layui-form-item" style="padding:20px;">
                        <table id="demo1" lay-filter="test"></table>
                        <div class="summary">
                            <div>
                                <div>商品金额：</div>
                                <div>30.00</div>
                            </div>
                            <div>
                                <div>运&emsp;&emsp;费：</div>
                                <div>10.00</div>
                            </div>
                            <div>
                                <div>优惠金额：</div>
                                <div>0.00</div>
                            </div>
                            <div>
                                <div>实付金额：</div>
                                <div>40.00</div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        layui.use('table', function(){
            var table = layui.table
            ,$ = layui.$;

            var data = [
                {img:"<?php echo e(asset('image/logo.png')); ?>",goodsname:'五常大米',price:'9.99',count:88,pay:'8.8',paytype:1,status:0},
                {img:"<?php echo e(asset('image/logo.png')); ?>",goodsname:'五常大米',price:'9.99',count:88,pay:'8.8',paytype:2,status:1}
            ];

            //第一个实例
            table.render({
                elem: '#demo1'
                ,cols: [[ //表头
                {field: 'img', title: '商品图片', align:'center', templet : function(d){
                            return `<img src=${d.img}>`;
                        }}
                ,{field: 'goodsname', title: '商品名称', align:'center' }
                ,{field: 'price', title: '单价',  sort: true, align:'center'}
                ,{field: 'count', title: '数量', align:'center' } 
                ,{field: 'pay', title: '合计金额', align:'center'}
                ,{field: 'paytype', title: '支付方式', align:'center', templet : function(d){
                            if(d.paytype==1){
                                return "<div>微信</div>";
                            }else if(d.paytype==2){
                                return "<div>支付宝</div>";
                            }
                        }}
                ,{field: 'status', title: '订单状态', align:'center', templet : function(d){
                            if(d.status==0){
                                return "<div>待发货</div>";
                            }else if(d.status==1){
                                return "<div>已发货</div>";
                            }
                        }}
                ]]
                ,data:data
            });

           
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>