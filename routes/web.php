<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified')->name('redirect');

Route::group(['middleware' => 'admin'], function(){
    // All admin Routes
    // Admin
    Route::get('/view_category', [AdminController::class, 'view_category']);
    Route::post('/add_category', [AdminController::class, 'add_category']);
    Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
    Route::get('/view_product', [AdminController::class, 'view_product']);
    Route::post('/add_product', [AdminController::class, 'add_product']);
    Route::get('/show_product', [AdminController::class, 'show_product']);
    Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
    Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);
    Route::get('/order', [AdminController::class, 'order']);
    Route::get('/delivered/{id}', [AdminController::class, 'delivered']);
    Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);
    Route::get('/send_email/{id}', [AdminController::class, 'send_email']);
    Route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email']);
    Route::get('/search', [AdminController::class, 'search_order']);
    Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
 });


//User
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/show_cart', [HomeController::class, 'show_cart']);
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
Route::get('/cash_order', [HomeController::class, 'cash_order']);
Route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);
Route::post('stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/show_order', [HomeController::class, 'show_order']);
Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);
Route::post('/add_comment', [HomeController::class, 'add_comment']);
Route::post('/add_reply', [HomeController::class, 'add_reply']);
Route::get('/search_product', [HomeController::class, 'search_product']);
Route::get('/products', [HomeController::class, 'products']);
Route::get('/search_product_view', [HomeController::class, 'search_product_view']);
Route::get('/about_us', [HomeController::class, 'about_us']);
Route::get('/contact', [HomeController::class, 'contact']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Login Google Account
Route::get('auth/google', [GoogleController::class, 'login_google']);
Route::get('auth/google/auth/google/callback', [GoogleController::class, 'login_google_callback']);

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
