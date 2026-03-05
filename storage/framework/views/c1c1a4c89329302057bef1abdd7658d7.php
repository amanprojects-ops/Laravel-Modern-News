<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Update User</h2>
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
                                <h5 class="mb-0">Update User</h5>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="fullname">Full Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="fullname" name="fullname"
                                                value="<?php echo e($user->name); ?>" aria-label="Enter full name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <div class="input-group">
                                            <input type="text" id="username" name="username" class="form-control"
                                                value="<?php echo e($user->username); ?>" aria-label="Enter username" readonly>
                                        </div>
                                        <div class="form-text">You can use letters, numbers &amp; underscores</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <div class="input-group">
                                            <input type="text" id="email" name="email" class="form-control"
                                                value="<?php echo e($user->email); ?>">
                                        </div>
                                        <div class="form-text">You can use letters, numbers &amp; periods</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="mobile_num">Mobile No</label>
                                        <div class="input-group">
                                            <input type="text" id="mobile" name="mobile" maxlength="10"
                                                class="form-control phone-mask" value="<?php echo e($user->mobile); ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter new password (leave blank to keep current)">
                                        </div>
                                        <div class="form-text">Leave blank if you don't want to change the password
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="role">User Role</label>
                                            <?php
                                                $roles = \App\Models\Role::all();
                                            ?>
                                            <div class="input-group">
                                                <select name="role" id="role" class="form-control">
                                                    <?php if($roles->isNotEmpty()): ?>
                                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($role->id); ?>"
                                                                <?php echo e($user->role == $role->id ? 'selected' : ''); ?>>
                                                                <?php echo e($role->role); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <option value="">No roles available</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="form-text">Select the user role from the list</div>

                                        </div>
                                        <button type="submit" class="btn btn-primary my-3.5">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/users/update.blade.php ENDPATH**/ ?>