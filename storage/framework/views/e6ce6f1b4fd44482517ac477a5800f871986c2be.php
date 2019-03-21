<link rel="stylesheet" href="<?php echo e(asset('css/action.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                    <button class="layui-btn addUser" onclick="addRole();">添加</button>
                </div>
                

                <table id="demo" lay-filter="test"></table>

        </div>  

        

        <script type="text/html" id="titleTpl">
            {{#  if(d.status ==1 ){ }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                        <input type="checkbox" checked lay-skin="switch" lay-filter="filter" >
                    </div>
                </div>
            {{#  } else { }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                        <input type="checkbox" lay-skin="switch" lay-filter="filter" >
                    </div>
                </div>
            {{#  } }}
        </script>


    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

   

    
    
      
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
 <script>

     function addRole(){
         window.location.href="/admin/role/edit";
     }


     layui.use(['table','form'], function(id=""){
        var table = layui.table
        form = layui.form;

        // #登录权限事件
        
        form.on('switch(filter)', function(data){
            var flag = data.elem.checked;
                console.log(data.elem.checked); //开关是否开启，true或者false
                console.log(data.elem); //得到checkbox原始DOM对象
                
                if(flag){
                    var btnTag = 1;
                }else{
                    var btnTag = 0;
                }
                
                $.post("",{
                    },function(res){

                    });

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
                
                },function(data){

                });

            });
        } else if(layEvent === 'edit'){
            window.location.href="/admin/role/edit";
        }
        });
    });

    layui.use(['table','laytpl'], function(){
        var table = layui.table
        ,laytpl = layui.laytpl;

        
        var data = [
            {name:'管理员',descript:'管理员1',boss:'香香是个大撒比',status:1,action:'-'},
            {name:'管理员',descript:'管理员1',boss:'香香',status:1,action:'-'},
            {name:'管理员',descript:'管理员1',boss:'香香',status:1,action:'-'},
            {name:'管理员',descript:'管理员1',boss:'香香',status:1,action:'-'},
            {name:'管理员',descript:'管理员1',boss:'香香',status:1,action:'-'},
            {name:'群众',descript:'群众2',boss:'香香2',status:1,action:'-'}
                ];               
                

        //第一个实例
        table.render({
            elem: '#demo'
            ,limit:999999
            ,width:666
            ,cols: [[ //表头
            {field: 'name', title: '角色名称', width:80, sort: true, fixed: 'left' , align:'center'}
            ,{field: 'descript', title: '角色描述' , width:150 , align:'center'}
            ,{field: 'boss', title: '上级名称' , width:150 , align:'center'}
            ,{field: 'status', title: '状态', width:100 , align:'center' ,  templet: '#titleTpl'} 
            ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
            ]]
            ,data:data
        });
    });

 
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>