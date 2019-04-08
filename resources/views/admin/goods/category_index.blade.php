@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/goodsclassify.css') }}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@section('content')
    {{ session('message') }}
    <div class="main">
        <button class="layui-btn add" lay-submit lay-filter="formDemo" style="margin:30px;" >添加</button>
        <div class="layui-form form">
            <table class="layui-table" lay-data="{ page:true, id:'test'}" lay-filter="test">
                <thead>
                    <tr>
                    <th lay-data="{field:'img' , align : 'center'}">图片</th>
                    <th lay-data="{field:'classify' , align : 'center'}">分类名称</th>
                    <th lay-data="{field:'parent' , align : 'center'}">父级ID</th>
                    <th lay-data="{field:'px' , sort: true , align : 'center'}">排序</th>
                    <th lay-data="{field:'action' , align : 'center'}">操作</th>
                    </tr>
                </thead>
            </table>

            <div>
                <ul>
                    @foreach($category_list as $value)
                    <li class="">
                        <div class="parentBox" >
                            <div class="pbFirst">

                                <div>@if(!empty($value["images"]))<img src="{{ImagesOssUrl}}/{{($value['images'])}}" alt="">@endif</div>

                                <div>{{$value['name']}}</div>
                                <div>{{$value['pid']}}</div>
                                <div>{{$value['sort_number']}}</div>
                            </div>

                            <div class="action" data-value="{{$value["id"]}}">操作</div>
                        </div>
                        <div class="listdd">
                            @if(!empty($value['children']))
                            @foreach($value['children'] as $val)
                            <dd >
                                <div>@if(!empty($val["images"]))<img src="{{ImagesOssUrl}}/{{$val["images"]}}" alt="">@endif</div>
                                <div>{{$val['name']}}</div>
                                <div>{{$val['pid']}}</div>
                                <div>{{$val['sort_number']}}</div>
                                <div class="action" data-value="{{$val["id"]}}">操作</div>
                            </dd>
                            @endforeach
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="page">
                {{$category_list->links()}}
            </div>

        </div>
        
    </div>


@endsection
@section('js')
<script>
    layui.use('table', function(){
        var table = layui.table
        ,laytpl = layui.laytpl
              $ = layui.$;
  
        //直接解析字符
        laytpl('@{{ d.name }}').render({
            name: `<a class="layui-btn layui-btn-xs edit" lay-event="edit" >编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs del" lay-event="del">删除</a>`
        }, function(string){
            $(".action").html(string);
        });

        $(".edit").click(function () {
            var id =$( $(this).parent()).data("value");
            console.log(id);
            window.location.href = '/admin/category/edit/'+id;
        });

        $(".del").click(function () {
            var id =$( $(this).parent()).data("value");
            console.log(id);
            $.ajax({
                url:"{{url('admin/category/del')}}",
                type:"POST",
                dataType:"json",
                data:{
                    "_token":"{{csrf_token()}}",
                    "id":id,
                },
                success:function (data) {
                    if(data.status == 1){
                        layer.msg("删除成功",{icon:1},function () {
                            window.location.href = "{{url('admin/category/index')}}"
                        });
                    }
                    if(data.status == 2){
                        layer.msg("删除失败",{icon:2},function () {
                            window.location.href = "{{url('admin/category/index')}}"
                        });
                    }
                    if(data.status == 3){
                        layer.msg("请删除子分类",{icon:2},function () {
                            window.location.href = "{{url('admin/category/index')}}"
                        });
                    }
                }
            })
        });



        $(".pbFirst").click(function(){
            console.log("dddd");
            var listdd = $($(this).parent()).next(".listdd");
            let flag = true;
            listdd.slideToggle();
            
        });

        $(".add").click(function(){
            window.location.href="/admin/category/add";
        });


    });
</script>
@endsection