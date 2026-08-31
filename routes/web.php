<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WhyUsController;

Route::get('/',[\App\Http\Controllers\Frontend\FrontendController::class,'index'])->name('home');

Route::post('/locale', [LocaleController::class, 'switch'])->name('locale.switch');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/hero', [\App\Http\Controllers\Admin\HeroController::class, 'index'])->name('hero.index');
    Route::put('/hero', [\App\Http\Controllers\Admin\HeroController::class, 'update'])->name('hero.update');
    Route::resource('marquee', \App\Http\Controllers\Admin\MarqueeController::class);
    Route::get('/about', [\App\Http\Controllers\Admin\AboutController::class, 'index'])->name('about.index');
    Route::put('/about', [\App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');
    Route::resource('hero-stats', \App\Http\Controllers\Admin\HeroStatController::class);
    Route::get('/why-us', [WhyUsController::class, 'index'])->name('why-us.index');
    Route::put('/why-us-section', [WhyUsController::class, 'updateSection'])->name('why-us.section.update');
// Why Us Items
    Route::post('/why-us-items', [WhyUsController::class, 'storeItem'])->name('why-us-items.store');
    Route::put('/why-us-items/{whyUsItem}', [WhyUsController::class, 'updateItem'])->name('why-us-items.update');
    Route::delete('/why-us-items/{whyUsItem}', [WhyUsController::class, 'destroyItem'])->name('why-us-items.destroy');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/partners', [\App\Http\Controllers\Admin\PartnersController::class, 'index'])->name('partners.index');
    Route::put('/partners-section', [\App\Http\Controllers\Admin\PartnersController::class, 'updateSection'])->name('partners.section.update');
    Route::post('/partners', [\App\Http\Controllers\Admin\PartnersController::class, 'storePartner'])->name('partners.store');
    Route::put('/partners/{partner}', [\App\Http\Controllers\Admin\PartnersController::class, 'updatePartner'])->name('partners.update');
    Route::delete('/partners/{partner}', [\App\Http\Controllers\Admin\PartnersController::class, 'destroyPartner'])->name('partners.destroy');

    Route::get('/testimonials', [\App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [\App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('testimonials.store');
    Route::put('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    Route::put('/testimonials-section', [\App\Http\Controllers\Admin\TestimonialController::class, 'updateSection'])->name('testimonials.section.update');

    Route::put('/settings/general', [\App\Http\Controllers\Admin\SettingController::class, 'updateGeneral'])->name('settings.updateGeneral');
    Route::put('/settings/company', [\App\Http\Controllers\Admin\SettingController::class, 'updateCompany'])->name('settings.updateCompany');
    Route::put('/settings/social', [\App\Http\Controllers\Admin\SettingController::class, 'updateSocial'])->name('settings.updateSocial');
    Route::get('/cta-section', [\App\Http\Controllers\Admin\CtaSectionController::class, 'index'])->name('cta.index');
    Route::put('/cta-section', [\App\Http\Controllers\Admin\CtaSectionController::class, 'update'])->name('cta.update');

    Route::put('/contact-section', [\App\Http\Controllers\Admin\ContactSectionController::class, 'update'])->name('contact-section.update');
    Route::get('/contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('/contact-messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::post('/contact-messages/{message}/mark-read', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-read');
    Route::delete('/contact-messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    // SEO Settings
    Route::get('/seo', [\App\Http\Controllers\Admin\SeoController::class, 'index'])->name('seo.index');
    Route::put('/seo', [\App\Http\Controllers\Admin\SeoController::class, 'update'])->name('seo.update');
    // Categories
    Route::get('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::put('/categories-section', [\App\Http\Controllers\Admin\CategoryController::class, 'updateSection'])->name('categories.section.update');
// Products
    Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/product-images/{image}', [\App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('products.images.destroy');
    Route::put('/products-section', [\App\Http\Controllers\Admin\ProductController::class, 'updateSection'])->name('products.section.update');
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
});
Route::get('/products/ajax', [\App\Http\Controllers\Admin\ProductController::class, 'ajax'])->name('frontend.products.ajax');
Route::get('/products/{product:slug}', [\App\Http\Controllers\Admin\ProductController::class, 'show'])->name('frontend.products.show');
Route::post('/contact', [\App\Http\Controllers\Frontend\ContactController::class, 'submit'])->name('frontend.contact.submit');
Route::get('/products', [\App\Http\Controllers\Frontend\FrontendController::class, 'products'])->name('frontend.products.index');

Route::get('/sitemap.xml', [\App\Http\Controllers\Frontend\SitemapController::class, 'index'])->name('sitemap');

require __DIR__.'/auth.php';
