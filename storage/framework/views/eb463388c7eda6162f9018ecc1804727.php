<footer>
    <div class="mx-5 d-md-flex py-3 h-auto">
        <div class="col-12 col-md-3 text-white">
            <h5 class="fw-bold">Giới thiệu</h5>
            <p class="ms-2"><?php echo e(@config('site.site_description')); ?></p>
        </div>

        <div class="col-12 col-md-3 text-white">
            <h5 class="fw-bold">Liên hệ</h5>
            <p class="ms-2">Địa chỉ: <?php echo e(@config('site.address_shop')); ?></p>
            <p class="ms-2">Email: <?php echo e(@config('site.email_shop')); ?></p>
            <p class="ms-2">Số điện thoại: <?php echo e(@config('site.phone_shop')); ?></p>
        </div>

        <div class="col-12 col-md-3 text-white">
            <h5 class="fw-bold">Liên kết</h5>
            <div class="d-flex gap-2">
                <a href="<?php echo e(@config('site.facebook_link')); ?>" target="_blank" class="text-reset">
                    <i class="fa-brands fa-facebook fs-2"></i>
                </a>
                <a href="<?php echo e(@config('site.instagram_link')); ?>" class="text-reset" target="_blank">
                    <i class="fa-brands fa-instagram fs-2"></i>
                </a>
                <a href="<?php echo e(@config('site.tiktok_link')); ?>" class="text-reset" target="_blank">
                    <i class="fa-brands fa-tiktok fs-2"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-3 text-white">
            <h5 class="fw-bold">Dịch vụ</h5>
            
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row text-muted">
            <p class="text-center mb-0">Copy rights by @<span><?php echo e(@config('site.site_name')); ?></span></p>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/partials/footer.blade.php ENDPATH**/ ?>