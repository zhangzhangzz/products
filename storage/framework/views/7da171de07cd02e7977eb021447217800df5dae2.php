<link rel="stylesheet" href="<?php echo e(asset('css/action.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                    <button class="layui-btn addUser" onclick="addRole();">添加</button>
                </div>
                <div class="topBox">
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">店铺名称 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="account" lay-verify="required" required  placeholder="" autocomplete="off" class="layui-input account">
                        </div>
                    </div>
        
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">手机号 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="phone" lay-verify="required" required placeholder="" autocomplete="off" class="layui-input phone">
                        </div>
                    </div>
                    <button class="layui-btn layui-btn-sm selectBtn" style="margin:20px 30px;" lay-submit lay-filter="formDemo1">查询</button>                    
                </div>

                <table id="demo" lay-filter="test"></table>

        </div>  

        <div class="layui-form-item">
    <label class="layui-form-label">输入框</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码框</label>
    <div class="layui-input-inline">
      <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">辅助文字</div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">选择框</label>
    <div class="layui-input-block">
      <select name="city" lay-verify="required">
        <option value=""></option>
        <option value="0">北京</option>
        <option value="1">上海</option>
        <option value="2">广州</option>
        <option value="3">深圳</option>
        <option value="4">杭州</option>
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">复选框</label>
    <div class="layui-input-block">
      <input type="checkbox" name="like[write]" title="写作">
      <input type="checkbox" name="like[read]" title="阅读" checked>
      <input type="checkbox" name="like[dai]" title="发呆">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">开关</label>
    <div class="layui-input-block">
      <input type="checkbox" name="switch" lay-skin="switch">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">单选框</label>
    <div class="layui-input-block">
      <input type="radio" name="sex" value="男" title="男">
      <input type="radio" name="sex" value="女" title="女" checked>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">文本域</label>
    <div class="layui-input-block">
      <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>

        

        <script type="text/html" id="titleTpl">
            {{#  if(d.login ==1 ){ }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                    <input type="checkbox" checked lay-skin="switch" lay-filter="filter" data-id="{{ d.id }}">
                    </div>
                </div>
            {{#  } else { }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                    <input type="checkbox" lay-skin="switch" lay-filter="filter" data-id="{{ d.id }}">
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
         window.location.href="/admin/admin/add"; 
     }


     layui.use(['table','form'], function(id=""){
        var table = layui.table
        form = layui.form;

        // #登录权限事件
        
        form.on('switch(filter)', function(data){
            var flag = data.elem.checked;
            var id = $(data.elem).data("id");
                console.log(data.elem.checked); //开关是否开启，true或者false
                console.log(data.elem); //得到checkbox原始DOM对象
                console.log($(data.elem).data("id"));
                if(flag){
                    var btnTag = 1;
                }else{
                    var btnTag = 0;
                }
                
                $.post("",{
                    id:id
                    },function(res){

<<<<<<< HEAD
            }); 

            var data = [
            {id:1,account:88888888,shopName:'桂香私厨',name:'1',partment:'入驻商',role:'管理员',creatdate:'1553654760',login:1,action:'-'},
            {id:2,account:88888888,shopName:'桂香私厨',name:'2',partment:'入驻商',role:'管理员',creatdate:'1553654760',login:0,action:'-'}
                ];


            table.render({
                    elem: '#demo'
                    ,limit:999999
                    ,width:1120
                    ,cols: [[ //表头
                        {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left' , align:'center'}
                        ,{field: 'account', title: '账号' , width:150 , align:'center'}
                        ,{field: 'shopName', title: '店铺名称' , width:150 , align:'center'}
                        ,{field: 'name', title: '姓名', width:100 , align:'center' ,templet : function(d){
                                if(d.name==1){
                                    return '香香1';
                                }else{
                                    return '吃屎2';
                                }
                            } }
                        ,{field: 'partment', title: '部门', width: 100 , align:'center'}
                        ,{field: 'role', title: '角色', width: 80 , align:'center'}  
                        ,{field: 'creatdate', title: '创建时间', width: 140, sort: true , align:'center' ,templet : "<div>{{layui.util.toDateString(d.creatdate*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>" }
                        ,{field: 'login', title: '登录权限', width: 130 , align:'center' , templet: '#titleTpl'}
                        ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
                    ]]
                    ,data:data
                });


                $(".selectBtn").click(function(){
                    var account = $(".account").val();
                    var phone = $(".phone").val();
                    if(account=="" && phone==""){
                        layer.msg('请至少输入一个查询条件');
                        return false; 
                    }

                    var data = [
                        {id:1,account:11111111,shopName:'222222',name:'香香3',partment:'入驻商',role:'管理员',creatdate:'2019-01-01',login:0,action:'-'},
                        {id:2,account:11111111,shopName:'333333',name:'香香4',partment:'入驻商',role:'管理员',creatdate:'2019-01-01',login:0,action:'-'}
                            ];


                    table.render({
                        elem: '#demo'
                        ,limit:999999
                        ,width:1120
                        ,cols: [[ //表头
                            {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left' , align:'center'}
                            ,{field: 'account', title: '账号' , width:150 , align:'center'}
                            ,{field: 'shopName', title: '店铺名称' , width:150 , align:'center'}
                            ,{field: 'name', title: '姓名', width:100 , align:'center'}
                            ,{field: 'partment', title: '部门', width: 100 , align:'center'}
                            ,{field: 'role', title: '角色', width: 80 , align:'center'}
                            ,{field: 'creatdate', title: '创建时间', width: 140, sort: true , align:'center'}
                            ,{field: 'login', title: '登录权限', width: 130 , align:'center' , templet: '#titleTpl'}
                            ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
                        ]]
                        ,data:data
=======
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
                    });

            }); 

        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });



        layui.use(['table','laytpl'], function(){
            var table = layui.table
            ,laytpl = layui.laytpl;

            
            var data = [
                {id:1,account:88888888,shopName:'桂香私厨',name:'香香1',partment:'入驻商',role:'管理员',creatdate:'2019-01-01',login:1,action:'-'},
                {id:2,account:88888888,shopName:'桂香私厨',name:'香香2',partment:'入驻商',role:'管理员',creatdate:'2019-01-01',login:0,action:'-'}
                    ];               
                    
    
            //第一个实例
            table.render({
                elem: '#demo'
                ,limit:999999
                ,width:1120
                ,cols: [[ //表头
                {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left' , align:'center'}
                ,{field: 'account', title: '账号' , width:150 , align:'center'}
                ,{field: 'shopName', title: '店铺名称' , width:150 , align:'center'}
                ,{field: 'name', title: '姓名', width:100 , align:'center'} 
                ,{field: 'partment', title: '部门', width: 100 , align:'center'}
                ,{field: 'role', title: '角色', width: 80 , align:'center'}
                ,{field: 'creatdate', title: '创建时间', width: 140, sort: true , align:'center'}
                ,{field: 'login', title: '登录权限', width: 130 , align:'center' , templet: '#titleTpl'}
                ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
                ]]
                ,data:data
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
                        id:id
                    },function(data){

                    });

                });
            } else if(layEvent === 'edit'){
                window.location.href="/admin/admin/add"; 
            }
        });
        
    });

    


    // $(".selectBtn").click(function(){
    //     var account = $(".account").val();
    //     var phone = $(".phone").val();
    //     if(account =="" && phone ==""){1
    //         alert("至少输入一个查询条件");
    //         return false;
    //     }



    // });
   

    
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>