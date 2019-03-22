<link rel="stylesheet" href="<?php echo e(asset('css/addgoods.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="padding:30px;">
            <div class="titleBox">
                <div>编辑基本信息</div>
            </div>

            <div style="padding:0 30px;">
                <form class="layui-form form" action="">
                    <div class="basicBox">基本信息</div>
                    <div class="layui-form-item">
                        <div class="warn">*</div>
                        <label class="layui-form-label" style="text-align:left">商品名称：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="goodsname" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">最多30个字</div>
                    </div>
                    <div class="goodsImg">
                        <div class="warn">*</div>
                        <label>商品展示图</label>
                        <div  class="imgBox">
                            <div class="pl">
                                <img src="<?php echo e(asset('image/eg.png')); ?>">
                            </div>
                            <div class="pl">
                                <img src="<?php echo e(asset('image/eg.png')); ?>">
                            </div>
                            <div class="pl">
                                <img src="<?php echo e(asset('image/eg.png')); ?>">
                            </div>
                            <div class="stext">建议尺寸：800 * 800像素，点击图片可设置为商品封面，最多上传10张</div>
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <div class="warn">*</div>
                        <label class="layui-form-label" style="text-align:left">商品类目</label>
                        <div class="layui-input-block">
                        <select name="city" lay-verify="required">
                            <option value="1">上海</option>
                            <option value="2">广州</option>
                            <option value="3">深圳</option>
                        </select>
                        <select name="city" lay-verify="required">
                            <option value="1">上海</option>
                            <option value="2">广州</option>
                            <option value="3">深圳</option>
                        </select>
                        </div>
                    </div>

                    <div>
                        <label>主图视频：</label>
                        <button type="button" class="layui-btn" id="test5"><i class="layui-icon"></i>上传视频</button>
                    </div>

                    <div class="basicBox">价格库存</div>

                    <div>
                        <div class="warn">*</div>
                        <label>商品规格</label>
                        <div class="unitBox">
                            <div class="ubBody">

                            </div>
                            
                            <div class="addBtn">
                                <button class="layui-btn layui-btn-primary addUnit" type="button">添加规格项目</button>
                            </div>
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
    </div> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    layui.use(['form','upload'], function(){
        var form = layui.form
        ,upload = layui.upload
            ,$  = layui.$;

        var uploadInst =  upload.render({
                elem: '#test5'
                ,url: '/upload/'
                ,accept: 'video' //视频
                ,done: function(res){
                console.log(res)
                }
            });
        
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });

        var html = "";
        $(".addUnit").click(function(){
            var ublen = $(".ubBody").find(".ub").length;
            if(ublen ==3 ){
                layer.msg("最多支持3组规格");
                return false;
            }

            html+=`<div class="ub1 ub">
                                <div class="unitname">
                                    <label>规格名：</label>
                                    <input type="text" name="unit" required lay-verify="required" placeholder="净含量" autocomplete="off" class="layui-input inBox">
                                </div>
                                <div class="unitdata">
                                    <div class="">
                                        <label>规格值：</label>
                                        <div class="setUnitBox">
                                            <input type="text" name="unit" required lay-verify="required" placeholder="kg" autocomplete="off" class="layui-input inBox">
                                        </div>
                                        
                                    </div>
                                    <a class="addUdata" style="color:#38f;" onclick="addUdata()">添加规格值</a>
                                    <span class="remove">x</span>
                                </div>
                            </div>`;
            $(".ubBody").html(html);

        });

        window.addUdata = function() {
            // var inLen = $(".setUnitBox").find("input").length;
            // if(inLen==3){
            //     layer.msg("最多支持3组规格");
            //     return false;
            // }
            $(".setUnitBox").append(`<input type="text" name="unit" required lay-verify="required" placeholder="kg" autocomplete="off" class="layui-input inBox">`);
        }

        $(".ub").mouseover(function(){
            $(this).find(".remove").css({display:"block"});
        });

        $(".ub").mouseout(function(){
            $(this).find(".remove").css({display:"none"});
        });

        $(".remove").click(function(){
            $($(this).parent()).parent().remove();
        });


    });
</script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>