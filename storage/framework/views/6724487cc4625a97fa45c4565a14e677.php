<?php $__env->startSection('admin_content'); ?>
    <h1 class="h3 mb-3"><strong>Danh sách đơn hàng</strong></h1>

    <div class="">
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success mb-3">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
    </div>

    <div class="card flex-fill">
        <div class="table-responsive mb-2">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="text-center">Dịch vụ</th>
                        <th class="text-center">Người đặt</th>
                        <th class="text-center">Số điện thoại</th>
                        <th class="text-center">Ngày đặt lịch</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Tổng tiền</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($order->product->name); ?></td>
                            <td class="text-center"> <?php echo e($order->customer); ?> </td>
                            <td class="text-center d-xl-table-cell"><?php echo e($order->pickup_phone); ?></td>
                            <td class="text-center d-xl-table-cell">
                                <?php echo e($order->booking_time); ?>

                            </td>
                            <td>
                                <?php
                                    $statuses = [
                                        0 => ['text' => 'Đã đặt lịch', 'class' => 'bg-primary'],
                                        1 => ['text' => 'Đang dùng dịch vụ', 'class' => 'bg-warning'],
                                        2 => ['text' => 'Đã hoàn thành', 'class' => 'bg-success'],
                                        3 => ['text' => 'Huỷ hẹn', 'class' => 'bg-danger'],
                                    ];

                                    $status = $statuses[$order->status] ?? ['text' => '---', 'class' => 'bg-danger'];
                                ?>

                                <span class="badge <?php echo e($status['class']); ?> text-white"><?php echo e($status['text']); ?></span>
                            </td>
                            <td class="text-center d-xl-table-cell"><?php echo e(number_format($order->total_funds, 0, ',', '.')); ?>đ
                            </td>
                            <td class="d-md-table-cell">
                                <div class="gap-1 d-flex align-center justify-content-center">
                                    <a href="<?php echo e(route('service.order.edit', ['id' => $order->id])); ?>"
                                        class="btn btn-warning mb-2">Edit</a>
                                    <?php if($order->status != 3): ?>
                                        <a role="button" class="btn btn-danger cancel-order"
                                            data-id="<?php echo e($order->id); ?>">
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

    <ul class="pagination">
        <li class="page-item <?php if($orders->currentPage() === 1): ?> disabled <?php endif; ?>">
            <a class="page-link" href="<?php echo e($orders->previousPageUrl()); ?>">Trước</a>
        </li>
        <?php for($i = 1; $i <= $orders->lastPage(); $i++): ?>
            <li class="page-item <?php if($orders->currentPage() === $i): ?> active <?php endif; ?>">
                <a class="page-link" href="<?php echo e($orders->url($i)); ?>"><?php echo e($i); ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?php if($orders->currentPage() === $orders->lastPage()): ?> disabled <?php endif; ?>">
            <a class="page-link" href="<?php echo e($orders->nextPageUrl()); ?>">Sau</a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/services/index.blade.php ENDPATH**/ ?>