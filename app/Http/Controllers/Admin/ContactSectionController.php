<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactSection;
use Illuminate\Http\Request;

class ContactSectionController extends Controller {

    public function update(Request $request)
    {
        if (!auth()->user()->can('edit content')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $validated = $request->validate([
            'label_ar' => 'required|string|max:100',
            'label_en' => 'required|string|max:100',

            'heading_ar' => 'required|string|max:255',
            'heading_en' => 'required|string|max:255',

            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ], [
            'label_ar.required' => __('messages.contact_label_ar_required'),
            'label_en.required' => __('messages.contact_label_en_required'),

            'heading_ar.required' => __('messages.contact_heading_ar_required'),
            'heading_en.required' => __('messages.contact_heading_en_required'),

            'description_ar.required' => __('messages.contact_description_ar_required'),
            'description_en.required' => __('messages.contact_description_en_required'),
        ]);

        $data = [
            'label' => [
                'ar' => $validated['label_ar'],
                'en' => $validated['label_en'],
            ],

            'heading' => [
                'ar' => $validated['heading_ar'],
                'en' => $validated['heading_en'],
            ],

            'description' => [
                'ar' => $validated['description_ar'],
                'en' => $validated['description_en'],
            ],
        ];

        $section = ContactSection::first();

        if ($section) {
            $section->update($data);
        } else {
            ContactSection::create($data);
        }

        return back()->with(
            'success',
            __('messages.contact_section_updated')
        );
    }
}
