<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Upload New File</h2>
            </div>
        </div>
    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="divider text-success">
            <div class="divider-text text-danger">
                <i class="bx bx-star"></i>
                <i class="bx bx-star"></i>
                <i class="bx bx-star"></i>
            </div>
        </div>
        <div class="col-md-4 offset-md-4">
            <div class="card mb-4">
                <div class="card-body">

                    <form action="<?php echo e(route('admin.attachements.save')); ?>" enctype="multipart/form-data" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="uploadfile">File Title & Keywords</label>
                            <input type="text" class="form-control" name="title" maxlength="55"
                                placeholder="Enter File Title and Keyqords" required>
                        </div>
                        <div class="form-group">
                            <label for="uploadfile">Upload File</label>
                            <input type="file" class="form-control" name="file" id="file"
                                onchange="document.getElementById('filePreview').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mt-3">Upload
                                File</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card md-4">
                <img id="filePreview" class="rounded" src="" alt="">
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/attachement/create.blade.php ENDPATH**/ ?>