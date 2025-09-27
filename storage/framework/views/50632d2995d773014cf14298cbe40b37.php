<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e(config('site.site_description')); ?>" />
    <link rel="shortcut icon" type="image/*" href="<?php echo e(asset(config('site.logo'))); ?>" />
    <title><?php echo e(@config('site.site_name')); ?></title>
    <?php echo $__env->make('layouts.import_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body>
    
    <?php echo $__env->make('partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php echo $__env->yieldContent('content'); ?>

    
    <div class="go-to-top"><i class="fas fa-chevron-up"></i></div>

    
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
<?php echo $__env->make('layouts.import_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(Session::has('message')): ?>
    <script>
        showToast(
            "<?php echo e(Session::get('message')['type']); ?>",
            'Thông báo',
            "<?php echo e(Session::get('message')['content']); ?>", {
                position: 'topRight'
            }
        );
    </script>
<?php endif; ?>

<script src="<?php echo e(asset('frontend/script/slickSlider.js')); ?>"></script>
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
<?php echo $__env->yieldContent('js'); ?>

</html>
<?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/layouts/site_layout.blade.php ENDPATH**/ ?>