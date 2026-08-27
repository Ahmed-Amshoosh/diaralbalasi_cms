<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hero;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        Hero::create([
            'title' => [
                'ar' => 'شريكك الموثوق في مواد البناء والسباكة والأدوات الصحية',
                'en' => 'Your Trusted Partner in Building Materials, Plumbing & Sanitary Ware',
            ],

            'description' => [
                'ar' => 'نوفر تشكيلة متكاملة من مواد البناء، والأنابيب البلاستيكية، والأدوات الصحية، والمحابس، ومضخات المياه، وإكسسوارات المطابخ والحمامات، بجودة عالية وأسعار تنافسية تلبي احتياجات الأفراد والمقاولين والمشاريع.',
                'en' => 'We provide a comprehensive range of building materials, plastic pipes, sanitary ware, valves, water pumps, and kitchen and bathroom accessories, with high quality and competitive prices to meet the needs of individuals, contractors, and projects.',
            ],

            'sub_title' => [
                'ar' => 'أكثر من 20 عاماً من الثقة في قطاع مواد البناء',
                'en' => 'More than 20 years of trust in the building materials industry',
            ],

        ]);
    }
}
