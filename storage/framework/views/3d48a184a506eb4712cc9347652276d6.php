<?php $__env->startSection('content'); ?>
    <style>
        .checkout-card {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }

        .checkmark {
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }
    </style>

    <div class="body mt-5">
        <div class="checkout-card">
            <div class="card_order">
                <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                    <i class="checkmark text-center text-success">✓</i>
                </div>
                <h1 class="text-center text-success">
                    <?php if(isset($type) && $type == 1): ?>
                        Đặt lịch
                    <?php else: ?>
                        Đặt hàng
                    <?php endif; ?>
                    thành công
                </h1>
                <?php if(isset($type) && $type != 1): ?>
                    <p class="text-center text-success">Chúng tôi đang trên đường giao đến bạn<br />hãy để ý đơn hàng!</p>
                <?php endif; ?>
                <p id="redirectMessage" class="text-center text-success mt-3">Bạn sẽ được chuyển hướng sau <span
                        id="countdown">5</span> giây.</p>
            </div>
        </div>
    </div>

    <script>
        var countdownNumber = 5;
        var countdownElement = document.getElementById('countdown');

        var countdownInterval = setInterval(function() {
            countdownNumber--;
            countdownElement.textContent = countdownNumber;
            if (countdownNumber <= 0) {
                clearInterval(countdownInterval);
                window.location.href = '/';
            }
        }, 1000);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/orderSuccess.blade.php ENDPATH**/ ?>