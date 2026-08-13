<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyUsSection;
use App\Models\WhyUsItem;
use Illuminate\Http\Request;

class WhyUsController extends Controller
{
    /**
     * عرض إعدادات Why Us والعناصر
     */
    public function index()
    {
        $section = WhyUsSection::first();

        $items = WhyUsItem::orderBy('order')->get();

        return view('admin.why-us.index', compact('section', 'items'));
    }

    /**
     * تحديث قسم Why Us
     */
    public function updateSection(Request $request)
    {
        $validated = $request->validate([
            'label_ar' => 'required|string|max:100',
            'label_en' => 'required|string|max:100',

            'heading_ar' => 'required|string|max:255',
            'heading_en' => 'required|string|max:255',

            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ]);

        $data = [
            'label' => [
                'ar' => $validated['label_ar'],
                'en' => $validated['label_en'],
            ],

            'heading' => [
                'ar' => $validated['heading_ar'],
                'en' => $validated['heading_en'],
            ],

            'description' => [
                'ar' => $validated['description_ar'],
                'en' => $validated['description_en'],
            ],
        ];

        $section = WhyUsSection::first();

        if ($section) {
            $section->update($data);
        } else {
            WhyUsSection::create($data);
        }

        return redirect()
            ->route('admin.why-us.index')
            ->with('success', __('messages.why_us_section_updated'));
    }

    /**
     * إضافة عنصر جديد
     */
    public function storeItem(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'nullable|string|max:100',

            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',

            'description_ar' => 'required|string',
            'description_en' => 'required|string',

            'order' => 'nullable|integer|min:0',
        ]);

        WhyUsItem::create([
            'icon' => $validated['icon'] ?? null,

            'title' => [
                'ar' => $validated['title_ar'],
                'en' => $validated['title_en'],
            ],

            'description' => [
                'ar' => $validated['description_ar'],
                'en' => $validated['description_en'],
            ],

            'order' => $validated['order'] ?? 0,

            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.why-us.index')
            ->with('success', __('messages.why_us_item_created'));
    }

    /**
     * تحديث عنصر
     */
    public function updateItem(Request $request, WhyUsItem $whyUsItem)
    {
        $validated = $request->validate([
            'icon' => 'nullable|string|max:100',

            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',

            'description_ar' => 'required|string',
            'description_en' => 'required|string',

            'order' => 'nullable|integer|min:0',
        ]);

        $whyUsItem->update([
            'icon' => $validated['icon'] ?? null,

            'title' => [
                'ar' => $validated['title_ar'],
                'en' => $validated['title_en'],
            ],

            'description' => [
                'ar' => $validated['description_ar'],
                'en' => $validated['description_en'],
            ],

            'order' => $validated['order'] ?? 0,

            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.why-us.index')
            ->with('success', __('messages.why_us_item_updated'));
    }

    /**
     * حذف عنصر
     */
    public function destroyItem(WhyUsItem $whyUsItem)
    {
        $whyUsItem->delete();

        return redirect()
            ->route('admin.why-us.index')
            ->with('success', __('messages.why_us_item_deleted'));
    }
}
