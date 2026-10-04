<?php echo $__env->make('admin.inc.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php
    $posts = $posts ?? 0;
    $active = $active ?? 0;
    $drafts = $drafts ?? 0;
    $rejected = $rejected ?? 0;
    $categoriesCount = $categoriesCount ?? 0;
    $usersCount = $usersCount ?? 0;
    $filesCount = $filesCount ?? 0;
    $recentPosts = $recentPosts ?? [];
    $topCategories = $topCategories ?? [];
    $topAuthors = $topAuthors ?? [];
    $monthLabels = !empty($monthLabels) ? $monthLabels : ['Apr 2024', 'Aug 2024', 'Sep 2024', 'Nov 2024', 'Jan 2025', 'Jul 2025'];
    $monthCounts = !empty($monthCounts) ? $monthCounts : [90, 21, 5, 1, 22, 1];
?>

<!-- Inline Style Backup to Guarantee Immediate Rendering Across Browser Caches -->
<style>
:root {
    --dash-primary: #4f46e5;
    --dash-success: #10b981;
    --dash-warning: #f59e0b;
    --dash-danger: #ef4444;
    --dash-info: #06b6d4;
    --dash-radius: 14px;
    --dash-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05), 0 2px 6px -1px rgba(0, 0, 0, 0.03);
    --dash-shadow-hover: 0 12px 28px -4px rgba(0, 0, 0, 0.1);
}
.dash-welcome-banner {
    position: relative;
    background: linear-gradient(135deg, #1e1b4b 0%, #1e293b 50%, #0f172a 100%);
    border-radius: var(--dash-radius);
    padding: 28px 32px;
    margin-bottom: 25px;
    color: #ffffff;
    box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.35);
    overflow: hidden;
}
.dash-welcome-title {
    font-size: 24px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 6px;
}
.dash-welcome-sub {
    color: #cbd5e1;
    font-size: 14px;
    margin-bottom: 0;
    line-height: 1.5;
}
.dash-status-beacon {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 500;
    color: #f1f5f9;
}
.pulse-dot {
    width: 8px;
    height: 8px;
    background-color: #10b981;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
}
.dash-btn-primary {
    background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    color: #ffffff !important;
    padding: 9px 18px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none !important;
}
.dash-btn-glass {
    background: rgba(255, 255, 255, 0.12);
    color: #ffffff !important;
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 9px 16px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none !important;
}
.dash-kpi-card {
    background: #ffffff;
    border-radius: var(--dash-radius);
    padding: 22px;
    box-shadow: var(--dash-shadow);
    border: 1px solid #edf2f7;
    position: relative;
    overflow: hidden;
    transition: all 0.25s ease;
    height: 100%;
    margin-bottom: 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.dash-kpi-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--dash-shadow-hover);
}
.dash-kpi-primary { border-top: 3px solid #4f46e5; }
.dash-kpi-success { border-top: 3px solid #10b981; }
.dash-kpi-warning { border-top: 3px solid #f59e0b; }
.dash-kpi-danger { border-top: 3px solid #ef4444; }
.dash-kpi-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 14px;
}
.dash-kpi-label {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    margin-bottom: 4px;
}
.dash-kpi-value {
    font-size: 32px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.1;
    margin-bottom: 0;
}
.dash-kpi-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.dash-icon-primary { background: #e0e7ff; color: #4338ca; }
.dash-icon-success { background: #d1fae5; color: #047857; }
.dash-icon-warning { background: #fef3c7; color: #b45309; }
.dash-icon-danger { background: #fee2e2; color: #b91c1c; }
.dash-icon-cyan { background: #cffafe; color: #0e7490; }
.dash-icon-purple { background: #ede9fe; color: #6d28d9; }
.dash-icon-pink { background: #fce7f3; color: #be185d; }
.dash-kpi-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 14px;
    padding-top: 12px;
    border-top: 1px solid #f1f5f9;
    font-size: 12px;
}
.dash-mini-stat {
    background: #ffffff;
    border-radius: var(--dash-radius);
    padding: 16px 20px;
    box-shadow: var(--dash-shadow);
    border: 1px solid #edf2f7;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 16px;
}
.dash-mini-stat-info h4 {
    font-size: 22px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}
.dash-mini-stat-info p {
    font-size: 12px;
    color: #64748b;
    margin: 0;
}
.dash-card {
    background: #ffffff;
    border-radius: var(--dash-radius);
    box-shadow: var(--dash-shadow);
    border: 1px solid #edf2f7;
    margin-bottom: 25px;
    overflow: hidden;
}
.dash-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
}
.dash-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}
.dash-card-sub {
    font-size: 12px;
    color: #64748b;
    margin: 2px 0 0 0;
}
.dash-card-body {
    padding: 24px;
}
.dash-card-footer {
    padding: 14px 24px;
    border-top: 1px solid #f1f5f9;
    background: #f8fafc;
    text-align: center;
}
.dash-quick-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 12px;
}
.dash-quick-item {
    background: #ffffff;
    border: 1px solid #edf2f7;
    border-radius: 12px;
    padding: 16px 12px;
    text-align: center;
    color: #1e293b !important;
    text-decoration: none !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.dash-quick-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    border-color: #c7d2fe;
}
.dash-quick-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-bottom: 8px;
}
.dash-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}
.dash-badge-success { background: #dcfce7; color: #15803d; }
.dash-badge-warning { background: #fef3c7; color: #b45309; }
.dash-badge-danger { background: #fee2e2; color: #b91c1c; }
.dash-avatar-circle {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #a855f7);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
}
.dash-cat-bar {
    height: 6px;
    background: #f1f5f9;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 6px;
    width: 100%;
}
.dash-cat-progress {
    height: 100%;
    background: linear-gradient(90deg, #4f46e5, #818cf8);
    border-radius: 10px;
}
.dash-cat-count {
    font-size: 12px;
    font-weight: 700;
    color: #4f46e5;
    background: #eef2ff;
    padding: 3px 8px;
    border-radius: 12px;
}
</style>

<!-- Dashboard Main Content Container -->
<div class="container-fluid" style="padding: 24px 20px;">

    <!-- 1. Hero Welcome Banner -->
    <div class="dash-welcome-banner">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12 mb-3 mb-lg-0">
                <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                    <span class="dash-status-beacon">
                        <span class="pulse-dot"></span> News Portal Active
                    </span>
                    <span class="badge ml-2" style="background: rgba(255,255,255,0.12); color: #e2e8f0; font-size: 11px; padding: 6px 12px; border-radius: 20px;">
                        <i class="fa fa-calendar-o mr-1"></i> <?php echo e(now()->format('l, d M Y')); ?>

                    </span>
                </div>
                <h1 class="dash-welcome-title">
                    Welcome back, <?php echo e(Auth::user()->name ?? 'Administrator'); ?>! ðŸ‘‹
                </h1>
                <p class="dash-welcome-sub">
                    Here is an overview of your news portal's publishing operations, audience metrics, and recent editorial activity.
                </p>
            </div>
            <div class="col-lg-4 col-md-12 text-lg-right">
                <div class="d-flex gap-2 justify-content-lg-end" style="gap: 10px;">
                    <a href="<?php echo e(route('admin.posts.create')); ?>" class="dash-btn-primary">
                        <i class="fa fa-plus-circle"></i> Create New Article
                    </a>
                    <a href="<?php echo e(url('/')); ?>" target="_blank" class="dash-btn-glass" title="Open Front Portal in New Tab">
                        <i class="fa fa-external-link"></i> Live Site
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Primary KPI Stat Cards (4 Cards) -->
    <div class="row">
        <!-- Total Articles -->
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="dash-kpi-card dash-kpi-primary">
                <div>
                    <div class="dash-kpi-top">
                        <div>
                            <div class="dash-kpi-label">Total Articles</div>
                            <h3 class="dash-kpi-value"><?php echo e(number_format($posts)); ?></h3>
                        </div>
                        <div class="dash-kpi-icon dash-icon-primary">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                    </div>
                </div>
                <div class="dash-kpi-bottom">
                    <span style="color: #64748b; font-weight: 500;">
                        <i class="fa fa-database mr-1"></i> Content in database
                    </span>
                    <a href="<?php echo e(route('admin.posts.view')); ?>" style="color: #4f46e5; font-weight: 600;">View all &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Published Articles -->
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="dash-kpi-card dash-kpi-success">
                <div>
                    <div class="dash-kpi-top">
                        <div>
                            <div class="dash-kpi-label">Published & Live</div>
                            <h3 class="dash-kpi-value"><?php echo e(number_format($active)); ?></h3>
                        </div>
                        <div class="dash-kpi-icon dash-icon-success">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="dash-kpi-bottom">
                    <span style="color: #10b981; font-weight: 600;">
                        <i class="fa fa-arrow-up mr-1"></i> <?php echo e($posts > 0 ? round(($active / $posts) * 100, 1) : 0); ?>% publication rate
                    </span>
                    <a href="<?php echo e(route('admin.posts.view')); ?>" style="color: #4f46e5; font-weight: 600;">Manage &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Draft Articles -->
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="dash-kpi-card dash-kpi-warning">
                <div>
                    <div class="dash-kpi-top">
                        <div>
                            <div class="dash-kpi-label">Drafts & Pending</div>
                            <h3 class="dash-kpi-value"><?php echo e(number_format($drafts)); ?></h3>
                        </div>
                        <div class="dash-kpi-icon dash-icon-warning">
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                    </div>
                </div>
                <div class="dash-kpi-bottom">
                    <span style="color: #64748b; font-weight: 500;">
                        <i class="fa fa-clock-o mr-1"></i> <?php echo e($posts > 0 ? round(($drafts / $posts) * 100, 1) : 0); ?>% in review
                    </span>
                    <a href="<?php echo e(route('admin.posts.view')); ?>" style="color: #4f46e5; font-weight: 600;">Review &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Rejected Articles -->
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="dash-kpi-card dash-kpi-danger">
                <div>
                    <div class="dash-kpi-top">
                        <div>
                            <div class="dash-kpi-label">Rejected Articles</div>
                            <h3 class="dash-kpi-value"><?php echo e(number_format($rejected)); ?></h3>
                        </div>
                        <div class="dash-kpi-icon dash-icon-danger">
                            <i class="fa fa-ban"></i>
                        </div>
                    </div>
                </div>
                <div class="dash-kpi-bottom">
                    <span style="color: #ef4444; font-weight: 600;">
                        <i class="fa fa-exclamation-circle mr-1"></i> Requires revision
                    </span>
                    <a href="<?php echo e(route('admin.posts.view')); ?>" style="color: #4f46e5; font-weight: 600;">Check &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Secondary Metrics Strip (Categories, Team, Media) -->
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="dash-mini-stat">
                <div class="dash-kpi-icon dash-icon-cyan">
                    <i class="fa fa-folder-open-o"></i>
                </div>
                <div class="dash-mini-stat-info">
                    <h4><?php echo e($categoriesCount); ?></h4>
                    <p>News Categories <a href="<?php echo e(route('admin.categories.view')); ?>" class="ml-1 text-primary font-weight-bold">&rarr;</a></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="dash-mini-stat">
                <div class="dash-kpi-icon dash-icon-purple">
                    <i class="fa fa-users"></i>
                </div>
                <div class="dash-mini-stat-info">
                    <h4><?php echo e($usersCount); ?></h4>
                    <p>Writers & Editorial Team <a href="<?php echo e(route('admin.users.view')); ?>" class="ml-1 text-primary font-weight-bold">&rarr;</a></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-4">
            <div class="dash-mini-stat">
                <div class="dash-kpi-icon dash-icon-pink">
                    <i class="fa fa-picture-o"></i>
                </div>
                <div class="dash-mini-stat-info">
                    <h4><?php echo e($filesCount); ?></h4>
                    <p>Media Assets & Attachments <a href="<?php echo e(route('admin.attachements.view')); ?>" class="ml-1 text-primary font-weight-bold">&rarr;</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Quick Action Shortcuts Hub -->
    <div class="dash-card mb-4">
        <div class="dash-card-header">
            <div>
                <h3 class="dash-card-title">
                    <i class="fa fa-bolt" style="color: #f59e0b;"></i> Quick Actions Hub
                </h3>
                <p class="dash-card-sub">Fast shortcuts for everyday editorial and management workflows</p>
            </div>
        </div>
        <div class="dash-card-body" style="padding-bottom: 16px;">
            <div class="dash-quick-grid">
                <a href="<?php echo e(route('admin.posts.create')); ?>" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #e0e7ff; color: #4338ca;">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <span style="font-size: 12px; font-weight: 600;">New Article</span>
                </a>

                <a href="<?php echo e(route('admin.posts.view')); ?>" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #dcfce7; color: #15803d;">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <span style="font-size: 12px; font-weight: 600;">All Articles</span>
                </a>

                <a href="<?php echo e(route('admin.categories.create')); ?>" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #cffafe; color: #0e7490;">
                        <i class="fa fa-tags"></i>
                    </div>
                    <span style="font-size: 12px; font-weight: 600;">Add Category</span>
                </a>

                <a href="<?php echo e(route('admin.attachements.create')); ?>" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #fce7f3; color: #be185d;">
                        <i class="fa fa-upload"></i>
                    </div>
                    <span style="font-size: 12px; font-weight: 600;">Upload Media</span>
                </a>

                <a href="<?php echo e(route('admin.users.create')); ?>" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #ede9fe; color: #6d28d9;">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <span style="font-size: 12px; font-weight: 600;">Add Author</span>
                </a>

                <a href="<?php echo e(route('admin.settings')); ?>" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #f1f5f9; color: #475569;">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <span style="font-size: 12px; font-weight: 600;">Site Settings</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 5. Visual Analytics Row (Monthly Activity Chart & Workflow Doughnut) -->
    <div class="row">
        <!-- Monthly Activity Chart -->
        <div class="col-lg-8 mb-4">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-line-chart" style="color: #4f46e5;"></i> Publishing Activity Trend
                        </h3>
                        <p class="dash-card-sub">Content output across active monthly periods</p>
                    </div>
                    <span class="badge badge-light" style="padding: 6px 12px; font-size: 11px;">
                        <i class="fa fa-bar-chart"></i> Activity
                    </span>
                </div>
                <div class="dash-card-body">
                    <div style="position: relative; width: 100%; height: 280px;">
                        <canvas id="publishTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workflow Status Breakdown Doughnut -->
        <div class="col-lg-4 mb-4">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-pie-chart" style="color: #10b981;"></i> Status Distribution
                        </h3>
                        <p class="dash-card-sub">Current distribution of articles</p>
                    </div>
                </div>
                <div class="dash-card-body d-flex flex-column justify-content-center">
                    <div style="position: relative; width: 100%; height: 200px;">
                        <canvas id="statusBreakdownChart"></canvas>
                    </div>
                    <div class="d-flex justify-content-center flex-wrap mt-3" style="gap: 16px; font-size: 12px;">
                        <div class="d-flex align-items-center">
                            <span style="width: 10px; height: 10px; border-radius: 3px; background: #10b981; display: inline-block; margin-right: 6px;"></span>
                            <span style="color: #64748b; font-weight: 500;">Published (<?php echo e($active); ?>)</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span style="width: 10px; height: 10px; border-radius: 3px; background: #f59e0b; display: inline-block; margin-right: 6px;"></span>
                            <span style="color: #64748b; font-weight: 500;">Drafts (<?php echo e($drafts); ?>)</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span style="width: 10px; height: 10px; border-radius: 3px; background: #ef4444; display: inline-block; margin-right: 6px;"></span>
                            <span style="color: #64748b; font-weight: 500;">Rejected (<?php echo e($rejected); ?>)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. Recent Articles Hub & Side Widgets Row -->
    <div class="row">
        <!-- Recent Articles Table -->
        <div class="col-xl-8 col-lg-12 mb-4">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-clock-o" style="color: #4f46e5;"></i> Recent Articles
                        </h3>
                        <p class="dash-card-sub">Latest news posts updated or created on your portal</p>
                    </div>
                    <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-sm btn-outline-primary" style="font-size: 12px; font-weight: 600; border-radius: 6px;">
                        <i class="fa fa-plus"></i> New Article
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0;">
                        <thead style="background: #f8fafc;">
                            <tr>
                                <th style="border-top: none; font-size: 11px; text-transform: uppercase; color: #475569; font-weight: 700;">Article</th>
                                <th style="border-top: none; font-size: 11px; text-transform: uppercase; color: #475569; font-weight: 700;">Category</th>
                                <th style="border-top: none; font-size: 11px; text-transform: uppercase; color: #475569; font-weight: 700;">Author</th>
                                <th style="border-top: none; font-size: 11px; text-transform: uppercase; color: #475569; font-weight: 700;">Status</th>
                                <th style="border-top: none; font-size: 11px; text-transform: uppercase; color: #475569; font-weight: 700;">Updated</th>
                                <th style="border-top: none; font-size: 11px; text-transform: uppercase; color: #475569; font-weight: 700;" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $imgSrc = null;
                                    if (!empty($post->image)) {
                                        if (str_starts_with($post->image, 'post_images/')) {
                                            $imgSrc = asset('uploads/' . $post->image);
                                        } else {
                                            $imgSrc = asset('uploads/post_images/' . $post->image);
                                        }
                                    }
                                ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <?php if($imgSrc): ?>
                                                <img src="<?php echo e($imgSrc); ?>"
                                                     alt="<?php echo e($post->title); ?>"
                                                     style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover; border: 1px solid #e2e8f0;"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div style="display: none; width: 44px; height: 44px; border-radius: 8px; background: #e2e8f0; align-items: center; justify-content: center; color: #94a3b8; font-size: 18px;">
                                                    <i class="fa fa-file-text-o"></i>
                                                </div>
                                            <?php else: ?>
                                                <div style="width: 44px; height: 44px; border-radius: 8px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 18px;">
                                                    <i class="fa fa-file-text-o"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <a href="<?php echo e(route('admin.posts.edit', $post->id)); ?>" style="font-weight: 600; color: #0f172a; font-size: 13px; line-height: 1.4; display: block;" title="<?php echo e($post->title); ?>">
                                                    <?php echo e(Str::limit($post->title, 45)); ?>

                                                </a>
                                                <span style="font-size: 11px; color: #64748b;">
                                                    <i class="fa fa-hashtag"></i> ID: #<?php echo e($post->id); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <span class="badge" style="font-weight: 600; color: #4338ca; background: #e0e7ff; border-radius: 6px; padding: 4px 8px;">
                                            <?php echo e($post->category_name ?? 'General'); ?>

                                        </span>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <span style="font-weight: 500; color: #334155; font-size: 12px;">
                                            <?php echo e($post->writer_name ?? 'Editor'); ?>

                                        </span>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <?php if($post->status == 1): ?>
                                            <span class="dash-badge dash-badge-success">
                                                <span style="width: 6px; height: 6px; border-radius: 50%; background: #16a34a; display: inline-block;"></span> Published
                                            </span>
                                        <?php elseif($post->status == 0): ?>
                                            <span class="dash-badge dash-badge-warning">
                                                <span style="width: 6px; height: 6px; border-radius: 50%; background: #d97706; display: inline-block;"></span> Draft
                                            </span>
                                        <?php else: ?>
                                            <span class="dash-badge dash-badge-danger">
                                                <span style="width: 6px; height: 6px; border-radius: 50%; background: #dc2626; display: inline-block;"></span> Rejected
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <span style="color: #64748b; font-size: 11px;">
                                            <?php echo e(\Carbon\Carbon::parse($post->updated_at ?? $post->created_at)->diffForHumans()); ?>

                                        </span>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-right">
                                        <a href="<?php echo e(route('admin.posts.edit', $post->id)); ?>" class="btn btn-sm btn-light" style="padding: 4px 8px; border-radius: 6px; font-size: 11px;" title="Edit Article">
                                            <i class="fa fa-pencil text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fa fa-newspaper-o fa-2x mb-2 d-block text-secondary"></i>
                                        No articles found. Start by creating a new article!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="dash-card-footer">
                    <a href="<?php echo e(route('admin.posts.view')); ?>" class="font-weight-bold text-primary" style="font-size: 13px;">
                        View All Articles (<?php echo e($posts); ?>) &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side Widgets Column -->
        <div class="col-xl-4 col-lg-12">
            <!-- Widget 1: Top Categories by Articles -->
            <div class="dash-card mb-4">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-folder-open-o" style="color: #06b6d4;"></i> Content Categories
                        </h3>
                        <p class="dash-card-sub">Top categories ranked by volume</p>
                    </div>
                    <a href="<?php echo e(route('admin.categories.view')); ?>" class="text-muted" title="View all">
                        <i class="fa fa-ellipsis-h"></i>
                    </a>
                </div>
                <div class="dash-card-body py-2">
                    <?php $__empty_1 = true; $__currentLoopData = $topCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $catPercentage = $posts > 0 ? round(($cat->total_posts / $posts) * 100) : 0;
                        ?>
                        <div style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span style="font-size: 13px; font-weight: 600; color: #1e293b;"><?php echo e($cat->name); ?></span>
                                    <span class="dash-cat-count"><?php echo e($cat->total_posts); ?> articles</span>
                                </div>
                                <div class="dash-cat-bar">
                                    <div class="dash-cat-progress" style="width: <?php echo e(max($catPercentage, 4)); ?>%;"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted py-3">No categories found.</p>
                    <?php endif; ?>
                </div>
                <div class="dash-card-footer">
                    <a href="<?php echo e(route('admin.categories.create')); ?>" class="font-weight-bold text-primary" style="font-size: 12px;">
                        <i class="fa fa-plus"></i> Add New Category
                    </a>
                </div>
            </div>

            <!-- Widget 2: Top Authors & Editorial Team -->
            <div class="dash-card mb-4">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-users" style="color: #8b5cf6;"></i> Editorial Team
                        </h3>
                        <p class="dash-card-sub">Writers & content contributors</p>
                    </div>
                    <a href="<?php echo e(route('admin.users.view')); ?>" class="text-muted" title="Manage Users">
                        <i class="fa fa-cog"></i>
                    </a>
                </div>
                <div class="dash-card-body py-2">
                    <?php $__empty_1 = true; $__currentLoopData = $topAuthors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                            <div class="dash-avatar-circle">
                                <?php echo e(strtoupper(substr($author->name ?? 'A', 0, 1))); ?>

                            </div>
                            <div style="flex-grow: 1; min-width: 0;">
                                <h5 style="font-size: 13px; font-weight: 600; color: #0f172a; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($author->name); ?></h5>
                                <p style="font-size: 11px; color: #64748b; margin: 0;"><?php echo e($author->email); ?></p>
                            </div>
                            <div>
                                <span class="badge badge-light" style="font-size: 11px; padding: 4px 8px; border-radius: 10px; background: #f1f5f9; color: #334155;">
                                    <strong><?php echo e($author->posts_count); ?></strong> posts
                                </span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted py-3">No authors found.</p>
                    <?php endif; ?>
                </div>
                <div class="dash-card-footer">
                    <a href="<?php echo e(route('admin.users.create')); ?>" class="font-weight-bold text-primary" style="font-size: 12px;">
                        <i class="fa fa-user-plus"></i> Invite Team Member
                    </a>
                </div>
            </div>

            <!-- Widget 3: System & Portal Info -->
            <div class="dash-card mb-4">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-server" style="color: #64748b;"></i> Portal System Info
                        </h3>
                        <p class="dash-card-sub">Environment & framework status</p>
                    </div>
                </div>
                <div class="dash-card-body py-2" style="font-size: 12px;">
                    <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f1f5f9;">
                        <span style="color: #64748b;"><i class="fa fa-code mr-1"></i> Framework</span>
                        <span style="color: #0f172a; font-weight: 600;">Laravel v<?php echo e(app()->version()); ?></span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f1f5f9;">
                        <span style="color: #64748b;"><i class="fa fa-cogs mr-1"></i> PHP Version</span>
                        <span style="color: #0f172a; font-weight: 600;">v<?php echo e(phpversion()); ?></span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f1f5f9;">
                        <span style="color: #64748b;"><i class="fa fa-database mr-1"></i> Database</span>
                        <span style="color: #0f172a; font-weight: 600;">MySQL / MariaDB</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #64748b;"><i class="fa fa-shield mr-1"></i> Environment</span>
                        <span class="badge badge-success text-white" style="font-size: 10px; padding: 3px 8px; border-radius: 6px;"><?php echo e(strtoupper(config('app.env'))); ?></span>
                    </div>
                </div>
                <div class="dash-card-footer">
                    <a href="<?php echo e(route('admin.settings')); ?>" class="font-weight-bold text-muted" style="font-size: 12px;">
                        <i class="fa fa-wrench"></i> Configure System Settings
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Dashboard Main Content Container -->

<?php echo $__env->make('admin.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Direct Script Execution for Chart.js (Guaranteed Execution After Footer Script Load) -->
<script>
(function() {
    var retryCount = 0;
    function renderDashboardCharts() {
        if (typeof Chart === 'undefined') {
            if (retryCount < 20) {
                retryCount++;
                setTimeout(renderDashboardCharts, 150);
            }
            return;
        }

        // 1. Publishing Activity Trend Chart (Bar Chart)
        var trendElem = document.getElementById('publishTrendChart');
        if (trendElem) {
            var labels = <?php echo json_encode($monthLabels, 15, 512) ?>;
            var counts = <?php echo json_encode($monthCounts, 15, 512) ?>;

            new Chart(trendElem.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Articles Created',
                        data: counts,
                        backgroundColor: 'rgba(79, 70, 229, 0.85)',
                        hoverBackgroundColor: 'rgba(67, 56, 202, 1)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                fontColor: '#64748b',
                                fontSize: 11
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: '#f1f5f9',
                                zeroLineColor: '#e2e8f0',
                                drawBorder: false
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#64748b',
                                fontSize: 11,
                                precision: 0
                            }
                        }]
                    }
                }
            });
        }

        // 2. Status Distribution Doughnut Chart
        var statusElem = document.getElementById('statusBreakdownChart');
        if (statusElem) {
            var activeCount = <?php echo e((int) $active); ?>;
            var draftsCount = <?php echo e((int) $drafts); ?>;
            var rejectedCount = <?php echo e((int) $rejected); ?>;

            var chartData = [activeCount, draftsCount, rejectedCount];
            if (activeCount === 0 && draftsCount === 0 && rejectedCount === 0) {
                chartData = [1, 0, 0];
            }

            new Chart(statusElem.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Published', 'Drafts', 'Rejected'],
                    datasets: [{
                        data: chartData,
                        backgroundColor: [
                            '#10b981', // emerald
                            '#f59e0b', // amber
                            '#ef4444'  // rose
                        ],
                        borderWidth: 3,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutoutPercentage: 68,
                    legend: {
                        display: false
                    }
                }
            });
        }
    }

    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        renderDashboardCharts();
    } else {
        window.addEventListener('load', renderDashboardCharts);
    }
})();
</script>

<?php /**PATH C:\xampp\htdocs\Laravel-Modern-News\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>