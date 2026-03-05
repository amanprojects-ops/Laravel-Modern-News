<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Article</h2>
            </div>
        </div>
    </div>
    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>
                                <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn cur-p btn-primary">
                                    <i class="fa fa-plus"></i>
                                    New
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Writer</th>
                                        <th>Status</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($posts->isEmpty()): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No posts found</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e(ucwords($post->title)); ?></td>
                                                <td><?php echo e(ucwords($post->category_name)); ?></td>
                                                <td><?php echo e(ucwords($post->writer_name)); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('admin.posts.status.update', $post->id)); ?>"
                                                        method="POST" style="display:inline;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <?php if($post->status == 1): ?>
                                                            <button type="submit" name="status" value="2"
                                                                class="badge badge-success cursor-pointer"
                                                                title="Click to set as Rejected"
                                                                onclick="return confirm('Are you sure you want to change the status to Rejected?');">Published</button>
                                                        <?php elseif($post->status == 0): ?>
                                                            <button type="submit" name="status" value="1"
                                                                class="badge badge-warning cursor-pointer"
                                                                title="Click to Publish"
                                                                onclick="return confirm('Are you sure you want to change the status to Published?');">Draft</button>
                                                        <?php else: ?>
                                                            <button type="submit" name="status" value="1"
                                                                class="badge badge-danger cursor-pointer"
                                                                title="Click to Publish"
                                                                onclick="return confirm('Are you sure you want to change the status to Published?');">Rejected</button>
                                                        <?php endif; ?>
                                                    </form>
                                                </td>
                                                <td><?php echo e(date('d M Y h:i A', strtotime($post->updated_at))); ?></td>
                                                <td>
                                                    <a target="_blank"
                                                        href="<?php echo e(route('admin.posts.temp-post', $post->id)); ?>"
                                                        class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                    <a href="<?php echo e(route('admin.posts.edit', $post->id)); ?>"
                                                        onclick="return confirm('Are you sure you want to edit this post?');"
                                                        class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <form action="<?php echo e(route('admin.posts.destroy', $post->id)); ?>"
                                                        method="POST" style="display:inline;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this post?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/posts/view.blade.php ENDPATH**/ ?>