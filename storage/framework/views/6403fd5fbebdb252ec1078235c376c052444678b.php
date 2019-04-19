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
                <button class="layui-btn addUser" onclick="addRole();">评价列表</button>
            </div>

            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">待处理</li>
                    <li>全部</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <table id="demo1" lay-filter="test"></table>
                    </div>
                    <div class="layui-tab-item">内容2</div>
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
                        var date = layui.util.toDateString(d.time*1000, 'yyyy-MM-dd HH:mm:ss');
                        return `<div>${d.content}</div><div>${date}</div>`;
                    }}
            ,{field: 'level', title: '评价等级', align:'center', templet : function(d){
                        return `<div id="star${d.level}" ></div>`;
                    }}
            ,{field: 'action', title: '操作' , align:'center', templet : function(d){
                        return `<div class="btnBox">
                                    <a class="layui-btn layui-btn-xs reply"  >回复</a>
                                    <a class="layui-btn layui-btn-primary layui-btn-xs cancle" >忽略</a>
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

        $(".reply").click(function(){
            layer.open({
                type: 1, 
                title:'回复评论',
                btn: ['提交', '取消'],
                content: `<div class="textBox">
                            <textarea placeholder="商家回复买家的评论" class="layui-textarea busText"></textarea>
                         </div>`
                ,yes: function(index, layero){
                    //按钮【按钮一】的回调
                    var reply = $(".busText").val();
                    console.log("回复"+reply);
                }
                ,btn2: function(index, layero){
                    //按钮【按钮二】的回调
                    console.log("取消");
                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
        });

        $(".cancle").click(function(){
            console.log("忽略");
        });

    });


 
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>