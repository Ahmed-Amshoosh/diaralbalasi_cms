<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhyUsSection;

class WhyUsSectionSeeder extends Seeder
{
    public function run(): void
    {
        WhyUsSection::create([
            'label' => [
                'ar' => 'لماذا نحن',
                'en' => 'Why Us',
            ],

            'heading' => [
                'ar' => 'لماذا يختارنا عملاؤنا؟',
                'en' => 'Why Do Our Customers Choose Us?',
            ],

            'description' => [
                'ar' => 'نلتزم بتقديم تجربة استثنائية لعملائنا في كل جوانب الخدمة',
                'en' => 'We are committed to providing our customers with an exceptional experience in every aspect of our service.',
            ],
        ]);
    }
}
