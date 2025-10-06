<?php $__env->startSection('content'); ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
           
            <div class="card text-white bg-primary">
                <div class="card-header h4 text-center">Total Events</div>
                <div class="card-body py-5">
                    <h5 class="text-center"><?php echo e($totalRooms); ?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success">
                <div class="card-header h4 text-center">Total Bookings
                <div class="card-body py-5">
                    <h5 class="text-center"><?php echo e($reservedRoom); ?></h5>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/admin1/index.blade.php ENDPATH**/ ?>