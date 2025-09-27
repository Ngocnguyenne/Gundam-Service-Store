<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5" />
    <meta name="author" content="Admin Dashboard" />
    <meta name="keywords"
        content="Admin Dashboard, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="shortcut icon" type="image/*" href="<?php echo e(asset(config('site.logo'))); ?>" />
    <title>Admin Dashboard</title>
    <?php echo $__env->make('admin.layouts.import_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
    <div class="wrapper">
        
        <?php echo $__env->make('admin.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="dropdown notifications-dropdown">
                            <a class="text-reset me-2 p-1 position-relative" type="button" data-bs-toggle="dropdown"
                                id="notifications-menu" aria-expanded="false">
                                <i class="fa-solid fa-bell" style="font-size: 24px;"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="total-unread-notification">
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-1" aria-labelledby="notifications-menu"
                                id='notifications-list'>
                                <?php if(!Auth::check()): ?>
                                    <li>Bạn cần đăng nhập để sử dụng tính năng này!</li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a type="button" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo e(asset(Auth::user()->avatar ?? 'frontend/img/user.jpg')); ?>"
                                    class="avatar img-fluid rounded-circle me-1" alt="Admin img" />
                                <span class="text-dark"><?php echo e(Auth::user()->name); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user-dropdown">
                                <li><a class="dropdown-item" href="<?php echo e(URL::to('/profile')); ?>"><i
                                            class="align-middle me-1" data-feather="user"></i>Hồ sơ</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="<?php echo e(URL::to('/admin_logout')); ?>"><i
                                            class="align-middle me-2" data-feather="log-out"></i><span
                                            class="align-middle">Đăng xuất</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


            <main class="content">
                <?php echo $__env->yieldContent('admin_content'); ?>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <p class="text-center mb-0">Copy rights by @<span><?php echo e(@config('site.site_name')); ?></span></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <style>
        .dropdown-menu.show {
            display: block;
        }
    </style>
</body>
<?php echo $__env->make('admin.layouts.import_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('js'); ?>
<?php if(Session::has('message')): ?>
    <script>
        showToast('<?php echo e(Session::get('message')['type']); ?>', 'Thông báo',
            '<?php echo e(Session::get('message')['content']); ?>', {
                position: 'topRight'
            });
    </script>
<?php endif; ?>
<script>
    const drop = document.querySelector('.nav-link.dropdown-toggle');
    const dropdownMenu = document.querySelector('.dropdown-menu-end');
    drop.addEventListener('click', function(event) {
        event.preventDefault();
        dropdownMenu.classList.toggle('show');
        dropdownMenu.setAttribute('data-bs-popper', 'static');
    });

    var currentUrl = window.location.href;
    var sidebarLinks = document.querySelectorAll('.sidebar-link');
    sidebarLinks.forEach(function(link) {
        if (link.href === currentUrl) {
            link.closest('.sidebar-item').classList.add('active');
        }

        link.addEventListener('click', function() {
            document.querySelectorAll('.sidebar-item').forEach(function(item) {
                item.classList.remove('active');
            });
            link.closest('.sidebar-item').classList.add('active');
        });
    });
</script>
<script>
    const csrfToken = '<?php echo e(csrf_token()); ?>';
</script>
<?php if(Auth::check()): ?>
    <script src="<?php echo e(asset('frontend/script/notifications.js')); ?>"></script>
    <script>
        const apiNotificationReadUrl = "<?php echo e(route('api_notification_read')); ?>";
        const api_token = '<?php echo e(Auth::user()->api_token); ?>';
        countUnreadNotifications("<?php echo e(route('api_notification_count_unread')); ?>");
        getListNotification("<?php echo e(route('api_notification_list_more')); ?>");
        const notificationsList = document.getElementById('notifications-list');
        notificationsList.addEventListener('scroll', () => {
            if (notificationsList.scrollTop + notificationsList.clientHeight >= notificationsList.scrollHeight) {
                getListNotification("<?php echo e(route('api_notification_list_more')); ?>");
            }
        });
    </script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script type="module" src="<?php echo e(asset('js/pusher8_3.min.js')); ?>"></script>
    <script type="module">
        import Echo from '<?php echo e(asset('js/laravel-echo_1.15.3_echo.min.js')); ?>';

        const id = '<?php echo e(Auth::id()); ?>';

        window.Pusher = Pusher;

        const echo = new Echo({
            broadcaster: 'pusher',
            namespace: 'App.Events',
            key: '<?php echo e(env('PUSHER_APP_KEY')); ?>',
            cluster: '<?php echo e(env('PUSHER_APP_CLUSTER')); ?>',
            forceTLS: true,
            wsHost: window.location.hostname,
            encrypted: true,
        });

        echo.channel(`notification-${id}`).listen('.notification', (data) => {
            appendNotifications(data?.message, true);
            countUnreadNotifications("<?php echo e(route('api_notification_count_unread')); ?>");
        });
    </script>
<?php endif; ?>

</html>
<?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/layouts/admin_layout.blade.php ENDPATH**/ ?>