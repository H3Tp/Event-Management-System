<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('components.show-success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <h3>All Event Types
                <a href="<?php echo e(route('organizer1.eventtypes.create')); ?>" class="btn btn-success rounded-circle">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <th scope="row"><?php echo e($loop->iteration); ?></th>
                        <td><?php echo e($type->name); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <form method="post"
                                      action="<?php echo e(route('organizer1.eventtypes.destroy', ['eventtype' => $type->id])); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                <a class="btn btn-warning"
                                   href="<?php echo e(route('organizer1.eventtypes.edit', ['eventtype' => $type->id])); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-primary fw-bold">You haven't created any lists.</p>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/organizer1/eventtypes/index.blade.php ENDPATH**/ ?>