<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Clear Spatie Permission Cache
        |--------------------------------------------------------------------------
        */

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();


        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',

            'view products',
            'create products',
            'edit products',
            'delete products',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view partners',
            'create partners',
            'edit partners',
            'delete partners',

            'view messages',
            'delete messages',

            'view content',
            'edit content',

            'view settings',
            'edit settings',

            'view seo',
            'edit seo',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
        ]);

        $superAdmin->syncPermissions(
            Permission::all()
        );


        /*
        |--------------------------------------------------------------------------
        | Content Manager
        |--------------------------------------------------------------------------
        */

        $contentManager = Role::firstOrCreate([
            'name' => 'Content Manager',
        ]);

        $contentManager->syncPermissions([
            'view users',

            'view products',
            'create products',
            'edit products',
            'delete products',

            'view testimonials',
            'create testimonials',
            'edit testimonials',
            'delete testimonials',

            'view hero',
            'edit hero',

            'view cta-section',
            'edit cta-section',

            'view about',
            'edit about',

            'view marquee',
            'create marquee',
            'edit marquee',
            'delete marquee',

            'view hero-stats',
            'create hero-stats',
            'edit hero-stats',
            'delete hero-stats',

            'view why-us',
            'create why-us',
            'edit why-us',
            'delete why-us',


            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view partners',
            'create partners',
            'edit partners',
            'delete partners',

            'view messages',
            'reply messages',
            'delete messages',

            'view content',
            'edit content',

            'view settings',
            'edit settings',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Editor
        |--------------------------------------------------------------------------
        */

        $editor = Role::firstOrCreate([
            'name' => 'Editor',
        ]);

        $editor->syncPermissions([
            'view products',
            'create products',
            'edit products',
            'delete products',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view partners',
            'create partners',
            'edit partners',
            'delete partners',

            'view messages',
            'reply messages',

            'view content',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Support
        |--------------------------------------------------------------------------
        */

        $support = Role::firstOrCreate([
            'name' => 'Support',
        ]);

        $support->syncPermissions([
            'view messages',
            'reply messages',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Admin User
        |--------------------------------------------------------------------------
        */

        $adminUser = User::firstOrCreate(
            [
                'email' => 'admin@diaralbalasi.com',
            ],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@diaralbalasi.com',
                'password' => Hash::make('123456'),
                'locale' => 'ar',
                'is_active' => true,
            ]
        );

        $adminUser->syncRoles([
            'Super Admin',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            'Roles, permissions and admin user created successfully.'
        );
    }
}
