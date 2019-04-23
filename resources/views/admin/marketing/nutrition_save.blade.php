@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/addgoods.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="titleBox">
                <div>基本信息</div>
            </div>

            <div style="padding:0 30px;">
                <form class="layui-form form" action="">
                    <div class="basicBox">基本信息</div>
                    <div class="layui-form-item"> 
                        <div class="warn">*</div>
                        <label class="layui-form-label" style="text-align:left">文章名称：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="goodsname" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">最多30个字</div>
                    </div>
                    <div class="goodsImg">
                        <div class="warn">*</div>
                        <label>商品展示图</label>
                        <div  class="imgBox">
                            <div class="pl">
                                <div id="toppic"></div>
                                <div id="toptext">封</div>
                                <img src="{{ asset('image/eg.png') }}">
                            </div>
                            <div class="pl">
                                <img src="{{ asset('image/eg.png') }}">
                            </div>
                            <div class="pl">
                                <img src="{{ asset('image/eg.png') }}">
                            </div>
                            <div class="pl">
                                <button class="layui-btn layui-btn-primary" style="margin-top: 34px;" id="test1">+ 添加图片</button>
                                <input type="file" style="display: none;" name="images" onchange="changepic(this)" id="file" class="file imgfile" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" data-id="1" />
                            </div>
                            <div class="stext">建议尺寸：800 * 800像素，点击图片可设置为商品封面，最多上传10张</div>
                        </div>
                    </div>


                    
                    <div class="basicBox">编辑营养搭配信息</div>
                    <div>
                        <textarea id="textDemo" style="display: none;"></textarea>
                    </div>

                   
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo" >立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">取消</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> 

@endsection

@section('js')
<script>
    layui.use(['form','upload','layedit'], function(){
        var form = layui.form
        ,upload = layui.upload
            ,$  = layui.$
        ,layedit = layui.layedit;

        //文本编辑器图片接口
        layedit.set({
            uploadImage: {
                url: '' //接口url
                ,type: '' //默认post
            }
        });

        //返回的格式
        // {
        //     "code": 0 //0表示成功，其它失败
        //     ,"msg": "" //提示信息 //一般上传失败后返回
        //     ,"data": {
        //         "src": "图片路径"
        //         ,"title": "图片名称" //可选
        //     }
        // }

        var index = layedit.build('textDemo');

        var uploadInst =  upload.render({
                elem: '#test5'
                ,url: '/upload/'
                ,accept: 'video' //视频
                ,done: function(res){
                console.log(res)
                }
            });

        $("#test1").click(function () {
            $(".imgfile").click();
            return false;
        })
        
        //监听提交
        form.on('submit(formDemo)', function(data){
            //layer.msg(JSON.stringify(data.field));
            console.log(layedit.getContent(index));
            return false;
        });

    });
</script> 
@endsection