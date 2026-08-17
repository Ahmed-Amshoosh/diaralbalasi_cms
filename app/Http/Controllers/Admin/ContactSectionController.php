<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactSection;
use Illuminate\Http\Request;

class ContactSectionController extends Controller {

    public function update(Request $request) {
        $validated = $request->validate([
            'label_ar' => 'required|string|max:100', 'label_en' => 'required|string|max:100',
            'heading_ar' => 'required|string|max:255', 'heading_en' => 'required|string|max:255',
            'description_ar' => 'required|string', 'description_en' => 'required|string',
        ], [
            'label_ar.required' => 'تسمية القسم بالعربية مطلوبة.',
            'label_en.required' => 'تسمية القسم بالإنجليزية مطلوبة.',
            'heading_ar.required' => 'العنوان بالعربية مطلوب.',
            'heading_en.required' => 'العنوان بالإنجليزية مطلوب.',
        ]);

        $data = [
            'label' => ['ar' => $validated['label_ar'], 'en' => $validated['label_en']],
            'heading' => ['ar' => $validated['heading_ar'], 'en' => $validated['heading_en']],
            'description' => ['ar' => $validated['description_ar'], 'en' => $validated['description_en']],
        ];

        $section = ContactSection::first();
        $section ? $section->update($data) : ContactSection::create($data);

        return back()->with('success', __('messages.contact_section_updated'));
    }
}
