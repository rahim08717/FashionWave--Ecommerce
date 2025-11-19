<?php

// admin@example.com
// password

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GatewayController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\subscribersController;
use App\Http\Controllers\Admin\testimonialController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StatesController;




Route::prefix('admin')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        //contact form routes
        Route::get('/contacts', [ContactController::class, 'contacts'])->name('admin.contacts');
        Route::get('/contacts/{id}', [ContactController::class, 'viewContact'])->name('admin.contacts.view');
        Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])
            ->name('admin.contacts.delete');

        //suscribers routes
        Route::get('/subscribers', [subscribersController::class, 'subscribers'])->name('admin.subscribers');

        //sliders routes

        Route::get('/sliders', [SlidersController::class, 'index'])->name('admin.sliders.index');
        Route::get('/sliders/create', [SlidersController::class, 'create'])->name('admin.slider.create');
        Route::post('/sliders/store', [SlidersController::class, 'store'])->name('admin.slider.store');
        Route::get('/sliders/edit/{id}', [SlidersController::class, 'edit'])->name('admin.slider.edit');
        Route::put('/sliders/update/{id}', [SlidersController::class, 'update'])->name('admin.slider.update');
        Route::delete('/sliders/delete/{id}', [SlidersController::class, 'destroy'])->name('admin.sliders.delete');

        //faq routes
        Route::get('/faq', [FaqController::class, 'index'])->name('admin.faq.index');
        Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
        Route::post('/faq/store', [FaqController::class, 'store'])->name('admin.faq.store');
        Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('admin.faq.edit');
        Route::put('/faq/update/{id}', [FaqController::class, 'update'])->name('admin.faq.update');
        Route::delete('/faq/delete/{id}', [FaqController::class, 'destroy'])->name('admin.faq.delete');

        // testimonials routes
        Route::get('/testimonial', [testimonialController::class, 'index'])->name('admin.testimonial.index');
        Route::get('/testimonial/create', [testimonialController::class, 'create'])->name('admin.testimonial.create');
        Route::post('/testimonial/store', [testimonialController::class, 'store'])->name('admin.testimonial.store');
        Route::get('/testimonial/edit/{id}', [testimonialController::class, 'edit'])->name('admin.testimonial.edit');
        Route::put('/testimonial/update/{id}', [testimonialController::class, 'update'])->name('admin.testimonial.update');
        Route::delete('/testimonial/delete/{id}', [testimonialController::class, 'destroy'])->name('admin.testimonial.delete');

        //cantegory routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');

        //barnd routes

        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands.index');
        Route::get('/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('/brands/store', [BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::put('/brands/update/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
        Route::delete('/brands/delete/{id}', [BrandController::class, 'destroy'])->name('admin.brands.delete');

        // page routes

        Route::get('/pages', [PageController::class, 'index'])->name('admin.pages.index');
        Route::get('/pages/edit/{id}', [PageController::class, 'edit'])->name('admin.pages.edit');
        Route::put('/pages/update/{id}', [PageController::class, 'update'])->name('admin.pages.update');
        Route::delete('/pages/delete/{id}', [PageController::class, 'destroy'])->name('admin.pages.delete');
        //settings route
        Route::get('/setting', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::put('/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');

        //coupon routes
        Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupons.index');
        Route::get('/coupons/create', [CouponController::class, 'create'])->name('admin.coupons.create');
        Route::post('/coupons/store', [CouponController::class, 'store'])->name('admin.coupons.store');
        Route::get('/coupons/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupons.edit');
        Route::put('/coupons/update/{id}', [CouponController::class, 'update'])->name('admin.coupons.update');
        Route::delete('/coupons/delete/{id}', [CouponController::class, 'destroy'])->name('admin.coupons.delete');

        //admin user management routes
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
        Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
        Route::post('/admins/store', [AdminController::class, 'store'])->name('admin.admins.store');
        Route::get('/admins/edit/{id}', [AdminController::class, 'edit'])->name('admin.admins.edit');
        Route::put('/admins/update/{id}', [AdminController::class, 'update'])->name('admin.admins.update');
        Route::delete('/admins/delete/{id}', [AdminController::class, 'destroy'])->name('admin.admins.delete');

        //gateway routes
        Route::get('/gateways', [GatewayController::class, 'index'])->name('admin.gateways.index');
        Route::get('/gateways/edit/{id}', [GatewayController::class, 'edit'])->name('admin.gateways.edit');
        Route::put('/gateways/update/{id}', [GatewayController::class, 'update'])->name('admin.gateways.update');

        //customer routes
        Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
        Route::get('/customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');
        Route::post('/customers/store', [CustomerController::class, 'store'])->name('admin.customers.store');
        Route::get('/customers/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customers.edit');
        Route::put('/customers/update/{id}', [CustomerController::class, 'update'])->name('admin.customers.update');
        Route::delete('/customers/delete/{id}', [CustomerController::class, 'destroy'])->name('admin.customers.delete');
        // all orders routes

        Route::get('/orders', action: [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
        Route::post('/orders/store', [OrderController::class, 'store'])->name('admin.orders.store');
        Route::get('/orders/view/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::get('/orders/edit/{id}', [OrderController::class, 'edit'])->name('admin.orders.edit');
        Route::put('/orders/update/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
        Route::get('/transaction', action: [OrderController::class, 'transaction'])->name('admin.transactions.index');



        //vat-tax controller
        Route::get('/countries', [CountryController::class, 'index'])->name('admin.countries.index');
        Route::get('/create', [CountryController::class, 'create'])->name('admin.countries.create');
        Route::post('/store', [CountryController::class, 'store'])->name('admin.countries.store');
        Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('admin.countries.edit');
        Route::put('/update/{id}', [CountryController::class, 'update'])->name('admin.countries.update');
        Route::delete('/delete/{id}', [CountryController::class, 'destroy'])->name('admin.countries.delete');


        // States CRUD routes
        Route::get('/states', [StatesController::class, 'index'])->name('admin.states.index');
        Route::get('/states/create', [StatesController::class, 'create'])->name('admin.states.create');
        Route::post('/states/store', [StatesController::class, 'store'])->name('admin.states.store');
        Route::get('/states/edit/{id}', [StatesController::class, 'edit'])->name('admin.states.edit');
        Route::put('/states/update/{id}', [StatesController::class, 'update'])->name('admin.states.update');
        Route::delete('/states/delete/{id}', [StatesController::class, 'destroy'])->name('admin.states.destroy');
    });
});
