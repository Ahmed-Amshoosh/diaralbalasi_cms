<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            HeroSeeder::class,
            AboutSectionSeeder::class,
            ContactMessageSectionSeeder::class,
            CtaSectionSeeder::class,
            RoleAndPermissionSeeder::class,
            WhyUsItemSeeder::class,
            WhyUsSectionSeeder::class,
            PartnersSectionSeeder::class,
            TestimonialsSectionSeeder::class,
            TestimonialSeeder::class,
            MarqueeSeeder::class,
            HeroStatSeeder::class,
            CategorySectionSeeder::class,
        ]);
    }
}
