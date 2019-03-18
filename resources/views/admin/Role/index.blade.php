@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/action.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                    <button class="layui-btn addUser" onclick="userAction();">添加</button>
                </div>
                <div class="topBox">
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">店铺名称 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="account" lay-verify="required" placeholder="" autocomplete="off" class="layui-input account">
                        </div>
                    </div>
        
                    <div class="layui-form-item">
                        <label class="layui-form-label iBox">手机号 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="phone" lay-verify="required" placeholder="" autocomplete="off" class="layui-input phone">
                        </div>
                    </div>
                    <button class="layui-btn layui-btn-sm selectBtn" style="margin:20px 30px;">查询</button>                    
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
        } else if(layEvent === 'edit'){ // #数据修改
            //do something
            console.log("修改"+tdata.account);

            var dlist = userAction(tdata);
            
            console.log(dlist+"---");
            //同步更新缓存对应的值
            obj.update(dlist);
        }

        
        });
        
        
        



    });

    function userAction(tdata=""){   
        let html = `<div class="layui-form-item">
                        <div style="float:left;color:red;line-height: 38px;">*</div>
                        <label class="layui-form-label iBox">账&emsp;&emsp;号 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="addAccount" lay-verify="required" placeholder="" autocomplete="off" class="layui-input addAccount">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div style="float:left;color:red;line-height: 38px;">*</div>
                        <label class="layui-form-label iBox">店铺名称 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="addShopName" lay-verify="required" placeholder="" autocomplete="off" class="layui-input addShopName">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div style="float:left;color:red;line-height: 38px;">*</div>
                        <label class="layui-form-label iBox">部&emsp;&emsp;门 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="addPartment" lay-verify="required" placeholder="" autocomplete="off" class="layui-input addPartment">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div style="float:left;color:red;line-height: 38px;">*</div>
                        <label class="layui-form-label iBox">姓&emsp;&emsp;名 ：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="addName" lay-verify="required" placeholder="" autocomplete="off" class="layui-input addName">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div style="float:left;color:red;line-height: 38px;">*</div>
                        <label class="layui-form-label iBox">密&emsp;&emsp;码 ：</label>
                        <div class="layui-input-inline">
                        <input type="password" name="addPwd" lay-verify="required" placeholder="" autocomplete="off" class="layui-input addPwd">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div style="float:left;color:red;line-height: 38px;">*</div>
                        <label class="layui-form-label iBox">确认密码 ：</label>
                        <div class="layui-input-inline">
                        <input type="password" name="addCheckpwd" lay-verify="required" placeholder="" autocomplete="off" class="layui-input addCheckpwd">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div style="float:left;color:red;line-height: 38px;">*</div>
                        <label class="layui-form-label iBox">角&emsp;&emsp;色 ：</label>
                        <select class="addRole" style="height:30px;margin:4px 0;">
                            <option value ="1">1</option>
                            <option value ="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="layui-form-item">
                        <div style="float:left;color:red;line-height: 38px;">*</div>
                        <label class="layui-form-label iBox">登录权限 ：</label>
                        <select class="addRoot" style="height:30px;margin:4px 0;">
                            <option value ="1">启用</option>
                            <option value ="0">禁用</option>
                        </select>
                    </div>`;
                    
        layer.open({
            type: 0,
            content: html ,//html //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
            btn: ['确定', '重置'],
            success: function(layero, index){
                if(tdata==""){
                    console.log("添加");
                }else{
                    //查询？？？
                    
                    $(".addAccount").attr("value",tdata.account);    
                    $(".addShopName").attr("value",tdata.shopName);
                    $(".addPartment").attr("value",tdata.partment);
                    $(".addName").attr("value",tdata.name);
                    //$(".addPwd").attr("value",tdata.shopName);
                    $(".addRole").attr("value",tdata.role);
                    $(".addRoot").attr("value",tdata.login);
                    

                }
                
            },
            yes: function(index, layero){
                //do something
                var addAccount = $(".addAccount").val();
                var addShopName = $(".addShopName").val();
                var addPartment = $(".addPartment").val();
                var addName = $(".addName").val();
                var addPwd = $(".addPwd").val();
                var addCheckpwd = $(".addCheckpwd").val();
                var addRole = $(".addRole").val();
                var addRoot = $(".addRoot").val();

                if(addAccount==""){
                    alert("请输入账号");
                    return false;
                }else if(addShopName==""){
                    alert("请输入店铺名称"); 
                    return false;
                }else if(addPartment==""){
                    alert("请输入部门"); 
                    return false;
                }else if(addName==""){
                    alert("请输入姓名"); 
                    return false;
                }else if(addPwd==""){
                    alert("请输入密码"); 
                    return false;
                }else if(addCheckpwd==""){
                    alert("请确认密码"); 
                    return false;
                }else if(addPwd!=addCheckpwd){
                    alert("两次密码不一致，请重新输入"); 
                    return false;
                }

                
                var dataobj = {
                        account:addAccount,
                        shopName:addShopName,
                        name:addName,
                        partment:addPartment,
                        role:addRole,
                        login:addRoot
                    };
                if(tdata != ""){
                    console.log(tdata != "");
                    return dataobj;
                }

                // $.post("",dataobj,function(data){
                    
                // });


                console.log(addAccount+"=="+addShopName+"=="+addPartment+"=="+addName+"=="+addPwd+"=="+addCheckpwd+"=="+addRole+"=="+addRoot);
                layer.close(index); //如果设定了yes回调，需进行手工关闭
            }
            ,btn2: function(index, layero){
                //按钮【按钮二】的回调
                console.log("重置");
                $(".addAccount").val("");
                $(".addShopName").val("");
                $(".addPartment").val("");
                $(".addName").val("");
                $(".addPwd").val("");
                $(".addCheckpwd").val("");
                $(".addRole").val("1");
                $(".addRoot").val("0");
                return false;
            }
        });
    };

    $(".selectBtn").click(function(){
        var account = $(".account").val();
        var phone = $(".phone").val();
        if(account =="" && phone ==""){1
            alert("至少输入一个查询条件");
            return false;
        }


       

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

        $.post("",{
            account:account,
            phone:phone
            },function(data){

            });

    });
   

    
 </script>
@endsection