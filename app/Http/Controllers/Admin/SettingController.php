<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name_ar' => 'required|string|max:255',
            'site_name_en' => 'required|string|max:255',
            'site_description_ar' => 'nullable|string',
            'site_description_en' => 'nullable|string',
            'company_name_ar' => 'required|string|max:255',
            'company_name_en' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address_ar' => 'nullable|string',
            'address_en' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:2048',
        ]);

        // تحديث معلومات الموقع
        Setting::set('site_name', [
            'ar' => $request->site_name_ar,
            'en' => $request->site_name_en,
        ], 'general');

        Setting::set('site_description', [
            'ar' => $request->site_description_ar,
            'en' => $request->site_description_en,
        ], 'general');

        // تحديث بيانات الشركة
        Setting::set('company_name', [
            'ar' => $request->company_name_ar,
            'en' => $request->company_name_en,
        ], 'company');

        Setting::set('address', [
            'ar' => $request->address_ar,
            'en' => $request->address_en,
        ], 'company');

        Setting::set('phone', $request->phone, 'company');
        Setting::set('mobile', $request->mobile, 'company');
        Setting::set('email', $request->email, 'company');

        // تحديث وسائل التواصل
        Setting::set('whatsapp', $request->whatsapp, 'social');
        Setting::set('instagram', $request->instagram, 'social');
        Setting::set('facebook', $request->facebook, 'social');
        Setting::set('twitter', $request->twitter, 'social');
        Setting::set('linkedin', $request->linkedin, 'social');
        Setting::set('youtube', $request->youtube, 'social');

        // رفع الشعار
        if ($request->hasFile('logo')) {
            // حذف الشعار القديم
            $oldLogo = Setting::get('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('logo')->store('settings', 'public');
            Setting::set('logo', $path, 'general');
        }

        // رفع الأيقونة
        if ($request->hasFile('favicon')) {
            // حذف الأيقونة القديمة
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }

            $path = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', $path, 'general');
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'تم حفظ الإعدادات بنجاح');
    }
}
