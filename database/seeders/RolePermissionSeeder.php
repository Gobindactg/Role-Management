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
        $roleAdmin = Role::create(['name' => 'superadmin']);
        $roleSuperAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);

        // permission list as array
        $permissions = [
            // dashboard

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            // blog permission route
            [
                'group_name' => 'blog',
                'permissions' => [
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',
                ]
            ],
            // admin permission route
            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],
            // role permission route
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],
            // profile permission route
            [
                'group_name' => 'profile',
                'permissions' => [
                    'profile.create',
                    'profile.view',
                    'profile.edit',
                ]
            ],


        ];

        // create assign permission
        // permission::create(['name' => 'dashboard.view']);
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // create permissions
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' =>$permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
           
        }
    }
}
