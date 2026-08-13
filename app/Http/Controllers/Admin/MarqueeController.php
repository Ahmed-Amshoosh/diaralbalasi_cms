<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarqueeItem;
use Illuminate\Http\Request;

class MarqueeController extends Controller {

    // عرض الصفحة الرئيسية التي تحتوي على الجدول والنافذة المنبثقة
    public function index() {
        $items = MarqueeItem::orderBy('order')->get();
        return view('admin.marquee.index', compact('items'));
    }

    // إضافة عنصر جديد
    public function store(Request $request) {
        $validated = $request->validate([
            'text_ar' => 'required|string|max:255',
            'text_en' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        MarqueeItem::create([
            'text' => ['ar' => $validated['text_ar'], 'en' => $validated['text_en']],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.marquee.index')->with('success', __('messages.marquee_created'));
    }

    // تحديث عنصر موجود
    public function update(Request $request, MarqueeItem $marquee) {
        $validated = $request->validate([
            'text_ar' => 'required|string|max:255',
            'text_en' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $marquee->update([
            'text' => ['ar' => $validated['text_ar'], 'en' => $validated['text_en']],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.marquee.index')->with('success', __('messages.marquee_updated'));
    }

    // حذف عنصر
    public function destroy(MarqueeItem $marquee) {
        $marquee->delete();
        return redirect()->route('admin.marquee.index')->with('success', __('messages.marquee_deleted'));
    }
}
