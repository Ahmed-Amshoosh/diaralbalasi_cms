<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\TestimonialsSection;
use Illuminate\Http\Request;

class TestimonialController extends Controller {
    public function index() {
        $section = TestimonialsSection::first();
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('section', 'testimonials'));
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

        $section = TestimonialsSection::first();
        $section ? $section->update($data) : TestimonialsSection::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', __('messages.testimonials_section_updated'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255', 'name_en' => 'required|string|max:255',
            'role_ar' => 'nullable|string|max:255', 'role_en' => 'nullable|string|max:255',
            'content_ar' => 'required|string', 'content_en' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'order' => 'nullable|integer|min:0',
        ]);
        Testimonial::create([
            'name' => ['ar' => $validated['name_ar'], 'en' => $validated['name_en']],
            'role' => ['ar' => $validated['role_ar'] ?? '', 'en' => $validated['role_en'] ?? ''],
            'content' => ['ar' => $validated['content_ar'], 'en' => $validated['content_en']],
            'rating' => $validated['rating'],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.testimonials.index')->with('success', __('messages.testimonial_created'));
    }

    public function update(Request $request, Testimonial $testimonial) {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255', 'name_en' => 'required|string|max:255',
            'role_ar' => 'nullable|string|max:255', 'role_en' => 'nullable|string|max:255',
            'content_ar' => 'required|string', 'content_en' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'order' => 'nullable|integer|min:0',
        ]);
        $testimonial->update([
            'name' => ['ar' => $validated['name_ar'], 'en' => $validated['name_en']],
            'role' => ['ar' => $validated['role_ar'] ?? '', 'en' => $validated['role_en'] ?? ''],
            'content' => ['ar' => $validated['content_ar'], 'en' => $validated['content_en']],
            'rating' => $validated['rating'],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.testimonials.index')->with('success', __('messages.testimonial_updated'));
    }

    public function destroy(Testimonial $testimonial) {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', __('messages.testimonial_deleted'));
    }
}
