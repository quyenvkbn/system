<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'user-all',

           'post-list',
           'post-create',
           'post-edit',
           'post-delete',
           'post-all',
           
           'post-category-list',
           'post-category-create',
           'post-category-edit',
           'post-category-delete',
           'post-category-all',

           'menu-list',
           'menu-create',
           'menu-edit',
           'menu-delete',
           'menu-all',
           
           'menu-category-list',
           'menu-category-create',
           'menu-category-edit',
           'menu-category-delete',
           'menu-category-all',
           
           'slide-category-list',
           'slide-category-create',
           'slide-category-edit',
           'slide-category-delete',
           'slide-category-all',

           'tag-list',
           'tag-create',
           'tag-edit',
           'tag-delete',
           'tag-all',

           'comment-list',
           'comment-create',
           'comment-edit',
           'comment-delete',
           'comment-all',

           'system-edit',
           'ckfinder-admin',
           'ckfinder-user'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        
        $this->call(SeedFakeAdminUserTableSeeder::class);
    }
}
