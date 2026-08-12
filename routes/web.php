<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Admin\DashboardController;

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




    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');


});

require __DIR__.'/auth.php';
