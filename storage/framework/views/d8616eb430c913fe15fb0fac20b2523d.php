<?php if( session('message') ): ?>
    <div class="alert-message alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('message')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/components/show-success.blade.php ENDPATH**/ ?>