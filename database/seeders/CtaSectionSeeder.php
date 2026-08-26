<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CtaSection;

class CtaSectionSeeder extends Seeder
{
    public function run(): void
    {
        CtaSection::updateOrCreate(
            ['id' => 1],
            [
                'heading' => [
                    'ar' => 'هل تحتاج إلى|استشارة أو عرض أسعار؟',
                    'en' => 'Need a|consultation or a quote?',
                ],

                'description' => [
                    'ar' => 'فريقنا جاهز للإجابة على استفساراتك ومساعدتك في اختيار المنتجات المناسبة لمشروعك. نوفر مواد البناء، الأنابيب البلاستيكية PVC و UPVC و CPVC و PPR، الأدوات الصحية، المحابس، مضخات المياه، وإكسسوارات المطابخ والحمامات بجودة عالية وأسعار تنافسية.',
                    'en' => 'Our team is ready to answer your questions and help you choose the right products for your project. We provide building materials, PVC, UPVC, CPVC, and PPR pipes, sanitary ware, valves, water pumps, and kitchen and bathroom accessories with high quality and competitive prices.',
                ],

                'button_text' => [
                    'ar' => 'احصل على أفضل الأسعار',
                    'en' => 'Get the Best Prices',
                ],

                'image' => null,
            ]
        );
    }
}
