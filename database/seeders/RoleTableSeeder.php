<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        	'Super Admin',
        	'Admin',
        	'Technical Support',
        	'User',
        ];

        foreach ($roles as $role) {
        	Role::create(['name'=>$role]);
        }
    }
}
