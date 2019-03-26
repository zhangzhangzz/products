@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/menuedit.css') }}">
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="bigbox">
            <form id="formmy" class="layui-form" action="{{url('admin/menu/update/'.$list -> id)}}" method="post" lay-filter="example">
                {{ csrf_field()  }}
                @if(session('errors'))
                    <div class="errors">
                        <h3>警告</h3>
                        <br/>
                        {{ session('errors') }}
                        <br/>
                    </div>
                @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单名称</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="{{ $list -> name  }}" required lay-verify="required" placeholder="请输入菜单名称" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error name">请填写汉子</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">URL</label>
                    <div class="layui-input-inline">
                    <input type="text" name="url" value="{{ $list -> url  }}" placeholder="请输入URL" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">上级名称</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="boss"  value="{{ $list -> boss  }}" lay-verify="required">
                        <option value="0">/</option>
                        @foreach ($data as $v)
                            <?php $nbsp = str_repeat("&nbsp;", substr_count($v -> path, ",")*5); ?>
                       <option value="{{ $v -> id }}">{{$nbsp}}|--{{ $v -> name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-inline">
                    <input type="text" name="sort" value="{{ $list -> sort  }}" placeholder="请输入上级名称" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error sort">请填写数字</span>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block" style="width: 190px;">
                    <select name="state"  lay-verify="required">
                        <option value="0">禁用</option>
                        <option value="1">开启</option>
                    </select>
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
 


        </div>
                

    </div>







    
    
      
@endsection

@section('js')
    <script>

    //Demo
    layui.use('form', function(){
    var form = layui.form;

    form.val("example",{
        "state":{{ $list -> state  }},
        "boss":{{ $list -> boss  }}
    });
    
    //监听提交
    form.on('submit(formDemo)', function(data){
//        layer.msg(JSON.stringify(data.field));
//        return false;
        $("#formmy").submit();
    });
    });

    $("input").blur(function() {
        var name = $(this).prop("name");
        var data = $(this).val();
        $.ajax({
            url: '{{url("admin/role/regular")}}',
            type: 'POST',
            dataType: 'JSON',
            data: {"_token": "{{csrf_token()}}", "name": name, "data": data},
            success: function (data) {
                if(data)
                {
                    $("."+name).css("color","red");
                    $("."+name).html(data);
                }else{
                    $("."+name).css("color","green");
                    $("."+name).html("√可以使用");
                }
            }
        });
    });
    </script>
@endsection