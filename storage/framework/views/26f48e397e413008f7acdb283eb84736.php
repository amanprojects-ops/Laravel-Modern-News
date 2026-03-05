<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-file yellow_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no"><?php echo e($posts); ?></p>
                            <p class="head_couter">Posts</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-file-text blue1_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no"><?php echo e($drafts); ?></p>
                            <p class="head_couter">Drafts Posts</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-newspaper-o green_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no"><?php echo e($active); ?></p>
                            <p class="head_couter">Active Posts</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-eye-slash red_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no"><?php echo e($rejected); ?></p>
                            <p class="head_couter">Rejected Posts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row column3">
            <!-- testimonial -->
            <div class="col-md-6">
                <div class="dark_bg full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Top 10 Posts</h2>
                        </div>
                    </div>
                    <div class="full graph_revenue">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content testimonial">
                                    <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for carousel items -->
                                        <div class="carousel-inner">
                                            <?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="item carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                                                    <div class="img-box"><img
                                                            src="<?php echo e(asset('storage/post_images/' . $post->image)); ?>"
                                                            alt="<?php echo e($post->title); ?>"></div>
                                                    <p class="testimonial"><?php echo e(Str::limit($post->title, 100)); ?></p>
                                                    <p class="overview">
                                                        <b><?php echo e($post->writer_name); ?></b>
                                                    </p>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <!-- Carousel controls -->
                                        <a class="carousel-control left carousel-control-prev"
                                            href="#testimonial_slider" data-slide="prev">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                        <a class="carousel-control right carousel-control-next"
                                            href="#testimonial_slider" data-slide="next">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end testimonial -->
            <!-- progress bar -->
            <div class="col-md-6">
                <div class="dash_blog">
                    <div class="dash_blog_inner">
                        <div class="dash_head">
                            <h3>
                                <span>
                                    <i class="fa fa-file"></i> Latest Posts
                                </span>
                                <span class="plus_green_bt">
                                    <a href="<?php echo e(route('admin.posts.create')); ?>">+</a>
                                </span>
                            </h3>
                        </div>
                        <?php
                            $latestPosts = App\Models\Post::latest()->take(5)->get();
                        ?>
                        <div class="task_list_main">
                            <ul class="task_list">
                                <?php $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="#"><?php echo e($post->title); ?></a>
                                        <br>
                                        <strong><?php echo e($post->created_at->diffForHumans()); ?></strong>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="read_more">
                            <div class="center"><a class="main_bt read_bt" href="<?php echo e(route('admin.posts.view')); ?>">Read
                                    More</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end progress bar -->
        </div>
    </div>
</div>
<!-- end dashboard inner -->

<?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\www\modern-news\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>