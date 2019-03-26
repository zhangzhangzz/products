@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/action.css') }}">
@section('content')
    <div>
        <ul>
            <li>{{ session('errors') }}</li>
        </ul>
    </div>
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                    <button class="layui-btn addUser" onclick="addRole();">添加</button>
                </div>
                

                <table id="demo" lay-filter="test"></table>

        </div>  

        

        <script type="text/html" id="titleTpl">
            @{{#  if(d.status ==1 ){ }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                        <input type="checkbox" checked lay-skin="switch" lay-filter="filter" >
                    </div>
                </div>
            @{{#  } else { }}
                <div class="layui-form-item">
                    <div class="layui-input-block swichBtn" >
                        <input type="checkbox" lay-skin="switch" lay-filter="filter" >
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
         window.location.href="/admin/menu/save";
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
//            obj.del(); //删除对应行（tr）的DOM结构，并更新缓存

            //向服务端发送删除指令
            $.get("/admin/menu/del/"+tdata.id,{

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
        } else if(layEvent === 'edit'){
            window.location.href="/admin/menu/edit/"+tdata.id;
        }
        });
    });

    layui.use(['table','laytpl'], function(){
        var table = layui.table
        ,laytpl = layui.laytpl;

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
        //第一个实例
        table.render({
            elem: '#demo'
            ,limit:999999
            ,width:666
            ,cols: [[ //表头
            {field: 'sort', title: '排序', width:80, sort: true, fixed: 'left' , align:'center'}
            ,{field: 'name', title: '名称' , width:150 , align:'center'}
            ,{field: 'url', title: '路径' , width:150 , align:'center'}
            ,{field: 'boss', title: '上级ID', width:100 , align:'center' }
            ,{field: 'action', title: '操作', width: 180 , align:'center' , toolbar: '#barDemo'}
            ]]
            ,data:data
        });
    });

 
 </script>
@endsection