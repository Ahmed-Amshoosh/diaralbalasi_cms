<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller {

    public function index() {
        if (!auth()->user()->can('view hero')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $hero = Hero::first();
        return view('admin.hero.index', compact('hero'));
    }

    public function update(Request $request) {
        if (!auth()->user()->can('edit hero')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'sub_title_ar' => 'nullable|string|max:255',
            'sub_title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = [
            'title' => ['ar' => $validated['title_ar'], 'en' => $validated['title_en']],
            'sub_title' => ['ar' => $validated['sub_title_ar'] ?? '', 'en' => $validated['sub_title_en'] ?? ''],
            'description' => ['ar' => $validated['description_ar'] ?? '', 'en' => $validated['description_en'] ?? ''],
        ];

        $hero = Hero::first();

        if ($request->hasFile('bg_image')) {
            if ($hero && $hero->bg_image) {
                Storage::disk('public')->delete($hero->bg_image);
            }
            $data['bg_image'] = $request->file('bg_image')->store('heroes', 'public');
        }

        if ($hero) {
            $hero->update($data);
        } else {
            Hero::create($data);
        }

        return redirect()
            ->route('admin.hero.index')
            ->with('success', __('messages.hero_updated_successfully'));
    }
}
