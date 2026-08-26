<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\CtaSection;
use App\Models\Partner;
use App\Models\PartnersSection;
use App\Models\WhyUsItem;
use App\Models\WhyUsSection;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $cta = CtaSection::first();
        $partnersSection = PartnersSection::first();
        $partners = Partner::orderBy('order')->get();
        $whyUsSectionSection = WhyUsSection::first();
        $whyUsItems = WhyUsItem::orderBy('order')->get();

        return view('frontend.index', compact('whyUsItems','whyUsSectionSection','cta','partnersSection','partners'));
    }
}
