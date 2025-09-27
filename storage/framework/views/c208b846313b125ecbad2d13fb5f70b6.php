<?php $__env->startSection('content'); ?>
    <?php if(Auth::check()): ?>
        <?php $user = Auth::user(); ?>
        <div class="container mt-4 py-4">
            <div class="row">
                <div class="col-12 col-md-9 row border rounded p-3 mx-auto">
                    <div class="col-md-4 d-flex flex-column justify-content-start align-items-center mt-md-4">
                        <img id="avatar-user" src="<?php echo e(asset($user->avatar ?? 'frontend/img/user.jpg')); ?>" alt="ảnh đại diện" width="200"
                            height="200" class="object-fit-cover" />
                        <p class="mt-1">
                            Đã tham gia: <?php echo e($user->created_at->diffForHumans()); ?>

                        </p>
                    </div>
                    <div class="col-md-8">
                        
                        <div class="form-check form-switch d-flex justify-content-end">
                            <input class="form-check-input shadow-none" type="checkbox" role="switch"
                                id="toggle-switch-edit-profile">
                            <label class="form-check-label ms-1" for="toggle-switch-edit-profile">Chỉnh sửa</label>
                        </div>

                        
                        <form action="<?php echo e(route('user_profile_update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                            <label for="fullname">Họ và tên:</label>
                            <input class="form-control mb-2" type="text" id="fullname" name="fullname"
                                value="<?php echo e($user->fullname ?? old('fullname')); ?>" disabled />
                            <label for="email">Email:</label>
                            <input class="form-control mb-2" type="email" id="email" value="<?php echo e($user->email); ?>"
                                placeholder="Nhập địa chỉ email của bạn" disabled />
                            <label for="phone">Số điện thoại:</label>
                            <input class="form-control mb-2" type="text" id="phone" name="phone"
                                value="<?php echo e($user->phone ?? old('phone')); ?>" placeholder="Nhập số điện thoại của bạn"
                                disabled />
                            <label for="address">Địa chỉ:</label>
                            <input class="form-control mb-2" type="text" id="address" name="address"
                                value="<?php echo e($user->address ?? old('address')); ?>" placeholder="Nhập địa chỉ của bạn"
                                disabled />
                            <div class="d-none" id="avatar-container">
                                <label for="avatar">Ảnh đại diện:</label>
                                <input class="form-control mb-2" type="file" id="avatar" name="avatar"
                                    value="<?php echo e($user->avatar); ?>" accept="image/jpeg, image/png, image/jpg, image/gif"
                                    disabled onchange="previewImage(this, 'avatar-user')"/>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success d-none" id="submit-update-profile">
                                    Cập nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container mt-5 py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger text-center p-4">
                        <strong>Bạn phải đăng nhập để thấy trang này!</strong>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const emailInput = document.getElementById('email');
            const toggleSwitch = document.getElementById('toggle-switch-edit-profile');
            const inputs = document.querySelectorAll('form input');
            const submitButton = document.getElementById('submit-update-profile');
            const avatarInput = document.getElementById('avatar-container');

            toggleSwitch.addEventListener('change', () => {
                const isEnabled = toggleSwitch.checked;
                inputs.forEach(input => {
                    input.disabled = !isEnabled;
                });
                if (isEnabled) {
                    emailInput.disabled = true;
                    submitButton.classList.remove('d-none');
                    avatarInput.classList.remove('d-none');
                } else {
                    submitButton.classList.add('d-none');
                    avatarInput.classList.add('d-none');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/pages/profile.blade.php ENDPATH**/ ?>