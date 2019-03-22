<link rel="stylesheet" href="<?php echo e(asset('css/addgoods.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div class="bigbox">
            <form class="layui-form form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label " >商品分类：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-upload" style="margin-left:110px!important;">
                    <div class="layui-upload-list uplist">
                        <img class="layui-upload-img" id="demo1">
                        <p id="demoText"></p>
                    </div>
                    <button type="button" class="layui-btn" id="test1">上传图片</button>
                </div>  

                <div class="layui-form-item">
                    <label class="layui-form-label" >排&emsp;&emsp;序：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <label class="layui-form-label">父级名称：</label>
                    <div class="layui-input-block" style="width:190px;margin-left: 110px;">
                        <select name="city" lay-verify="required">
                        <option value="0">顶级</option>
                        <option value="1">上海</option>
                        <option value="2">广州</option>
                        <option value="3">深圳</option>
                        <option value="4">杭州</option>
                        </select>
                    </div>
                </div>

                <div class="layui-input-block btnbox" style="margin-left: 110px!important;">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">保存</button>
                    <button  class="layui-btn layui-btn-primary">取消</button>
                </div>
            </form>

        </div>
    </div>  

        

        
   

    
    
      
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        layui.use(['form','upload'], function(){
            var form = layui.form
            ,upload = layui.upload;
  
            //普通图片上传
            var uploadInst = upload.render({
                elem: '#test1'
                ,url: '/upload/'
                ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
                }
                ,done: function(res){
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
                }
                //上传成功
                }
                ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
                }
            });
            
            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>