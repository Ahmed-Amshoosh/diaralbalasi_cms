<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategorySection;

class CategorySectionSeeder extends Seeder
{
    public function run(): void
    {
        CategorySection::updateOrCreate(
            ['id' => 1],
            [
                'label' => [
                    'ar' => 'تصنيفاتنا',
                    'en' => 'Our Categories',
                ],

                'heading' => [
                    'ar' => 'استكشف أقسام منتجاتنا',
                    'en' => 'Explore Our Product Categories',
                ],

                'description' => [
                    'ar' => 'نوفر جميع مستلزمات البناء والتشطيب والسباكة في أقسام منظمة لتسهيل الوصول إلى المنتجات التي تحتاجها',
                    'en' => 'We provide all building, finishing, and plumbing supplies in organized categories to make it easy to find the products you need.',
                ],
            ]
        );

        $this->command->info('Category section seeded successfully.');
    }
}
