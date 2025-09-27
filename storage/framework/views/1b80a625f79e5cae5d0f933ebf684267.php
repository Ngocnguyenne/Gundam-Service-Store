<?php $__env->startSection('admin_content'); ?>
    <?php if($isSearch): ?>
        <h1 class="h3 mb-3"><strong> Kết quả tìm kiếm cho "<?php echo e($keyword); ?>"</strong></h1>
    <?php else: ?>
        <h1 class="h3 mb-3"><strong>Danh sách người dùng</strong></h1>
    <?php endif; ?>
    <div>
        <form action="<?php echo e(route('users.search')); ?>" method="GET"  class="d-flex gap-1">
            <input type="text" value="" placeholder="Tìm kiếm theo tên, email,..." name="keyword" class="form-control shadow-none" required>
            <button class="btn btn-primary" type="submit">
                <i class="align-middle" data-feather="search"></i>
            </button>
        </form>
    </div>
    <div class="table-responsive mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Ảnh đại diện</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Phân quyền</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhập</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><img src="<?php echo e(asset($user->avatar)); ?>" alt="avatar" /></td>
                        <td><?php echo e($user->fullname); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->role->name); ?></td>
                        <td><?php echo e($user->created_at); ?></td>
                        <td><?php echo e($user->updated_at); ?></td>
                        <th>
                            <button type="button" class="btn btn-success open-modal-btn" data-bs-toggle="modal"
                                data-bs-target="#userDetailModal" data-avatar="<?php echo e(asset($user->avatar)); ?>"
                                data-fullname="<?php echo e($user->fullname); ?>" data-email="<?php echo e($user->email); ?>"
                                data-role="<?php echo e($user->role->name); ?>" data-created="<?php echo e($user->created_at); ?>"
                                data-updated="<?php echo e($user->updated_at); ?>" data-phone="<?php echo e($user->phone); ?>"
                                data-address="<?php echo e($user->address); ?>">
                                Chi tiết
                            </button>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <nav aria-label="page navigation">
            <ul class="pagination">
                <li class="page-item <?php if($users->currentPage() === 1): ?> disabled <?php endif; ?>">
                    <a class="page-link" href="<?php echo e($users->previousPageUrl()); ?>">Trước</a>
                </li>
                <?php for($i = 1; $i <= $users->lastPage(); $i++): ?>
                    <li class="page-item <?php if($users->currentPage() === $i): ?> active <?php endif; ?>">
                        <a class="page-link" href="<?php echo e($users->url($i)); ?>"><?php echo e($i); ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if($users->currentPage() === $users->lastPage()): ?> disabled <?php endif; ?>">
                    <a class="page-link" href="<?php echo e($users->nextPageUrl()); ?>">Sau</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailModalLabel">Chi tiết người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="user-avatar" src="" alt="avatar" class="img-fluid rounded-circle"
                            style="width: 150px; height: 150px;">
                    </div>
                    <p><strong>Họ tên:</strong> <span id="user-fullname"></span></p>
                    <p><strong>Email:</strong> <span id="user-email"></span></p>
                    <p><strong>Số điện thoại:</strong> <span id="user-phone"></span></p>
                    <p><strong>Địa chỉ:</strong> <span id="user-address"></span></p>
                    <p><strong>Phân quyền:</strong> <span id="user-role"></span></p>
                    <p><strong>Ngày tạo:</strong> <span id="user-created"></span></p>
                    <p><strong>Ngày cập nhập:</strong> <span id="user-updated"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalTriggerButtons = document.querySelectorAll('.open-modal-btn');

            modalTriggerButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var avatar = this.getAttribute('data-avatar');
                    var fullname = this.getAttribute('data-fullname');
                    var email = this.getAttribute('data-email');
                    var role = this.getAttribute('data-role');
                    var created = this.getAttribute('data-created');
                    var updated = this.getAttribute('data-updated');
                    var address = this.getAttribute('data-address');
                    var phone = this.getAttribute('data-phone');

                    var modal = document.getElementById('userDetailModal');
                    var modalAvatar = modal.querySelector('#user-avatar');
                    var modalFullname = modal.querySelector('#user-fullname');
                    var modalEmail = modal.querySelector('#user-email');
                    var modalRole = modal.querySelector('#user-role');
                    var modalCreated = modal.querySelector('#user-created');
                    var modalUpdated = modal.querySelector('#user-updated');
                    var modalAddress = modal.querySelector('#user-address');
                    var modalPhone = modal.querySelector('#user-phone');

                    modalAvatar.setAttribute('src', avatar);
                    modalFullname.textContent = fullname;
                    modalEmail.textContent = email;
                    modalRole.textContent = role;
                    modalCreated.textContent = created;
                    modalUpdated.textContent = updated;
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\CuahangGundam\resources\views/admin/users/index.blade.php ENDPATH**/ ?>