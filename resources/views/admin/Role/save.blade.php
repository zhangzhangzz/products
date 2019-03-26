@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/roleedit.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <form id="formmy" class="layui-form formBox" action="{{url('admin/role/insert')}}" method="post">
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
                    <label class="layui-form-label">角色名称：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="{{ old('name') }}" required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error name">请填写汉子</span>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">角色描述：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="descript" value="{{ old('descript') }}" required lay-verify="required" placeholder="请输入描述" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">上级名称：</label>
                    <div class="layui-input-block">
                        <select name="boss" lay-verify="required">
                            <option value="/">/</option>
                            @foreach ($name as $v)
                                <option value="{{ $v -> name }}">{{ $v -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">状&emsp;&emsp;态：</label>
                    <div class="layui-input-block">
                    <select name="state" lay-verify="required">
                        <option value="1">启用</option>
                        <option value="0">禁用</option>
                    </select>
                    </div>
                </div>
            
                <div style="color:#555;padding: 15px;"><h2>权限设置</h2></div>
                @foreach ($list as $v)
                <div class="quanxian">
                    <div class="tables">
                        <div class="list">
                            <p class="title">
                                <input type="checkbox" value="{{ $v['id'] }}" data-id="12" lay-skin="primary" title="{{ $v['name'] }}" name="action_id[]" lay-filter="allChoose"
                                    class="allChoose">
                            </p>
                            <div class="ultable">
                                <ul>
                                    @if(is_array($v))
                                    @foreach ($v as $s)
                                    @if(is_array($s))
                                    <li>
                                        <input type="checkbox" value="{{ $s['id'] }}" data-id="12" lay-skin="primary" title="{{ $s['name'] }}" name="action_id[]" lay-filter="choose"
                                            class="aaa">

                                        <div class="list-three">
                                            <ul>
                                                @foreach ($s as $c)
                                                 @if(is_array($c))
                                                <li>
                                                    <input type="checkbox" value="{{ $c['id'] }}" data-id="12" lay-skin="primary" title="{{ $c['name'] }}" name="action_id[]" lay-filter="three-choose">
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
		        </div>
                @endforeach
                <div class="layui-form-item btnBox">
                    <div class="layui-input-block" style="margin: 0;">
                    <button class="layui-btn pl" lay-submit lay-filter="formDemo" style="margin-left:130px;">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
@endsection

@section('js')
    <script>

        layui.use('form', function(){
            var form = layui.form
            $ = layui.$;

            //全选选单选      ----------------------------------------
   			form.on('checkbox(allChoose)', function(data) {

                var child = $(data.elem).parents('.list').children('.ultable').find(
                    'ul li input[type="checkbox"]:not([name="show"])');

                child.each(function(index, item) {
                    item.checked = data.elem.checked;
                });
                form.render('checkbox');
                });





                //全部选中来确定全选按钮是否选中
                form.on('checkbox(choose)', function(data) {
                var three_child = $(data.elem).siblings().find(
                                    'ul li input[type="checkbox"]:not([name="show"])');
                three_child.each(function(index, item) {
                    item.checked = data.elem.checked;
                });
                var child = $(data.elem).parents('.list').children('.ultable').find(
                    'ul li input[type="checkbox"]:not([name="show"])');
                var childChecked = $(data.elem).parents('.list').children('.ultable').find(
                    'ul li input[type="checkbox"]:not([name="show"]):checked')
                if (childChecked.length == child.length) {
                    $(data.elem).parents('.list').children('.title').find(' input.allChoose').get(0).checked = true;
                }else if(childChecked.length==0){
                        $(data.elem).parents('.list').children('.title').find(' input.allChoose').get(0).checked = false;
                    }
                    else {
                    $(data.elem).parents('.list').children('.title').find(' input.allChoose').get(0).checked = true;
                }
                form.render('checkbox');
                });

                form.on('checkbox(three-choose)', function(data) {
                    var child = $(data.elem).parents('li').find(
                    'input[type="checkbox"]:not([name="show"])');
                    var childChecked = $(data.elem).parents('li').find(
                        'ul li input[type="checkbox"]:not([name="show"]):checked')
                    if (childChecked.length == child.length-1) {
                        $(data.elem).parents('li').find(' input.aaa').get(0).checked = true;
                    } else if(childChecked.length==0){
                            $(data.elem).parents('li').find(' input.aaa').get(0).checked = false;

                        }
                        else {
                    $(data.elem).parents('li').find(' input.aaa').get(0).checked = true;

                    }
                        form.render('checkbox');
                });







          //监听提交
          form.on('submit(formDemo)', function(data){
//            layer.msg(JSON.stringify(data.field));
//            return false;
              $("#formmy").submit();
          });
        });
        $("input").blur(function(){
            var name = $(this).prop("name");
            var data = $(this).val();
            $.ajax({
                url: '{{url("admin/role/regular")}}',
                type: 'POST',
                dataType: 'JSON',
                data: {"_token":"{{csrf_token()}}" , "name":name , "data":data},
                success: function (data)
                {
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
