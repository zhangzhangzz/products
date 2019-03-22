<link rel="stylesheet" href="<?php echo e(asset('css/goodsmanage.css')); ?>">
<?php $__env->startSection('content'); ?>
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
                        <li class="layui-this">出售中</li>
                        <li>已售罄</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <table id="demo" lay-filter="test"  class="tableBox"></table>
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

    <script type="text/html" id="imgDemo">
        <img src="{{d.img}}" >
    </script>

    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    layui.use(['table','element'], function(id=""){
        var table = layui.table
        ,element = layui.element
        ,$ = layui.$;

        $(".addgoods").click(function(){
            window.location.href="/admin/goods/add";

        });
        

        var data = [
        {img:'<?php echo e(asset('image/logo.png')); ?>',title:'这是中央人民广播电视台',price:'5.00',stock: 999, sale: 999, monsale: 999, createdate:'2019-01-01' , action:'-'},
        {img:'<?php echo e(asset('image/logo.png')); ?>',title:'这是中央人民广播电视台',price:'5.00',stock: 999, sale: 999, monsale: 999, createdate:'2019-01-01' , action:'-'},
        {img:'<?php echo e(asset('image/logo.png')); ?>',title:'这是中央人民广播电视台',price:'5.00',stock: 999, sale: 999, monsale: 999, createdate:'2019-01-01' , action:'-'}
            ];               
            

        //第一个实例
        table.render({
            elem: '#demo'
            ,limit:999999
            ,cols: [[ //表头
            {field: 'img', title: '图片',   align:'center' , toolbar: '#imgDemo'}
            ,{field: 'title', title: '标题' ,  align:'center'}
            ,{field: 'price', title: '价格' ,  align:'center'}
            ,{field: 'stock', title: '库存' ,  align:'center'}
            ,{field: 'sale', title: '总销量' ,  align:'center'}
            ,{field: 'monsale', title: '月销量' ,  align:'center'}
            ,{field: 'createdate', title: '创建时间' ,  align:'center'}
            ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
            ]]
            ,data:data
        });

        //第一个实例
        table.render({
            elem: '#demo2'
            ,limit:999999
            ,cols: [[ //表头
            {field: 'img', title: '图片',   align:'center' , toolbar: '#imgDemo'}
            ,{field: 'title', title: '标题' ,  align:'center'}
            ,{field: 'price', title: '价格' ,  align:'center'}
            ,{field: 'stock', title: '库存' ,  align:'center'}
            ,{field: 'sale', title: '总销量' ,  align:'center'}
            ,{field: 'monsale', title: '月销量' ,  align:'center'}
            ,{field: 'createdate', title: '创建时间' ,  align:'center'}
            ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
            ]]
            ,data:data
        });
        
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>