<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view seo')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $seo = [
            'title' => Setting::get('seo_title'),
            'description' => Setting::get('seo_description'),
            'keywords' => Setting::get('seo_keywords'),
            'author' => Setting::get('seo_author'),
            'robots' => Setting::get('seo_robots'),
            'og_image' => Setting::get('seo_og_image'),
            'twitter_card' => Setting::get('seo_twitter_card'),
            'twitter_site' => Setting::get('seo_twitter_site'),
            'canonical_url' => Setting::get('seo_canonical_url'),
            'google_analytics' => Setting::get('seo_google_analytics'),
            'google_tag_manager' => Setting::get('seo_google_tag_manager'),
            'schema_type' => Setting::get('seo_schema_type'),
        ];

        return view('admin.seo.index', compact('seo'));
    }

    public function update(Request $request)
    {
        if (!auth()->user()->can('edit seo')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }

        $validated = $request->validate([
            'title_ar' => 'required|string|max:70',
            'title_en' => 'required|string|max:70',
            'description_ar' => 'required|string|max:160',
            'description_en' => 'required|string|max:160',
            'keywords_ar' => 'nullable|string',
            'keywords_en' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:100',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'twitter_card' => 'nullable|string|in:summary,summary_large_image',
            'twitter_site' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'google_analytics' => 'nullable|string|max:50|regex:/^G-[A-Z0-9]+$/',
            'google_tag_manager' => 'nullable|string|max:50|regex:/^GTM-[A-Z0-9]+$/',
        ], [
            'title_ar.required' => 'عنوان SEO بالعربية مطلوب.',
            'title_en.required' => 'عنوان SEO بالإنجليزية مطلوب.',
            'title_ar.max' => 'عنوان SEO بالعربية يجب ألا يتجاوز 70 حرف.',
            'title_en.max' => 'عنوان SEO بالإنجليزية يجب ألا يتجاوز 70 حرف.',
            'description_ar.required' => 'وصف SEO بالعربية مطلوب.',
            'description_en.required' => 'وصف SEO بالإنجليزية مطلوب.',
            'description_ar.max' => 'وصف SEO بالعربية يجب ألا يتجاوز 160 حرف.',
            'description_en.max' => 'وصف SEO بالإنجليزية يجب ألا يتجاوز 160 حرف.',
        ]);

        Setting::set('seo_title', [
            'ar' => $validated['title_ar'],
            'en' => $validated['title_en'],
        ], 'seo');

        Setting::set('seo_description', [
            'ar' => $validated['description_ar'],
            'en' => $validated['description_en'],
        ], 'seo');

        Setting::set('seo_keywords', [
            'ar' => $validated['keywords_ar'] ?? '',
            'en' => $validated['keywords_en'] ?? '',
        ], 'seo');

        Setting::set('seo_author', $validated['author'] ?? '', 'seo');
        Setting::set('seo_robots', $validated['robots'] ?? 'index, follow', 'seo');
        Setting::set('seo_twitter_card', $validated['twitter_card'] ?? 'summary_large_image', 'seo');
        Setting::set('seo_twitter_site', $validated['twitter_site'] ?? '', 'seo');
        Setting::set('seo_canonical_url', $validated['canonical_url'] ?? '', 'seo');
        Setting::set('seo_google_analytics', $validated['google_analytics'] ?? '', 'seo');
        Setting::set('seo_google_tag_manager', $validated['google_tag_manager'] ?? '', 'seo');

        if ($request->hasFile('og_image')) {
            $oldImage = Setting::get('seo_og_image');
            if ($oldImage && \Illuminate\Support\Facades\Storage::disk('public')->exists($oldImage)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldImage);
            }
            Setting::set('seo_og_image', $request->file('og_image')->store('seo', 'public'), 'seo');
        }

        return back()->with('success', __('messages.seo_saved_successfully'));
    }
}
