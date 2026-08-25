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
        if (!auth()->user()->can('view settings')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $settings = [];
        $records = Setting::all();

        $simpleFields = ['logo', 'favicon', 'phone', 'mobile', 'email', 'whatsapp', 'instagram', 'facebook', 'twitter', 'linkedin', 'youtube'];

        foreach ($records as $record) {
            $translations = $record->getTranslations('value');

            if (in_array($record->key, $simpleFields)) {
                if (is_array($translations) && !empty($translations)) {
                    $values = array_values($translations);
                    $settings[$record->key] = $values[0] ?? null;
                } else {
                    $settings[$record->key] = $record->value;
                }
            } else {
                $settings[$record->key] = is_array($translations) ? $translations : [];
            }
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        if (!auth()->user()->can('edit settings')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $request->validate([
            'site_name_ar' => 'required|string|max:255',
            'site_name_en' => 'required|string|max:255',
            'site_description_ar' => 'nullable|string',
            'site_description_en' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:2048',
        ], [
            'site_name_ar.required' => __('messages.site_name_ar_required'),
            'site_name_en.required' => __('messages.site_name_en_required'),
        ]);
        Setting::set('site_name', [
            'ar' => $request->site_name_ar,
            'en' => $request->site_name_en
        ], 'general');

        Setting::set('site_description', [
            'ar' => $request->site_description_ar,
            'en' => $request->site_description_en
        ], 'general');

        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('logo');
            if ($oldLogo && \Illuminate\Support\Facades\Storage::disk('public')->exists($oldLogo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldLogo);
            }
            Setting::set('logo', $request->file('logo')->store('settings', 'public'), 'general');
        }

        if ($request->hasFile('favicon')) {
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && \Illuminate\Support\Facades\Storage::disk('public')->exists($oldFavicon)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldFavicon);
            }
            Setting::set('favicon', $request->file('favicon')->store('settings', 'public'), 'general');
        }
        return back()->with('success', __('messages.site_info_saved_successfully'));
    }

    public function updateCompany(Request $request)
    {
        if (!auth()->user()->can('edit settings')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $request->validate([
            'company_name_ar' => 'required|string|max:255',
            'company_name_en' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address_ar' => 'nullable|string',
            'address_en' => 'nullable|string',
        ], [
            'company_name_ar.required' => __('messages.company_name_ar_required'),
            'company_name_en.required' => __('messages.company_name_en_required'),
        ]);

        Setting::set('company_name', ['ar' => $request->company_name_ar, 'en' => $request->company_name_en], 'company');
        Setting::set('address', ['ar' => $request->address_ar, 'en' => $request->address_en], 'company');
        Setting::set('phone', $request->phone, 'company');
        Setting::set('mobile', $request->mobile, 'company');
        Setting::set('email', $request->email, 'company');

        return back()->with('success', __('messages.company_data_saved_successfully'));
    }

    public function updateSocial(Request $request)
    {
        if (!auth()->user()->can('edit settings')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $request->validate([
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
        ]);

        Setting::set('whatsapp', $request->whatsapp, 'social');
        Setting::set('instagram', $request->instagram, 'social');
        Setting::set('facebook', $request->facebook, 'social');
        Setting::set('twitter', $request->twitter, 'social');
        Setting::set('linkedin', $request->linkedin, 'social');
        Setting::set('youtube', $request->youtube, 'social');

        return back()->with('success', __('messages.social_links_saved_successfully'));
    }
}
