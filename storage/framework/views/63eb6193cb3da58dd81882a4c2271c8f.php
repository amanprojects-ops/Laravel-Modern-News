<!DOCTYPE html>
<html lang="en">
<?php
    $settings = \App\Models\Setting::first();
?>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title><?php echo e($title ?? 'Admin Panel'); ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="<?php echo e(asset('storage/' . $settings->favicon)); ?>" type="image/png" />
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
                                <img class="logo_icon img-responsive" src="<?php echo e(asset('storage/' . $settings->logo)); ?>"
                                    alt="<?php echo e($settings->name); ?>" title="<?php echo e($settings->name); ?>" />
                            </a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img"><img class="img-responsive"
                                    src="<?php echo e(asset('storage/' . $settings->favicon)); ?>"
                                    alt="<?php echo e($settings->name ?? 'ExamInfoBlog'); ?>" /></div>
                            <div class="user_info">
                                <h6><?php echo e(Auth::user()->role == 1 ? 'Super Admin' : 'Admin'); ?></h6>
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4><?php echo e(Str::upper($settings->name) ?? 'ExamInfoBlog'); ?></h4>
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
                                            <a class="dropdown-toggle" data-toggle="dropdown">
                                                <img class="img-responsive rounded-circle"
                                                    src="<?php echo e(asset('backend/images/layout_img/user_img.jpg')); ?>"
                                                    alt="#" />
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