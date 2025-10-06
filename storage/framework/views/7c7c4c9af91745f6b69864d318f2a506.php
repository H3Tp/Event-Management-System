<div class="container-fluid bg-dark px-0">
    <div class="row gx-0">
        <div class="col-lg-3 bg-dark d-none d-lg-block">
            <a href="<?php echo e(route('home')); ?>"
               class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <h1 class="m-0 text-primary text-uppercase">Event Mgt</h1>
            </a>
        </div>
        <div class="col-lg-9">
            <div class="row gx-0 bg-white d-none d-lg-flex">
                <div class="col-lg-7 px-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        <p class="mb-0">event@gmail.com</p>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center py-2">
                        <i class="fa fa-phone-alt text-primary me-2"></i>
                        <p class="mb-0">+1 (647) 669-0466</p>
                    </div>
                </div>
                <div class="col-lg-5 px-5 text-end">
                    <div class="d-inline-flex align-items-center py-2">
                        <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                        <a class="" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                <a href="<?php echo e(route('home')); ?>" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 text-primary text-uppercase">Event Management</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a class="nav-item nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>"
                           href="<?php echo e(route('home')); ?>">Home</a>
                        <a class="nav-item nav-link <?php echo e(request()->routeIs('rooms.index') ? 'active' : ''); ?>"
                           href="<?php echo e(route('rooms.index')); ?>">Event</a>
                        <?php if(auth()->guard()->guest()): ?>
                            <a class="nav-item nav-link <?php echo e(request()->routeIs('login') ? 'active' : ''); ?>"
                               href="<?php echo e(route('login')); ?>">Login</a>
                            <a class="nav-item nav-link <?php echo e(request()->routeIs('register') ? 'active' : ''); ?>"
                               href="<?php echo e(route('register')); ?>">Register</a>
                        <?php else: ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <?php echo e(Auth::user()->name); ?></a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="<?php echo e(route('orders.index')); ?>" class="dropdown-item">My Bookings</a>
                                    <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">My Profile</a>
                                    <form method="post" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-link dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </div>
                            <?php if(Auth::user()->is_admin): ?>
                                <a href="<?php echo e(route('admin.index')); ?>" class="nav-item nav-link">Admin Page</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Dell\Downloads\eventmanagement system_test\eventmanagement system\eventmanagement system\resources\views/layouts/header.blade.php ENDPATH**/ ?>