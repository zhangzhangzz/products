<?php
    $sql = "select * from action order by concat(path, id)";
    $list = DB::select($sql);
?>
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
            <li class="layui-nav-item layui-nav-itemed">
                <?php if(substr_count($v -> path, ",") == 1): ?>
                    <?php if(in_array($v -> name, session("route"))): ?>
                        <a href="javascript:;"><?php echo e($v -> name); ?></a>
                    <?php endif; ?>
                <?php endif; ?>
                <dl class="layui-nav-child">
                    <?php if(substr_count($v -> path, ",") == 2): ?>
                        <?php if(in_array($v -> name, session("route"))): ?>
                            <dd><a href="<?php echo e($v -> a); ?>"><?php echo e($v -> name); ?></a></dd>
                        <?php endif; ?>
                    <?php endif; ?>
                </dl>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
