<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{

    public function index()
    {
        if (!auth()->user()->can('view about')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $about = AboutSection::first();
        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        if (!auth()->user()->can('edit about')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'label_ar' => 'required|string|max:100',
            'label_en' => 'required|string|max:100',
            'heading_ar' => 'required|string|max:255',
            'heading_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'experience_number' => 'nullable|string|max:50',
            'experience_text_ar' => 'required|string|max:100',
            'experience_text_en' => 'required|string|max:100',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'secondary_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'features' => 'nullable|array',
            'features.*.icon' => 'required|string|max:100',
            'features.*.title_ar' => 'required|string|max:255',
            'features.*.title_en' => 'required|string|max:255',
            'features.*.desc_ar' => 'nullable|string',
            'features.*.desc_en' => 'nullable|string',
        ], [
            'features.*.icon.required' => 'أيقونة الميزة رقم :position مطلوبة.',
            'features.*.title_ar.required' => 'عنوان الميزة رقم :position بالعربية مطلوب.',
            'features.*.title_en.required' => 'عنوان الميزة رقم :position بالإنجليزية مطلوب.',
        ]);

        $data = [
            'label' => ['ar' => $validated['label_ar'], 'en' => $validated['label_en']],
            'heading' => ['ar' => $validated['heading_ar'], 'en' => $validated['heading_en']],
            'description' => ['ar' => $validated['description_ar'], 'en' => $validated['description_en']],
            'experience_number' => $validated['experience_number'],
            'experience_text' => ['ar' => $validated['experience_text_ar'], 'en' => $validated['experience_text_en']],
            'features' => $validated['features'] ?? [],
        ];

        $about = AboutSection::first();

        foreach (['main_image', 'secondary_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($about && $about->$field) Storage::disk('public')->delete($about->$field);
                $data[$field] = $request->file($field)->store('about', 'public');
            }
        }

        if ($about) {
            $about->update($data);
        } else {
            AboutSection::create($data);
        }

        return redirect()->route('admin.about.index')->with('success', __('messages.about_updated'));
    }
}
