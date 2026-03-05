<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Update Article</h2>
            </div>
        </div>
    </div>
    <div class='container-fluid flex-grow-1 container-p-y'>
        <div class='container my-5'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='col-xl'>
                        <div class='card mb-4'>
                            <div class='card-header d-flex justify-content-between align-items-center'>
                                <h5 class='mb-0'>Update Article</h5>
                            </div>
                            <div class='card-body'>
                                <form action='<?php echo e(route('admin.posts.update', $post->id)); ?>' method='POST'
                                    enctype='multipart/form-data'>
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class='mb-3'>
                                        <label class='form-label' for='title'>Title <span
                                                class='text-danger fs-5'>*</span></label>
                                        <input type='text' class='form-control' id='title' name='title'
                                            value='<?php echo e($post->title); ?>' required>
                                        <div class='form-text text-danger'>Title of the article under 60 characters
                                        </div>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='short_description'>Short Description
                                            <span class='text-danger fs-5'>*</span></label>
                                        <input type='text' class='form-control' id='short_description'
                                            name='short_description' value='<?php echo e($post->short_description); ?>' required>
                                        <div class='form-text text-danger'>Short description of the article under 160
                                            characters
                                        </div>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='keywords'>Keywords <span
                                                class='text-danger fs-5'>*</span></label>
                                        <input type='text' class='form-control' id='keywords' name='keywords'
                                            value='<?php echo e(substr($post->post_keywords, 0, 255) ?? $post->post_keywords); ?>'
                                            placeholder="Enter keywords" required>
                                        <div class='form-text text-danger'>Keywords for the article, separated by commas
                                            and no
                                            spaces under 255 characters</div>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='feature_image' class='form-label'>Feature Image
                                            <span class='text-danger fs-5'>*</span>
                                        </label>
                                        <input type='file' name='feature_image' class='form-control mb-4'
                                            id='feature_image' accept='image/*'
                                            onchange='document.getElementById("featuredimagepreview").src = window.URL.createObjectURL(this.files[0])'>

                                        <div class='card mb-4'>
                                            <img class='card-img' id='featuredimagepreview'
                                                style='width: 100%; height: auto; object-fit: cover;'
                                                src='<?php echo e(asset('storage/post_images/' . $post->image)); ?>'
                                                alt='<?php echo e($post->title); ?>'>
                                        </div>
                                        <div class='form-text text-danger'>Upload a feature image for the
                                            article. Recommended size:
                                            1200x630 pixels.</div>
                                        <input type='hidden' name='old_category' value='<?php echo e($post->id); ?>'>
                                    </div>

                                    <div class='mb-3'>
                                        <label for='category' class='form-label'>Category
                                            <span class='text-danger fs-5'>*</span>
                                        </label>
                                        <?php
                                            $categories = DB::table('categories')
                                                ->where('status', 1)
                                                ->orderBy('name', 'asc')
                                                ->get();
                                        ?>
                                        <select class='form-control' id='category' name='category'
                                            aria-label='Category' required>

                                            <?php if($categories->count() > 0): ?>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value='<?php echo e($category->id); ?>'
                                                        <?php if($category->id == $post->category_id): ?> selected <?php endif; ?>>
                                                        <?php echo e(ucwords($category->name)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <option selected>Categories not found</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <div class='mb-3'>
                                        <label class='form-label' for='Content'>Content
                                            <span class='text-danger fs-5'>*</span>
                                        </label>
                                        <textarea id='description' name='content' class='form-control' cols="30" rows="5" required><?php echo e($post->description); ?></textarea>
                                    </div>
                                    <button type='submit' class='btn btn-primary'>Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/admin/posts/update.blade.php ENDPATH**/ ?>