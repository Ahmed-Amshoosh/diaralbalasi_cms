<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => [
                    'ar' => 'مواد البناء',
                    'en' => 'Building Materials',
                ],
                'icon' => 'fas fa-hard-hat',
                'image' => null,
                'order' => 1,
                'is_active' => true,
            ],

            [
                'name' => [
                    'ar' => 'مواد البناء',
                    'en' => 'Building Materials',
                ],
                'icon' => 'fas fa-building',
                'image' => null,
                'order' => 2,
                'is_active' => true,
            ],

            [
                'name' => [
                    'ar' => 'الأدوات الصحية',
                    'en' => 'Sanitary Ware',
                ],
                'icon' => 'fas fa-bath',
                'image' => null,
                'order' => 3,
                'is_active' => true,
            ],

            [
                'name' => [
                    'ar' => 'الأدوات الصحية',
                    'en' => 'Sanitary Ware',
                ],
                'icon' => 'fas fa-toilet',
                'image' => null,
                'order' => 4,
                'is_active' => true,
            ],

            [
                'name' => [
                    'ar' => 'السباكة والأنابيب',
                    'en' => 'Plumbing & Pipes',
                ],
                'icon' => 'fas fa-faucet',
                'image' => null,
                'order' => 5,
                'is_active' => true,
            ],

            [
                'name' => [
                    'ar' => 'السباكة والأنابيب',
                    'en' => 'Plumbing & Pipes',
                ],
                'icon' => 'fas fa-water',
                'image' => null,
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('Categories created successfully.');
    }
}
