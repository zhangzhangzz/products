<link rel="stylesheet" href="<?php echo e(asset('css/business_assess.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div>
        <ul>
            <li><?php echo e(session('errors')); ?></li>
        </ul>
    </div>
    <div class="main">
        <div style="padding:30px;">
            <div style="margin-bottom:15px;">
                <div style="border-radius: 2px;height: 38px;line-height: 38px;padding: 0 18px;background-color: #009688;color: #fff;text-align: center;display: inline-block">评价列表</div>
            </div>

            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this dBox" data-item="dcl">待处理</li>
                    <li class="dBox" data-item="qb">全部</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <table id="demo1" lay-filter="test"></table>
                    </div>
                    <div class="layui-tab-item">
                        <table id="demo2" lay-filter="test"></table>
                    </div>
                </div>
            </div>
                

        </div>
    
      
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
 <script>

layui.use(['element','table','rate','layer'], function(){
        var element = layui.element
        ,table = layui.table
        ,rate = layui.rate
        ,$ = layui.$
        ,layer = layui.layer;


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
            elem: '#demo1'
            ,cols: [[ //表头
            {field: 'pic', title: '图片',  align:'center' ,  templet : function(d){
                        return `<img src='${d.pic}' style='width:100%;height:100%'>`;
                    }}
            ,{field: 'goodsname', title: '商品名称', align:'center' }
            ,{field: 'realpay', title: '价格', align:'center'}
            ,{field: 'username', title: '买家信息', align:'center', templet : function(d){
                        return `<div>用户昵称: ${d.username}</div><div>物流单号: ${d.ems}</div>`;
                    }}
            ,{field: 'content', title: '商品评价', align:'center', templet : function(d){
                        var date = layui.util.toDateString(d.content_time*1000, 'yyyy-MM-dd HH:mm:ss');
                        return `<div>${d.content}</div><div>${date}</div>`;
                    }}
            ,{field: 'level', title: '评价等级', align:'center', templet : function(d){
                        return `<div id="star${d.level}" ></div>`;
                    }}
            ,{field: 'action', title: '操作' , align:'center', templet : function(d){
                        return `<div class="btnBox">
                                    <a class="layui-btn layui-btn-xs"  data-id=${d.id} lay-event="reply">回复</a>
                                    <a class="layui-btn layui-btn-primary layui-btn-xs" data-id=${d.id} lay-event="hulv">忽略</a>
                                </div>`;
                    }}
            ]]
            ,data:data
            ,done:function(res, curr, count){
                var data = res.data;

                for (var item in data) {
                    //评分
                    rate.render({
                        elem: '#star'+data[item].level         //绑定元素
                        , length: 5           //星星个数
                        , value: data[item].level              //初始化值
//                      , half: true           //支持半颗星
                        , text: false           //显示文本，默认显示 '3.5星'
                        , readonly: true      //只读
                    });
                }
            }
        });



    $(".dBox").click(function () {
        var index = $(this).attr("data-item");
<<<<<<< HEAD
        var url = "<?php echo e(url('admin/business/show')); ?>"+ "/" + index;
=======
        var url = "<?php echo e(url('admin/business/search')); ?>"+ "/" + index;
>>>>>>> cf0a94a1d12d7a2da1a5f140a983d25f6581340d
        $.ajax({
            url:url,
            type:"POST",
            dataType:"json",
            data:{"_token":"<?php echo e(csrf_token()); ?>"},
            success:function (data) {
                //第一个实例
                if(index==1){
                    //第一个实例
                    table.render({
                        elem: '#demo1'
                        ,cols: [[ //表头
                            {field: 'pic', title: '图片',  align:'center' ,  templet : function(d){
                                return `<img src='${d.pic}' style='width:100%;height:100%'>`;
                            }}
                            ,{field: 'goodsname', title: '商品名称', align:'center' }
                            ,{field: 'realpay', title: '价格', align:'center'}
                            ,{field: 'username', title: '买家信息', align:'center', templet : function(d){
                                return `<div>用户昵称: ${d.username}</div><div>物流单号: ${d.ems}</div>`;
                            }}
                            ,{field: 'content', title: '商品评价', align:'center', templet : function(d){
                                var date = layui.util.toDateString(d.content_time*1000, 'yyyy-MM-dd HH:mm:ss');
                                return `<div>${d.content}</div><div>${date}</div>`;
                            }}
                            ,{field: 'level', title: '评价等级', align:'center', templet : function(d){
                                return `<div id="star${d.level}" ></div>`;
                            }}
                            ,{field: 'action', title: '操作' , align:'center', templet : function(d){
                                return `<div class="btnBox">
                                    <a class="layui-btn layui-btn-xs"  data-id=${d.id} lay-event="reply">回复</a>
                                    <a class="layui-btn layui-btn-primary layui-btn-xs" data-id=${d.id} lay-event="hulv">忽略</a>
                                </div>`;
                            }}
                        ]]
                        ,data:data
                        ,done:function(res, curr, count){
                            var data = res.data;

                            for (var item in data) {
                                //评分
                                rate.render({
                                    elem: '#star'+data[item].level         //绑定元素
                                    , length: 5           //星星个数
                                    , value: data[item].level              //初始化值
//                      , half: true           //支持半颗星
                                    , text: false           //显示文本，默认显示 '3.5星'
                                    , readonly: true      //只读
                                });
                            }
                        }
                    });
                }else{
                    table.render({
                        elem: '#demo2'
                        ,cols: [[ //表头
                            {field: 'pic', title: '图片',  align:'center' ,  templet : function(d){
                                return `<img src='${d.pic}' style='width:100%;height:100%'>`;
                            }}
                            ,{field: 'goodsname', title: '商品名称', align:'center' }
                            ,{field: 'realpay', title: '价格', align:'center'}
                            ,{field: 'username', title: '买家信息', align:'center', templet : function(d){
                                return `<div>用户昵称: ${d.username}</div><div>物流单号: ${d.ems}</div>`;
                            }}
                            ,{field: 'content', title: '商品评价', align:'center', templet : function(d){
                                var date = layui.util.toDateString(d.content_time*1000, 'yyyy-MM-dd HH:mm:ss');
                                return `<div>${d.content}</div><div>${date}</div>`;
                            }}
                            ,{field: 'reply', title: '商家回复', align:'center', templet : function(d){
                                if(d.state == 1)
                                {
                                    var date = layui.util.toDateString(d.reply_time*1000, 'yyyy-MM-dd HH:mm:ss');
                                    return `<div>${d.reply}</div><div>${date}</div>`;
                                }else{
                                    return `<div></div><div></div>`;
                                }
                            }}
                            ,{field: 'level', title: '评价等级', align:'center', templet : function(d){
                                return `<div id="stars${d.level}" ></div>`;
                            }}
                            ,{field: 'action', title: '操作' , align:'center', templet : function(d){
                                if(d.state == 1){
                                    return '<a class="layui-btn layui-btn-xs layui-btn-disabled" style="margin-top: 14px">已回复</a>';
                                }else{
                                    return '<a class="layui-btn layui-btn-xs layui-btn-disabled" style="margin-top: 14px">已忽略</a>';
                                }
                            }}
                        ]]
                        ,data:data
                        ,done:function(res, curr, count){
                            var data = res.data;

                            for (var item in data) {
                                //评分
                                rate.render({
                                    elem: '#stars'+data[item].level         //绑定元素
                                    , length: 5           //星星个数
                                    , value: data[item].level              //初始化值
                                    //                      , half: true           //支持半颗星
                                    , text: false           //显示文本，默认显示 '3.5星'
                                    , readonly: true      //只读
                                });
                            }
                        }
                    });
                }
            },
            error:function (data) {
                console.log("错误");
            }
        });

    })


    table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的DOM对象
        var id = data.id;
        if(layEvent === 'reply'){ //删除
            layer.open({
                type: 1,
                title:'回复评论',
                btn: ['提交', '取消'],
                content: `<div class="textBox">
                            <textarea placeholder="商家回复买家的评论" class="layui-textarea busText"></textarea>
                         </div>`
                ,yes: function(index, layero){
                    //  回复评价 的数据
                    var reply = $(".busText").val();
                    $.ajax({
                        // 回复评价 提交
                        url:"/admin/business/reply",
                        type:"POST",
                        dataType:"json",
                        data:{"_token":"<?php echo e(csrf_token()); ?>","type":1,"id":id, "reply": reply},
                        success:function (data) {
                            if(data)
                            {
//                                location = location;
                                obj.del();
                            }else{
                                alert("回复失败");
                            }
                        },
                        error:function (data) {
                            console.log("错误");
                        }
                    });
                    layer.close(index);
                }
                ,btn2: function(index, layero){
                    //按钮【按钮二】的回调
                    console.log("取消");
                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
        } else if(layEvent === 'hulv'){ //编辑
            layer.open({
                type: 1,
                title:false,
                btn: ['确定', '取消'],
                btnAlign: 'c',
                content: '<div style="padding: 30px 100px 20px;text-align: center;font-size: 16px;color: #555;">确定要忽略此评价吗</div>'
                ,yes: function(index, layero){
                    //  回复评价 的数据
                    var reply = $(".busText").val();
                    $.ajax({
                        // 回复评价 提交
                        url:"/admin/business/reply",
                        type:"POST",
                        dataType:"json",
                        data:{"_token":"<?php echo e(csrf_token()); ?>","type":2,"id":id, "reply": reply},
                        success:function (data) {
                            if(data)
                            {
//                                location = location;
                                obj.del();
                            }else{
                                alert("忽略失败");
                            }
                        },
                        error:function (data) {
                            console.log("错误");
                        }
                    });
                    layer.close(index);
                }
                ,btn2: function(index, layero){
                    //按钮【按钮二】的回调
                    console.log("取消");
                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
        }
    });

    });


 
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>