@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/user_look.css') }}">
@section('content')
    <div class="main" >
        <div style="padding:30px;">
            <div class="titleBox">
                <div>基本信息</div>
            </div>
            <div class="mainBox">
               
                <fieldset class="layui-elem-field site-demo-button msg" style="margin-top: 30px;">

                </fieldset>
                <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;">
                    <legend>商品清单</legend>
                    <div class="layui-form-item" style="padding:20px;">
                        <table id="demo1" lay-filter="test"></table>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        layui.use('table', function(){
            var table = layui.table
            ,$ = layui.$;
            var url = window.location.href;
            var id;
            if(url.indexOf('/') != -1){
                id = url.split('/')[6];
            }
            $.ajax({
                url:"{{url('admin/user/look/{id}')}}",
                type:"POST",
                dataType:"json",
                data:{"_token":"{{csrf_token()}}","id":id},
                success:function (data) {
                    console.log(data);
                    var data = data.data.user;
                    //var order = data.data.order;
                    var html =`<legend>收货人信息</legend>
                                <div>
                                    <div class="layui-form-item" >
                                        <label class="layui-form-label zlabel">收货人姓名：</label>
                                        <label class="layui-form-label zlabel">${data[0].name}</label>
                                    </div>
                                    <div class="layui-form-item" >
                                        <label class="layui-form-label zlabel">收货人手机号：</label>
                                        <label class="layui-form-label zlabel">${data[0].phone}</label>
                                    </div>
                                    <div class="layui-form-item" >
                                        <label class="layui-form-label zlabel">收货人地址：</label>
                                        <label class="layui-form-label zlabel">${data[0].address}</label>
                                    </div>
                                </div>`;

                    $(".msg").html(html);
                    //第一个实例
                    table.render({
                        elem: '#demo1'
                        ,cols: [[ //表头
                            {field: 'img', title: '商品图片', align:'center', templet : function(d){
                                return `<img src=${d.img}>`;
                            }}
                            ,{field: 'goodsname', title: '商品名称', align:'center' }
                            ,{field: 'price', title: '单价',  sort: true, align:'center'}
                            ,{field: 'count', title: '数量', align:'center' }
                            ,{field: 'pay', title: '合计金额', align:'center'}
                            ,{field: 'paytype', title: '支付方式', align:'center', templet : function(d){
                                if(d.paytype==1){
                                    return "<div>微信</div>";
                                }else if(d.paytype==2){
                                    return "<div>支付宝</div>";
                                }
                            }}
                            ,{field: 'status', title: '订单状态', align:'center', templet : function(d){
                                if(d.status==0){
                                    return "<div>待发货</div>";
                                }else if(d.status==1){
                                    return "<div>已发货</div>";
                                }
                            }}
                        ]]
                        ,data:data
                    });

                },
                error:function (data) {
                    console.log("错误")
                }
            });


           
        });
    </script>
@endsection