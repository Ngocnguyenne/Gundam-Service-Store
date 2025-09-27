<?php $__env->startSection('admin_content'); ?>
    <h1 class="h3 mb-3"><strong>Danh sách sản phẩm</strong></h1>

    <div class="">
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success mb-3" role="alert">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-between">
        <a class="btn btn-primary" href="<?php echo e(route('product.create')); ?>">Thêm sản phẩm</a>
        <form action="<?php echo e(route('search.product')); ?>" method="GET" class="d-flex">
            <input type="text" value="" placeholder="Nhập để tìm kiếm..." name="keyword" class="form-control"
                style="width: unset;" required>
            <button class="btn btn-primary" type="submit">
                <i class="align-middle" data-feather="search"></i>
            </button>
        </form>
    </div>
    <div class="table-responsive mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Hình</th>
                    <th>Số lượng</th>
                    <th>Giá gốc</th>
                    <th>Giảm giá</th>
                    <th>Giá khuyến mại</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($product->name); ?></td>
                        <td><img src="<?php echo e(asset($product->image_path)); ?>" class="object-fit-contain" width="120"
                                height="120" alt=""></td>
                        <td><?php echo e($product->amount); ?></td>
                        <td><?php echo e($product->price); ?></td>
                        <td>
                            <?php if($product->discount): ?>
                                <?php echo e($product->discount); ?>%
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($product->promotional_price); ?></td>
                        <td colspan="2">
                            <a href="<?php echo e(route('product.edit', ['product' => $product])); ?>"
                                class="btn btn-warning mb-2">Edit</a>
                            <form method="post" action="<?php echo e(route('product.destroy', ['product' => $product])); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                                <input type="submit" class="btn btn-danger" value="Delete"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?php if($products->currentPage() === 1): ?> disabled <?php endif; ?>">
                <a class="page-link" href="<?php echo e($products->previousPageUrl()); ?>">Trước</a>
            </li>
            <?php for($i = 1; $i <= $products->lastPage(); $i++): ?>
                <li class="page-item <?php if($products->currentPage() === $i): ?> active <?php endif; ?>">
                    <a class="page-link" href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php if($products->currentPage() === $products->lastPage()): ?> disabled <?php endif; ?>">
                <a class="page-link" href="<?php echo e($products->nextPageUrl()); ?>">Sau</a>
            </li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/products/index.blade.php ENDPATH**/ ?>