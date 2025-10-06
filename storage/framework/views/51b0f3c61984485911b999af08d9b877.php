<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Menu</span>
        </a>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="fs-4 me-2">👤</span>
        <span class="d-none d-sm-inline mx-1">
            <?php echo e(Auth::user()->name); ?>

        </span>
    </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><form method="post" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-link dropdown-item">Sign out</button>
                    </form>
                </li>
            </ul>
        </div>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <!-- <li class="nav-item">
                <a href="<?php echo e(route('home')); ?>" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.index')); ?>" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.eventtypes.index')); ?>" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Event Type</span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.events.index')); ?>" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Events</span></a>
            </li>
             <li>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Bookings</span></a>
            </li>


            <li>
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
            </li>


 <li>
    <a href="<?php echo e(route('admin.orders.waiting')); ?>" class="nav-link px-0 align-middle">
        <i class="fs-4 bi-table"></i>
        <span class="ms-1 d-none d-sm-inline">Waiting List</span>
    </a>
</li>





        </ul>
    </div>
</div>
<?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_final\eventmanagement system\eventmanagement system\resources\views/admin/sidebar.blade.php ENDPATH**/ ?>