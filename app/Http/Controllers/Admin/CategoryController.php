<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySection;
use App\Models\TestimonialsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view categories')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $categories = Category::orderBy('order')->get();
        $section = CategorySection::first();
        return view('admin.categories.index', compact('categories','section'));
    }

    public function updateSection(Request $request)
    {
        if (!auth()->user()->can('edit categories')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'label_ar' => 'required|string|max:100', 'label_en' => 'required|string|max:100',
            'heading_ar' => 'required|string|max:255', 'heading_en' => 'required|string|max:255',
            'description_ar' => 'required|string', 'description_en' => 'required|string',
        ]);

        $data = [
            'label' => ['ar' => $validated['label_ar'], 'en' => $validated['label_en']],
            'heading' => ['ar' => $validated['heading_ar'], 'en' => $validated['heading_en']],
            'description' => ['ar' => $validated['description_ar'], 'en' => $validated['description_en']],
        ];

        $section = CategorySection::first();
        $section ? $section->update($data) : CategorySection::create($data);

        return redirect()->route('admin.categories.index')->with('success', __('messages.testimonials_section_updated'));
    }


    public function store(Request $request)
    {
        if (!auth()->user()->can('create categories')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ], [
            'name_ar.required' => __('messages.category_name_ar_required'),
            'name_en.required' => __('messages.category_name_en_required'),
            'image.image' => __('messages.image_must_be_image'),
            'image.mimes' => __('messages.image_invalid_format'),
            'image.max' => __('messages.image_max_size'),
            'order.integer' => __('messages.order_must_be_integer'),
            'order.min' => __('messages.order_min'),
        ]);

        $data = [
            'name' => [
                'ar' => $validated['name_ar'],
                'en' => $validated['name_en']
            ],
            'icon' => $validated['icon'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return back()->with(
            'success',
            __('messages.category_added_successfully')
        );
    }

    public function update(Request $request, Category $category)
    {
        if (!auth()->user()->can('edit categories')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ], [
            'name_ar.required' => __('messages.category_name_ar_required'),
            'name_en.required' => __('messages.category_name_en_required'),
            'image.image' => __('messages.image_must_be_image'),
            'image.mimes' => __('messages.image_invalid_format'),
            'image.max' => __('messages.image_max_size'),
            'order.integer' => __('messages.order_must_be_integer'),
            'order.min' => __('messages.order_min'),
        ]);

        $data = [
            'name' => [
                'ar' => $validated['name_ar'],
                'en' => $validated['name_en']
            ],
            'icon' => $validated['icon'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return back()->with(
            'success',
            __('messages.category_updated_successfully')
        );
    }

    public function destroy(Category $category)
    {
        if (!auth()->user()->can('delete categories')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return back()->with(
            'success',
            __('messages.category_deleted_successfully')
        );
    }
}
