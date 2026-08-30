<?php

namespace Database\Seeders;

use App\Models\MarqueeItem;
use Illuminate\Database\Seeder;

class MarqueeSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'text' => [
                    'ar' => 'منتجات أصلية 100%',
                    'en' => '100% Genuine Products',
                ],
                'order' => 1,
                'is_active' => true,
            ],

            [
                'text' => [
                    'ar' => 'أسعار تنافسية للجملة والتجزئة',
                    'en' => 'Competitive Wholesale & Retail Prices',
                ],
                'order' => 2,
                'is_active' => true,
            ],

            [
                'text' => [
                    'ar' => 'توريد للمشاريع والمقاولين',
                    'en' => 'Project & Contractor Supply',
                ],
                'order' => 3,
                'is_active' => true,
            ],

            [
                'text' => [
                    'ar' => 'استشارات فنية متخصصة',
                    'en' => 'Specialized Technical Consultations',
                ],
                'order' => 4,
                'is_active' => true,
            ],

            [
                'text' => [
                    'ar' => 'خدمة عملاء احترافية',
                    'en' => 'Professional Customer Service',
                ],
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            MarqueeItem::create($item);
        }
    }
}
