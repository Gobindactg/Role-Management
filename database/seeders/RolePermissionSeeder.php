<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create Role
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);

        // permission list as array
        $permissions = [
            // dashboard
            'dashboard.view',
            // blog permission route
            'blog.create',
            'blog.view',
            'blog.edit',
            'blog.delete',
            'blog.approve',

            // admin permission route
            'admin.create',
            'admin.view',
            'admin.edit',
            'admin.delete',
            'admin.approve',

            // admin permission route
            'create.create',
            'create.view',
            'create.edit',
            'create.delete',
            'create.approve',

            // role permission route
            'role.create',
            'role.view',
            'role.edit',
            'role.delete',
            'role.approve',

            // profile permission route
            'profile.create',
            'profile.view',
            'profile.edit',

        ];

        // create assign permission
        // permission::create(['name' => 'dashboard.view']);
        for ($i = 0; $i < count($permissions); $i++) {
            $permission = Permission::create(['name' => $permissions[$i]]);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }
    }
}
