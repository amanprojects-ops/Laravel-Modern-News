<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Role</h2>
            </div>
        </div>
    </div>

    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2><a href="<?php echo e(route('admin.roles.create')); ?>" class="btn cur-p btn-primary"><i
                                        class="fa fa-plus"></i> New</a>
                            </h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Role Name</th>
                                        <th>Status</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($roles->count() > 0): ?>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e(ucwords($role->role)); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('admin.roles.updateStatus', $role->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" name="status"
                                                            value="<?php echo e($role->status == 1 ? 0 : 1); ?>"
                                                            class="btn btn-sm <?php echo e($role->status == 0 ? 'btn-danger' : 'btn-success'); ?>"
                                                            onclick="return confirm('Are you sure you want to <?php echo e($role->status == 0 ? 'activate' : 'deactivate'); ?> this role?')">
                                                            <?php echo e($role->status == 0 ? 'Deactivated' : 'Activated'); ?>

                                                        </button>
                                                    </form>
                                                </td>
                                                <td><?php echo e(date('d-m-Y H:i A', strtotime($role->updated_at))); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('admin.roles.edit', $role->id)); ?>"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="<?php echo e(route('admin.roles.destroy', $role->id)); ?>"
                                                        method="POST" style="display:inline;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No roles found</td>
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
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/roles/view.blade.php ENDPATH**/ ?>