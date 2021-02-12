<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login-facebook', [App\Http\Controllers\SocialLoginController::class, 'facebook'])->name('login.facebook');
    Route::get('/login-facebook/redirect', [App\Http\Controllers\SocialLoginController::class, 'facebookRedirect'])->name('login.facebook.redirect');
    Route::get('/login-google', [App\Http\Controllers\SocialLoginController::class, 'google'])->name('login.google');
    Route::get('/login-google/redirect', [App\Http\Controllers\SocialLoginController::class, 'googleRedirect'])->name('login.google.redirect');

});
Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('index');
Route::get('/vip', [App\Http\Controllers\PagesController::class, 'getVip'])->name('vip');
Route::get('/profile/{user}', [App\Http\Controllers\PagesController::class, 'profile'])->name('profile');
Route::resource('/listing', \App\Http\Controllers\ListingsController::class, [
    'names' => [
        'index' => 'listing.index',
        'create' => 'listing.create',
        'store' => 'listing.store',
        'show' => 'listing.show',
        'update' => 'listing.update',
        'edit' => 'listing.edit',
        'destroy' => 'listing.destroy',
    ]
]);

Route::resource('/hotline', \App\Http\Controllers\HotlineController::class, [
    'names' => [
        'index' => 'hotline.index',
        'store' => 'hotline.store',
        'destroy' => 'hotline.destroy',
    ]
]);
Route::group(['middleware' => 'auth'], function () {
    Route::delete('/user/delete/{user}', [App\Http\Controllers\HomeController::class, 'deleteUser'])->name('user.delete');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home/profile/{user}', [App\Http\Controllers\HomeController::class, 'profile'])->name('home.profile');
    Route::put('/home/profile/{user}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('home.profile.update');
    Route::put('/home/profile/photo/{user}', [App\Http\Controllers\HomeController::class, 'updateProfileImage'])->name('home.profile.photo.update');
    Route::put('/home/profile/cover/{user}', [App\Http\Controllers\HomeController::class, 'updateCoverImage'])->name('home.profile.cover.update');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');

    Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\UsersController::class, 'updateUserRole'])->name('admin.users.update.role');

    Route::get('/listings', [App\Http\Controllers\Admin\ListingsController::class, 'index'])->name('admin.listings');

    Route::get('/hotline', [App\Http\Controllers\Admin\HotlineController::class, 'index'])->name('admin.hotline');

    Route::get('/subscriptions', [App\Http\Controllers\Admin\SubscriptionsController::class, 'index'])->name('admin.subscriptions');
    Route::post('/subscriptions', [App\Http\Controllers\Admin\SubscriptionsController::class, 'create'])->name('admin.subscriptions.create');
    Route::put('/subscriptions/{subscription}', [App\Http\Controllers\Admin\SubscriptionsController::class, 'update'])->name('admin.subscriptions.update');
    Route::delete('/subscriptions/{subscription}', [App\Http\Controllers\Admin\SubscriptionsController::class, 'destroy'])->name('admin.subscriptions.destroy');

    Route::get('/payments', [App\Http\Controllers\Admin\AdminController::class, 'payments'])->name('admin.payments');
    Route::get('/ads', [App\Http\Controllers\Admin\AdminController::class, 'ads'])->name('admin.ads');

});

Route::get('/privacy', [App\Http\Controllers\LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/terms', [App\Http\Controllers\LegalController::class, 'terms'])->name('legal.terms');
Route::get('/sitemap', [App\Http\Controllers\LegalController::class, 'sitemap'])->name('legal.sitemap');
