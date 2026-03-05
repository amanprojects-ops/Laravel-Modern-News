<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>New Article</h2>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New Article</h5>
                    <small class="text-muted float-end"><?php echo 'Technical Aman' . @$_SESSION['name']; ?></small>
                </div>
                <div class="card-body">
                    <div class="alert alert-dismissible" id="message" role="alert" style='display:none;'>

                    </div>
                    <form id="newPost" action="<?php echo e(route('admin.posts.save')); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-post-title">Post Title <span
                                    class="text-danger fs-5">*</span></label>
                            <input type="text" class="form-control" name="post_title" value="<?php echo e(old('post_title')); ?>"
                                maxlength="60" placeholder="Enter Post Title">
                            <div class="form-text">Post title should be unique and descriptive. only allow upto 60
                                Characters</div>
                            <?php $__errorArgs = ['post_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="Short Description">Short Description
                                <span class="text-danger fs-5">*</span></label>
                            <input type="text" class="form-control" name="short_description"
                                value="<?php echo e(old('short_description')); ?>" maxlength="160"
                                placeholder="Enter Short Description.">
                            <div class="form-text">Short description should be unique and descriptive. only allow
                                upto 160 Characters</div>
                            <?php $__errorArgs = ['short_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="post-keywords">Post Keywords <span
                                    class="text-danger fs-5">*</span></label>
                            <input type="text" class="form-control" name="post_keywords"
                                value="<?php echo e(old('post_keywords')); ?>" maxlength="255" placeholder="Enter Post Keywords.">
                            <div class="form-text">Post keywords should be unique and descriptive. only allow upto
                                255 Characters</div>
                            <?php $__errorArgs = ['post_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Feature Image
                                <span class="text-danger fs-5">*</span>
                            </label>
                            <input class="form-control mb-3" type="file" id="featureImage" name="featureImage">

                            <?php $__errorArgs = ['featureImage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <script>
                                document.getElementById('featureImage').addEventListener('change', function() {
                                    const file = this.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            document.getElementById('featureImagePreview').src = e.target.result;
                                        }
                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>
                            <div class='card mb-4'>
                                <img class='card-img' id='featureImagePreview' src=""
                                    alt='Feature Image not selected preview not available'>
                            </div>
                            <div class="form-text">Feature image should be in jpg, jpeg, png, webp format and less than
                                2MB
                                in size.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Category
                                <span class="text-danger fs-5">*</span></label>
                            <select class="form-control" name="category" required>
                                <option selected disabled>Select Category</option>
                                <?php
                                    $categories = DB::table('categories')
                                        ->where('status', 1)
                                        ->orderBy('name', 'asc')
                                        ->get();
                                    if ($categories->isEmpty()) {
                                        echo "<option value=''>No categories available</option>";
                                    }
                                ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"
                                        <?php echo e(old('category') == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e(ucwords($category->name)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">Post Content
                                <span class="text-danger fs-5">*</span>
                            </label>
                            <textarea name="content" id="description" class="form-control summernote"
                                placeholder="Exam Info Education Portal Create New Posts.">
                                 <?php echo e(old('content') ?? 'Exam Info Education Portal Create New Posts.'); ?>

                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\www\modern-news\resources\views/admin/posts/create.blade.php ENDPATH**/ ?>