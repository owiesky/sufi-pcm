<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'SUPERADMIN']);
        $admin = Role::create(['name' => 'ADMIN']);
        $projectManager = Role::create(['name' => 'PROJECTMANAGER']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-project',
            'edit-project',
            'delete-project',
            'create-customer',
            'edit-customer',
            'delete-customer',
            'create-supplier',
            'edit-supplier',
            'delete-supplier',
        ]);

        $projectManager->givePermissionTo([
            'create-project',
            'edit-project',
            'create-customer',
            'edit-customer',
            'create-supplier',
            'edit-supplier',
        ]);
    }
}
