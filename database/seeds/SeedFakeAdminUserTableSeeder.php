<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedFakeAdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $permissions = Permission::pluck('id','id')->all();
        $admin = User::create([
            'name' => 'Nguyễn Quyền',
            'email' => 'nguyenquyen18011996@gmail.com',
            'password' => Hash::make('quyen123'),
        ]);
        
        $roleAdmin = Role::create(['name' => 'Admin']);
   
        $roleAdmin->syncPermissions($permissions);
   
        $admin->assignRole([$roleAdmin->id]);

        $user = User::create([
            'name' => 'Nguyễn Quyền',
            'email' => '01quyen01@gmail.com',
            'password' => Hash::make('quyen123'),
        ]);
        
        $roleUser = Role::create(['name' => 'User']);
   
        $roleUser->syncPermissions($permissions);
   
        $user->assignRole([$roleUser->id]);
    }
}
