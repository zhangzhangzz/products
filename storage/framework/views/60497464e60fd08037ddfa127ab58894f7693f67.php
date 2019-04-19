<link rel="stylesheet" href="<?php echo e(asset('css/shopcheck.css')); ?>">
<?php $__env->startSection('content'); ?>
<div class="main" >
    <?php $__currentLoopData = $shop_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bigbox">
            <div class="titleBox">
                <div>基本信息</div>
            </div>
            <div class="basicMsg msg">
                <div class="leftBox msgBox">
                    <div>
                        <label>店铺信息</label>
                        <div><img src="<?php echo e(asset('image/logo.png')); ?>" alt=""></div>
                    </div>
                    <div>
                        <label>店铺名称</label>
                        <div><?php echo e($value["shop_name"]); ?></div>
                    </div>
    
                    <div>
                        <label>公司名称</label>
                        <div><?php echo e($value["company_name"]); ?></div>
                    </div>
    
                    <div>
                        <label>负责人</label>
                        <div><?php echo e($value["functionary"]); ?></div>
                    </div>
    
                    <div>
                        <label>性别</label>
                        <div><?php echo e($value["sex"]); ?></div>
                    </div>
    
                    <div>
                        <label>联系电话</label>
                        <div><?php echo e($value["phone"]); ?></div>
                    </div>
    
                </div>

                <div class="rightBox msgBox">

                    <div>
                        <label>店铺地址</label>
                        <div><?php echo e($value["shop_address"]); ?></div>
                    </div>
                    
                    <div>
                        <label>后台管理账号</label>
                        <?php if(!empty($value["admin_name"])): ?>
                        <div><?php echo e($value["admin_name"]); ?></div>
                        <?php endif; ?>
                    </div>
    
                    <div>
                        <label>后台管理密码号</label>
                        <?php if(!empty($value["admin_passwd"])): ?>
                        <div><?php echo e($value["admin_passwd"]); ?></div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label>主营类目</label>
                        <?php if(!empty($value["goods_type_name"])): ?>
                        <div><?php echo e($value["goods_type_name"]); ?></div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label>微信号</label>
                        <div><?php echo e($value["weixin"]); ?></div>
                    </div>
                </div>
                

            </div>

            <div class="titleBox">
                <div>身份认证</div>
            </div>

            <div class="personMgs msg">
                <div>
                    <label>申请人身份证</label>
                    <div class="imgBox">
                        <div class="pl">
                            <img src="<?php echo e(asset('image/eg.png')); ?>" alt="">
                            <span class="sptext">正面</span>
                        </div>
                        
                        <div class="pl">
                            <img src="<?php echo e(asset('image/eg.png')); ?>" alt="">
                            <span class="sptext">反面</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label>企业资质</label>
                    <div class="imgBox">
                        <div class="pl">
                            <img src="<?php echo e(asset('image/eg.png')); ?>" alt="">
                            <span class="sptext">营业执照</span>
                        </div>
                    </div>
                    
                </div>

                <div>
                    <label>是否有品牌</label>
                    <div style="margin-left:140px;">
                        <?php if($value["is_brand"] == 1): ?>
                            有
                        <?php elseif($value["is_brand"] == 2): ?>
                            无
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label>经营资质</label>
                    <div  class="imgBox">
                        <div class="pl">
                            <img src="<?php echo e(asset('image/eg.png')); ?>" alt="">
                            <span class="sptext">商标</span>
                        </div>
                        <div class="pl">
                            <img src="<?php echo e(asset('image/eg.png')); ?>" alt="">
                            <span class="sptext">授权书</span>
                        </div>
                        <div class="pl">
                            <img src="<?php echo e(asset('image/eg.png')); ?>" alt="">
                            <span class="sptext">经营资质</span>
                        </div>
                    </div>
                </div>
            </div>

<<<<<<< HEAD
            <?php if(!empty($shop_show)): ?>
=======
>>>>>>> cf0a94a1d12d7a2da1a5f140a983d25f6581340d
            <div class="titleBox">
                <div>审核日志</div>
            </div>

            <div class="checkMsg">
<<<<<<< HEAD
                <?php if($value["audit_status"] == 1): ?>
                    <div class="actionLog">
                        <label>审核员操作</label>
                        <div style="margin-left: 140px;">
                            <button class="layui-btn pass">通过</button>
                            <button class="layui-btn layui-btn-primary refuse ShopId" data-value="<?php echo e($value["id"]); ?>">驳回</button>
                        </div>
                    </div>
                <?php endif; ?>

                <div>
                    <?php if($value["audit_status"] == 1): ?>
                    <?php else: ?>
                        <div class="actionLog">
                            <label>审核员操作</label>
                            <?php if($value["audit_status"] == 2): ?>
                                <div style="margin-left:140px;">已驳回</div>
                            <?php elseif($value["audit_status"] == 3): ?>
                                <div style="margin-left:140px;">已通过</div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div style="overflow:hidden">
                        <label>审核日志</label>
                        <div style="margin-left:140px;">
                            <div class="acmsg" style="margin-top: 10px">
                                <?php $__currentLoopData = $shop_show; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div style="margin: 10px 0;">
                                    <div><?php echo e(date('Y-m-d,H:i:s',$val['create_time'])); ?></div>
                                    <div><?php echo e($val['shop_text']); ?></div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
=======
                <div class="actionLog">
                    <label>审核员操作</label>
                    <div style="margin-left: 140px;">
                        <button class="layui-btn pass">通过</button>
                        <button class="layui-btn layui-btn-primary refuse ShopId" data-value="<?php echo e($value["id"]); ?>">驳回</button>
                    </div>
                </div>
>>>>>>> cf0a94a1d12d7a2da1a5f140a983d25f6581340d

            </div>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>



<?php $__env->stopSection(); ?>
<!-- <div id="alertBox">
        <div class="layui-form-item">
            <div class="layui-input-inline" style="margin-left:10px;">
                <textarea name="desc" placeholder="例如：您提交的商标注册已经无效，请提供有效的商标注册证，如有疑问，请联系0452-12345678" class="layui-textarea refuseText"></textarea>
            </div>
        </div>
    
    </div> -->
<?php $__env->startSection('js'); ?>

    <script>
        //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
        layui.use(['element','layer','util'], function(){
        var element = layui.element
            ,layer = layui.layer
            ,util = layui.util
            ,$ = layui.$;
        
        //…

            $(".refuse").click(function(){
                layer.open({
                    title: '在线调试'
                    ,content: `<textarea name="desc" placeholder="例如：您提交的商标注册已经无效，请提供有效的商标注册证，如有疑问，请联系0452-12345678" class="layui-textarea refuseText"></textarea>`
                    ,yes: function(index, layero){
                        //按钮【按钮一】的回调
                        var data = $(".refuseText").val();
                        var id = $(".ShopId").data("value");
                        console.log(id);
                        console.log(data);
                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                        $.ajax({
                            url:"<?php echo e(url('admin/shop/opinion')); ?>",
                            type:"POST",
                            dataType:"json",
                            data:{
                                "_token":"<?php echo e(csrf_token()); ?>",
                                "id":id,
                                "shop_text":data,
                            },
                            success:function (data) {
                                console.log(data);
                                if(data.status == 1){
                                    var html ="";
                                    var text = "";
                                    $.each(data.data,function(index,value){
                                        var time = layui.util.toDateString(value.create_time*1000, 'yyyy-MM-dd HH:mm:ss');
                                        text+=`<div class="acmsg">
                                                    <div>${time}</div>
                                                    <div>${value.shop_text}</div>
                                                </div>`;
                                    });
                                    html+= `<div>
                                                <div class="actionLog">
                                                    <label>审核员操作</label>
                                                    <div style="margin-left:140px;">已驳回</div>
                                                </div>
                                                <div style="overflow:hidden">
                                                    <label>审核日志</label>
                                                    <div style="margin-left:140px;">
                                                        ${text}
                                                    </div>
                                                </div>
                                             </div>`;
                                    $(".checkMsg").html(html);
                                }
                            },
                            error:function (data) {
                                console.log("错误");
                            }
                        })
                    }
                });
            });

            $(".pass").click(function () {
                layer.open({
                    title: '在线调试'
                    ,content: `<textarea name="desc" placeholder="例如：店铺资质无问题，已通过，如有疑问，请联系0452-12345678" class="layui-textarea passText"></textarea>`
                    ,yes: function(index, layero){
                        //按钮【按钮一】的回调
                        var data = $(".passText").val();
                        var id = $(".ShopId").data("value");
                        console.log(id);
                        console.log(data);
                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                        $.ajax({
                            url:"<?php echo e(url('admin/shop/opinion_pass')); ?>",
                            type:"POST",
                            dataType:"json",
                            data:{
                                "_token":"<?php echo e(csrf_token()); ?>",
                                "id":id,
                                "shop_text":data,
                            },
                            success:function (data) {
                                console.log(data);
                                if(data.status == 1){
                                    var html ="";
                                    var text = "";
                                    $.each(data.data,function(index,value){
                                        var time = layui.util.toDateString(value.create_time*1000, 'yyyy-MM-dd HH:mm:ss');
                                        text+=`<div class="acmsg">
                                                    <div>${time}</div>
                                                    <div>${value.shop_text}</div>
                                                </div>`;
                                    });
                                    html+= `<div>
                                                <div class="actionLog">
                                                    <label>审核员操作</label>
                                                    <div style="margin-left:140px;">已通过</div>
                                                </div>
                                                <div style="overflow:hidden">
                                                    <label>审核日志</label>
                                                    <div style="margin-left:140px;">
                                                        ${text}
                                                    </div>
                                                </div>
                                             </div>`;
                                    $(".checkMsg").html(html);
                                }
                            },
                            error:function (data) {
                                console.log("错误");
                            }
                        })
                    }
                });



            })


        });
    </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>