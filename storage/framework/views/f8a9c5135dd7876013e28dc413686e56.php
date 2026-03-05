<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Update Category</h2>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Update Category</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?php echo e(route('admin.categories.update', $category->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name
                                        <span class="text-danger fs-5">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo e($category->name); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="title">Title
                                        <span class="text-danger fs-5">*</span>
                                    </label>
                                    <textarea id="title" name="title" class="form-control" cols="30" rows="5" required><?php echo e($category->title); ?></textarea>
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
<?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/categories/update.blade.php ENDPATH**/ ?>