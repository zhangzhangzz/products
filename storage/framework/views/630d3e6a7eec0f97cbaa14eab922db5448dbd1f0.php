<link rel="stylesheet" href="<?php echo e(asset('css/user.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main" >
        <div class="layui-tab bigbox">
            <ul class="layui-tab-title">
                <li class="layui-this">普通用户</li>
                <li>禁用用户</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <form class="layui-form form" action="">
                        <input type="text" name="name" required lay-verify="required" placeholder="昵称" autocomplete="off" class="layui-input">
                        <input type="text" name="phone" required lay-verify="required" placeholder="手机号" autocomplete="off" class="layui-input">
                        <input type="text" name="wxqq" required lay-verify="required" placeholder="微信/QQ" autocomplete="off" class="layui-input">
                        <input type="text" name="address" required lay-verify="required" placeholder="收货地址" autocomplete="off" class="layui-input">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">搜索</button>
                    </form>

                    <table id="demo" lay-filter="test"></table>

                </div>
                <div class="layui-tab-item">
                    <form class="layui-form form" action="">
                    <input type="text" name="name" required lay-verify="required" placeholder="昵称" autocomplete="off" class="layui-input">
                        <input type="text" name="phone" required lay-verify="required" placeholder="手机号" autocomplete="off" class="layui-input">
                        <input type="text" name="wxqq" required lay-verify="required" placeholder="微信/QQ" autocomplete="off" class="layui-input">
                        <input type="text" name="address" required lay-verify="required" placeholder="收货地址" autocomplete="off" class="layui-input">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">搜索</button>
                    </form>

                    <table id="demo2" lay-filter="test">

                    </table>
                </div>
            </div>
        </div>


    </div>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >详情</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">禁用</a>
    </script>

    <script type="text/html" id="headDemo">
        <img src="{{d.headimg}}" >
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['table','form','element'], function(){
        var element = layui.element
            table = layui.table
            form = layui.form;


        $.ajax({
            url: '<?php echo e(url("admin/user/index")); ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {"_token": "<?php echo e(csrf_token()); ?>"},
            success: function (data) {
                console.log(data);
                var data = data.data;
                //第一个实例
                table.render({
                    elem: '#demo'
                    , limit: 999999
                    , cols: [[ //表头
                        {
                            field: 'headimg',
                            title: '头像',
                            width: 150,
                            fixed: 'left',
                            align: 'center',
                            toolbar: '#headDemo'
                        }
                        , {field: 'name', title: '名称', width: 150, align: 'center'}
                        , {field: 'phone', title: '电话', width: 150, align: 'center'}
                        , {field: 'weixin_qq', title: '微信/QQ', width: 130, align: 'center'}
                        , {field: 'address', title: '地址', width: 300, align: 'center'}
                        , {field: 'create_time', title: '创建时间', width: 140, sort: true, align: 'center'}
                        , {field: 'action', title: '操作', width: 180, align: 'center', toolbar: '#barDemo'}
                    ]]
                    , data: data

                });
            },
            error: function (data) {
                console.log("错误");
            }
        });
        function timetrans(date){
            var date = new Date(date*1000);//如果date为13位不需要乘1000
            var Y = date.getFullYear() + '-';
            var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
            var D = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate()) + ' ';
            var h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
            var m = (date.getMinutes() <10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
            var s = (date.getSeconds() <10 ? '0' + date.getSeconds() : date.getSeconds());
            return Y+M+D+h+m+s;
        }


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

                $.ajax("",{
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