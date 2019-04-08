<link rel="stylesheet" href="<?php echo e(asset('css/setting.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="padding:30px;">
            <div class="titleBox">
                <div>费率设置</div>
            </div>
            <div class="mainBox">
                <button class="layui-btn addrule" style="float:right;" >添加</button> 
                <table id="demo" lay-filter="test" style="margin-top:48px;"></table>
            </div>
        </div>
    </div>  

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['table','layer'], function(id=""){
            var table = layui.table
            ,layer = layui.layer
            ,$ = layui.$;

            $(".addrule").click(function(){
                layer.open({
                title:false,
                type: 1, 
                content: `<div class="motai">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="text-align:center;">一级类目</label>
                                <select name="city" class="slist">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label" style="text-align:center;">二级类目</label>
                                <select name="city" class="slist">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label" style="text-align:center;">费率</label>
                                <div class="layui-input-inline" style="width:100px;">
                                    <input type="text" name="rmbPercent" required lay-verify="required" placeholder="请输入费率" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>`,
                        btn: ['提交', '取消'],
                        yes: function(index, layero){
                                //do something

                                layer.close(index); //如果设定了yes回调，需进行手工关闭
                            },
                            btn2: function(index, layero){
                                layer.close(index);
                            }
                        
                });

            });
            
            $.ajax({
                url:"<?php echo e(url('admin/setting/index')); ?>",
                type:"POST",
                dataType:"json",
                data:{"_token":"<?php echo e(csrf_token()); ?>"},
                success:function (data) {
                    console.log(data);
                    if(data.status == 1){
                        var category = data.category;
                        var category_data = data.category_data;
                    }
                    table.render({
                        elem: '#demo'
                        ,limit:999999
                        ,cols: [[ //表头
                            {field: 'one', title: '一级类目',   align:'center'}
                            ,{field: 'two', title: '二级类目' ,  align:'center'}
                            ,{field: 'rmbPercent', title: '费率' ,  align:'center'}
                            ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
                        ]]
                        ,data:data
                    });
                },
                error:function (data) {
                    console.log("错误");
                }
            });

                

            //第一个实例

            
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