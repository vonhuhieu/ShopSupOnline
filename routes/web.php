<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::group([
    'prefix' => 'admin',
], function () {
    // // Dashboard
    // Route::get('/dashboard', [App\Http\Controllers\admin\DashboardController::class, 'dashboard']);

    // Profile
    // Update
    Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'update_profile_form']);
    Route::post('/profile', [App\Http\Controllers\admin\ProfileController::class, 'update_profile']);
    // Logout
    Route::get('/logout_user', [App\Http\Controllers\admin\ProfileController::class, 'logout_user']);

    // Country
    // List
    Route::get('/country_list', [App\Http\Controllers\admin\CountryController::class, 'country_list']);
    // Add
    Route::get('/country_add', [App\Http\Controllers\admin\CountryController::class, 'country_add_form']);
    Route::post('/country_add', [App\Http\Controllers\admin\CountryController::class, 'country_add']);
    //Delete
    Route::get('/country_delete/{country_id}', [App\Http\Controllers\admin\CountryController::class, 'country_delete']);

    // Blog
    // List
    Route::get('/blog_list', [App\Http\Controllers\admin\BlogController::class, 'blog_list']);
    // Add
    Route::get('/blog_add', [App\Http\Controllers\admin\BlogController::class, 'blog_add_form']);
    Route::post('/blog_add', [App\Http\Controllers\admin\BlogController::class, 'blog_add']);
    // Update
    Route::get('/blog_update/{blog_id}', [App\Http\Controllers\admin\BlogController::class, 'blog_update_form']);
    Route::post('/blog_update/{blog_id}', [App\Http\Controllers\admin\BlogController::class, 'blog_update']);
    // Delete
    Route::get('/blog_delete/{blog_id}', [App\Http\Controllers\admin\BlogController::class, 'blog_delete']);

    // Category
    // Category Cha
    Route::get('/category');

    // Product
    // List
    Route::get('/product_list', [App\Http\Controllers\admin\ProductController::class, 'product_list']);
});

// Member
Route::group([
    'prefix' => 'member',
], function () {
    // Home
    Route::get('/home', [App\Http\Controllers\member\HomeController::class, 'home']);
    // Member
    // Register
    Route::get('/member_register', [App\Http\Controllers\member\MemberController::class, 'member_register_form']);
    Route::post('/member_register', [App\Http\Controllers\member\MemberController::class, 'member_register']);

    // Login
    Route::get('/member_login', [App\Http\Controllers\member\MemberController::class, 'member_login_form']);
    Route::post('/member_login', [App\Http\Controllers\member\MemberController::class, 'member_login']);

    // Logout
    Route::get('/member_logout', [App\Http\Controllers\member\MemberController::class, 'member_logout']);

    // Blog
    // Blog List
    Route::get('/blog_list', [App\Http\Controllers\member\BlogController::class, 'blog_list']);
    // Blog Detail
    Route::get('/blog_detail/{blog_id}', [App\Http\Controllers\member\BlogController::class, 'blog_detail']);
    // Rate
    Route::post('/blog_detail_rate', [App\Http\Controllers\member\BlogController::class, 'blog_detail_rate']);
    // Comment
    Route::post('/blog_detail_comment', [App\Http\Controllers\member\BlogController::class, 'blog_detail_comment']);
    // Replay
    Route::post('/blog_detail_replay', [App\Http\Controllers\member\BlogController::class, 'blog_detail_replay']);

    // Account
    Route::get('/account', [App\Http\Controllers\member\account\AccountController::class, 'account']);
    Route::group([
        'prefix' => 'account',
    ], function () {
        // Update
        Route::get('/account_update', [App\Http\Controllers\member\account\AccountController::class, 'account_update_form']);
        Route::post('/account_update', [App\Http\Controllers\member\account\AccountController::class, 'account_update']);
    });
});
