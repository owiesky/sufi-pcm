<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Owiesky Superadmin',
            'email' => 'owiesky@sinca.com',
            'password' => Hash::make('superadmin')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Owiesky Admin',
            'email' => 'owiesky@sufi.com',
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $projectManager = User::create([
            'name' => 'H Firman Khooliq',
            'email' => 'firman@sufi.com',
            'password' => Hash::make('firman123')
        ]);
        $projectManager->assignRole('Project Manager');
    }
}
