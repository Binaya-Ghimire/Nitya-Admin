<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $superadmin = User::create([
            'name' => 'Super admin',
            'email' => 'super-admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
       $manager = User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
       $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

       $superadmin->AssignRole('super admin');
       $manager->AssignRole('Technical Support');
       $user->AssignRole('User');

       $permissions = Permission::all();
       foreach ($permissions as  $permission) {
            $superadmin->syncPermissions($permission);
       }
    }
}
