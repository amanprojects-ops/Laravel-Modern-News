<!DOCTYPE html>
<html lang="en">
<?php
    $settings = \App\Models\Setting::first();
    // Null-safe fallback so nothing crashes if settings row is missing
    if (!$settings) {
        $settings = new \App\Models\Setting([
            'name'        => config('app.name', 'Admin Panel'),
            'title'       => config('app.name', 'Admin Panel'),
            'logo'        => null,
            'logo_dark'   => null,
            'favicon'     => null,
            'keywords'    => '',
            'description' => '',
            'meta_author' => '',
        ]);
    }
?>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title><?php echo e($title ?? ($settings->name ? $settings->name . ' — Admin Panel' : 'Admin Panel')); ?></title>
    <meta name="keywords" content="<?php echo e($settings->keywords ?? ''); ?>">
    <meta name="description" content="<?php echo e($settings->description ?? ''); ?>">
    <meta name="author" content="<?php echo e($settings->meta_author ?? $settings->name ?? ''); ?>">
    <!-- site icon -->
    <?php if($settings->favicon): ?>
    <link rel="icon" href="<?php echo e(asset('uploads/' . $settings->favicon)); ?>" type="image/png" />
    <?php endif; ?>
    <?php if($settings->apple_touch_icon ?? null): ?>
    <link rel="apple-touch-icon" href="<?php echo e(asset('uploads/' . $settings->apple_touch_icon)); ?>" />
    <?php endif; ?>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap.min.css')); ?>" />
    <!-- site css -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/style.css')); ?>" />
    <!-- responsive css -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/responsive.css')); ?>" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-select.css')); ?>" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/perfect-scrollbar.css')); ?>" />
    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/custom.css')); ?>?v=<?php echo e(file_exists(public_path('backend/css/custom.css')) ? filemtime(public_path('backend/css/custom.css')) : time()); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.css')); ?>" />

    <style>
    /* ── Initials Avatar ── */
    .initials-avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .5px;
        flex-shrink: 0;
        text-transform: uppercase;
        user-select: none;
    }
    .initials-avatar.lg {
        width: 48px;
        height: 48px;
        font-size: 1rem;
        border-radius: 10px;
    }
    /* ── Logo text fallback ── */
    .logo-text-fallback {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 6px 0;
        display: block;
    }
    </style>

</head>

<body class="dashboard dashboard_1">
    <?php echo $__env->make('admin.inc.sweetalert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="<?php echo e(url('/')); ?>">
                                <?php if($settings->logo): ?>
                                <img class="logo_icon img-responsive"
                                    src="<?php echo e(asset('uploads/images/' . $settings->logo)); ?>"
                                    alt="<?php echo e($settings->name ?? 'Site Logo'); ?>"
                                    title="<?php echo e($settings->name ?? ''); ?>"
                                    onerror="this.style.display='none';this.nextElementSibling.style.display='block';"
                                />
                                <?php else: ?>
                                <span class="logo-text-fallback">
                                    <?php echo e($settings->name ?? config('app.name')); ?>

                                </span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img">
                                <?php
                                    $authUser   = Auth::user();
                                    $uInitials  = collect(explode(' ', $authUser->name ?? 'A'))
                                                    ->map(fn($w) => strtoupper($w[0]))
                                                    ->take(2)->implode('');
                                ?>
                                <div class="initials-avatar lg" title="<?php echo e($authUser->name ?? ''); ?>">
                                    <?php echo e($uInitials); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4><?php echo e(Str::upper($settings->name ?? config('app.name', 'NEWS ADMIN'))); ?></h4>
                    <ul class="list-unstyled components">
                        <!-- Deshboard List -->
                        <li class="active">
                            <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard yellow_color"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <!-- Article List -->
                        <li>
                            <a href="#articles" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-newspaper-o purple_color"></i><span>Articles</span></a>
                            <ul class="collapse list-unstyled" id="articles">
                                <li><a href="<?php echo e(route('admin.posts.view')); ?>">> <span>View Articles</span></a></li>
                                <li><a href="<?php echo e(route('admin.posts.create')); ?>">> <span>New Articles</span></a></li>
                            </ul>
                        </li>
                        <!-- Article File -->
                        <li>
                            <a href="#files" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-image orange_color"></i><span>Article File</span></a>
                            <ul class="collapse list-unstyled" id="files">
                                <li><a href="<?php echo e(route('admin.attachements.view')); ?>">> <span>View Files</span></a></li>
                                <li><a href="<?php echo e(route('admin.attachements.create')); ?>">> <span>New Files</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- Article Category -->
                        <li>
                            <a href="#category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-tasks green_color"></i><span>Cotegory</span></a>
                            <ul class="collapse list-unstyled" id="category">
                                <li><a href="<?php echo e(route('admin.categories.view')); ?>">> <span>View Category</span></a>
                                </li>
                                <li><a href="<?php echo e(route('admin.categories.create')); ?>">> <span>New Category</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- Article Users Role -->
                        <li>
                            <a href="#user_role" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-plus purple_color"></i><span>Users Role</span></a>
                            <ul class="collapse list-unstyled" id="user_role">
                                <li><a href="<?php echo e(route('admin.roles.view')); ?>">> <span>View Role</span></a></li>
                                <li><a href="<?php echo e(route('admin.roles.create')); ?>">> <span>New Role</span></a></li>
                            </ul>
                        </li>
                        <!-- Article Users -->
                        <li>
                            <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-users red_color"></i><span>Users</span></a>
                            <ul class="collapse list-unstyled" id="users">
                                <li><a href="<?php echo e(route('admin.users.view')); ?>">> <span>View Users</span></a></li>
                                <li><a href="<?php echo e(route('admin.users.create')); ?>">> <span>New Users</span></a></li>
                            </ul>
                        </li>
                        <!-- Article Settings -->
                        <li>
                            <a href="#settings" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i
                                    class="fa fa-cogs blue2_color"></i><span>Settings</span></a>
                            <ul class="collapse list-unstyled" id="settings">
                                <li><a href="<?php echo e(route('admin.settings')); ?>">> <span>Manage Settings</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="right_topbar">

                                <div class="icon_info">
                                    <ul>
                                        <li>
                                            <a href="#" id="notification" class="dropdown-toggle"
                                                data-toggle="dropdown">
                                                <i class="fa fa-bell-o"></i>
                                                <span class="badge" id="notification_count">2</span>
                                            </a>
                                            <div class="dropdown-menu" x-placement="left-start">
                                                <ul>
                                                    <li class="dropdown-item"> notification </li>
                                                    <li class="dropdown-item"> notification </li>
                                                    <li class="dropdown-item"> notification </li>
                                                    <li class="dropdown-item"> notification </li>
                                                    <li class="dropdown-item"> notification </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown" style="display:flex;align-items:center;gap:8px;">
                                                <?php
                                                    $topInitials = collect(explode(' ', Auth::user()->name ?? 'A'))
                                                                    ->map(fn($w) => strtoupper($w[0]))
                                                                    ->take(2)->implode('');
                                                ?>
                                                <span class="initials-avatar" title="<?php echo e(Auth::user()->name ?? ''); ?>">
                                                    <?php echo e($topInitials); ?>

                                                </span>
                                                <span class="name_user"><?php echo e(Auth::user()->name ?? 'Guest'); ?></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('admin.profile', Auth::user()->id)); ?>">
                                                    <i class="fa fa-user"></i>
                                                    My Profile
                                                </a>
                                                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>">
                                                    <span>
                                                        <i class="fa fa-sign-out"></i>
                                                        Log Out
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end topbar -->
                <div class="midde_cont">
<?php /**PATH C:\xampp\htdocs\Laravel-Modern-News\resources\views/admin/inc/header.blade.php ENDPATH**/ ?>