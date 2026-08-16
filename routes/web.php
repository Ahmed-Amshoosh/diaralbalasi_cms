<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WhyUsController;

// الصفحة الرئيسية للزوار (لاحقاً)
Route::get('/', function () {
    return view('frontend.index');
})->name('home');

// تبديل اللغة
Route::post('/locale', [LocaleController::class, 'switch'])->name('locale.switch');

// مسارات لوحة التحكم
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    // Dashboard - الآن يعمل مع /admin/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // يمكنك أيضاً إضافة /admin كـ redirect إلى dashboard (اختياري)
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Hero Management
// إدارة قسم الهيرو (عنصر واحد فقط)
    Route::get('/hero', [\App\Http\Controllers\Admin\HeroController::class, 'index'])->name('hero.index');
    Route::put('/hero', [\App\Http\Controllers\Admin\HeroController::class, 'update'])->name('hero.update');

    Route::resource('marquee', \App\Http\Controllers\Admin\MarqueeController::class);

    Route::get('/about', [\App\Http\Controllers\Admin\AboutController::class, 'index'])->name('about.index');
    Route::put('/about', [\App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');

    Route::resource('hero-stats', \App\Http\Controllers\Admin\HeroStatController::class);

    // Why Us Section
// Why Us (صفحة مدمجة)

    Route::get('/why-us', [WhyUsController::class, 'index'])
        ->name('why-us.index');

    Route::put('/why-us-section', [WhyUsController::class, 'updateSection'])
        ->name('why-us.section.update');

// Why Us Items
    Route::post('/why-us-items', [WhyUsController::class, 'storeItem'])
        ->name('why-us-items.store');

    Route::put('/why-us-items/{whyUsItem}', [WhyUsController::class, 'updateItem'])
        ->name('why-us-items.update');

    Route::delete('/why-us-items/{whyUsItem}', [WhyUsController::class, 'destroyItem'])
        ->name('why-us-items.destroy');    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');


    Route::get('/partners', [\App\Http\Controllers\Admin\PartnersController::class, 'index'])->name('partners.index');
    Route::put('/partners-section', [\App\Http\Controllers\Admin\PartnersController::class, 'updateSection'])->name('partners.section.update');
    Route::post('/partners', [\App\Http\Controllers\Admin\PartnersController::class, 'storePartner'])->name('partners.store');
    Route::put('/partners/{partner}', [\App\Http\Controllers\Admin\PartnersController::class, 'updatePartner'])->name('partners.update');
    Route::delete('/partners/{partner}', [\App\Http\Controllers\Admin\PartnersController::class, 'destroyPartner'])->name('partners.destroy');

});

require __DIR__.'/auth.php';
