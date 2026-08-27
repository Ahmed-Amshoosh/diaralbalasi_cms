<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestimonialsSection;

class TestimonialsSectionSeeder extends Seeder
{
    public function run(): void
    {
        TestimonialsSection::create([
            'label' => [
                'ar' => 'آراء العملاء',
                'en' => 'Testimonials',
            ],

            'heading' => [
                'ar' => 'ماذا يقول عملاؤنا وشركاؤنا؟',
                'en' => 'What Do Our Customers and Partners Say?',
            ],

            'description' => [
                'ar' => 'نفخر بثقة عملائنا وشراكاتنا الناجحة في مختلف المشاريع الإنشائية والتجارية',
                'en' => 'We are proud of our customers’ trust and our successful partnerships across various construction and commercial projects.',
            ],
        ]);
    }
}
