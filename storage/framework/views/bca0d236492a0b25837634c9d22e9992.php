<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Users</h2>
            </div>
        </div>
    </div>

    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2><a href="<?php echo e(route('admin.users.create')); ?>" class="btn cur-p btn-primary"><i
                                        class="fa fa-plus"></i> New</a>
                            </h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Last Login</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($users->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e($user->username); ?></td>
                                                <td><?php echo e($user->mobile); ?></td>
                                                <td><?php echo e($user->email); ?></td>
                                                <td><?php echo e(ucwords($user->role_name)); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('admin.users.updateStatus', $user->id)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" name="status"
                                                            value="<?php echo e($user->status == 1 ? 0 : 1); ?>"
                                                            onclick="return confirm('Are you sure you want to <?php echo e($user->status == 1 ? 'deactivate' : 'activate'); ?> this user?')"
                                                            class="btn btn-sm btn-<?php echo e($user->status == 0 ? 'danger' : 'success'); ?>">
                                                            <?php echo e($user->status == 0 ? 'Deactivated' : 'Activated'); ?>

                                                        </button>
                                                    </form>
                                                </td>
                                                <td><?php echo e($user->created_at->format('d M Y')); ?></td>
                                                <td><?php echo e($user->last_login ? date('d M Y H:i A', strtotime($user->last_login)) : 'Never'); ?>

                                                </td>
                                                <td>
                                                    <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>"
                                                        method="POST" style="display:inline;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" class="text-center">No users found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/users/view.blade.php ENDPATH**/ ?>