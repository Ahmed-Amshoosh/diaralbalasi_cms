<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PartnersSection;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersController extends Controller {
    public function index() {
        $section = PartnersSection::first();
        $partners = Partner::orderBy('order')->get();
        return view('admin.partners.index', compact('section', 'partners'));
    }

    public function updateSection(Request $request) {
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
        $section = PartnersSection::first();
        $section ? $section->update($data) : PartnersSection::create($data);
        return redirect()->route('admin.partners.index')->with('success', __('messages.partners_section_updated'));
    }

    public function storePartner(Request $request) {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255', 'name_en' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);
        $logoPath = $request->file('logo')->store('partners', 'public');
        Partner::create([
            'name' => ['ar' => $validated['name_ar'], 'en' => $validated['name_en']],
            'logo' => $logoPath,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.partners.index')->with('success', __('messages.partner_created'));
    }

    public function updatePartner(Request $request, Partner $partner) {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255', 'name_en' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);
        $data = [
            'name' => ['ar' => $validated['name_ar'], 'en' => $validated['name_en']],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ];
        if ($request->hasFile('logo')) {
            if ($partner->logo) Storage::disk('public')->delete($partner->logo);
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }
        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success', __('messages.partner_updated'));
    }

    public function destroyPartner(Partner $partner) {
        if ($partner->logo) Storage::disk('public')->delete($partner->logo);
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', __('messages.partner_deleted'));
    }
}
