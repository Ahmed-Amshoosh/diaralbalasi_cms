<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الصلاحيات
        $permissions = [
            'view_dashboard',
            'manage_settings',
            'manage_hero',
            'manage_about',
            'manage_statistics',
            'manage_why_us',
            'manage_products',
            'manage_categories',
            'manage_brands',
            'manage_testimonials',
            'manage_contact',
            'manage_messages',
            'manage_seo',
            'manage_users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // إنشاء الأدوار
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // إنشاء مستخدم Admin
        $admin = User::create([
            'name' => 'المدير',
            'email' => 'admin@website.com',
            'password' => bcrypt('password123'),
            'phone' => '0500000000',
            'locale' => 'ar',
            'is_active' => true,
        ]);

        $admin->assignRole($adminRole);
    }
}
