<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">My Bookings</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">My Bookings </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<div class="container my-4">

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
 <?php endif; ?>
<!--<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?> -->

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($err); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>


</body>

    <div class="card">
        <div class="card-header">
            <h2>My Bookings</h2>
        </div>
        <div class="card-body">

            
            <div style="max-height: 300px; overflow-y: auto; font-size: 14px;">
                <table class="table table-sm table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>User Name</th>
                            <th>Event Name</th>
                            <th>Date</th>

                            <th>Price</th>
                            <th>Booked On</th>
                            <th>Book Status</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($order->user->name ?? 'Guest User'); ?></td>
                                <td><?php echo e($order->room->roomtype->name ?? 'N/A'); ?></td>
                                <td><?php echo e($order->check_in); ?></td>

                                <td>$<?php echo e($order->room->price ?? '0'); ?></td>
                                <td><?php echo e($order->created_at->format('d M Y, H:i')); ?></td>
                                <td>
                                   <span class="badge <?php echo e($order->status == 'approved' ? 'bg-success' : ($order->status=='waiting' ? 'bg-secondary' : 'bg-warning')); ?>">
        <?php echo e(ucfirst($order->status)); ?>

    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center text-primary fw-bold">
                                    You don't have any orders yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div></div></div>

<?php
    use App\Models\Order as OrderModel;

    // collect event ids the current user has booked (from $orders passed by controller)
    $userEventIds = $orders->pluck('room.roomtype.id')->filter()->unique()->values();

    if ($userEventIds->isEmpty()) {
        $waitingOrders = collect();
    } else {
        $waitingOrders = OrderModel::with(['user','room.roomtype'])
            ->where('status', 'waiting')
            ->whereHas('room.roomtype', function($q) use ($userEventIds) {
                $q->whereIn('id', $userEventIds->toArray());
            })
            ->get()
            ->groupBy(function($order){
                return $order->room->roomtype->name ?? 'N/A';
            });
    }
?>



        <div class="container my-4">
<div class="card shadow-sm mt-4">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0" style="color:white"> Waiting List (Events You Booked)</h4>
        <span class="badge bg-light text-dark">Total: <?php echo e($waitingOrders->flatten()->count()); ?></span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
            <table class="table table-striped table-hover align-middle mb-0 text-center">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th>Sr.No</th>
                        <th>User</th>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Booked On</th>
                        <th>Status</th>
                        <th>Leave Waiting</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $waitingOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventName => $eventOrders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="table-primary">
                            <td colspan="7" class="fw-bold text-start">
                                <?php echo e($eventName); ?> (<?php echo e($eventOrders->count()); ?> waiting)
                            </td>
                        </tr>

                       <?php $__currentLoopData = $eventOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($i + 1); ?></td>
        <td><?php echo e($order->user->name ?? 'Guest User'); ?></td>
        <td><?php echo e($eventName); ?></td>
        <td><?php echo e(\Carbon\Carbon::parse($order->check_in)->format('d M Y')); ?></td>
        <td>$<?php echo e(number_format($order->room->price ?? 0, 2)); ?></td>
        <td><?php echo e($order->created_at->format('d M Y, h:i A')); ?></td>
        <td>
            <span class="badge bg-secondary px-3 py-2 text-capitalize">
                <?php echo e($order->status); ?>

            </span>
        </td>
        <td>
            <?php if($order->user_id === auth()->id()): ?>
                <form action="<?php echo e(route('orders.leaveWaiting', $order->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to leave waiting list?');">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-sm">
                        Leave
                    </button>
                </form>
            <?php else: ?>
                <span class="text-muted">—</span>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                    <strong>No waiting orders found for your booked events</strong>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Downloads\eventmanagement_system\eventmanagement_system\eventmanagement_system\resources\views/pages/list-orders.blade.php ENDPATH**/ ?>