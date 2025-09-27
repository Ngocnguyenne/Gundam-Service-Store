<?php $__env->startSection('admin_content'); ?>
    <h1 class="h3 mb-3"><strong>Danh sách banner</strong></h1>

    <div class="">
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success mb-3">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
    </div>

    <a class="btn btn-primary" href="<?php echo e(route('banner.create')); ?>">Thêm banner</a>
    <div class="table-responsive mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Vị trí hiển thị</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($banner->id); ?></td>
                        <td><img src="<?php echo e(asset($banner->image_path)); ?>" class="object-fit-contain" width="120"
                                height="120" alt=""></td>
                        <td><?php echo e($banner->title); ?></td>
                        <td>
                            <?php if($banner->position == 0): ?>
                                Header (Slider)
                            <?php elseif($banner->position == 1): ?>
                                Middle
                            <?php else: ?>
                                Footer
                            <?php endif; ?>
                        </td>
                        <td colspan="2">
                            <a href="<?php echo e(route('banner.edit', ['banner' => $banner])); ?>"
                                class="btn btn-warning mb-2">Edit</a>
                            <form method="post" action="<?php echo e(route('banner.destroy', ['banner' => $banner])); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                                <input type="submit" class="btn btn-danger" value="Delete"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa banner này không?')">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/banner/index.blade.php ENDPATH**/ ?>