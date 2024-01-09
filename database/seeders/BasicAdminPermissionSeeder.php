<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BasicAdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        $role = \Spatie\Permission\Models\Role::create(['name' => 'Admin']);
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        $role2 = \Spatie\Permission\Models\Role::create(['name' => 'Super Admin']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com'
        ]);

        $user2 = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);
    }
}
