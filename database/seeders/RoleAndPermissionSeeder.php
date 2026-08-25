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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view users', 'create users', 'edit users', 'delete users',
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view partners', 'create partners', 'edit partners', 'delete partners',
            'view messages', 'reply messages', 'delete messages',
            'view content', 'edit content',
            'view settings', 'edit settings',
            'view seo', 'edit seo',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $contentManager = Role::firstOrCreate(['name' => 'Content Manager']);
        $contentManager->givePermissionTo([
            'view users',
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view partners', 'create partners', 'edit partners', 'delete partners',
            'view messages', 'reply messages', 'delete messages',
            'view content', 'edit content',
            'view settings', 'edit settings',
        ]);

        $editor = Role::firstOrCreate(['name' => 'Editor']);
        $editor->givePermissionTo([
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view partners', 'create partners', 'edit partners', 'delete partners',
            'view messages', 'reply messages',
            'view content',
        ]);

        $support = Role::firstOrCreate(['name' => 'Support']);
        $support->givePermissionTo([
            'view messages', 'reply messages',
        ]);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@diaralbalasi.com'],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@diaralbalasi.com',
                'password' => Hash::make('123456'),
            ]
        );

        $adminUser->assignRole('Super Admin');

        $this->command->info(__('messages.roles_permissions_created_successfully'));
    }
}
