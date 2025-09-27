<?php $__env->startSection('content'); ?>
    <div class="body">
        <div class="body__main-title">
            <h2>Từ khóa đã tìm kiếm: <?php echo e($keyword); ?></h2>
        </div>
        <div>
            <div class="row">
                <?php $__currentLoopData = $searchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <!-- call component -->
                    <?php if (isset($component)) { $__componentOriginalecfc721726b8b5798826c96d529d8b59 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecfc721726b8b5798826c96d529d8b59 = $attributes; } ?>
<?php $component = App\View\Components\ProductCard::resolve(['product' => $search] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4">
                <ul class="pagination">
                    <li class="page-item <?php if($searchs->currentPage() === 1): ?> disabled <?php endif; ?>">
                        <a class="page-link" href="<?php echo e($searchs->url(1)); ?>&keyword=<?php echo e($keyword); ?>">First</a>
                    </li>
                    <li class="page-item <?php if($searchs->currentPage() === 1): ?> disabled <?php endif; ?>">
                        <a class="page-link"
                            href="<?php echo e($searchs->previousPageUrl()); ?>&keyword=<?php echo e($keyword); ?>">Previous</a>
                    </li>
                    <?php for($i = 1; $i <= $searchs->lastPage(); $i++): ?>
                        <li class="page-item <?php if($searchs->currentPage() === $i): ?> active <?php endif; ?>">
                            <a class="page-link"
                                href="<?php echo e($searchs->url($i)); ?>&keyword=<?php echo e($keyword); ?>"><?php echo e($i); ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if($searchs->currentPage() === $searchs->lastPage()): ?> disabled <?php endif; ?>">
                        <a class="page-link" href="<?php echo e($searchs->nextPageUrl()); ?>&keyword=<?php echo e($keyword); ?>">Next</a>
                    </li>
                    <li class="page-item <?php if($searchs->currentPage() === $searchs->lastPage()): ?> disabled <?php endif; ?>">
                        <a class="page-link"
                            href="<?php echo e($searchs->url($searchs->lastPage())); ?>&keyword=<?php echo e($keyword); ?>">Last</a>
                    </li>
                </ul>
            </nav>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/search.blade.php ENDPATH**/ ?>