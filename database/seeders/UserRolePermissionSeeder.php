<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'list post', 'create post', 'edit post', 'delete post',
            'list category', 'create category', 'edit category', 'delete category',
            'list tag', 'create tag', 'edit tag', 'delete tag'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $roles = [
            'admin' => [
                'list post', 'create post', 'edit post', 'delete post', 'list category', 'create category', 'edit category', 'delete category', 'list tag', 'create tag', 'edit tag', 'delete tag'
            ],
            'author'  => [
                'list post', 'create post', 'edit post', 'delete post', 'list category', 'create category', 'edit category', 'list tag', 'create tag', 'edit tag'
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($rolePermissions);
        }
    }
}
