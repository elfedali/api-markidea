<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('auth/register', [App\Http\Controllers\AuthController::class, 'register']);

//Route::post('/v1/auth/login/google', [\App\Http\Controllers\Api\AuthController::class, 'loginWithGoogle']);

//verify email
Route::get('user/{user}/verify-email/{token}', [App\Http\Controllers\User\UserVerifyEmailController::class, 'store'])->name('user.email.verify');

Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::get('auth/me', [App\Http\Controllers\AuthController::class, 'me']);
        //users
        Route::get('user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('user/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
        Route::put('user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

        Route::post('user/{user}/avatar', [App\Http\Controllers\User\UserAvatarController::class, 'update'])->name('user.avatar.store');
        Route::delete('user/{user}/avatar', [App\Http\Controllers\User\UserAvatarController::class, 'delete'])->name('user.avatar.destroy');
        //change email
        Route::put('user/{user}/change-email', [App\Http\Controllers\User\UserChangeEmailController::class, 'store'])->name('user.email.store');
        //change password
        Route::put('user/{user}/change-password', [App\Http\Controllers\User\UserChangePasswordController::class, 'store'])->name('user.password.store');
        //update phone number
        Route::put('user/{user}/change-phone', [App\Http\Controllers\User\UserPhoneNumberController::class, 'store'])->name('user.phone.update');

        // categories
        Route::get('category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
        Route::get('category/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
        Route::post('category', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
        Route::put('category/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');

        // shops
        Route::get('shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
        Route::get('shop/{shop}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
        Route::post('shop', [App\Http\Controllers\ShopController::class, 'store'])->name('shop.store');
        Route::put('shop/{shop}', [App\Http\Controllers\ShopController::class, 'update'])->name('shop.update');
        Route::delete('shop/{shop}', [App\Http\Controllers\ShopController::class, 'destroy'])->name('shop.destroy');

        // images
        Route::get('image', [App\Http\Controllers\ImageController::class, 'index'])->name('image.index');
        Route::get('image/{image}', [App\Http\Controllers\ImageController::class, 'show'])->name('image.show');
        Route::post('image', [App\Http\Controllers\ImageController::class, 'store'])->name('image.store');
        Route::put('image/{image}', [App\Http\Controllers\ImageController::class, 'update'])->name('image.update');
        Route::delete('image/{image}', [App\Http\Controllers\ImageController::class, 'destroy'])->name('image.destroy');

        Route::apiResource('/shop/{shop}/image', App\Http\Controllers\ShopImageController::class)->except(['show', 'destroy', 'update']);

        Route::delete('image/{image}', [App\Http\Controllers\ImageController::class, 'destroy'])->name('image.destroy');
        Route::get('image/{image}', [App\Http\Controllers\ImageController::class, 'show'])->name('image.show');

        Route::apiResource('/shop/{shop}/review', App\Http\Controllers\ShopReviewsController::class)->except(['show', 'destroy', 'update']);
        Route::delete('review/{review}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('review.destroy');
        Route::get('review/{review}', [App\Http\Controllers\ReviewController::class, 'show'])->name('review.show');
        Route::put('review/{review}', [App\Http\Controllers\ReviewController::class, 'update'])->name('review.update');
    }
);
