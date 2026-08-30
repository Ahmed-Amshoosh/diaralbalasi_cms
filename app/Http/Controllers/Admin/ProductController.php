<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Partner;
use App\Models\ProductImage;
use App\Models\ProductSection;
use Illuminate\Http\JsonResponse;
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
        $section = ProductSection::first();

        $partners = Partner::where('is_active', true)->orderBy('order')->get();

        return view('admin.products.index', compact('section', 'products', 'categories', 'partners'));
    }

    public function updateSection(Request $request)
    {
        if (!auth()->user()->can('edit products')) {
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

        $section = ProductSection::first();
        $section ? $section->update($data) : ProductSection::create($data);

        return redirect()->route('admin.products.index')->with('success', __('messages.testimonials_section_updated'));
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
            $lastOrder = (int)($product->images()->max('order') ?? -1);
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

    public function ajax(): JsonResponse
    {
        $category = request('category', 'all');
        $partner = request('partner', 'all');
        $search = trim(request('search', ''));
        $page = request('page', 1);
        $locale = app()->getLocale();

        $query = Product::with([
            'category',
            'images',
            'partner'
        ])
            ->where('is_active', true)
            ->orderBy('order');
        if ($search !== '') {
            $query->where(function ($q) use ($search, $locale) {
                $q->where(
                    "name->{$locale}",
                    'like',
                    '%' . $search . '%'
                )
                    ->orWhere(
                        "description->{$locale}",
                        'like',
                        '%' . $search . '%'
                    );
            });
        }

        if ($category !== 'all') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('category_id', (int)$category);
            });
        }

        if ($partner !== 'all' && is_numeric($partner)) {
            $query->where('partner_id', (int)$partner);
        }

        $products = $query->paginate(
            20, ['*'],
            'page', $page
        );

        return response()->json([
            'success' => true,
            'data' => $products->map(function ($product) use ($locale) {
                $image = $product->images->first();
                return [
                    'id' => $product->id,
                    'name' => $product->getTranslation(
                        'name',
                        $locale
                    ),
                    'price' => $product->price !== null
                        ? number_format($product->price, 2)
                        . ' '
                        . __('messages.currency')
                        : '',
                    'category' => $product->category
                        ? [
                            'name' => $product->category->getTranslation(
                                'name',
                                $locale
                            ),
                            'id' => $product->category->id,
                        ]
                        : null,
                    'partner' => $product->partner
                        ? [
                            'id' => $product->partner->id,
                            'name' => $product->partner->getTranslation(
                                'name',
                                $locale
                            ),
                        ]
                        : null,
                    'image' => $image
                        ? asset('storage/' . $image->image)
                        : asset(
                            'frontend/img/product-placeholder.png'
                        ),
                    'url' => route(
                        'frontend.products.show',
                        $product->id
                    ),
                ];
            })->values(),
            'next_page_url' => $products->nextPageUrl(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'total' => $products->total(),
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'partner', 'images']);
        $similarProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('category_id', $product->category_id)
                    ->orWhere('partner_id', $product->partner_id);
            })
            ->limit(4)
            ->get();

        return view('frontend.products.show', compact('product', 'similarProducts'));
    }

}
