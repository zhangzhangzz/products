<link rel="stylesheet" href="<?php echo e(asset('css/goods.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main" > 

        <form class="layui-form form" action="">
            <div class="layui-form-item" style="">
                <label class="layui-form-label" style="width:auto;">产品名称或ID：</label>
                <div class="layui-input-inline">
                    <input type="text" name="product" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品分类</label>
                <div class="layui-input-block">
                    <select name="proclass" lay-verify="required">
                        <option value="0">北京</option>
                        <option value="1">上海</option>
                        <option value="2">广州</option>
                        <option value="3">深圳</option>
                        <option value="4">杭州</option>
                    </select>
                </div>
                </div>
            <button class="layui-btn" lay-submit lay-filter="formDemo" style="margin-left:20px;">查询</button>
        </form>
        
        <div class="layui-tab bigbox">
            <ul class="layui-tab-title">
                <li class="layui-this">待审核</li>
                <li>上架中</li>
                <li>已失效</li>
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
            </div>
        </div>
 

    </div>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >查看</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

    <!-- 商品状态 -->
    <script type="text/html" id="barDemo1">
        {{#  if(d.status == 1){ }}
            <div style="color:green">上架中</div>
        {{#  } else if(d.status == -1){ }}
        <div style="color:red">已失效</div>
        {{#  } else if(d.status == 0){ }}
        <div style="color:red">待审核</div>
        {{#  } }}
    </script>

    <!-- 审核状态 -->
    <script type="text/html" id="barDemo2">
       <img src="{{d.img}}" alt="">
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['table','form','element'], function(){
        var element = layui.element
            table = layui.table
            form = layui.form;


        var data = [
                {shopName:"意国小镇",classify:"大米",img:"<?php echo e(asset('image/1.jpg')); ?>",title:'肇州小米',price:'9.9',stock:999,sale:999,
                    msale:188,createtime:'2019-01-01',status:1,action:'-'},
                {shopName:"意国小镇",classify:"大米",img:"<?php echo e(asset('image/logo.png')); ?>",title:'肇州小米',price:'9.9',stock:999,sale:999,
                    msale:188,createtime:'2019-01-01',status:0,action:'-'},
                {shopName:"意国小镇",classify:"大米",img:"<?php echo e(asset('image/1.jpg')); ?>",title:'肇州小米',price:'9.9',stock:999,sale:999,
                    msale:188,createtime:'2019-01-01',status:-1,action:'-'},
                    ];               
                    
    
        //第一个实例
        table.render({
            elem: '#demo'
            ,limit:999999
            ,cols: [[ //表头
            {field: 'shopName', title: '店铺名称', width:150,  fixed: 'left' , align:'center'}
            ,{field: 'classify', title: '商品分类' , width:150 , align:'center'}
            ,{field: 'img', title: '商品图片' , width:150 , align:'center' , toolbar: '#barDemo2'}
            ,{field: 'title', title: '标题', width:130 , align:'center'} 
            ,{field: 'price', title: '价格', width: 140 , align:'center' ,sort:true}
            ,{field: 'stock', title: '库存', width: 140,  align:'center' , sort:true}
            ,{field: 'sale', title: '总销量', width: 140,  align:'center' , sort:true}
            ,{field: 'msale', title: '月销量', width: 140,  align:'center' , sort:true}
            ,{field: 'createtime', title: '创建时间', width: 140,  align:'center' , sort:true}
            ,{field: 'status', title: '商品状态', width: 140,  align:'center' , toolbar: '#barDemo1'}
            ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
            ]]
            ,data:data
        });


        //第二个实例
        table.render({
            elem: '#demo2'
            ,limit:999999
            ,width:1189
            ,cols: [[ //表头
            {field: 'shopName', title: '店铺名称', width:150,  fixed: 'left' , align:'center'}
            ,{field: 'classify', title: '商品分类' , width:150 , align:'center'}
            ,{field: 'img', title: '商品图片' , width:150 , align:'center' , toolbar: '#barDemo2'}
            ,{field: 'title', title: '标题', width:130 , align:'center'} 
            ,{field: 'price', title: '价格', width: 140 , align:'center' ,sort:true}
            ,{field: 'stock', title: '库存', width: 140,  align:'center' , sort:true}
            ,{field: 'sale', title: '总销量', width: 140,  align:'center' , sort:true}
            ,{field: 'msale', title: '月销量', width: 140,  align:'center' , sort:true}
            ,{field: 'createtime', title: '创建时间', width: 140,  align:'center' , sort:true}
            ,{field: 'status', title: '商品状态', width: 140,  align:'center' , toolbar: '#barDemo1'}
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>