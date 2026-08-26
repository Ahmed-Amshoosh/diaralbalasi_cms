<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PartnersSection;

class PartnersSectionSeeder extends Seeder
{
    public function run(): void
    {
        PartnersSection::create([
            'label' => [
                'ar' => 'علاماتنا التجارية',
                'en' => 'Our Brands',
            ],

            'heading' => [
                'ar' => 'علاماتنا التجارية',
                'en' => 'Our Brands',
            ],

            'description' => [
                'ar' => 'نتعامل مع أفضل العلامات التجارية العالمية في مجال مواد البناء والسباكة',
                'en' => 'We work with leading international brands in the building materials and plumbing industry.',
            ],
        ]);
    }
}
