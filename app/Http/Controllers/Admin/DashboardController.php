<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'brands' => Partner::count(),
            'testimonials' => Testimonial::count(),
            'messages' => ContactMessage::where('is_read', false)->count(),
            'users' => User::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages'));
    }
}
