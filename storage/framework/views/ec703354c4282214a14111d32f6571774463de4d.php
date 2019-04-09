<link rel="stylesheet" href="<?php echo e(asset('css/shopcheck.css')); ?>">
<?php $__env->startSection('content'); ?>
<div class="main" > 
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
                        <div>xxx店铺</div>
                    </div>
    
                    <div>
                        <label>公司名称</label>
                        <div>xxx公司</div>
                    </div>
    
                    <div>
                        <label>负责人</label>
                        <div>张三</div>
                    </div>
    
                    <div>
                        <label>性别</label>
                        <div>女</div>
                    </div>
    
                    <div>
                        <label>联系电话</label>
                        <div>13188888888</div>
                    </div>
    
                </div>

                <div class="rightBox msgBox">

                    <div>
                        <label>店铺地址</label>
                        <div>黑龙江省齐齐哈尔市龙沙区xx街道xxxxxxxxxxxx</div>
                    </div>
                    
                    <div>
                        <label>后台管理账号</label>
                        <div>13333333333</div>
                    </div>
    
                    <div>
                        <label>后台管理密码号</label>
                        <div>123456789</div>
                    </div>

                    <div>
                        <label>主营类目</label>
                        <div>干活干果</div>
                    </div>

                    <div>
                        <label>微信号</label>
                        <div>weixin123</div>
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
                    <div style="margin-left:140px;">有</div>
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

            <div class="titleBox">
                <div>审核日志</div>
            </div>

            <div class="checkMsg">
                <label>审核员操作</label>
                <div style="margin-left: 140px;">
                    <button class="layui-btn pass">通过</button>
                    <button class="layui-btn layui-btn-primary refuse">驳回</button>
                </div>
            </div>

        </div>
            
               
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
        layui.use(['element','layer'], function(){
        var element = layui.element
            ,layer = layui.layer
            ,$ = layui.$;
        
        //…

        $(".refuse").click(function(){
            layer.open({
                title: '在线调试'
                ,content: `<textarea name="desc" placeholder="例如：您提交的商标注册已经无效，请提供有效的商标注册证，如有疑问，请联系0452-12345678" class="layui-textarea refuseText"></textarea>`
                ,yes: function(index, layero){
                    //按钮【按钮一】的回调
                    console.log($(".refuseText").val());
                    layer.close(index); //如果设定了yes回调，需进行手工关闭
                }
            }); 
                

        });


        });
    </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>