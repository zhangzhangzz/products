<link rel="stylesheet" href="<?php echo e(asset('css/editgoodsclass.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div class="bigbox">
            <form class="layui-form form" action="<?php echo e(url('admin/category/updata')); ?>" method="post" enctype="multipart/form-data">
                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="layui-form-item">
                    <label class="layui-form-label">商品分类：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="<?php echo e($val->name); ?>" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-upload" style="margin:0!important;">
                    <div class="layui-upload-list uplist">
                        <span class="closebox">x</span>
                        <img class="layui-upload-img Imgaes" id="demo1" src="<?php echo e(ImagesOssUrl); ?>/<?php echo e($val->images); ?>">
                        <input type="file" style="display: none;" name="images" onchange="changepic(this)" id="file" class="file imgfile" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" data-id="1" required="required" />
                        <p id="demoText"></p>
                    </div>
                    <button type="button" class="layui-btn" id="test1">上传图片</button>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label" >排&emsp;&emsp;序：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort_number" required lay-verify="required" placeholder="<?php echo e($val->sort_number); ?>" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">父级名称：</label>
                    <div class="layui-input-block" style="width:190px;margin-left: 110px;">
                        <select name="pid" lay-verify="required">
                            <option value="0">顶级</option>
                            <?php $__currentLoopData = $category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($value['id'] == $val->pid): ?>
                                <option value="<?php echo e($value["id"]); ?>" selected=""><?php echo e($value["name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo e($value["id"]); ?>"><?php echo e($value["name"]); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="layui-input-block btnbox" style="margin-left: 110px!important;">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" class="CategoryId" name="id" value="<?php echo e($val->id); ?>">
                    <button class="layui-btn" lay-submit lay-filter="formDemo" type="submit">保存</button>
                    <button  class="layui-btn layui-btn-primary">取消</button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    url:"<?php echo e(url('admin/category/images')); ?>",
                    type:"POST",
                    dataType:"json",
                    data:{
                        "_token":"<?php echo e(csrf_token()); ?>",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>