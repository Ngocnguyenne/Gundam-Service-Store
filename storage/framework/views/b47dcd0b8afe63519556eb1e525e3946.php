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
                        <th class="text-center">ID</th>
                        <th class="text-center">Người nhận</th>
                        <th class="text-center">Thanh toán</th>
                        <th class="text-center">Ngày đặt</th>
                        <th class="text-center">Ngày giao</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Địa chỉ giao hàng</th>
                        <th class="text-center">Điện thoại</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($order->id); ?></td>
                            <td class="text-center"><?php echo e($order->recipient); ?></td>
                            <?php if($order->payment_methods == 0): ?>
                                <td class="d-xl-table-cell text-center">
                                    <div class="badge bg-secondary">COD</div>
                                </td>
                            <?php elseif($order->payment_methods == 1): ?>
                                <td class="d-xl-table-cell text-center">
                                    <div class="badge bg-primary">VNPAY</div>
                                </td>
                            <?php else: ?>
                                <td class="d-xl-table-cell text-center">NaN</td>
                            <?php endif; ?>

                            <td class=" d-xl-table-cell text-center"><?php echo e($order->order_date); ?></td>
                            <?php if($order->delivery_date): ?>
                                <td class="d-xl-table-cell text-center">
                                    <?php echo e(date('d/m/Y', strtotime($order->delivery_date))); ?></td>
                            <?php else: ?>
                                <td class="text-center">----</td>
                            <?php endif; ?>
                            <td class="text-center">
                                
                                <?php if($order->status == 0): ?>
                                    <span class="badge bg-primary">Đang xử lý</span>
                                <?php elseif($order->status == 1): ?>
                                    <span class="badge bg-warning">Chờ lấy hàng</span>
                                <?php elseif($order->status == 2): ?>
                                    <span class="badge bg-success">Đang giao hàng</span>
                                <?php elseif($order->status == 3): ?>
                                    <span class="badge bg-success">Giao hàng thành công</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">----</span>
                                <?php endif; ?>
                            </td>
                            <td class="d-md-table-cell text-center"><?php echo e($order->delivery_address); ?></td>
                            <td class="d-md-table-cell text-center"><?php echo e($order->pickup_phone); ?></td>
                            <td class="d-md-table-cell text-center"><a
                                    href="<?php echo e(route('orders.edit', ['orders' => $order->id])); ?>"
                                    class="btn btn-primary">Edit</a></td>
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

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>