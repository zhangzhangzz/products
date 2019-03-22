@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/goodsclassify.css') }}">
@section('content')
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
                    <li class="">
                        <div class="parentBox">
                            <!--div class="fuhao"><i class="layui-icon layui-icon-up" style="font-size: 20px;"></i></div-->
                            <div><img src="{{ asset('image/logo.png') }}" alt=""></div>
                            <div>坚果</div>
                            <div>001</div>
                            <div>1</div>
                            <div class="action">操作</div>
                        </div>
                        <div class="listdd">
                            <dd>
                                <div><img src="{{ asset('image/logo.png') }}" alt=""></div>
                                <div>坚果</div>
                                <div>001</div>
                                <div>1</div>
                                <div class="action">操作</div>
                            </dd>
                        
                            <dd>
                                <div><img src="{{ asset('image/logo.png') }}" alt=""></div>
                                <div>坚果</div>
                                <div>001</div>
                                <div>1</div>
                                <div class="action">操作</div>
                                  
                            </dd>
                        </div>
                    </li>
                    <li class="">
                        <div class="parentBox">
                            <div><img src="{{ asset('image/logo.png') }}" alt=""></div>
                            <div>坚果</div>
                            <div>001</div>
                            <div>1</div>
                            <div class="action">操作</div>
                        </div>
                        <div class="listdd">
                            <dd>
                                <div><img src="{{ asset('image/logo.png') }}" alt=""></div>
                                <div>坚果</div>
                                <div>001</div>
                                <div>1</div>
                                <div class="action">操作</div>
                            </dd>
                        
                            <dd>
                                <div><img src="{{ asset('image/logo.png') }}" alt=""></div>
                                <div>坚果</div>
                                <div>001</div>
                                <div>1</div>
                                <div class="action">操作</div>
                            </dd>
                        </div>
                    </li>
                </ul>
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
            name: `<a class="layui-btn layui-btn-xs" lay-event="edit" >详情</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">禁用</a>`
        }, function(string){
            $(".action").html(string);
        });

        $(".parentBox").click(function(){
            var listdd = $(this).next(".listdd");
            var docs = $(this);
            let flag = true;
            listdd.slideToggle();
            
        });

        $(".add").click(function(){
            window.location.href="/admin/goods/add";
        });


    });
</script>
@endsection