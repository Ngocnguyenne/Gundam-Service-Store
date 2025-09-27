<?php $__env->startSection('admin_content'); ?>
    <h1 class="h3 mb-3"><strong>Danh sách danh mục</strong></h1>

    <div class="">
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success mb-3">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
    </div>

    <a class="btn btn-primary" href="<?php echo e(route('category.create')); ?>">Thêm danh mục</a>
    <p class="text-danger my-2">Chỉ nên thêm ít danh mục</p>
    <div class="table-responsive mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên danh mục</th>
                    <th>Hiển thị trên nav</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($category->id); ?></td>
                        <td><?php echo e($category->name); ?></td>
                        <td>
                            <?php if($category->is_show_in_nav == 1): ?>
                                Có
                            <?php elseif($category->is_show_in_nav == 0): ?>
                                Không
                            <?php endif; ?>
                        </td>
                        <td colspan="2">
                            <a href="<?php echo e(route('category.edit', ['category' => $category])); ?>"
                                class="btn btn-warning mb-2">Edit</a>
                            <form method="post" action="<?php echo e(route('category.destroy', ['category' => $category])); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                                <input type="submit" class="btn btn-danger" value="Delete"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>