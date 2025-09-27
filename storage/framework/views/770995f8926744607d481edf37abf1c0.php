<?php $__env->startSection('admin_content'); ?>
    <h1 class="h3 mb-3"><strong>Sửa sản phẩm</strong></h1>

    <div class="err">
        <?php if($errors->any()): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-danger"><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>


    <form method="POST" action="<?php echo e(route('product.update', ['product' => $product->id])); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($product->name); ?>" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh:</label>
            <input type="hidden" name="image_path_old" value="<?php echo e($product->image_path); ?>">
            <input type="file" class="form-control mb-3" id="image_path" name="image_path" value="<?php echo e($product->image_path); ?>"
                accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(this, 'preview_image_product')">
            <img id="preview_image_product" src="<?php echo e(asset($product->image_path)); ?>" alt="" width="auto"
                height="120" />
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo e($product->price); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?php echo e($product->description); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="discount" class="form-label">Giảm giá (%):</label>
            <input type="number" class="form-control" id="discount" name="discount" min="0" max="100"
                value="<?php echo e($product->discount); ?>">
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Số lượng:</label>
            <input type="number" class="form-control" id="amount" name="amount" value="<?php echo e($product->amount); ?>"
                required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Danh mục:</label>
            <select name="id_category" class="form-select">
                <option value="<?php echo e($product->id_category); ?>" selected><?php echo e($product->categories->name); ?></option>
                <?php $__currentLoopData = $list_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <input type="submit" class="btn btn-primary" value="Update">
            &nbsp;<a class="btn btn-secondary" href="<?php echo e(URL::to('/admin/product')); ?>">Hủy</a>
        </div>
    </form>

    <script>
        document.getElementById('image').addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;

                img.style.height = '200px';

                document.getElementById('imagePreview').innerHTML = '';
                document.getElementById('imagePreview').appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>