<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroStat;

class HeroStatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'number' => '20',
                'label' => [
                    'ar' => 'عاماً من الخبرة',
                    'en' => 'Years of Experience',
                ],
                'order' => 1,
                'is_active' => true,
            ],

            [
                'number' => '5000',
                'label' => [
                    'ar' => 'منتج متنوع',
                    'en' => 'Diverse Products',
                ],
                'order' => 2,
                'is_active' => true,
            ],

            [
                'number' => '15',
                'label' => [
                    'ar' => 'ألف عميل',
                    'en' => 'Thousand Customers',
                ],
                'order' => 3,
                'is_active' => true,
            ],

            [
                'number' => '8',
                'label' => [
                    'ar' => 'أقسام رئيسية',
                    'en' => 'Main Categories',
                ],
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            HeroStat::create($stat);
        }
    }
}
