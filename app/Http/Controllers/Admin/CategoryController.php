<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
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
