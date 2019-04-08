@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/action.css') }}">
@section('content')
<<<<<<< HEAD
    <div>
        <ul>
            <li>{{ session('errors') }}</li>
        </ul>
    </div>
=======
    @if(session('errors'))
        <div class="errors">
            <h3>警告</h3>
            <br/>
            {{ session('errors') }}
            <br/>
        </div>
    @endif
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                    <button class="layui-btn addUser" onclick="addRole();">添加</button>
                </div>
                

                <table id="demo" lay-filter="test"></table>
        </div>


        <script type="textml" id="titleTpl">
            @{{#  if(d.state ==1 ){ }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                        <input type="checkbox" checked lay-skin="switch" lay-filter="filter" data-id=@{{ d.id }}>
                    </div>
                </div>
            @{{#  } else { }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                        <input type="checkbox" lay-skin="switch" lay-filter="filter" data-id=@{{ d.id }}>
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
         window.location.href="/admin/role/save";
     }


     layui.use(['table','form','laytpl'], function(){
        var table = layui.table
            ,form = layui.form
            ,laytpl = layui.laytpl
            ,$ = layui.$;

         form.render();

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
<<<<<<< HEAD
        console.log(data);
=======
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
         //第一个实例
         table.render({
             elem: '#demo'
             ,limit:999999
             ,cols: [[ //表头
                 {field: 'name', title: '角色名称',  sort: true, fixed: 'left' , align:'center'}
                 ,{field: 'descript', title: '角色描述' , align:'center'}
                 ,{field: 'boss', title: '上级名称' ,  align:'center'}
                 ,{field: 'state', title: '状态',  align:'center' ,  templet: '#titleTpl'}
                 ,{field: 'action', title: '操作',  align:'center' , toolbar: '#barDemo'}
             ]]
             ,data:data
         });

         // #table操作事件
         table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
             let tdata = obj.data; //获得当前行数据
             var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
             var tr = obj.tr; //获得当前行 tr 的DOM对象
<<<<<<< HEAD
             console.log(tdata);
=======
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
             da = obj.data;

             // #数据删除

             if(layEvent === 'del'){ //删除
                 layer.confirm('真的删除行么', function(index){
                     //            obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                     layer.close(index);
                     //向服务端发送删除指令
                     //            console.log("删除");

                     $.get("/admin/role/del/"+tdata.id,{

                     },function(data){
                         if(data == 1)
                         {
                             obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                         }else{
                             alert("删除失败");
                         }
                     });

                 });
             } else if(layEvent === 'edit'){
                 window.location.href="/admin/role/edit/"+tdata.id;
             }
         });

        // #登录权限事件

         form.on('switch(filter)', function(data){
             var flag = data.elem.checked;
             var id =$(data.elem).data("id");
             if(flag){
                 var btnTag = 1;
             }else{
                 var btnTag = 0;
             }
<<<<<<< HEAD
             $.get("/admin/role/state/"+ id + "/" + btnTag,{
             },function(res){
                 if(res==1)
                 {
                    // data.elem.checked = !flag;
                     console.log("here");
                 }else{
                     console.log(btnTag+"---"+flag);
                     data.elem.checked = !flag;
                     form.render();
                     console.log("t");

=======
//             $.get("/admin/role/state/"+ id + "/" + btnTag,{
             $.get("/admin/role/state/"+ id + "/" + btnTag,{
             },function(res){
                 console.log(res);
                 if(res==1)
                 {
                     data.elem.checked = !flag;
                 }else{
                     data.elem.checked = !flag;
                     form.render();
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200
                 }
             });

         });
    });



 
 </script>
@endsection