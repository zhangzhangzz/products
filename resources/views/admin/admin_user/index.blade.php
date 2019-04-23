@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/action.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                    <button class="layui-btn addUser" onclick="addRole();">添加</button>
                </div>
                <div class="topBox">
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">店铺名称 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="shopname" lay-verify="required" required  placeholder="" autocomplete="off" class="layui-input account">
                        </div>
                    </div>
        
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">手机号 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="phone" lay-verify="required" required placeholder="" autocomplete="off" class="layui-input phone">
                        </div>
                    </div>
                    <button class="layui-btn layui-btn-sm selectBtn" style="margin:20px 30px;" lay-filter="formDemo">查询</button>                    
                </div>

                <table id="demo" lay-filter="test"></table>

        </div>  

        

        

        <script type="text/html" id="titleTpl">
            @{{#  if(d.login ==1 ){ }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                    <input type="checkbox" checked lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                    </div>
                </div>
            @{{#  } else { }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                    <input type="checkbox" lay-skin="switch" lay-filter="filter" data-id="@{{ d.id }}">
                    </div>
                </div>
            @{{#  } }}
        </script>


    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

   

    
    
      
@endsection

@section('js')
 <script>

     function addRole(){
         window.location.href="/admin/admin_user/save";
     }


     layui.use(['table','form'], function(id=""){
        var table = layui.table
        ,form = layui.form
        ,$ = layui.$;

        // #登录权限事件
        
        form.on('switch(filter)', function(data){
            var flag = data.elem.checked;
            var id =$(data.elem).data("id");
            if(flag){
                var btnTag = 1;
            }else{
                var btnTag = 0;
            }
//             $.get("/admin/role/state/"+ id + "/" + btnTag,{
            $.get("/admin/admin_user/state/"+ id + "/" + btnTag,{
            },function(res){
                if(res==1)
                {
                    data.elem.checked = !flag;
                }else{
                    data.elem.checked = !flag;
                    form.render();
                }
            });
                
                

            }); 


         var list = <?php echo $list; ?>;
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
            table.render({
                    elem: '#demo'
                    ,limit:999999
                    ,cols: [[ //表头
                        {field: 'id', title: 'ID',  sort: true, fixed: 'left' , align:'center'}
                        ,{field: 'account', title: '账号' ,  align:'center'}
                        ,{field: 'shopname', title: '店铺名称' ,  align:'center'}
                        ,{field: 'name', title: '姓名',  align:'center'}
                        ,{field: 'partment', title: '部门', align:'center'}
                        ,{field: 'role_name', title: '角色',  align:'center'}
                        ,{field: 'time', title: '创建时间', sort: true , align:'center' ,templet : "<div>@{{layui.util.toDateString(d.time*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>"}
                        ,{field: 'login', title: '登录权限',  align:'center' , templet: '#titleTpl'}
                        ,{field: 'action', title: '操作',  align:'center' , templet: function(d){
                            if(d.role_name=="商户"){
                                return '<a class="layui-btn layui-btn-xs  layui-btn-disabled" >编辑</a><a class="layui-btn  layui-btn-disabled layui-btn-xs">删除</a>';
                            }else{
                                return '<a class="layui-btn layui-btn-xs " lay-event="edit" >编辑</a><a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>';
                            }
                        }}
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

                    table.render({
                        elem: '#demo'
                        ,limit:999999
                        ,cols: [[ //表头
                            {field: 'id', title: 'ID', sort: true, fixed: 'left' , align:'center'}
                            ,{field: 'account', title: '账号'  , align:'center'}
                            ,{field: 'shopName', title: '店铺名称'  , align:'center'}
                            ,{field: 'name', title: '姓名',  align:'center'}
                            ,{field: 'partment', title: '部门',  align:'center'}
                            ,{field: 'role', title: '角色', align:'center'}
                            ,{field: 'creatdate', title: '创建时间',  sort: true , align:'center',templet : "<div>@{{layui.util.toDateString(d.creatdate, 'yyyy-MM-dd HH:mm:ss')}}</div>"
                }
                            ,{field: 'login', title: '登录权限',  align:'center' , templet: '#titleTpl'}
                            ,{field: 'action', title: '操作',  align:'center', templet: function(d){
                                if(d.role_name=="商户"){
                                    return '<a class="layui-btn layui-btn-xs  layui-btn-disabled" >编辑</a><a class="layui-btn  layui-btn-disabled layui-btn-xs">删除</a>';
                                }else{
                                    return '<a class="layui-btn layui-btn-xs" lay-event="edit" >编辑</a><a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>';
                                }
                            }}
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
            if(layEvent === 'del'){ //删除
                layer.confirm('真的删除行么', function(index){
                    //向服务端发送删除指令
                    $.get("/admin/admin_user/del/"+tdata.id,{

                    },function(data){
                        if(data == 1)
                        {
                            obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        }else{
                            alert("删除失败");
                        }

                        layer.close(index);
                    });

               
                });
            }else if(layEvent === 'edit'){
                window.location.href="/admin/admin_user/edit/"+tdata.id;
            }
        });
        
    });

   

    
 </script>
@endsection