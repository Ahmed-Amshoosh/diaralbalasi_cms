<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\Category;
use App\Models\CategorySection;
use App\Models\ContactSection;
use App\Models\CtaSection;
use App\Models\Hero;
use App\Models\HeroStat;
use App\Models\MarqueeItem;
use App\Models\Partner;
use App\Models\PartnersSection;
use App\Models\ProductSection;
use App\Models\Testimonial;
use App\Models\TestimonialsSection;
use App\Models\WhyUsItem;
use App\Models\WhyUsSection;

class FrontendController extends Controller
{
    public function index()
    {
        $cta = CtaSection::first();
        $partnersSection = PartnersSection::first();
        $partners = Partner::query()->where('is_active' ,true)->orderBy('order')->get();
        $whyUsSectionSection = WhyUsSection::first();
        $whyUsItems = WhyUsItem::query()->where('is_active' ,true)->orderBy('order')->get();
        $testimonialsSection = TestimonialsSection::first();
        $testimonials = Testimonial::query()->where('is_active' ,true)->orderBy('order')->get();
        $marqueeItems = MarqueeItem::query()->where('is_active' ,true)->orderBy('order')->get();
        $heroStats = HeroStat::query()->where('is_active' ,true)->orderBy('order')->get();
        $hero = Hero::first();
        $categorySection = CategorySection::first();
        $categories = Category::orderBy('order')->get();
        $about = AboutSection::first();
        $contact = ContactSection::first();
        $productSection = ProductSection::first();


        return view('frontend.index', compact('productSection','contact','about','categories','categorySection','hero','heroStats','whyUsItems','marqueeItems','testimonials','testimonialsSection','whyUsSectionSection','cta','partnersSection','partners'));
    }

    public function products()
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('order')->get();
        $partners = \App\Models\Partner::where('is_active', true)->orderBy('order')->get();

        return view('frontend.products.index', compact('categories', 'partners'));
    }

    public function ajax(): \Illuminate\Http\JsonResponse
    {
        $category = request()->get('category', 'all');
        $partner = request()->get('partner', 'all');
        $page = (int) request()->get('page', 1);
        $locale = app()->getLocale();
        $query = \App\Models\Product::with(['category', 'images', 'partner'])
            ->where('is_active', true)
            ->orderBy('order', 'asc');

        if ($category !== 'all' && is_numeric($category)) {
            $query->where('category_id', (int) $category);
        }

        if ($partner !== 'all' && is_numeric($partner)) {

            $query->where('partner_id', (int) $partner);
        }

        $products = $query->paginate(20, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $products->map(function ($product) use ($locale) {
                $image = $product->images->first();
                return [
                    'id' => $product->id,
                    'name' => $product->getTranslation('name', $locale),
                    'price' => $product->price !== null ? number_format($product->price, 2) . ' ' . __('messages.currency') : '',
                    'category' => $product->category ? [
                        'id' => $product->category->id,
                        'name' => $product->category->getTranslation('name', $locale),
                    ] : null,
                    'partner' => $product->partner ? [
                        'id' => $product->partner->id,
                        'name' => $product->partner->getTranslation('name', $locale),
                    ] : null,
                    'image' => $image ? asset('storage/' . $image->image) : asset('frontend/img/product-placeholder.png'),
                    'url' => route('frontend.products.show', $product->id),
                ];
            })->values(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'next_page_url' => $products->nextPageUrl(),
            'total' => $products->total(),
        ]);
    }
}
