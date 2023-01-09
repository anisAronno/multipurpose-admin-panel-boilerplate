<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Role::truncate();
        Permission::truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();



        $user = new User();
        $user->name = 'Anichur Rahaman';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('password');
        $user->status = UserStatus::ACTIVE;
        $user->email_verified_at = Date::now();
        $user->save();


        // Create Roles
        $roleSuperAdmin = Role::create([ 'name' => 'superadmin']);
        $roleUser = Role::create([ 'name' => 'user']);
        $roleAdmin = Role::create([ 'name' => 'admin']);
        $roleEditor = Role::create([ 'name' => 'editor']);
        $roleAuthor = Role::create([ 'name' => 'author']);


        // Permission List as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'blog',
                'permissions' => [
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.status',
                ]
            ],
            [
                'group_name' => 'user',
                'permissions' => [

                    'user.create',
                    'user.view',
                    'user.edit',
                    'user.delete',
                    'user.status',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.status',
                ]
            ],


            [
                'group_name' => 'category',
                'permissions' => [

                    'category.create',
                    'category.view',
                    'category.edit',
                    'category.delete',
                    'category.status',
                ]
            ],

            [
                'group_name' => 'tag',
                'permissions' => [

                    'tag.create',
                    'tag.view',
                    'tag.edit',
                    'tag.delete',
                    'tag.status',
                ]
            ],


            [
                'group_name' => 'about',
                'permissions' => [

                    'about.create',
                    'about.view',
                    'about.edit',
                    'about.delete',
                    'about.status',
                ]
            ],
            [
                'group_name' => 'contact',
                'permissions' => [

                    'contact.create',
                    'contact.view',
                    'contact.edit',
                    'contact.delete',
                    'contact.status',
                ]
            ],
            [
                'group_name' => 'slider',
                'permissions' => [
                    'slider.create',
                    'slider.view',
                    'slider.edit',
                    'slider.delete',
                    'slider.status',
                ]
            ],

            [
                'group_name' => 'options',
                'permissions' => [
                    'options.create',
                    'options.view',
                    'options.edit',
                    'options.delete',
                    'options.status',
                ]
            ],
            [
                'group_name' => 'pages',
                'permissions' => [

                    'pages.create',
                    'pages.view',
                    'pages.edit',
                    'pages.delete',
                    'pages.status',
                ]
            ],

            [
                'group_name' => 'social',
                'permissions' => [

                    'social.create',
                    'social.view',
                    'social.edit',
                    'social.delete',
                    'social.status',
                ]
            ],

            [
                'group_name' => 'notification',
                'permissions' => [
                    'notification.create',
                    'notification.view',
                    'notification.edit',
                    'notification.delete',
                    'notification.status',
                ]
            ]
        ];


        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }


        // Editor Permission

        $editorPermissions = [

            'dashboard.view',

            'blog.create',
            'blog.view',
            'blog.edit',
            'blog.status',

            'category.create',
            'category.view',
            'category.edit',
            'category.status',

            'tag.create',
            'tag.view',
            'tag.edit',
            'tag.delete',
            'tag.status',

            'about.create',
            'about.view',
            'about.edit',
            'about.status',

            'contact.create',
            'contact.view',
            'contact.edit',
            'contact.status',

            'slider.create',
            'slider.view',
            'slider.edit',
            'slider.delete',
            'slider.status',

            'options.create',
            'options.view',
            'options.edit',
            'options.status',

            'pages.create',
            'pages.view',
            'pages.edit',
            'pages.status',

            'user.view',
            'user.status',

        ];

        $roleEditor->syncPermissions($editorPermissions);



        //Admin Permission

        $adminPermissions = [

            'dashboard.view',

            'blog.create',
            'blog.view',
            'blog.edit',
            'blog.delete',
            'blog.status',

            'category.create',
            'category.view',
            'category.edit',
            'category.delete',
            'category.status',


            'about.create',
            'about.view',
            'about.edit',
            'about.delete',
            'about.status',

            'contact.create',
            'contact.view',
            'contact.edit',
            'contact.delete',
            'contact.status',

            'slider.create',
            'slider.view',
            'slider.edit',
            'slider.delete',
            'slider.status',

            'options.create',
            'options.view',
            'options.edit',
            'options.delete',
            'options.status',

            'pages.create',
            'pages.view',
            'pages.edit',
            'pages.delete',
            'pages.status',


            'social.create',
            'social.view',
            'social.edit',
            'social.delete',
            'social.status',

            'tag.create',
            'tag.view',
            'tag.edit',
            'tag.delete',
            'tag.status',

            'user.create',
            'user.view',
            'user.edit',
            'user.status',

        ];

        $roleAdmin->syncPermissions($adminPermissions);


        //User Permission

        $userPermissions = [

            'dashboard.view',

            'blog.create',
            'blog.view',
            'blog.edit',
            'blog.delete',
            'blog.status',

            'category.create',
            'category.view',

            'tag.create',
            'tag.view',

        ];

        $roleUser->syncPermissions($userPermissions);

        //User Permission

        $authorPermissions = [

            'dashboard.view',

            'blog.create',
            'blog.view',
            'blog.edit',
            'blog.delete',
            'blog.status',

            'category.create',
            'category.view',

            'tag.create',
            'tag.view',

        ];

        $roleAuthor->syncPermissions($authorPermissions);

        //Model Has Roles Create

        DB::table('model_has_roles')->insert([
            'role_id' => $roleSuperAdmin->id,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => $roleAdmin->id,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => $roleEditor->id,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => $roleUser->id,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => $roleAuthor->id,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id
        ]);
    }
}
