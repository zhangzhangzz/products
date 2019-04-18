<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <?php
                $menu = tree(arr(menu()));
                $i = 0;
            ?>
            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $i++; ?>
                <?php if($i == 1): ?>
                <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
                <li class="layui-nav-item layui-nav-itemed">
                <?php else: ?>
                <li class="layui-nav-item">
                <?php endif; ?>
                    <?php if(in_array($v['name'], session("route"))): ?>
                        <a href="javascript:;"><?php echo e($v['name']); ?></a>
                    <?php endif; ?>
                    <?php if(!empty($v['child'])): ?>
                        <dl class="layui-nav-child">
                            <?php $__currentLoopData = $v['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(in_array($e['name'], session("route"))): ?>
                                    <dd><a href="<?php echo e($e['a']); ?>"><?php echo e($e['name']); ?></a></dd>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </dl>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
