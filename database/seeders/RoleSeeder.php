<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(["name" => "users.create"]);
        Permission::create(["name" => "users.delete"]);
        Permission::create(["name" => "users.update"]);

        Permission::create(["name" => "articles.create"]);
        Permission::create(["name" => "articles.delete"]);
        Permission::create(["name" => "articles.updateAll"]);
        Permission::create(["name" => "articles.updateOwn"]);
        Permission::create(["name" => "articles.review"]);

        Permission::create(["name" => "pages.create"]);
        Permission::create(["name" => "pages.update"]);
        Permission::create(["name" => "pages.delete"]);

        Permission::create(["name" => "menus.update"]);
        Permission::create(["name" => "menus.create"]);
        Permission::create(["name" => "menus.delete"]);

        $superAdminRole = Role::create(["name" => 'Super Admin']);

        $adminRole = Role::create(['name' => 'Admin']);

        $authorRole = Role::create(['name' => 'Author']);

        $reviewerRole = Role::create(['name' => 'Reviewer']);

        $adminRole->givePermissionTo([
            'users.create',
            'users.delete',
            'users.update',
            'articles.create',
            'articles.delete',
            'articles.updateAll',
            'articles.review',
            'pages.create',
            'pages.update',
            'pages.delete',
            'menus.update',
            'menus.create',
            'menus.delete',
        ]);

        $authorRole->givePermissionTo([
            'articles.create',
            'articles.updateOwn',
        ]);

        $reviewerRole->givePermissionTo([
            'articles.review',
        ]);

        $superAdmin = User::find(1);
        $superAdmin->assignRole('Super Admin');

    }
}
