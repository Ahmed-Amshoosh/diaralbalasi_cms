<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhyUsItem;

class WhyUsItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'icon' => 'fas fa-award',
                'title' => [
                    'ar' => 'أكثر من 20 عاماً من الخبرة',
                    'en' => 'More than 20 Years of Experience',
                ],
                'description' => [
                    'ar' => 'خبرة طويلة في قطاع مواد البناء والسباكة نضمن لك من خلالها الجودة والاحترافية',
                    'en' => 'Extensive experience in the building materials and plumbing sector, ensuring quality and professionalism.',
                ],
                'order' => 1,
                'is_active' => true,
            ],

            [
                'icon' => 'fas fa-check-circle',
                'title' => [
                    'ar' => 'منتجات أصلية',
                    'en' => 'Genuine Products',
                ],
                'description' => [
                    'ar' => 'نوفر منتجات من علامات تجارية موثوقة مع ضمان الجودة والشهادات المعتمدة',
                    'en' => 'We provide products from trusted brands with guaranteed quality and certified standards.',
                ],
                'order' => 2,
                'is_active' => true,
            ],

            [
                'icon' => 'fas fa-tags',
                'title' => [
                    'ar' => 'أسعار منافسة',
                    'en' => 'Competitive Prices',
                ],
                'description' => [
                    'ar' => 'أفضل الأسعار في السوق مع عروض وخصومات مستمرة للجملة والتجزئة',
                    'en' => 'Competitive market prices with ongoing offers and discounts for wholesale and retail.',
                ],
                'order' => 3,
                'is_active' => true,
            ],

            [
                'icon' => 'fas fa-layer-group',
                'title' => [
                    'ar' => 'تشكيلة واسعة',
                    'en' => 'Wide Range of Products',
                ],
                'description' => [
                    'ar' => 'آلاف المنتجات تحت سقف واحد من مواد البناء، السباكة، الأدوات الصحية، والكهرباء',
                    'en' => 'Thousands of products under one roof, including building materials, plumbing, sanitary ware, and electrical supplies.',
                ],
                'order' => 4,
                'is_active' => true,
            ],

            [
                'icon' => 'fas fa-building',
                'title' => [
                    'ar' => 'توريد للمشاريع',
                    'en' => 'Project Supply',
                ],
                'description' => [
                    'ar' => 'حلول متكاملة للمقاولين والشركات مع خدمة التوصيل والتركيب عند الحاجة',
                    'en' => 'Complete solutions for contractors and companies, with delivery and installation services when needed.',
                ],
                'order' => 5,
                'is_active' => true,
            ],

            [
                'icon' => 'fas fa-headset',
                'title' => [
                    'ar' => 'خدمة عملاء احترافية',
                    'en' => 'Professional Customer Service',
                ],
                'description' => [
                    'ar' => 'فريق متخصص لمساعدتك في اختيار المنتجات المناسبة ومتابعة ما بعد البيع',
                    'en' => 'A specialized team to help you choose the right products and provide after-sales support.',
                ],
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            WhyUsItem::create($item);
        }
    }
}
