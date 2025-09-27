<?php $__env->startSection('content'); ?>
<style>
    input[type="number"] {
        -webkit-appearance: textfield;
        -moz-appearance: textfield;
        appearance: textfield;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }
</style>
<div class="body mt-5">
    <?php if(Auth::check()): ?>
        <?php if($carts->count() <= 0): ?>
            <?php echo $__env->make('components.no-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <div class="table-responsive mb-2">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center">Ảnh</th>
                            <th class="text-center">Sản phẩm</th>
                            <th class="text-center">Giá gốc</th>
                            <th class="text-center">Giảm giá</th>
                            <th class="text-center">Khuyến mại</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Tổng tiền</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php        $total = 0 ?>
                        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php            $total += $cart->product->promotional_price * $cart->quantity ?>
                            <tr data-id="<?php echo e($cart->id); ?>">
                                <td class="text-center">
                                    <img src="<?php echo e(asset($cart->product->image_path)); ?>" width="100" height="100"
                                        class="object-fit-contain" />
                                </td>
                                <td class="text-center">
                                    <p><?php echo e($cart->product->name); ?></p>
                                </td>
                                <td class="text-center text-decoration-line-through">
                                    <p><?php echo e(number_format($cart->product->price, 0, ',', '.')); ?>đ</p>
                                </td>
                                <td class="text-center">
                                    <p><?php echo e($cart->product->discount); ?>%</p>
                                </td>
                                <td class="text-center">
                                    <p><?php echo e(number_format($cart->product->promotional_price, 0, ',', '.')); ?>đ</p>
                                </td>
                                <td class="text-center">
                                    <?php if(!in_array($cart->product->id_category, [1, 4])): ?>
                                        <div class="d-flex justify-content-around gap-1">
                                            <button class="btn btn-danger decrease-btn" data-id="<?php echo e($cart->id); ?>">-</button>
                                            <input type="number" class="form-control text-center quantity-input" name="quantity"
                                                value="<?php echo e($cart->quantity); ?>" min="1" max="<?php echo e($cart->product->amount); ?>" readonly />
                                            <button class="btn btn-danger increase-btn" data-id="<?php echo e($cart->id); ?>">+</button>
                                        </div>
                                    <?php else: ?>
                                        <p>--</p>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center total-money">
                                    <?php echo e(number_format($cart->product->promotional_price * $cart->quantity, 0, ',', '.')); ?>đ
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="updateQuantity(<?php echo e($cart->id); ?>, 0)">Xóa</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <h5 class="d-flex justify-content-end align-items-center">
                Tổng thanh toán:&nbsp;<span class="text-danger total-cart" style="font-size: 20px;">
                    <?php echo e(number_format($total, 0, ',', '.')); ?>đ</span>
            </h5>
            <a href="<?php echo e(url('/')); ?>" class="btn btn-info text-white">
                <i class="fa fa-arrow-left"></i> Tiếp tục mua sắm
            </a>
            <button class="btn btn-success">
                <a class="text-white text-decoration-none" href="<?php echo e(route('checkout')); ?>">
                    Thanh toán
                </a>
            </button>
        <?php endif; ?>
    <?php else: ?>
        <div class="my-5 py-5 text-center">
            <p class="fs-5">Đăng nhập để sử dụng tính năng này!</p>
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    function updateQuantity(id, quantity) {

            fetch("<?php echo e(route('update_quantity_cart')); ?>", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    id: id,
                    quantity: quantity
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        row.querySelector('.total-money').textContent = data.totalPrice;
                        document.querySelector('.total-cart').textContent = data.totalCart;

                        if (quantity === 0) {
                            showToast('success', 'Thông báo', data.message, {
                                position: 'topRight'
                            });
                            row.remove();
                            document.querySelector('.total-cart').textContent = data.totalCart;
                            if (document.querySelectorAll('tbody tr').length === 0) {
                                document.querySelector('.body').innerHTML = `<?php echo $__env->make('components.no-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>`;
                            }
                        }
                    } else {
                        showToast('error', 'Lỗi', 'Có lỗi xảy ra vui lòng thử lại sau!', {
                            position: 'topRight'
                        });
                    }
                })
                .catch(error => {
                    showToast('error', 'Lỗi', 'Có lỗi xảy ra vui lòng thử lại sau!', {
                        position: 'topRight'
                    });
                });
        }
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('tbody').addEventListener('click', function (event) {
            const target = event.target;
            if (target.classList.contains('increase-btn') || target.classList.contains(
                'decrease-btn')) {
                const row = target.closest('tr');
                const quantityInput = row.querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value);

                if (target.classList.contains('increase-btn')) {
                    if (quantity < parseInt(quantityInput.max)) {
                        quantity++;
                        updateQuantity(row.dataset.id, quantity);
                    }
                } else if (target.classList.contains('decrease-btn')) {
                    if (quantity > 0) {
                        quantity--;
                        updateQuantity(row.dataset.id, quantity);
                    }
                }

                quantityInput.value = quantity;
            }
        });


    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/cart.blade.php ENDPATH**/ ?>