<a href="<?php echo e(route('detail', ['id' => $product->id])); ?>" class="col-6 col-md-3 px-1 py-1 text-decoration-none text-reset">
    <div class="card">
        <div class="product__img">
            <img src="<?php echo e(asset($product->image_path)); ?>" class="object-cover" alt="">
        </div>
        <div class="product__sale">
            <div>
                <?php if($product->discount): ?>
                    -<?php echo e($product->discount); ?>%
                <?php else: ?>
                    Mới
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body p-2">
            <p class="card-title text-nowrap title-product">
                <?php echo e($product->name); ?>

            </p>
            <div class="card-text">
                <p class="text-decoration-line-through mb-0">
                    <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                    <span>₫</span>
                </p>
                <p>
                    <?php echo e(number_format($product->promotional_price, 0, ',', '.')); ?>

                    <span>₫</span>
                </p>
            </div>
        </div>
    </div>
</a>
<?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/components/product-card.blade.php ENDPATH**/ ?>