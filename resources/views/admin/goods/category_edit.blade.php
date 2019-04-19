@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/editgoodsclass.css') }}">
@section('content')
    <div class="main">
        <div class="bigbox">
            <form class="layui-form form" action="{{url('admin/category/updata')}}" method="post" enctype="multipart/form-data">
                @foreach($category as $val)
                <div class="layui-form-item">
                    <label class="layui-form-label">商品分类：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" value="{{$val->name}}" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-upload" style="margin:0!important;">
                    <div class="layui-upload-list uplist">
                        <span class="closebox">x</span>
                        @if(!empty($val->images))
                        <img class="layui-upload-img Imgaes" id="demo1" src="{{ImagesOssUrl}}/{{$val->images}}">
                        @endif
                        <input type="file" style="display: none;" name="images" onchange="changepic(this)" id="file" class="file imgfile" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" data-id="1" />
                        <p id="demoText"></p>
                    </div>
                    <button type="button" class="layui-btn" id="test1">上传图片</button>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label" >排&emsp;&emsp;序：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort_number" required lay-verify="required" value="{{$val->sort_number}}" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">父级名称：</label>
                    <div class="layui-input-block" style="width:190px;margin-left: 110px;">
                        <select name="pid" lay-verify="required">
                            <option value="0">顶级</option>
                            @foreach($category_list as $value)
                                @if($value['id'] == $val->pid)
                                <option value="{{$value["id"]}}" selected="">{{$value["name"]}}</option>
                                @else
                                <option value="{{$value["id"]}}">{{$value["name"]}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="layui-input-block btnbox" style="margin-left: 110px!important;">
                    {{ csrf_field() }}
                    <input type="hidden" class="CategoryId" name="id" value="{{$val->id}}">
                    <button class="layui-btn" lay-submit lay-filter="formDemo" type="submit">保存</button>
                    <button  class="layui-btn layui-btn-primary">取消</button>
                </div>
                @endforeach
            </form>

        </div>
    </div>









@endsection

@section('js')
    <script>
        layui.use(['form','upload'], function(){
            var form = layui.form
                ,upload = layui.upload
                ,$=layui.$;

            $(".uplist").mouseover(function () {
                $(".closebox").css({display:"block"});
            });

            $(".uplist").mouseout(function () {
                $(".closebox").css({display:"none"});
            });

            $(".closebox").click(function () {
                $("#demo1").css({display:"none"});
                var id = $(".CategoryId").val();
                console.log(id);
                $.ajax({
                    url:"{{url('admin/category/images')}}",
                    type:"POST",
                    dataType:"json",
                    data:{
                        "_token":"{{csrf_token()}}",
                        "id":id,
                    },
                    success:function (data) {
                        if(data.status == 1){
                            layer.msg("删除成功",{icon:1});
                        }
                    },
                    error:function (data) {
                        layer.msg("删除失败",{icon:2});
                    }
                })

            })

            $("#test1").click(function () {
                $(".imgfile").click();

                console.log("aaa");
            })

            window.changepic = function () {
                var reads= new FileReader();

                f=document.getElementById('file').files[0];

                reads.readAsDataURL(f);

                reads.onload=function (e) {

                    //document.getElementById('show').src=this.result;
                    $("#demo1").attr("src",this.result);
                    $("#demo1").css({display:"block"});
                };
            }

//

            //监听提交
            form.on('submit(formDemo)', function(data){

            });
        });
    </script>
@endsection