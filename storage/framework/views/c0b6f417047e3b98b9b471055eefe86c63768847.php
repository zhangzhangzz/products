<link rel="stylesheet" href="<?php echo e(asset('css/roleedit.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="padding:30px;">
            <form id="formmy" class="layui-form formBox" action="<?php echo e(url('admin/role/insert')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <?php if(session('errors')): ?>
                    <div class="errors">
                        <h3>警告</h3>
                        <br/>
                        <?php echo e(session('errors')); ?>

                        <br/>
                    </div>
                <?php endif; ?>
                <div class="layui-form-item">
                    <label class="layui-form-label">角色名称：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" lay-verify="name" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>
<<<<<<< HEAD
                    <span class="error erna">请填写至少2个汉字</span>
=======
                    <span class="error name">请填写汉字</span>
>>>>>>> 69fbb80c0d6d5ababe6c8c3af23a368ca11c768b
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">角色描述：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="descript" value="<?php echo e(old('descript')); ?>" lay-verify="describe" placeholder="请输入描述" autocomplete="off" class="layui-input">
                    </div>
                    <span class="error erde">请填写相关描述</span>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">上级名称：</label>
                    <div class="layui-input-block seinput">
                        <select name="boss" lay-verify="required">
                            <?php $__currentLoopData = $name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($v -> name); ?>"><?php echo e($v -> name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">状&emsp;&emsp;态：</label>
                    <div class="layui-input-block seinput">
                    <select name="state" lay-verify="required">
                        <option value="1">启用</option>
                        <option value="0">禁用</option>
                    </select>
                    </div>
                </div>
            
                <div style="color:#555;padding: 15px;"><h2>权限设置</h2></div>
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="quanxian">
                    <div class="tables">
                        <div class="list">
                            <p class="title">
                                <input type="checkbox" value="<?php echo e($v['id']); ?>" data-id="12" lay-skin="primary" title="<?php echo e($v['name']); ?>" name="action_id[]" lay-filter="allChoose" class="allChoose">
                            </p>
                            <div class="ultable">
                                <ul>

                                    <?php if(!empty($v['child'])): ?>
                                    <?php $__currentLoopData = $v['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(is_array($s)): ?>
                                    <li>
                                        <input type="checkbox" value="<?php echo e($s['id']); ?>" data-id="12" lay-skin="primary" title="<?php echo e($s['name']); ?>" name="action_id[]" lay-filter="choose" class="aaa">

                                        <div class="list-three">
                                            <ul>
                                                <?php if(!empty($s['child'])): ?>
                                                <?php $__currentLoopData = $s['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <?php if(is_array($c)): ?>
                                                <li>
                                                    <input type="checkbox" value="<?php echo e($c['id']); ?>" data-id="12" lay-skin="primary" title="<?php echo e($c['name']); ?>" name="action_id[]" lay-filter="three-choose">
                                                </li>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
		        </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="layui-form-item btnBox">
                    <div class="layui-input-block" style="margin: 0;">
                    <button class="layui-btn layui-btn-disabled getBtn" lay-submit lay-filter="formDemo" style="margin-left:130px;">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

        layui.use('form', function(){
            var form = layui.form
            $ = layui.$;

            //全选选单选      ----------------------------------------
            var num = false;
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
                }else {
                $(data.elem).parents('.list').children('.title').find(' input.allChoose').get(0).checked = true;
                }
                form.render('checkbox');
            });

            form.on('checkbox(three-choose)', function(data) {
                num = true;
                var child = $(data.elem).parents('li').find(
                'input[type="checkbox"]:not([name="show"])');
                var childChecked = $(data.elem).parents('li').find(
                    'ul li input[type="checkbox"]:not([name="show"]):checked')
                if (childChecked.length == child.length-1) {
                    $(data.elem).parents('li').find(' input.aaa').get(0).checked = true;
                } else if(childChecked.length==0){
                    $(data.elem).parents('li').find(' input.aaa').get(0).checked = false;
                }else {
                    $(data.elem).parents('li').find(' input.aaa').get(0).checked = true;
                }
                form.render('checkbox');
            });

            var dflag = false,nflag = false;
            $(".layui-input").change(function(){
                var item = $(this).attr("name");
                var value = $(this).val();
                var error = $($(this).parent()).next();
                
                if(item=="name"){
                    var ret = /^[\u4E00-\u9FA5]+$/;
                    nflag = ret.test(value);
                    if(nflag){
                        $(error).css({color:"green"});
                        $(error).html("√可以使用");
                    }else{
                        $(error).css({color:"red"});
                        $(error).html("汉字组成");
                    }
                }

                if(item=="descript"){
                    if(value!=""){
                        $(error).css({color:"red"});
                        $(error).html("请填写角色描述");
                    }else{
                        $(error).css({color:"green"});
                        $(error).html("√可以使用");
                        dflag=true;
                    }
                }

                if(aflag && nflag && psflag && spflag && partment!=""){
                    $(".getBtn").attr("class","layui-btn getBtn");
                }else{
                    $(".getBtn").attr("class","layui-btn layui-btn-disabled getBtn");
                }
            });

            form.verify({
                name: [
                    /^[\u4E00-\u9FA5]{2,}$/
                    ,'至少由两个汉字组成'
                ]
                ,pass: function(value,item){
                    if(value==""){
                        return '请填写角色描述';
                    }
                }
            });      
      

          //监听提交
          form.on('submit(formDemo)', function(data){
              if(!num){
                    layer.msg('至少选择一个权限！');
                    return false;
              }
                $("#formmy").submit();
          });

        });
        

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>