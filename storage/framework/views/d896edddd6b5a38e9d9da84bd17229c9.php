<?php $__env->startSection('content'); ?>
    <!--Main-->
    <div class="body" style="padding-top: 50px;">
        <a class="buy_continute" href="<?php echo e(URL::to('/')); ?>"><i class="fa fa-arrow-circle-left"></i> Trở lại mua hàng</a>
        <div class="mt-3 d-md-flex">
            <div class="col-md-6">
                <img src="<?php echo e(asset(@$product->image_path)); ?>" class="my-2 rounded"
                    style="visibility: visible; width: 100%; height: auto;">
            </div>
            <div class="col-md-6 my-3">
                <h4 class="fw-bold"><?php echo e(@$product->name); ?></h4>
                <div>
                    <p class="m-0">Giá gốc:
                        <span class="text-decoration-line-through me-1">
                            <?php echo e(number_format(@$product->price, 0, ',', '.')); ?>₫
                        </span>
                        (-<?php echo e($product->discount); ?>%)
                    </p>
                    <p class="m-0">Giá khuyến mãi:
                        <?php echo e(number_format(@$product->promotional_price, 0, ',', '.')); ?>₫
                    </p>
                </div>
                <?php if(isset($product) && !in_array($product->id_category, [1, 4])): ?>
                    <div class="d-flex">
                        <span>Số lượng hiện có: <?php echo e($product->amount); ?></span>
                    </div>
                    <input class="form-control mt-2" style="width: 100px;" type='number' name='quantity' id="quantity" value='1' />
                    <form action="" method="POST">
                        <div class="d-flex mt-3">
                            <a href="<?php echo e(route('add_to_cart', @$product->id)); ?>" id="add-to-cart-link"
                                class="product__cart-add text-decoration-none" name="add-to-cart">
                                Thêm vào giỏ hàng
                            </a>
                            <a href="<?php echo e(route('buy_now', @$product->id)); ?>" class="product__cart-buy text-decoration-none" name="buy-now">
                                Mua ngay
                            </a>
                        </div>
                    </form>
                <?php else: ?>
                <form action="" method="POST">
                    <div class="d-flex mt-3">
                        <a href="<?php echo e(route('site.service.checkout', @$product->id)); ?>" class="product__cart-buy text-decoration-none" name="buy-now">
                            Đặt lịch
                        </a>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>

        <div class="body__main-title">
            <h2>MÔ TẢ SẢN PHẨM</h2>
        </div>
        <div class="px-2 my-4"><?php echo e(@$product->description); ?></div>

        <!--Bình luận sản phẩm-->
        <div class="body__main-title">
            <h2>BÌNH LUẬN</h2>
        </div>
        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <img src="<?php echo e(asset('frontend/img/user.jpg')); ?>" width="45" height="45" style="border-radius: 50%;" />
                    <div class="pl-3">
                        <b><?php echo e($comment->username); ?></b>
                        <div style="line-height: 30px;"><?php echo e($comment->content); ?></div>
                        <div><?php echo e($comment->created_at->format('d/m/Y')); ?></div>
                    </div>
                </div>
            </div>
            <hr />
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <form action="<?php echo e(route('comments.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="d-flex justify-content-between align-items-center">
                <div>Nội dung</div>
                <div class="d-flex align-items-center">
                    <input type="hidden" id="rating" name="rating" value="0" />
                </div>
            </div>
            <textarea name="content" class="form-control" style="outline: none; margin-bottom: 5px;"></textarea>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" />
            <?php if(Auth::user()): ?>
            <input type="hidden" name="username" value="<?php echo e(Auth::user()->fullname); ?>" />
            <?php endif; ?>
            <div>
                <input class="btn btn-maincolor" type="submit" value="Gửi" />
            </div>
        </form>
        <hr>

        <div class="body__main-title">
            <h2>CÓ THỂ BẠN CŨNG THÍCH</h2>
        </div>
        <div class="row">
            <?php if($randoms): ?>
                <?php $__currentLoopData = $randoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $random): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalecfc721726b8b5798826c96d529d8b59 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecfc721726b8b5798826c96d529d8b59 = $attributes; } ?>
<?php $component = App\View\Components\ProductCard::resolve(['product' => $random] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ProductCard::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalecfc721726b8b5798826c96d529d8b59)): ?>
<?php $attributes = $__attributesOriginalecfc721726b8b5798826c96d529d8b59; ?>
<?php unset($__attributesOriginalecfc721726b8b5798826c96d529d8b59); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalecfc721726b8b5798826c96d529d8b59)): ?>
<?php $component = $__componentOriginalecfc721726b8b5798826c96d529d8b59; ?>
<?php unset($__componentOriginalecfc721726b8b5798826c96d529d8b59); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div>Không có dữ liệu!</div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        document.getElementById('quantity').addEventListener('input', function() {
            var quantity = this.value;
            var link = document.getElementById('add-to-cart-link');
            var url = new URL(link.href);
            url.searchParams.set('quantity', quantity);
            link.href = url.toString();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/detail.blade.php ENDPATH**/ ?>