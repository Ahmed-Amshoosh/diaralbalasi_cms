<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Partner;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view products')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $products = Product::with(['category', 'partner', 'images'])->orderBy('order')->get();
        $categories = Category::all();
        $partners = Partner::where('is_active', true)->orderBy('order')->get();

        return view('admin.products.index', compact('products', 'categories', 'partners'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create products')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'partner_id' => 'nullable|exists:partners,id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ], [
            'name_ar.required' => 'اسم المنتج بالعربية مطلوب.',
            'name_en.required' => 'اسم المنتج بالإنجليزية مطلوب.',
            'images.*.image' => 'الملف يجب أن يكون صورة.',
            'images.*.max' => 'حجم الصورة يجب ألا يتجاوز 2MB.',
        ]);

        $product = Product::create([
            'name' => ['ar' => $validated['name_ar'], 'en' => $validated['name_en']],
            'description' => ['ar' => $validated['description_ar'] ?? '', 'en' => $validated['description_en'] ?? ''],
            'price' => $validated['price'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'partner_id' => $validated['partner_id'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image' => $path,
                    'order' => $index,
                ]);
            }
        }

        return back()->with('success', __('messages.product_created_successfully'));
    }

    public function update(Request $request, Product $product)
    {
        if (!auth()->user()->can('edit products')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'partner_id' => 'nullable|exists:partners,id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ], [
            'name_ar.required' => 'اسم المنتج بالعربية مطلوب.',
            'name_en.required' => 'اسم المنتج بالإنجليزية مطلوب.',
        ]);

        $product->update([
            'name' => ['ar' => $validated['name_ar'], 'en' => $validated['name_en']],
            'description' => ['ar' => $validated['description_ar'] ?? '', 'en' => $validated['description_en'] ?? ''],
            'price' => $validated['price'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'partner_id' => $validated['partner_id'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->hasFile('images')) {
            $lastOrder = $product->images()->max('order') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image' => $path,
                    'order' => $lastOrder + $index + 1,
                ]);
            }
        }

        return back()->with('success', __('messages.product_updated_successfully'));
    }

    public function destroy(Product $product)
    {
        if (!auth()->user()->can('delete products')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
            $image->delete();
        }
        $product->delete();
        return back()->with('success', __('messages.product_deleted_successfully'));
    }

    public function deleteImage(ProductImage $image)
    {
        if (!auth()->user()->can('delete products')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();
        return back()->with('success', __('messages.product_image_deleted_successfully'));
    }
}
