

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h2>Customer</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">User Name</th>
                     
                    <th scope="col">Email</th>
                   
                    <th scope="col"> Phone</th>
                    <th scope="col">Create At</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($customer->name); ?></td>
                        
                        <td><?php echo e($customer->email); ?></td>
                        
                        <td><?php echo e($customer->phone); ?></td>
                        <td><?php echo e($customer->created_at); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-primary fw-bold">You don't have any customers.</p>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/organizer/customers/index.blade.php ENDPATH**/ ?>