<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Category</h2>
            </div>
        </div>
    </div>

    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2><a href="<?php echo e(route('admin.categories.create')); ?>" class="btn cur-p btn-primary"><i
                                        class="fa fa-plus"></i> New</a></h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Main Nav</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($categories->count() > 0): ?>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e(ucwords($category->name)); ?></td>
                                                <td><?php echo e(ucwords($category->title)); ?></td>
                                                <td>
                                                    <form
                                                        action="<?php echo e(route('admin.categories.main-navigation', $category->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" name="main_nav"
                                                            class="btn btn-sm btn-<?php echo e($category->main_nav == 1 ? 'success' : 'danger'); ?>"
                                                            value="<?php echo e($category->main_nav == 1 ? 0 : 1); ?>"
                                                            onclick="return confirm('Are you sure you want to <?php echo e($category->main_nav == 0 ? 'Activate' : 'Deactivate'); ?> the main navigation?')">
                                                            <?php echo e($category->main_nav == 1 ? 'Activated' : 'Deactivated'); ?>

                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form
                                                        action="<?php echo e(route('admin.categories.status-update', $category->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" name="status"
                                                            class="btn btn-sm btn-<?php echo e($category->status == 1 ? 'success' : 'danger'); ?>"
                                                            value="<?php echo e($category->status == 1 ? 0 : 1); ?>"
                                                            onclick="return confirm('Are you sure you want to <?php echo e($category->status == 0 ? 'Activate' : 'Deactivate'); ?> the status?')">
                                                            <?php echo e($category->status == 1 ? 'Activated' : 'Deactivated'); ?>

                                                        </button>
                                                    </form>
                                                </td>
                                                <td><?php echo e(date('d M Y H:i A', strtotime($category->created_at))); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                    <form
                                                        action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>"
                                                        method="POST" style="display:inline;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No categories found.</td>
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
<?php /**PATH C:\xampp\htdocs\www\modern-news\resources\views/admin/categories/view.blade.php ENDPATH**/ ?>