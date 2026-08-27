<?php

namespace Database\Seeders;

use App\Models\ContactSection;
use Illuminate\Database\Seeder;

class ContactMessageSectionSeeder extends Seeder
{
    public function run(): void
    {
        ContactSection::updateOrCreate(
            ['id' => 1],
            [
                'title' => [
                    'ar' => 'تواصل معنا',
                    'en' => 'Contact Us',
                ],

                'sub_title' => [
                    'ar' => 'نحن هنا لمساعدتك',
                    'en' => 'We Are Here to Help',
                ],

                'description' => [
                    'ar' => 'لديك استفسار أو تحتاج إلى عرض أسعار؟ تواصل معنا وسيسعد فريقنا بالإجابة على استفساراتك ومساعدتك في اختيار المنتجات المناسبة.',
                    'en' => 'Have a question or need a quote? Contact us and our team will be happy to answer your inquiries and help you choose the right products.',
                ],
            ]
        );
    }
}
