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
        /*
       |--------------------------------------------------------------------------
       | Clear Spatie Permission Cache
       |--------------------------------------------------------------------------
       */

        app(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();


        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Products
            'view products',
            'create products',
            'edit products',
            'delete products',

            // Categories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            // Partners
            'view partners',
            'create partners',
            'edit partners',
            'delete partners',

            // Messages
            'view messages',
            'reply messages',
            'delete messages',

            // Content
            'view content',
            'edit content',

            // Settings
            'view settings',
            'edit settings',

            // SEO
            'view seo',
            'edit seo',

            // Testimonials
            'view testimonials',
            'create testimonials',
            'edit testimonials',
            'delete testimonials',

            // Hero
            'view hero',
            'edit hero',

            // CTA Section
            'view cta-section',
            'edit cta-section',

            // About
            'view about',
            'edit about',

            // Marquee
            'view marquee',
            'create marquee',
            'edit marquee',
            'delete marquee',

            // Hero Stats
            'view hero-stats',
            'create hero-stats',
            'edit hero-stats',
            'delete hero-stats',

            // Why Us
            'view why-us',
            'create why-us',
            'edit why-us',
            'delete why-us',
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

            'view seo',
            'edit seo',
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

        $adminUser = User::updateOrCreate(
            [
                'email' => 'admin@diaralbalasi.com',
            ],
            [
                'name' => 'مدير النظام',
                'password' => Hash::make('123456'),
                'locale' => 'ar',
                'is_active' => true,
            ]
        );

        $amshoosh = User::updateOrCreate(
            [
                'email' => 'amshoosh2@gmail.com',
            ],
            [
                'name' => 'Amshoosh',
                'password' => Hash::make('123456'),
                'locale' => 'ar',
                'is_active' => true,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Assign Roles
        |--------------------------------------------------------------------------
        */

        $adminUser->syncRoles([
            'Super Admin',
        ]);

        $amshoosh->syncRoles([
            'Super Admin',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            'Roles, permissions and admin users created successfully.'
        );
    }
}
