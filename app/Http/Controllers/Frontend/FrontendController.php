<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\Category;
use App\Models\CategorySection;
use App\Models\ContactMessage;
use App\Models\ContactSection;
use App\Models\CtaSection;
use App\Models\Hero;
use App\Models\HeroStat;
use App\Models\MarqueeItem;
use App\Models\Partner;
use App\Models\PartnersSection;
use App\Models\Testimonial;
use App\Models\TestimonialsSection;
use App\Models\WhyUsItem;
use App\Models\WhyUsSection;
use Illuminate\Http\Request;

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

        return view('frontend.index', compact('contact','about','categories','categorySection','hero','heroStats','whyUsItems','marqueeItems','testimonials','testimonialsSection','whyUsSectionSection','cta','partnersSection','partners'));
    }
}
