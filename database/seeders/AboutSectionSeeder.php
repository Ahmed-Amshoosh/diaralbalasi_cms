<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutSection;

class AboutSectionSeeder extends Seeder
{
    public function run(): void
    {
        AboutSection::updateOrCreate(
            ['id' => 1],
            [
                'label' => [
                    'ar' => 'من نحن',
                    'en' => 'About Us',
                ],

                'heading' => [
                    'ar' => 'شريكك الموثوق في عالم البناء',
                    'en' => 'Your Trusted Partner in the World of Construction',
                ],

                'description' => [
                    'ar' => 'ديار البلعسي مؤسسة متخصصة في توفير مواد البناء، والأنابيب البلاستيكية، والأدوات الصحية، ومستلزمات السباكة، والمحابس، ومضخات المياه، وإكسسوارات المطابخ والحمامات. نحرص على توفير منتجات أصلية بجودة عالية تلبي احتياجات الأفراد والمقاولين والشركات، مع الالتزام بالأسعار المناسبة وخدمة العملاء المتميزة.',
                    'en' => 'Diar Al-Balasi is a specialized company providing building materials, plastic pipes, sanitary ware, plumbing supplies, valves, water pumps, and kitchen and bathroom accessories. We are committed to providing genuine, high-quality products that meet the needs of individuals, contractors, and companies, while offering competitive prices and excellent customer service.',
                ],

                'main_image' => null,

                'secondary_image' => null,

                'experience_number' => '20+',

                'experience_text' => [
                    'ar' => 'عاماً من التميز',
                    'en' => 'Years of Excellence',
                ],

                'features' => [
                    'ar' => [
                        [
                            'icon' => 'fas fa-certificate',
                            'title' => 'منتجات أصلية',
                            'description' => 'نوفر منتجات من علامات تجارية موثوقة',
                        ],
                        [
                            'icon' => 'fas fa-tags',
                            'title' => 'أسعار منافسة',
                            'description' => 'أفضل الأسعار للجملة والتجزئة',
                        ],
                        [
                            'icon' => 'fas fa-truck-loading',
                            'title' => 'توريد للمشاريع',
                            'description' => 'حلول متكاملة للمقاولين والشركات',
                        ],
                        [
                            'icon' => 'fas fa-user-tie',
                            'title' => 'استشارات فنية',
                            'description' => 'مساعدتك في اختيار المنتجات المناسبة',
                        ],
                    ],

                    'en' => [
                        [
                            'icon' => 'fas fa-certificate',
                            'title' => 'Genuine Products',
                            'description' => 'Products from trusted and reliable brands',
                        ],
                        [
                            'icon' => 'fas fa-tags',
                            'title' => 'Competitive Prices',
                            'description' => 'The best prices for wholesale and retail',
                        ],
                        [
                            'icon' => 'fas fa-truck-loading',
                            'title' => 'Project Supply',
                            'description' => 'Complete solutions for contractors and companies',
                        ],
                        [
                            'icon' => 'fas fa-user-tie',
                            'title' => 'Technical Consultation',
                            'description' => 'Helping you choose the right products',
                        ],
                    ],
                ],
            ]
        );

        $this->command->info('About section created successfully.');
    }
}
