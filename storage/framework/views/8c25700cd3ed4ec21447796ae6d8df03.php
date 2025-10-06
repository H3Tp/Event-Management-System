<?php $__env->startSection('content'); ?>
<div class="container mt-3">

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill"></i> <strong>Success!</strong> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-x-circle-fill"></i> <strong>Error!</strong> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📅 Upcoming Bookings</h4>
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
                            <th>Action</th>
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
                                    <?php
                                        $statusClass = [
                                            'approved' => 'success',
                                            'pending' => 'warning text-dark',
                                            'waiting' => 'secondary',
                                            'rejected' => 'danger',
                                            'cancelled' => 'danger'
                                        ][$order->status] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?php echo e($statusClass); ?> px-3 py-2 text-capitalize">
                                        <?php echo e($order->status ?? 'N/A'); ?>

                                    </span>
                                </td>

                                
                                <td>
                                    <form action="<?php echo e(route('admin1.orders.update', $order->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="input-group input-group-sm">
                                            <select name="status" class="form-select">


                                              
                                                <option value="rejected" <?php echo e($order->status == 'rejected' ? 'selected' : ''); ?>>Rejected</option>

                                            </select>
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                        <strong>No bookings found</strong>
                                        <p class="mb-0">All clear, no upcoming events yet.</p>
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

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/admin1/orders/index.blade.php ENDPATH**/ ?>