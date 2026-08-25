<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyUsSection;
use App\Models\WhyUsItem;
use Illuminate\Http\Request;

class WhyUsController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view why-us')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $section = WhyUsSection::first();

        $items = WhyUsItem::orderBy('order')->get();

        return view('admin.why-us.index', compact('section', 'items'));
    }

    public function updateSection(Request $request)
    {
        if (!auth()->user()->can('edit why-us')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
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

    public function storeItem(Request $request)
    {
        if (!auth()->user()->can('create why-us')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
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

    public function updateItem(Request $request, WhyUsItem $whyUsItem)
    {
        if (!auth()->user()->can('edit why-us')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
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

    public function destroyItem(WhyUsItem $whyUsItem)
    {
        if (!auth()->user()->can('delete why-us')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $whyUsItem->delete();

        return redirect()
            ->route('admin.why-us.index')
            ->with('success', __('messages.why_us_item_deleted'));
    }
}
