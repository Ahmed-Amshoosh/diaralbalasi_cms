<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');

        if (in_array($locale, config('app.available_locales'))) {
            session(['locale' => $locale]);
            app()->setLocale($locale);

            // تحديث لغة المستخدم في قاعدة البيانات
            if (auth()->check()) {
                auth()->user()->update(['locale' => $locale]);
            }
        }

        return redirect()->back();
    }
}
