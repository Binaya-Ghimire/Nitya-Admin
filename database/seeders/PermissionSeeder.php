<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Permissions = [
        	'role-list',
        	'role-create',
        	'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-ban',
            'user-unban',
            'user-login',
            'payment-type-list',
            'payment-type-create',
            'payment-type-edit',
            'payment-type-delete',
            'payment-status-list',
            'payment-status-create',
            'payment-status-edit',
            'payment-status-delete',
            'default-rate-list',
            'default-rate-create',
            'default-rate-edit',
            'payment-list',
            'payment-edit',
            'payment-report',
            'user-balance-report',
            'balance-report',
            'token-list',
            'token-create',
            'token-edit',
            'token-delete', 
        ];
        
        $role = Role::first();
        foreach ($Permissions as  $permission) {
        	Permission::create(['name'=>$permission]);
            $role->givePermissionTo($permission);
        }


    }
}
