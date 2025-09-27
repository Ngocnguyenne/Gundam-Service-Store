<?php $__env->startSection('content'); ?>
<form class="body mt-5" action="<?php echo e(route('service.create', ['id' => $product->id])); ?>" method="POST" id="service-checkout" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php
        $user = Auth::user();
        // dd($product);
    ?>
    <div class="mb-3 bg-light p-3 my-3">
        <h4>Dịch vụ muốn đặt</h4>
        <div class="d-md-flex justify-content-between">
            <div class="col-12 col-md-5">
                 <img src="<?php echo e(asset(@$product->image_path)); ?>" class="my-2 rounded"
                    style="visibility: visible; width: 100%; height: auto;">
            </div>
            <div class="col-12 col-md-7">
                <h4 class="fw-bold"><?php echo e(@$product->name); ?></h4>
                <div>
                    <p class="m-0">Giá gốc:
                        <span class="text-decoration-line-through me-1">
                            <?php echo e(number_format(@$product->price, 0, ',', '.')); ?>₫
                        </span>
                        (-<?php echo e($product->discount); ?>%)
                    </p>
                    <p class="m-0">Giá khuyến mãi:
                        <?php echo e(number_format(@$product->promotional_price, 0, ',', '.')); ?>₫
                    </p>
                </div>
                <div class="my-4"><?php echo e(@$product->description); ?></div>
            </div>
        </div>
    </div>
    <div class="mb-3 bg-light p-3 my-3">
        <h4>Thông tin khách hàng</h4>
        <div class="d-md-flex justify-content-between">
            <div class="col-12 col-md-6">
                <div style="font-size: 16px;">
                    <strong>Khách hàng:</strong>
                    <input type="text" name="customer" class="form-control my-1" placeholder="Tên khách hàng"
                        value="<?php echo e(@$user->fullname ?? old('customer')); ?>">
                </div>
                <div style="font-size: 16px;"><strong>Email:</strong>
                    <input type="email" name="email" value="<?php echo e(@$user->email ?? old('email')); ?>"
                        class="form-control my-1" placeholder="Email khách hàng">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div style="font-size: 16px;"><strong>Số điện thoại:</strong>
                    <input type="text" name="pickup_phone" value="<?php echo e(@$user->phone ?? old('phone')); ?>"
                        class="form-control my-1" placeholder="Số điện thoại khách hàng">
                </div>
                <div style="font-size: 16px;">
                    <strong>Thời gian đặt lịch (Từ 8h đến 20h):</strong>
                    <input type="datetime-local" name="booking_time" class="form-control my-1" id="bookingDate" required
                        min="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d\T08:00')); ?>"
                        max="<?php echo e(\Carbon\Carbon::now()->addDays(30)->format('Y-m-d\T20:00')); ?>">
                </div>
            </div>
        </div>
    </div>
    <h5 class="d-flex justify-content-end align-items-center">
        Tổng thanh toán:&nbsp;<span class="text-danger total-cart" style="font-size: 20px;">
        <?php echo e(number_format(@$product->promotional_price, 0, ',', '.')); ?>đ</span>
        <input type="hidden" name="total_funds" value="<?php echo e($product->promotional_price); ?>">
    </h5>
    <a href="<?php echo e(url('/product/detail', $product->id)); ?>" class="btn btn-danger">
        <i class="fa fa-arrow-left"></i> Quay lại
    </a>
    <button type="submit" class="btn btn-success text-white submit-order">Đặt lịch</button>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('frontend/script/services-order.js')); ?>"></script>
<?php if($errors->any()): ?>
    <script>
        showToast('error', 'Lỗi', '<?php echo e($errors->first()); ?>', {
            position: 'topRight'
        });
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/services_order_checkout.blade.php ENDPATH**/ ?>