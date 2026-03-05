<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Manage Website Settings</h2>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Website Basic Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.settings.general.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label" for="name">Website Name <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="30"
                                    value="<?php echo e($settings->name); ?>" required>
                                <div class="form-text">Name of your website</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">Website Title <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="<?php echo e($settings->title); ?>" maxlength="60" required>
                                <div class="form-text">Title of your website</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="url">Url <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" class="form-control" id="url" name="url"
                                    value="<?php echo e($settings->url); ?>">
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Website Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.settings.basic.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label" for="about">About Us
                                    <span class="text-danger fs-5">*</span>
                                </label>
                                <textarea name="about" id="about" class="form-control" cols="30" rows="5"><?php echo e($settings->about); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="keywords">Keywords
                                    <span class="text-danger fs-5">*</span>
                                </label>
                                <textarea name="keywords" id="keywords" class="form-control" cols="30" rows="10"><?php echo e($settings->keywords); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description
                                    <span class="text-danger fs-5">*</span>
                                </label>
                                <textarea name="description" class="form-control" cols="30" rows="5" required><?php echo e($settings->description); ?></textarea>
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Social Media Links</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.social-media-settings.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label" for="facebook">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook"
                                    value="<?php echo e($settings->fbPage); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="telegram">Telegram</label>
                                <input type="text" class="form-control" id="telegram" name="telegram"
                                    value="<?php echo e($settings->tgChannel); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="youtube">YouTube Channel</label>
                                <input type="text" class="form-control" id="youtube" name="youtube"
                                    value="<?php echo e($settings->ytChannel); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="wpGroup" class="form-label">Whatsapp Group</label>
                                <input type="text" class="form-control" id="wpGroup" name="wpGroup"
                                    value="<?php echo e($settings->wpGroup); ?>">
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Logo & Favicon</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.settings.images-update')); ?>" method="post"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label" for="logo">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo"
                                    onchange='document.getElementById("previewLogo").src = window.URL.createObjectURL(this.files[0])'>

                                
                                <img id="previewLogo" src="<?php echo e(asset('storage/' . $settings->logo)); ?>" alt="Logo"
                                    class="img-fluid mt-2" style="max-width: 200px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="favicon">Favicon</label>
                                <input type="file" class="form-control" id="favicon" name="favicon"
                                    onchange="document.getElementById('previewFavicon').src = window.URL.createObjectURL(this.files[0])">

                                
                                <img id="previewFavicon" src="<?php echo e(asset('storage/' . $settings->favicon)); ?>"
                                    alt="Favicon" class="img-fluid mt-2" style="max-width: 200px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="main_image">Main Image</label>
                                <input type="file" class="form-control" id="main_image" name="main_image"
                                    onchange="document.getElementById('previewMainImage').src = window.URL.createObjectURL(this.files[0])">

                                
                                <img id="previewMainImage" src="<?php echo e(asset('storage/' . $settings->image)); ?>"
                                    alt="Main Image" class="img-fluid mt-2" style="max-width: 200px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/settings/manage-settings.blade.php ENDPATH**/ ?>