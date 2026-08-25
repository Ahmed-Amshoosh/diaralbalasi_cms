<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarqueeItem;
use Illuminate\Http\Request;

class MarqueeController extends Controller {

    public function index() {
        if (!auth()->user()->can('view marquee')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $items = MarqueeItem::orderBy('order')->get();
        return view('admin.marquee.index', compact('items'));
    }

    public function store(Request $request) {
        if (!auth()->user()->can('create marquee')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
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

    public function update(Request $request, MarqueeItem $marquee) {
        if (!auth()->user()->can('edit marquee')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
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

    public function destroy(MarqueeItem $marquee) {
        if (!auth()->user()->can('delete marquee')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $marquee->delete();
        return redirect()->route('admin.marquee.index')->with('success', __('messages.marquee_deleted'));
    }
}
