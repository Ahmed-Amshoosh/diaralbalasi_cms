<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // إعادة تعيين الكاش لتجنب الأخطاء
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. إنشاء الصلاحيات (Permissions)
        $permissions = [
            // صلاحيات المستخدمين
            'view users', 'create users', 'edit users', 'delete users',
            // صلاحيات المنتجات والتصنيفات
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            // صلاحيات الإعدادات والمحتوى
            'view settings', 'edit settings',
            'view messages', 'reply messages',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. إنشاء الأدوار (Roles) وتعيين الصلاحيات لها

        // دور المدير العام (صلاحيات كاملة)
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // دور المدير (صلاحيات محدودة)
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view messages', 'reply messages',
        ]);

        // دور المحرر (صلاحيات أساسية)
        $editorRole = Role::firstOrCreate(['name' => 'Editor']);
        $editorRole->givePermissionTo([
            'view products', 'create products', 'edit products',
            'view categories',
        ]);

        // 3. إنشاء مستخدم مدير عام افتراضي
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@diaralbalasi.com'],
            [
                'name' => 'المدير العام',
                'email' => 'admin@diaralbalasi.com',
                'password' => Hash::make('password'), // كلمة المرور: password
            ]
        );

        // تعيين دور المدير العام للمستخدم
        $superAdmin->assignRole($superAdminRole);

        $this->command->info('✅ تم إنشاء الأدوار والصلاحيات والمستخدم الافتراضي بنجاح!');
    }
}
