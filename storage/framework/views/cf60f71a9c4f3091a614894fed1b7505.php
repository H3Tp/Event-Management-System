<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('components.show-success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <h3>All Event
                <a href="<?php echo e(route('organizer1.events.create')); ?>" class="btn btn-success rounded-circle">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </h3>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Capacity</th>
                        <th>Given Slot</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Date Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            
                            <th scope="row"><?php echo e($rooms->firstItem() + $loop->index); ?></th>
                            <td><?php echo e($room->roomtype->name); ?></td>
                            <td><?php echo e($room->total_room); ?></td>
                            <td><?php echo e($room->no_beds); ?></td>
                            <td><?php echo e($room->orders->count()); ?></td>
                            <td><?php echo e($room->price); ?></td>
                            <td><img src="<?php echo e(asset($room->image)); ?>" width="50" height="40"></td>
                            <td><?php echo e($room->created_at->format('d-m-Y H:i')); ?></td>
                            <td>
                                <?php if($room->status): ?>
                                    <span class="text-success">Active</span>
                                <?php else: ?>
                                    <span class="text-danger">Disabled</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    
                                    <?php if($room->orders()->count() == 0): ?>
                                        <form method="post" action="<?php echo e(route('organizer1.events.destroy', $room->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-secondary" disabled title="Event already booked by users">
                                            <i class="fa-solid fa-lock"></i>
                                        </button>
                                    <?php endif; ?>

                                    <a class="btn btn-warning"
                                        href="<?php echo e(route('organizer1.events.edit', $room->id)); ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center text-primary fw-bold">
                                You haven't created any Events.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Showing <?php echo e($rooms->firstItem()); ?> to <?php echo e($rooms->lastItem()); ?> of <?php echo e($rooms->total()); ?> entries
                </div>
                <div>
                    <?php echo e($rooms->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/organizer1/events/index.blade.php ENDPATH**/ ?>