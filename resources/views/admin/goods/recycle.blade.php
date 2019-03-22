@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/goodsrecycle.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="layui-tab">  
                <ul class="layui-tab-title">
                    <li class="layui-this">已失效</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <table id="demo" lay-filter="test"></table>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit" >编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

    <script type="text/html" id="barDemo2">
        <img src="@{{d.img}}">
     </script>

@endsection

@section('js')
<script>
    layui.use(['table','element'], function(){
        var table = layui.table
        ,element = layui.element;

        var data = [
                {img:"{{ asset('image/1.jpg') }}",title:'这里中央人民广播电视台',price:'9.9',stock:999,sale:999,
                    monsale:188,reason:'您的商品因为xxx情况违规，请重新修改并提交审核',action:'-'},
                {img:"{{ asset('image/1.jpg') }}",title:'这里中央人民广播电视台',price:'9.9',stock:999,sale:999,
                    monsale:188,reason:'您的商品因为xxx情况违规，请重新修改并提交审核',action:'-'},
                {img:"{{ asset('image/1.jpg') }}",title:'这里中央人民广播电视台',price:'9.9',stock:999,sale:999,
                    monsale:188,reason:'您的商品因为xxx情况违规，请重新修改并提交审核',action:'-'},
            ];  
        
        //第一个实例
        table.render({
            elem: '#demo'
            ,cols: [[ //表头
            {field: 'img', title: '图片', align:'center', fixed: 'left' ,toolbar: '#barDemo2'}
            ,{field: 'title', title: '标题', align:'center'}
            ,{field: 'price', title: '价格', align:'center'}
            ,{field: 'stock', title: '库存', align:'center'} 
            ,{field: 'sale', title: '总销量', align:'center'}
            ,{field: 'monsale', title: '月销量', align:'center'}
            ,{field: 'reason', title: '失效原因', align:'center'}
            ,{field: 'action', title: '操作', align:'center' , toolbar: '#barDemo'}
            ]],
            data:data
        });
        
    });
</script>
@endsection