<?php $__env->startSection('admin_content'); ?>
    <h1 class="h3 mb-3"><strong>Sửa banner</strong></h1>

    <div class="err">
        <?php if($errors->any()): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-danger"><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>

    <form action="<?php echo e(route('banner.update', ['bannerId' => $banner->id])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <p class="text-danger">Lưu ý: Bạn phải cập nhập lại ảnh khi chỉnh sửa!</p>
            <label for="title" class="form-label">Tiêu đề:</label>
            <input type="text" class="form-control mb-3" id="title" title="title" name="title"
                value="<?php echo e($banner->title ?? old('title')); ?>" required>
            <label for="position" class="form-label">Vị trí hiển thị:</label>
            <select class="form-select mb-3" aria-label="" id="position" name="position"
                data-old-value="<?php echo e(old('position', '')); ?>" required>
                <option selected disabled>Chọn</option>
                <option value="0" <?php echo e($banner->position == 0 ? 'selected' : ''); ?>> Header (Slider)</option>
                <option value="1" <?php echo e($banner->position == 1 ? 'selected' : ''); ?>>Middle</option>
                <option value="2" <?php echo e($banner->position == 2 ? 'selected' : ''); ?>> Footer</option>
            </select>
            <label for="image_path" class="form-label">Tải ảnh lên (hỗ trợ jpeg, jpg, png, gif tối đa 3500kb):</label>
            <input type="file" class="form-control mb-3" id="image_path" name="image_path"
                accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(this, 'preview_image')">
            <img id="preview_image" src="<?php echo e(asset($banner->image_path)); ?>" alt="" width="auto" height="120" />
        </div>

        <button type="submit" class="btn btn-primary">Tạo mới</button>
        &nbsp;<a class="btn btn-secondary" href="<?php echo e(URL::to('/admin/banner')); ?>">Hủy</a>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/banner/edit.blade.php ENDPATH**/ ?>