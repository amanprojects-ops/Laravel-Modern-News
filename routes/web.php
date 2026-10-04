<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\FilelistController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\CategorieController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/{title}', [BlogController::class, 'GetBlog'])->name('view-blog');
Route::get('/category/{category}', [BlogController::class, 'GetCategory'])->name('view-category');
Route::get('/tags/{tag}', [BlogController::class, 'GetTag'])->name('view-tag');
Route::get('/search/{query}', [BlogController::class, 'Search'])->name('search');

//Default Routes
Route::get('/contact', function () {
    return 'Contact Us';
})->name('contact');

Route::get('/about', function () {
    return 'About Us';
})->name('about');

Route::get('/disclaimer', function () {
    return 'disclaimer';
})->name('disclaimer');

Route::get('/privacy-policy', function () {
    return 'Privacy Policy';
})->name('privacy-policy');

Route::get('/sitemap', function () {
    return 'sitemap';
})->name('sitemap');

//Admin Routes
Route::middleware("guest")->prefix('admin')->group(function () {
    //Login Routes
    Route::get('/login', [AdminAuthController::class, 'showlogin'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login');
});

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/', [AdminController::class, 'index']);
    //Post Management Routes
    Route::resource('posts', AdminPostController::class)->names([
        'index' => 'admin.posts.view',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.save',
        'show' => 'admin.posts.show',
        'edit' => 'admin.posts.edit',
        'update' => 'admin.posts.update',
        'destroy' => 'admin.posts.destroy',
    ]);
    Route::get('temprory/post/{post}', [AdminPostController::class, 'tempPost'])->name('admin.posts.temp-post');
    Route::patch('posts/{post}/status', [AdminPostController::class, 'updateStatus'])->name('admin.posts.status.update');
    Route::get('posts/{post}/view', [AdminPostController::class, 'view'])->name('admin.posts.view-single-post');

    //Category Management Routes
    Route::resource('categories', CategorieController::class)->names([
        'index' => 'admin.categories.view',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.save',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
    Route::patch('categories/{category}/status', [CategorieController::class, 'updateStatus'])->name('admin.categories.status-update');
    Route::patch('categories/{category}/main-nav', [CategorieController::class, 'mainNavigation'])->name('admin.categories.main-navigation');
    //User Role Management Routes
    Route::resource('roles', RoleController::class)->names([
        'index' => 'admin.roles.view',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.save',
        'show' => 'admin.roles.show',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy',
    ]);
    Route::patch('roles/{role}/status', [RoleController::class, 'updateStatus'])->name('admin.roles.updateStatus');

    //User Management Routes
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.view',
        'create' => 'admin.users.create',
        'store' => 'admin.users.save',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::patch('users/{user}/status', [UserController::class, 'updateStatus'])->name('admin.users.updateStatus');
    Route::post('users/checkUsername', [UserController::class, 'checkUsername'])->name('admin.users.checkUsername');

    //Attachement Routes
    Route::resource('attachements', FilelistController::class)->names([
        'index' => 'admin.attachements.view',
        'create' => 'admin.attachements.create',
        'store' => 'admin.attachements.save',
        'destroy' => 'admin.attachements.destroy'
    ]);

    //Settings Management Routes
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'settings'])->name('admin.settings');
        Route::put('general/update', [SettingController::class, 'updateGeneralSettings'])->name('admin.settings.general.update');
        Route::put('basic/update', [SettingController::class, 'updateBasicSettings'])->name('admin.settings.basic.update');
        Route::put('social-media-settings/update', [SettingController::class, 'updateSocialMediaSettings'])->name('admin.social-media-settings.update');
        Route::put('images/update', [SettingController::class, 'updateImageSettings'])->name('admin.settings.images-update');
    });

    //Admin Profile Routes
    Route::get('profile/{id?}', [AdminController::class, 'profile'])->name('admin.profile');

    Route::get('search', [AdminController::class, 'search'])->name('admin.search');
    //Analytics Route
    Route::get('analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
    //Notifications Route
    Route::get('notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    //API Routes
    Route::prefix('api')->group(function () {
        Route::get('posts', [AdminController::class, 'apiPosts'])->name('admin.api.posts');
        Route::get('categories', [AdminController::class, 'apiCategories'])->name('admin.api.categories');
        Route::get('users', [AdminController::class, 'apiUsers'])->name('admin.api.users');
        Route::get('roles', [AdminController::class, 'apiRoles'])->name('admin.api.roles');
    });
});
Route::get('mail/test-email', [EmailController::class, 'sandEmail'])->name('test-email');
/**
 * Api Routes Call
 */
// Route::get('api/posts', [BlogController::class, 'posts'])->name('api.posts');
// Route::get('api/post/{id}', [BlogController::class, 'post'])->name('api.post');
// Route::get('api/categories', [BlogController::class, 'apiCategories'])->name('api.categories');
// Route::get('api/users', [BlogController::class, 'apiUsers'])->name('api.users');
// Route::get('api/roles', [BlogController::class, 'apiRoles'])->name('api.roles');

Route::get('cmd/run-cron', function () {
    Artisan::call('queue:work --stop-when-empty');
})->name('run-cron');
