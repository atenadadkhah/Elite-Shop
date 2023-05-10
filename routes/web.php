<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [IndexController::class,"index"])->name("index");

Route::get('/contact', [IndexController::class,"contact"])->name("contact");

Route::get('/blog',[BlogController::class,"getAllBlogs"])->name("blog");
Route::get('/blog/{slug}',[BlogController::class,"getBlogByName"])->name("singleBlog");


Route::get('/faq',[IndexController::class,"faq"])->name("faq");

Route::get('/about-us',[IndexController::class,"about"])->name("about-us");

Route::get('/shop',[ShopController::class,"getAllProducts"])->name("shop");
Route::post('/shop',[ShopController::class,"filterProducts"]);
Route::get('/shop/product/{slug}',[ShopController::class,"singleProduct"])->name("singleProduct");

Route::resource('cart', CartController::class)->only([
    'index', 'update', 'destroy', 'store'
]);
Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile-details', [App\Http\Controllers\HomeController::class, 'profileDetails'])->name('profile');
    Route::get('/orders', [App\Http\Controllers\HomeController::class, 'getOrders'])->name('orders');
    Route::post('/profile-details', [App\Http\Controllers\HomeController::class, 'editProfile']);
});




// Socialite Authentication
Route::get('/auth/{social}/redirect', function ($social) {
    return Socialite::driver($social)->redirect();
})->name('social.redirect');
Route::get('/auth/{social}/callback', [SocialController::class,'loginWithSocial']);

// 404
Route::fallback(function() {
    return view('errors.404');
});
