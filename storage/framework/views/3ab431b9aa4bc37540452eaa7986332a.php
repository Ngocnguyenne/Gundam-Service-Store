<?php $__env->startSection('content'); ?>

<div class="post-slider">
    <i class="fa fa-chevron-left prev" aria-hidden="true"></i>
    <i class="fa fa-chevron-right next" aria-hidden="true"></i>

    <div class="post-wrapper">
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($banner->position == 0): ?>
                <div class="post">
                    <img src="<?php echo e(asset($banner->image_path)); ?>" alt="<?php echo e($banner->title); ?>">
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- Sản phẩm nổi bật -->
<div class="body">

    <div class="body__main-title">
        <h2>Sản phẩm nổi bật</h2>
    </div>

    <div class="post-slider2">
        <i class="fa fa-chevron-left prev2" aria-hidden="true"></i>
        <i class="fa fa-chevron-right next2" aria-hidden="true"></i>

        <div class="row">
            <div class="post-wrapper-slick w-100">
                <?php if($related_products): ?>
                    <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="col-md-3 col-6 post-card-container text-reset text-decoration-none"
                            href="<?php echo e(route('detail', ['id' => @$product->id])); ?>">
                            <div class="product">
                                <div class="product__img">
                                    <img src="<?php echo e(asset(@$product->image_path)); ?>" alt="">
                                </div>
                                <div class="product__sale">
                                    <div>
                                        <?php if(@$product->discount): ?>
                                            -<?php echo e(@$product->discount); ?>%
                                        <?php else: ?>
                                            Mới
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="product__content">
                                    <div class="product__title">
                                        <?php echo e(@$product->name); ?>

                                    </div>

                                    <div class="product__old-price">
                                        <span class="Price">
                                            <bdi>
                                                <?php echo e(number_format(@$product->price, 0, ',', '.')); ?>

                                                <span class="currencySymbol">₫</span>
                                            </bdi>
                                        </span>
                                    </div>

                                    <div class="product__new-price">
                                        <span>
                                            <bdi>
                                                <?php echo e(number_format(@$product->promotional_price, 0, ',', '.')); ?>

                                                <span class="currencySymbol">₫</span>
                                            </bdi>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div>No data</div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<div class="banner">
    <div class="body__main-title">
        <h2>Dịch vụ của chúng tôi</h2>
    </div>

    <div class="banner-top banner-top-2 row gap-2 gap-md-0" style="color: <?php echo e(config('site.text_color')); ?>;">
        <div class="col-md-3 col-sm-6">
            <a href="#" class="banner-top-2-child text-decoration-none text-reset"
                style="background-color: <?php echo e(config('site.color_services_firt')); ?>;">
                <div> <?php echo e(config('site.services_firt')); ?> </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6">
            <a href="#" class="banner-top-2-child text-decoration-none text-reset"
                style="background-color: <?php echo e(config('site.color_services_second')); ?>;">
                <div style="margin: 0 auto;"> <?php echo e(config('site.services_second')); ?> </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6">
            <a href="#" class="banner-top-2-child text-decoration-none text-reset"
                style="background-color: <?php echo e(config('site.color_services_third')); ?>;">
                <div style="margin: 0 auto;"> <?php echo e(config('site.services_third')); ?> </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6">
            <a href="#" class="banner-top-2-child text-decoration-none text-reset"
                style="background-color: <?php echo e(config('site.color_services_fourth')); ?>;">
                <div> <?php echo e(config('site.services_fourth')); ?> </div>
            </a>
        </div>

    </div>
</div>

<div class="banner">
    <?php
        $randomBanner = $banners
            ->filter(function ($banner) {
                return $banner->position == 1;
            })
            ->sortByDesc('created_at')
            ->first();
    ?>

    <?php if($randomBanner): ?>
        <div class="banner-top">
            <img src="<?php echo e(asset($randomBanner->image_path)); ?>" alt="<?php echo e($randomBanner->title); ?>">
        </div>
    <?php endif; ?>

</div>

<div class="body" id='products-by-categories'>
    <div class="body__main-title d-flex align-items-center">
        <h2>Sản phẩm theo danh mục</h2>
    </div>
    <ul class="nav nav-tabs" id="tab-products-category" role="tablist">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item nav-link-item" role="presentation">
                <button class="nav-link<?php echo e((request()->query('category') ?? 1) == $category->id ? ' active' : ''); ?>"
                    id="<?php echo e(Str::slug($category->name)); ?>-tab" data-bs-toggle="tab"
                    data-bs-target="#<?php echo e(Str::slug($category->name)); ?>" role="tab"
                    aria-controls="<?php echo e(Str::slug($category->name)); ?>" aria-selected="<?php echo e($loop->first ? 'true' : 'false'); ?>"
                    onclick="window.location='<?php echo e(route('home', ['category' => $category->id])); ?>#products-by-categories';">
                    <?php echo e($category->name); ?>

                </button>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <div class="tab-content" id="tab-products-category-content">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade<?php echo e($loop->first ? ' show active' : ''); ?>" id="<?php echo e(Str::slug($category->name)); ?>"
                role="tabpanel" aria-labelledby="<?php echo e(Str::slug($category->name)); ?>-tab">
                <div class="row">
                    <?php if($products_by_category->count() > 0): ?>
                        <?php $__currentLoopData = $products_by_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginalecfc721726b8b5798826c96d529d8b59 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecfc721726b8b5798826c96d529d8b59 = $attributes; } ?>
<?php $component = App\View\Components\ProductCard::resolve(['product' => $product] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                        <div class="mt-3 mb-1">Opps! Không tìm thấy dữ liệu!</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="banner">
    <?php
        $latestBanners = $banners
            ->filter(function ($banner) {
                return $banner->position == 2;
            })
            ->sortByDesc('created_at')
            ->take(3);
    ?>
    <div class="row banner-top">
        <?php $__currentLoopData = $latestBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img class="col-md-4 col-sm-6" src="<?php echo e(asset($banner->image_path)); ?>" />
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- Products -->
<div class="body">

    <div class="body__main-title">
        <h2>TẤT CẢ SẢN PHẨM</h2>
    </div>

    <div>
        <div class="row">
            <?php $__currentLoopData = $productsForHome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalecfc721726b8b5798826c96d529d8b59 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecfc721726b8b5798826c96d529d8b59 = $attributes; } ?>
<?php $component = App\View\Components\ProductCard::resolve(['product' => $product] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
        </div>
        <center style="margin-top: 30px;">
            <a href="<?php echo e(route('viewAll')); ?>" class="btn text-white" style="background: #ff4500;">Xem thêm</a>
        </center>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/home.blade.php ENDPATH**/ ?>