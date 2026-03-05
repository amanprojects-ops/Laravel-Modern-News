<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Update Role</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid flex-grow-1 container-p-y">

        <!-- Layout Demo -->
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Update Role</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo e(route('admin.roles.update', $role->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="role_name">Role Name
                                            <span class="text-danger fs-5">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="role_name" name="role_name"
                                            value="<?php echo e(old('role_name', $role->role)); ?>" placeholder="Enter Role Name"
                                            required>
                                        <?php $__errorArgs = ['role_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Permissions <span
                                                class="text-danger fs-5">*</span></label>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" id="permission_all" class="form-check-input"
                                                onclick="toggleAllPermissions(this)">
                                            <label class="form-check-label fw-bold" for="permission_all">Allow
                                                All</label>
                                        </div>
                                        <?php
                                            $modules = [
                                                'user' => 'User',
                                                'category' => 'Category',
                                                'role' => 'Role',
                                                'posts' => 'Posts',
                                                'settings' => 'Settings',
                                                'message' => 'Message',
                                                'comments' => 'Comments',
                                            ];
                                            $actions = [
                                                'view' => 'View',
                                                'create' => 'Create',
                                                'edit' => 'Edit',
                                                'delete' => 'Delete',
                                            ];
                                            $permissions = json_decode($role->permissions, true);
                                        ?>
                                        <div class="row">
                                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moduleKey => $moduleName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6 mb-2">
                                                    <div class="fw-bold"><?php echo e($moduleName); ?></div>
                                                    <div class="ms-3">
                                                        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actionKey => $actionName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $permValue = $moduleKey . '.' . $actionKey;
                                                                $isChecked =
                                                                    is_array($permissions) &&
                                                                    in_array($permValue, $permissions);
                                                            ?>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox"
                                                                    class="form-check-input permission-checkbox"
                                                                    name="role_permission[]"
                                                                    id="permission_<?php echo e($moduleKey); ?>_<?php echo e($actionKey); ?>"
                                                                    value="<?php echo e($permValue); ?>"
                                                                    <?php echo e($isChecked ? 'checked' : ''); ?>>
                                                                <label class="form-check-label"
                                                                    for="permission_<?php echo e($moduleKey); ?>_<?php echo e($actionKey); ?>">
                                                                    <?php echo e($actionName); ?>

                                                                </label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleAllPermissions(source) {
            let checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(cb => cb.checked = source.checked);
        }
    </script>
    <?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/roles/update.blade.php ENDPATH**/ ?>