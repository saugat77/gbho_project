<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', 'DashboardController@index')->name('backend.dashboard');

Route::resources([
    'stores' => 'StoreController',
    'products' => 'ProductController',
]);

Route::get('products/{product}/images', 'ProductController@images')->name('products.images');
Route::get('products/{product}/seo', 'ProductController@seo')->name('products.seo');
Route::post('products/{product}/seo', 'ProductController@storeSeo')->name('products.seo.store');

// Categories Route
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::post('categories', 'CategoryController@store')->name('categories.store');
Route::get('categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
Route::put('categories/{category}', 'CategoryController@update')->name('categories.update');
Route::delete('categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

// users routes
Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('users/{user}', 'UserController@update')->name('users.update');
Route::put('users/{user}/change-password', 'UserController@changePassword')->name('users.change-password');

// orders route
Route::get('orders', 'OrderController@index')->name('backend.orders.index');
Route::get('orders/{order}', 'OrderController@show')->name('backend.orders.show');

// cateogry-menus routes
Route::get('category-menus', 'CategoryMenuController@index')->name('category-menu.index');
Route::post('category-menus', 'CategoryMenuController@store')->name('category-menu.store');
Route::put('category-menus/sort', 'CategoryMenuController@sort')->name('category-menu.sort');
Route::delete('category-menus/remove-item', 'CategoryMenuController@removeItem')->name('category-menu.remove-item');

// product-grids routes
Route::get('product-grids', 'ProductGridController@index')->name('product-grids.index');
Route::post('product-grids', 'ProductGridController@store')->name('product-grids.store');
Route::put('product-grids/sort', 'ProductGridController@sort')->name('product-grids.sort');
Route::get('product-grids/{productGrid}/edit', 'ProductGridController@edit')->name('product-grids.edit');
Route::put('product-grids/{productGrid}', 'ProductGridController@update')->name('product-grids.update');
Route::delete('product-grids/{productGrid}', 'ProductGridController@destroy')->name('product-grids.destroy');

// Product Groups
Route::get('product-group', 'ProductGroupController@index')->name('product-group.index');
Route::post('product-group', 'ProductGroupController@store')->name('product-group.store');

// image sliders routes
Route::get('image-sliders', 'ImageSliderController@index')->name('image-sliders.index');
Route::get('image-sliders/create', 'ImageSliderController@create')->name('image-sliders.create');
Route::get('image-sliders/{imageSlider}/edit', 'ImageSliderController@edit')->name('image-sliders.edit');
Route::delete('image-sliders/{imageSlider}', 'ImageSliderController@delete')->name('image-sliders.destroy');

// setting routes
Route::group(['namespace' => 'Setting'], function () {
    // general settings
    Route::get('settings/general', 'GeneralSettingController@index')->name('settings.general.index');
    Route::post('settings/general', 'GeneralSettingController@store')->name('settings.general.store');

    // api key
    Route::get('settings/api-and-keys', 'ApiKeySettingController@index')->name('settings.api-and-keys.index');
    Route::post('settings/api-and-keys', 'ApiKeySettingController@store')->name('settings.api-and-keys.store');

    // Email Settings
    Route::get('settings/email', 'EmailSettingController@index')->name('settings.email.index');
    Route::post('settings/email', 'EmailSettingController@store')->name('settings.email.store');
    Route::post('settings/send-test-email', 'EmailSettingController@sendTestEmail')->name('settings.email.send-test-email');

     // Paypal Settings
     Route::get('settings/payment', 'PaymentSettingController@index')->name('settings.payment.index');
     Route::post('settings/payment', 'PaymentSettingController@store')->name('settings.payment.store');

    // image sliders
    Route::get('settings/image-sliders', 'ImageSliderSettingController@index')->name('settings.image-sliders.index');
    Route::post('settings/image-sliders', 'ImageSliderSettingController@store')->name('settings.image-sliders.store');

    Route::get('settings/footer', 'FooterSettingController@index')->name('settings.footer.index');
    Route::post('settings/footer', 'FooterSettingController@store')->name('settings.footer.store');
});


Route::get('invoices/{order}', 'InvoiceController@create')->name('invoices.create');

// pages
Route::get('pages', 'PageController@index')->name('pages.index');
Route::get('pages/create-or-edit', 'PageController@createOrEdit')->name('pages.create-or-edit');
Route::delete('pages/{page}', 'PageController@destroy')->name('pages.destroy');
Route::patch('pages/{page}/restore', 'PageController@restore')->name('pages.restore');
Route::delete('pages/{page}/force-delete', 'PageController@forceDelete')->name('pages.force-delete');

// Coupons
Route::get('coupons', 'CouponController@index')->name('coupons.index');
Route::get('coupons/create', 'CouponController@create')->name('coupons.create');
// Route::post('coupons', 'CouponController@store')->name('coupons.store');
Route::get('coupons/{coupon}/edit', 'CouponController@edit')->name('coupons.edit');
Route::delete('coupons/{coupon}', 'CouponController@destroy')->name('coupons.destroy');

// Contact Form
Route::get('contact-form-submissions', 'ContactFormSubmissionController@index')->name('contact-form-submissions.index');
Route::get('contact-form-submissions/{contactUs}', 'ContactFormSubmissionController@show')->name('contact-form-submissions.show');

// Posts
Route::get('posts', 'PostController@index')->name('posts.index');
Route::get('posts/create', 'PostController@create')->name('posts.create');
Route::post('posts', 'PostController@store')->name('posts.store');
Route::get('posts/{post}/edit', 'PostController@edit')->name('posts.edit');
Route::put('posts/{post}', 'PostController@update')->name('posts.update');
Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');
Route::patch('posts/{post}/restore', 'PostController@restore')->name('posts.restore');
Route::delete('posts/{post}/forceDelete', 'PostController@forceDelete')->name('posts.forceDelete');