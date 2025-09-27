<?php $__env->startSection('admin_content'); ?>
    <h1 class="h3 mb-3"><strong>Sửa danh mục</strong></h1>

    <div class="err">
        <?php if($errors->any()): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>


    <form method="POST" action="<?php echo e(route('category.update', ['category' => $category->id])); ?>"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục:</label>
            <input type="text" class="form-control mb-3" id="name" name="name" value="<?php echo e($category->name ?? old('name')); ?>"
                required>
            <label for="is_show_in_nav" class="form-label">Hiển thị trên thanh điều hướng:</label>
            <select class="form-select mb-3" id="is_show_in_nav" name="is_show_in_nav" required>
                <option disabled>Chọn</option>
                <option value="1" <?php echo e($category->is_show_in_nav == 1 ? 'selected' : ''); ?>>Có</option>
                <option value="0" <?php echo e($category->is_show_in_nav == 0 ? 'selected' : ''); ?>>Không</option>
            </select>
            <label for="path" class="form-label">Đường dẫn:</label>
            <input type="text" class="form-control mb-3" id="path" name="path"
                value="<?php echo e($category->path ?? old('path')); ?>">
        </div>

        <div>
            <input type="submit" class="btn btn-primary" value="Update">
            &nbsp;<a class="btn btn-secondary" href="<?php echo e(URL::to('/admin/category')); ?>">Hủy</a>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>