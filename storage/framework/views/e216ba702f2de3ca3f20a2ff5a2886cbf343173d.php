<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/addgoodsclass.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div class="bigbox">
            <form class="layui-form form" action="<?php echo e(url('admin/category/save')); ?>" method="post" enctype="multipart/form-data">
                <div class="layui-form-item">
                    <label class="layui-form-label " >商品分类：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-upload" style="margin-left:110px!important;">
                    <div class="layui-upload-list uplist">
                        <img class="layui-upload-img Imgaes" id="demo1" >
                        <input type="file" style="display: none;" name="images" onchange="changepic(this)" id="file" class="file imgfile" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" data-id="1" />
                        <p id="demoText"></p>
                    </div>
                    <button type="button" class="layui-btn" id="test1">上传图片</button>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label" >排&emsp;&emsp;序：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort_number" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">父级名称：</label>
                    <div class="layui-input-block" style="width:190px;margin-left: 110px;">
                        <select name="pid" lay-verify="required">
                            <option value="0">顶级</option>
                            <?php $__currentLoopData = $category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value["id"]); ?>" <?php if($value["pid"] != 0): ?> disabled <?php endif; ?>><?php echo e($value["name"]); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="layui-input-block btnbox" style="margin-left: 110px!important;">
                    <?php echo e(csrf_field()); ?>

                    <button class="layui-btn" lay-submit lay-filter="formDemo" type="submit">保存</button>
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
                ,upload = layui.upload
                ,$=layui.$;

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
                //var Imgaes = $(".Imgaes")
                console.log($("#img1").val());

            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>