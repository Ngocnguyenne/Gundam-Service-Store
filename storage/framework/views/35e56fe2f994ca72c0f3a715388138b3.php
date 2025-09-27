<div class="header">
    <div class="navbar mx-1">
        <div class="navbar__left">
            <a href="<?php echo e(URL::to('/')); ?>" class="navbar__logo">
                <img src="<?php echo e(asset(@config('site.logo'))); ?>" alt="">
            </a>

            <div class="navbar__menu">
                <i id="bars" class="fa fa-bars" aria-hidden="true"></i>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/')); ?>">Trang chủ</a>
                    </li>
                    <?php $__currentLoopData = $categories_in_nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a
                                href="<?php echo e(route('home', ['category' => $item->id])); ?>#products-by-categories"><?php echo e($item->name); ?></a>
                            <!-- <a href="<?php echo e(URL::to($item->path)); ?>"><?php echo e($item->name); ?></a> -->
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>

        <div class="navbar__center">
            <form action="<?php echo e(route('search')); ?>" method="GET" class="navbar__search">
                <input type="text" value="" placeholder="Nhập để tìm kiếm..." name="keyword" class="search "
                    required>
                <i class="fa fa-search" id="searchBtn"></i>
            </form>
        </div>

        <div class="navbar__right">
            <div class="dropdown me-3 mt-2 pt-1 notifications-dropdown">
                <a class="text-reset me-2 p-1 position-relative" type="button" data-bs-toggle="dropdown"
                    id="notifications-menu" aria-expanded="false">
                    <i class="fa-solid fa-bell" style="font-size: 24px;"></i>
                    <?php if(Auth::check()): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            id="total-unread-notification">
                        </span>
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu px-2 py-1" aria-labelledby="notifications-menu" id='notifications-list'>
                    <?php if(!Auth::check()): ?>
                        <li>Bạn cần đăng nhập để sử dụng tính năng này!</li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if(Auth::check() && Auth::user()): ?>
                <div class="dropdown">
                    <button class="btn btn-outline-dark me-2 p-1" type="button" data-bs-toggle="dropdown"
                        id="dropdown-menu-user" aria-expanded="false">
                        <img class="rounded-circle " src="<?php echo e(asset(Auth::user()->avatar ?? 'frontend/img/user.jpg')); ?>"
                            alt="avatar" width="32" height="32" />
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-menu-user" style="left:-56px">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1" href="<?php echo e(route('user_profile')); ?>">
                                <i class="fa-solid fa-user icon-dropdown-menu"></i>
                                Trang cá nhân
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1" href="<?php echo e(route('site.order')); ?>">
                                <i class="fa-solid fa-truck icon-dropdown-menu"></i>
                                Đơn hàng
                            </a>
                        </li>
                         <li>
                            <a class="dropdown-item d-flex align-items-center gap-1" href="<?php echo e(route('site.services')); ?>">
                                <i class="fa-solid fa-calendar icon-dropdown-menu"></i>
                                Dịch vụ
                            </a>
                        </li>
                        <?php if(Auth::user()->id_role == 1): ?>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-1"
                                    href="<?php echo e(route('dashboard')); ?>">
                                    <i class="fa-brands fa-black-tie icon-dropdown-menu"></i>
                                    Quản trị
                                </a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="dropdown-item btn d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-right-from-bracket icon-dropdown-menu"></i>
                                    Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="login">
                    <a href="<?php echo e(URL::to('login')); ?>"><i class="fa fa-user"></i></a>
                </div>
            <?php endif; ?>

            <a href="<?php echo e(route('cart')); ?>" class="navbar__shopping-cart">
                <img src="<?php echo e(asset('frontend/img/shopping-cart.svg')); ?>" style="width: 24px;" alt="">
                <?php if($count_cart): ?>
                    <?php if($count_cart > 9): ?>
                        <span>9+</span>
                    <?php else: ?>
                        <span><?php echo e($count_cart); ?></span>
                    <?php endif; ?>
                <?php else: ?>
                    <span>0</span>
                <?php endif; ?>
            </a>
        </div>
    </div>

</div>
<?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/partials/navigation.blade.php ENDPATH**/ ?>