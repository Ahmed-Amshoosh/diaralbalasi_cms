<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => [
                    'ar' => 'محمد عبدالله',
                    'en' => 'Mohammed Abdullah',
                ],
                'role' => [
                    'ar' => 'مقاول',
                    'en' => 'Contractor',
                ],
                'content' => [
                    'ar' => 'تعاملنا معهم في عدة مشاريع، وكانت تجربة ممتازة من حيث جودة المنتجات وسرعة التوريد والأسعار المنافسة.',
                    'en' => 'We have worked with them on several projects, and the experience has been excellent in terms of product quality, fast delivery, and competitive prices.',
                ],
                'rating' => 5,
                'order' => 1,
                'is_active' => true,
            ],

            [
                'name' => [
                    'ar' => 'أحمد علي',
                    'en' => 'Ahmed Ali',
                ],
                'role' => [
                    'ar' => 'مهندس مشاريع',
                    'en' => 'Project Engineer',
                ],
                'content' => [
                    'ar' => 'من أفضل الموردين الذين تعاملنا معهم. المنتجات أصلية والخدمة احترافية وفريق العمل متعاون جداً.',
                    'en' => 'One of the best suppliers we have worked with. The products are genuine, the service is professional, and the team is very helpful.',
                ],
                'rating' => 5,
                'order' => 2,
                'is_active' => true,
            ],

            [
                'name' => [
                    'ar' => 'خالد محمد',
                    'en' => 'Khalid Mohammed',
                ],
                'role' => [
                    'ar' => 'صاحب مؤسسة',
                    'en' => 'Business Owner',
                ],
                'content' => [
                    'ar' => 'تشكيلة واسعة من المنتجات وأسعار مناسبة جداً، بالإضافة إلى سرعة الاستجابة وخدمة العملاء الممتازة.',
                    'en' => 'A wide range of products at very reasonable prices, along with fast response and excellent customer service.',
                ],
                'rating' => 5,
                'order' => 3,
                'is_active' => true,
            ],

            [
                'name' => [
                    'ar' => 'عبدالرحمن صالح',
                    'en' => 'Abdulrahman Saleh',
                ],
                'role' => [
                    'ar' => 'مقاول ومورد',
                    'en' => 'Contractor & Supplier',
                ],
                'content' => [
                    'ar' => 'جودة المنتجات والالتزام بالمواعيد من أهم الأسباب التي تجعلنا نفضل التعامل معهم في مشاريعنا.',
                    'en' => 'Product quality and commitment to delivery schedules are among the main reasons we prefer working with them on our projects.',
                ],
                'rating' => 5,
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
