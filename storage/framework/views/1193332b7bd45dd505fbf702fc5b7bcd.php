<?php $__env->startSection('content'); ?>
<div class="auth-form-container" style="height: unset !important; margin-top: -105px!important;">
    <div class="main" style="padding-top: 180px; padding-bottom: 15px; margin-bottom: 0;">
        <form action="<?php echo e(route('register')); ?>" method="POST" class="form" style="width: 400px;" id="form-1">
            <?php echo csrf_field(); ?>
            <h3 class="my-2">Đăng ký tài khoản</h3>
            <div class="my-2 fs-6">
                Bạn đã có tài khoản? <a class="account-register" href="<?php echo e(URL::to('login')); ?>">Đăng nhập</a>
            </div>
            <div class="form-group">
                <label class="control-label text-start">Họ và tên:</label>
                <div>
                    <input type="text" name="fullname" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="required-field ps-2 text-small"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="form-group">
                <label class="control-label text-start">Email:</label>
                <div>
                    <input type="text" name="email" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="required-field ps-2 text-small"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <!-- phone -->
            <div class="form-group">
                <label class="control-label text-start">Phone:</label>
                <div>
                    <input type="text" name="phone" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="required-field ps-2 text-small"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="form-group">
                <label class="control-label text-start">Mật khẩu:</label>
                <div>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="required-field ps-2 text-small"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <div class="form-group">
                <label class="control-label text-start">Nhắc lại mật khẩu:</label>
                <div>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <!-- Hiển thị lỗi của ô input -->
            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="required-field ps-2 text-small"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <button type="submit" value="Create" class="form-submit" name="register_submit">Đăng ký</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/register.blade.php ENDPATH**/ ?>