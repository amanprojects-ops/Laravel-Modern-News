<?php
    $settings = \App\Models\Setting::first();
?>
<?php $__env->startSection('content'); ?>
    <main>
        <!-- Hero Section -->
        <section class="hero-section container">
            <div class="hero-content text-center mb-4">
                <div class="hero-title text-primary">
                    <span class="website"><?php echo e($settings->name); ?></span>:
                    <span class="tagline text-dark">
                        <?php echo e('Stay updated with ' .
                            htmlspecialchars($settings->name) .
                            ' - Timely Government Updates (' .
                            date('Y') .
                            ')'); ?>

                    </span>
                </div>
                <p class="hero-subtitle mt-2 text-red">Welcome to <?php echo e($settings->name . date(' Y')); ?></p>
            </div>

            <!-- Social Media Links -->
            <div class="social-links-container d-flex justify-content-center">
                <a href="<?php echo e($settings->wpGroup); ?>" class="social-link whatsapp d-flex align-items-center">
                    <div class="icon"><i class="fab fa-whatsapp"></i></div>
                    <div class="text"><?php echo e(ucwords($settings->name)); ?> WhatsApp</div>
                </a>

                <a href="<?php echo e($settings->ytChannel); ?>" class="social-link youtube d-flex align-items-center">
                    <div class="icon"><i class="fab fa-youtube"></i></div>
                    <div class="text"><?php echo e(ucwords($settings->name)); ?> YouTube</div>
                </a>

                <a href="<?php echo e($settings->tgChannel); ?>" class="social-link telegram d-flex align-items-center">
                    <div class="icon"><i class="fab fa-telegram-plane"></i></div>
                    <div class="text"><?php echo e(ucwords($settings->name)); ?> Telegram</div>
                </a>
            </div>

            <!-- Marquee Banner -->
            <div class="marquee-container">
                <div class="marquee-content">
                    <span>🎉</span>
                    WELCOME TO <strong><?php echo e(ucwords($settings->name)); ?></strong> - TIMELY UPDATES
                    <span>🚀</span>
                </div>
            </div>
        </section>

        <style>
            .hero-section {
                padding: 2rem 0;
                background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
                animation: fadeIn 1s ease-in-out;
                border-radius: 5px;
                margin-bottom: 10px;
            }

            .hero-title {
                font-size: 1.5rem;
                line-height: 1.2;
                animation: slideIn 1s ease-in-out;
            }

            .hero-subtitle {
                font-size: 1.25rem;
                animation: fadeInUp 1s ease-in-out;
            }

            .social-links-container {
                margin-top: 2rem;
                gap: 1.5rem;
            }

            .social-link {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 1rem;
                border-radius: 5px;
                transition: background-color 0.3s, transform 0.3s;
            }

            .social-link:hover {
                background-color: rgba(0, 0, 0, 0.1);
                transform: translateY(-2px);
            }

            .marquee-container {
                margin-top: 2rem;
                overflow: hidden;
                white-space: nowrap;
                animation: scroll 10s linear infinite;
            }

            .marquee-content {
                display: inline-block;
                font-size: 1.5rem;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes slideIn {
                from {
                    transform: translateX(-100%);
                }

                to {
                    transform: translateX(0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes scroll {
                from {
                    transform: translateX(100%);
                }

                to {
                    transform: translateX(-100%);
                }
            }

            @media (max-width: 575.98px) {

                /* Extra small devices (portrait phones) */
                .hero-title {
                    font-size: 1.5rem;
                    font-weight: bold;
                    text-align: center;
                    visibility: visible;
                }
            }

            @media (min-width: 576px) and (max-width: 767.98px) {

                /* Small devices (landscape phones) */
                .hero-title {
                    font-size: 2rem;
                    font-weight: bold;
                    text-align: center;
                    visibility: visible;
                }
            }

            @media (min-width: 768px) and (max-width: 991.98px) {

                /* Medium devices (tablets) */
                .hero-title {
                    font-size: 2.5rem;
                    font-weight: bold;
                    text-align: center;
                    visibility: visible;
                }
            }

            @media (min-width: 992px) and (max-width: 1199.98px) {

                /* Large devices (desktops) */
                .hero-title {
                    font-size: 2.5rem;
                    font-weight: bold;
                    text-align: center;
                    visibility: visible;
                }
            }

            @media (min-width: 1200px) {

                /* Extra large devices (large desktops) */
                .hero-title {
                    font-size: 2.5rem;
                    font-weight: bold;
                    text-align: center;
                    visibility: visible;
                }
            }
        </style>
        <?php
            $latestPosts = \App\Models\Post::where('status', 1)->latest()->take(8)->get();
            $gradientClasses = [
                'gradient-1',
                'gradient-2',
                'gradient-3',
                'gradient-4',
                'gradient-5',
                'gradient-6',
                'gradient-7',
                'gradient-8',
            ];
        ?>
        <!-- Featured Posts -->
        <section class="featured-posts container">
            <h1 class="text-center mb-4">Latest Updates</h1>

            <div class="post-grid">
                <?php $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('view-blog', $post->slug == null ? Str::slug($post->title) : $post->slug)); ?>"
                        class="post-card <?php echo e($gradientClasses[$index % count($gradientClasses)]); ?>">
                        <?php echo e(Str::limit($post->title, 45)); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
        <!-- Category Listings Section -->
        <section class="container">
            <h3 class="text-center mb-4 mt-5">Browse by Categories</h3>
            <?php
                $categories = \App\Models\Categorie::all();
            ?>
            <div class="categories-grid">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="category-card">
                        <h4 class="category-heading">
                            <?php echo e(strtoupper($category->name)); ?>

                        </h4>
                        <ul class="category-list">
                            <?php
                                $posts = \App\Models\Post::whereRaw("category_id = {$category->id} AND status = 1")
                                    ->orderBy('updated_at', 'desc')
                                    ->take(8)
                                    ->get();
                            ?>
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('view-blog', $post->slug == null ? Str::slug($post->title) : $post->slug)); ?>"
                                        title="<?php echo e(Str::limit("{$post->title}")); ?>">
                                        <?php echo e(Str::limit($post->title, 35)); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\App\Models\Post::where('category_id', $category->id)->where('status', 1)->count() == 0): ?>
                                <li>No posts available</li>
                            <?php endif; ?>
                        </ul>
                        <div class="text-center">
                            <a href="<?php echo e(route('view-category', Str::slug($category->name))); ?>" class="view-more-btn">View
                                More</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tut\news-admin\resources\views/frontend/index.blade.php ENDPATH**/ ?>