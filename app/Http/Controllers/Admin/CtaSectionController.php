<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CtaSectionController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view cta-section')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $cta = CtaSection::first();
        return view('admin.cta.index', compact('cta'));
    }

    public function update(Request $request)
    {
        if (!auth()->user()->can('edit cta-section')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'heading_ar' => 'required|string',
            'heading_en' => 'required|string',

            'description_ar' => 'required|string',
            'description_en' => 'required|string',

            'button_text_ar' => 'required|string|max:100',
            'button_text_en' => 'required|string|max:100',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'heading_ar.required' => __('messages.heading_ar_required'),
            'heading_en.required' => __('messages.heading_en_required'),

            'description_ar.required' => __('messages.description_ar_required'),
            'description_en.required' => __('messages.description_en_required'),

            'button_text_ar.required' => __('messages.button_text_ar_required'),
            'button_text_en.required' => __('messages.button_text_en_required'),

            'button_text_ar.max' => __('messages.button_text_ar_max'),
            'button_text_en.max' => __('messages.button_text_en_max'),

            'image.image' => __('messages.image_invalid'),
            'image.mimes' => __('messages.image_mimes'),
            'image.max' => __('messages.image_max'),
        ]);

        $data = [
            'heading' => [
                'ar' => $validated['heading_ar'],
                'en' => $validated['heading_en'],
            ],

            'description' => [
                'ar' => $validated['description_ar'],
                'en' => $validated['description_en'],
            ],

            'button_text' => [
                'ar' => $validated['button_text_ar'],
                'en' => $validated['button_text_en'],
            ],
        ];

        $cta = CtaSection::first();

        if ($request->hasFile('image')) {

            if ($cta && $cta->image) {
                Storage::disk('public')->delete($cta->image);
            }

            $data['image'] = $request->file('image')->store('cta', 'public');
        }

        if ($cta) {
            $cta->update($data);
        } else {
            CtaSection::create($data);
        }

        return redirect()
            ->route('admin.cta.index')
            ->with('success', __('messages.cta_updated'));
    }
}
