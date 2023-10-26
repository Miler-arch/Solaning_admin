<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolSeeder extends Seeder
{
    public function run()
    {
        $role1 = Role::create(['name' => 'superAdmin']);
        $role2 = Role::create(['name' => 'admin']);

        Permission::create(['name' => 'dashboard.index'])->syncRoles([$role1]);

        Permission::create(['name' => 'clients.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clients.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clients.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clients.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'courses.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'courses.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'courses.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'courses.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'registrations.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'registrations.list_registrations'])->syncRoles([$role1, $role2]);
    }
}
