<?php $__env->startSection('admin_content'); ?>
    <h1 class="h3 mb-3"><strong>Thông tin đặt lịch</strong></h1>

    <div class="err">
        <?php if($errors->any()): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
    <hr>
    <div class="mb-3">
        <div style="font-size: 16px;"><strong>Khách hàng:</strong> <?php echo e($order->customer); ?></div>
        <div style="font-size: 16px;"><strong>Email:</strong> <?php echo e($order->email); ?></div>
        <div style="font-size: 16px;"><strong>Số điện thoại:</strong> <?php echo e($order->pickup_phone); ?></div>
    </div>
    <hr>
    <div class="mb-3">
        <label for="id_service_order" class="form-label">Mã đặt lịch</label>
        <input type="text" class="form-control" id="id_service_order" name="id_service_order" value="<?php echo e($order->id); ?>"
            disabled>
    </div>

    <div class="mb-3">
        <label for="order_date" class="form-label">Ngày đặt</label>
        <input type="text" class="form-control" id="order_date" name="order_date" value="<?php echo e($order->order_date); ?>"
            disabled>
    </div>

    <div class="mb-3">
        <?php
            $statusOptions = [
                0 => 'Đã đặt lịch',
                1 => 'Đang dùng dịch vụ',
                2 => 'Đã hoàn thành',
                3 => 'Huỷ hẹn',
            ];
        ?>

        <label for="status" class="form-label">Trạng thái</label>
        <select class="form-select" id="status" name="status" required>
            <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value); ?>" <?php echo e($order->status == $value ? 'selected' : ''); ?>>
                    <?php echo e($label); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <div class="d-md-flex justify-content-between gap-2">
            <div class="col-12 col-md-3">
                <img src="<?php echo e(asset($order->product->image_path)); ?>" class="my-2 rounded"
                    style="visibility: visible; width: 100%; height: auto;">
            </div>
            <div class="col-12 col-md-9">
                <h4 class="fw-bold"><?php echo e($order->product->name); ?></h4>
                <div>
                    <p class="m-0">Giá gốc:
                        <span class="text-decoration-line-through me-1">
                            <?php echo e(number_format($order->product->price, 0, ',', '.')); ?>₫
                        </span>
                        (-<?php echo e($order->product->discount); ?>%)
                    </p>
                    <p class="m-0">Giá khuyến mãi:
                        <?php echo e(number_format($order->product->promotional_price, 0, ',', '.')); ?>₫
                    </p>
                </div>
                <div class="my-4"><?php echo e($order->product->description); ?></div>
            </div>
        </div>

        <div class="mb-3">
            <h4 class="text-end text-danger fs-2">Tổng tiền: <?php echo e(number_format($order->total_funds, 0, ',', '.')); ?>đ
            </h4>
        </div>

        <a role="button" class="btn btn-success update-order" data-id="<?php echo e($order->id); ?>">
            Update
        </a>
        &nbsp;<a class="btn btn-secondary" href="<?php echo e(URL::to('/admin/servicer-oders')); ?>">Hủy</a>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.update-order').forEach(button => {
                    button.addEventListener('click', function() {
                        const orderId = this.dataset.id;
                        const selectedStatus = document.querySelector('#status').value;

                        fetch(`/services/change-status/${orderId}?status=${selectedStatus}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({})
                            })
                            .then(res => res.json())
                            .then(order => {
                                showToast('success', 'Thành công',
                                    'Thay đổi trạng thái thành công.', {
                                        position: 'topRight'
                                    });
                                setTimeout(() => location.reload(), 1000);
                            })
                            .catch(error => {
                                console.error(error);
                                showToast('error', 'Lỗi', 'Có lỗi xảy ra khi gửi yêu cầu.', {
                                    position: 'topRight'
                                });
                            });
                    });
                });
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/services/edit.blade.php ENDPATH**/ ?>