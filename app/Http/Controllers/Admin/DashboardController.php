<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// سنضيف باقي الموديلات لاحقاً

class DashboardController extends Controller
{
    public function index()
    {
        // سنضيف الإحصائيات الفعلية لاحقاً عند إنشاء الموديلات
        $stats = [
            'products' => 0,
            'categories' => 0,
            'brands' => 0,
            'testimonials' => 0,
            'messages' => 0,
            'users' => User::count(),
        ];

        // آخر الرسائل (سنضيفها لاحقاً)
        $recentMessages = collect([]);

        // آخر المنتجات (سنضيفها لاحقاً)
        $recentProducts = collect([]);

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProducts'));
    }
}
