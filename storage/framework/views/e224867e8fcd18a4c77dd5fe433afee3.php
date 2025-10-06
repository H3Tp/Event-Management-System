<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3>Edit Event Types</h3>
        </div>
        <div class="card-body">
            <form class="row g-3" method="post" action="<?php echo e(route('organizer.eventtypes.update', ['eventtype' => $type->id])); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>
                <div class="col-auto">
                    <label class="form-label">Event Type Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $type->name)); ?>"
                           class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Event Type</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/organizer/eventtypes/edit.blade.php ENDPATH**/ ?>