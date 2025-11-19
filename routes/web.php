<?php

use Illuminate\Support\Facades\Auth;

use Phiki\Grammar\Injections\Prefix;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\PagesController;
use App\Http\Controllers\frontend\CouponController;
use App\Http\Controllers\frontend\CompareController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\WelcomeController;
use App\Http\Controllers\frontend\categoryController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\frontend\SubscribeController;
use App\Http\Controllers\frontend\OrderTrackingController;
use App\Http\Controllers\frontend\ReviewController;


// frontend route start
Route::get('/', [WelcomeController::class, 'index']);

Route::get('/allcategory', [categoryController::class, 'index'])->name('category.all');

Route::get('/terms-and-conditions', [PagesController::class, 'terms'])->name('pages.terms');
Route::get('/faq', [PagesController::class, 'faq'])->name('pages.faq');
Route::get('/about-us', [PagesController::class, 'about'])->name('pages.about');
Route::get('/contact-us', [PagesController::class, 'contact'])->name('pages.contact');
Route::post('/contact-us', [PagesController::class, 'store'])->name('contact.store');
Route::get('/privacy-policy', [PagesController::class, 'privacy'])->name('pages.privacy');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'product_detail'])->name('product.detail');
Route::get('/category/{slug}', [ProductController::class, 'category_product'])->name('category.product');
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
 Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');
Route::post('/cart/increase', [CartController::class, 'increaseQuantity'])->name('cart.increase');
Route::post('/cart/decrease', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('order/checkout', [OrderController::class, 'store'])->name('order.store');
Route::get('order/success', [CheckoutController::class, 'success'])->name('success.store');
Route::get('/get-states/{country_id}', [CheckoutController::class, 'getStates'])->name('get.states');
Route::get('/get-country-vat/{id}', [CheckoutController::class, 'getCountryVat'])->name('get.country.vat');
Route::get('/get-shipping-charge/{id}', [CheckoutController::class, 'getShippingCharge'])->name('get.shipping.charge');



// Compare Routes
Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');
Route::get('/compare/add/{id}', [CompareController::class, 'AddToCompare'])->name('compare.add');

// Route::post('/compare', [CompareController::class, 'store'])->name('compare.store');
Route::delete('/compare/remove', [CompareController::class, 'removeCompare'])
    ->name('compare.remove');


// Wishlist Routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/wishlist/{id}', [WishlistController::class, 'AddWishlist'])->name('wishlist.add');

Route::delete('/wishlist/remove', [WishlistController::class, 'wishlistremove'])->name('wishlist.remove');

// Subscribe Routes
// Route::get('/subscribe', [SubscribeController::class, 'index'])->name('subscribe.index');
Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe.store');

// for coupon apply
Route::post('/coupon/apply', [CouponController::class, 'applyCoupon'])->name('coupon.apply');
Route::get('/order/tracking/{tracking_number}', [OrderTrackingController::class, 'ordertracking'])->name('order.tracking');
Route::post('/user/password_change', [UserController::class, 'Change_password'])->name('user.changePassword');


//with google login

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Auth::routes();

// auth::routes(); ar moddhe muloto aguli ase
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);

//user group routes
Route::prefix('user')->group(function () {

    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/order', [UserController::class, 'order'])->name('user.order');
    Route::get('/review', [UserController::class, 'review'])->name('user.review');
    Route::get('/profile-edit', [UserController::class, 'profileEdit'])->name('user.profileEdit');
    Route::post('/profile-update', [UserController::class, 'profileUpdate'])->name('user.profile.update');
    Route::get('/order/detail/{id}', [UserController::class, 'orderDetail'])->name('user.order.detail');
    Route::get('/order/invoice/{id}', [UserController::class, 'invoice'])->name('order.invoice');
});
