<?php $__env->startSection('content'); ?>
<div class="container mt-3">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📌 Waiting Orders</h4>
            <span class="badge bg-light text-dark">Total: <?php echo e($orders->count()); ?></span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                <table class="table table-striped table-hover align-middle mb-0 text-center">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th>User</th>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Booked On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($order->user->name ?? 'Guest User'); ?></td>
                                <td><?php echo e($order->room->roomtype->name ?? 'N/A'); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($order->check_in)->format('d M Y')); ?></td>
                                <td>$<?php echo e(number_format($order->room->price ?? 0, 2)); ?></td>
                                <td><?php echo e($order->created_at->format('d M Y, h:i A')); ?></td>
                                <td>
                                    <span class="badge bg-secondary px-3 py-2 text-capitalize">
                                        <?php echo e($order->status); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                        <strong>No waiting orders found</strong>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/organizer/orders/waiting.blade.php ENDPATH**/ ?>