<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroStat;
use Illuminate\Http\Request;

class HeroStatController extends Controller {
    public function index() {
        if (!auth()->user()->can('view hero-stats')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $stats = HeroStat::orderBy('order')->get();
        return view('admin.hero-stats.index', compact('stats'));
    }

    public function store(Request $request) {
        if (!auth()->user()->can('create hero-stats')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'number' => 'required|string|max:50',
            'label_ar' => 'required|string|max:255',
            'label_en' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        HeroStat::create([
            'number' => $validated['number'],
            'label' => ['ar' => $validated['label_ar'], 'en' => $validated['label_en']],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.hero-stats.index')->with('success', __('messages.stat_created'));
    }

    public function update(Request $request, HeroStat $heroStat) {
        if (!auth()->user()->can('edit hero-stats')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'number' => 'required|string|max:50',
            'label_ar' => 'required|string|max:255',
            'label_en' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $heroStat->update([
            'number' => $validated['number'],
            'label' => ['ar' => $validated['label_ar'], 'en' => $validated['label_en']],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.hero-stats.index')->with('success', __('messages.stat_updated'));
    }

    public function destroy(HeroStat $heroStat) {
        if (!auth()->user()->can('delete hero-stats')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $heroStat->delete();
        return redirect()->route('admin.hero-stats.index')->with('success', __('messages.stat_deleted'));
    }
}
