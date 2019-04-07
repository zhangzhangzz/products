<?php $__env->startSection('content'); ?>
    <div style="background:blue;">我是内容区域</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>