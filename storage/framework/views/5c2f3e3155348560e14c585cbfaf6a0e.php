<?php $__env->startSection('content'); ?>
    <div class="body my-5">
        <h1 class="h3 mb-3"><strong>Danh sách đặt lịch</strong></h1>

        <div class="">
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success mb-3">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
        </div>

        <div class="card flex-fill" style="overflow-x: scroll; max-width: 100%;">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="text-center">Dịch vụ</th>
                        <th class="text-center">Người đặt</th>
                        <th class="text-center">Số điện thoại</th>
                        <th class="text-center">Ngày đặt lịch</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($service->product->name); ?></td>
                            <td class="text-center"> <?php echo e($service->customer); ?> </td>
                            <td class="text-center d-xl-table-cell"><?php echo e($service->pickup_phone); ?></td>
                            <td class="text-center d-xl-table-cell">
                                <?php echo e($service->booking_time); ?>

                            </td>
                            <td>
                                <?php if($service->status == 0): ?>
                                    <span class="badge bg-primary text-white">Đã đặt lịch</span>
                                <?php elseif($service->status == 1): ?>
                                    <span class="badge bg-warning text-white">Đang dùng dịch vụ</span>
                                <?php elseif($service->status == 2): ?>
                                    <span class="badge bg-success text-white">Đã hoàn thành</span>
                                <?php elseif($service->status == 3): ?>
                                    <span class="badge bg-danger text-white">Huỷ hẹn</span>
                                <?php else: ?>
                                    <span class="badge bg-danger text-white">---</span>
                                <?php endif; ?>
                            </td>
                            
                            <td class="d-md-table-cell">
                                <div class="gap-1 d-flex align-center justify-content-center">
                                    <?php if($service->status != 3 && $service->status == 0): ?>
                                        <a role="button" type="button" class="btn btn-outline-success btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modal-edit-service-order">Sửa</a>
                                        <a role="button" class="btn btn-outline-danger btn-sm cancel-order"
                                            data-id="<?php echo e($service->id); ?>">
                                            Huỷ lịch
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- Modal -->
    <form action="<?php echo e(route('service.update', $service->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="modal fade" id="modal-edit-service-order" tabindex="-1"
            aria-labelledby="modal-edit-service-order-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-edit-service-order-label">Cập nhập thông tin khách hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-md-flex justify-content-between">
                            <div class="col-12 col-md-6">
                                <div style="font-size: 16px;">
                                    <strong>Khách hàng:</strong>
                                    <input type="text" name="customer" class="form-control my-1"
                                        placeholder="Tên khách hàng" value="<?php echo e(old('customer', @$service->customer)); ?>">
                                </div>
                                <div style="font-size: 16px;"><strong>Email:</strong>
                                    <input type="email" name="email" value="<?php echo e(old('email', @$service->email)); ?>"
                                        class="form-control my-1" placeholder="Email khách hàng">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div style="font-size: 16px;"><strong>Số điện thoại:</strong>
                                    <input type="text" name="pickup_phone"
                                        value="<?php echo e(old('pickup_phone', @$service->pickup_phone)); ?>" class="form-control my-1"
                                        placeholder="Số điện thoại khách hàng">
                                </div>
                                <div style="font-size: 16px;">
                                    <strong>Thời gian đặt lịch:</strong>
                                    <input type="datetime-local" name="booking_time" class="form-control my-1" required
                                        min="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d\T08:00')); ?>"
                                        max="<?php echo e(\Carbon\Carbon::now()->addDays(30)->format('Y-m-d\T20:00')); ?>"
                                        value="<?php echo e(optional($service->booking_time)->format('Y-m-d\TH:i')); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <?php if($errors->any()): ?>
        <script>
            showToast('error', 'Lỗi', '<?php echo e($errors->first()); ?>', {
                position: 'topRight'
            });
        </script>
    <?php endif; ?>
    <script src="<?php echo e(asset('frontend/script/services-order.js')); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.cancel-order').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.id;
                    if (!confirm('Bạn có chắc muốn huỷ lịch này không?')) return;

                    fetch(`/services/change-status/${orderId}?status=3`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({})
                        })
                        .then(res => res.json())
                        .then(order => {
                            if (order.status == 3) {
                                showToast('success', 'Thành công', 'Huỷ lịch thành công.', {
                                    position: 'topRight'
                                });
                                setTimeout(() => location.reload(), 1000);
                            } else {
                                showToast('error', 'Lỗi', 'Không thể huỷ lịch.', {
                                    position: 'topRight'
                                });
                            }
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

<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/services_order.blade.php ENDPATH**/ ?>