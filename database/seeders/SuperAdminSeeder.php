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
        User::create([
        'username' => 'Super Admin',
        'login_email' => 'superadmin@system.com',
        'password' => Hash::make('password'),
        'user_type' => 'admin',
        'status' => 'active',
        'is_super_admin' => true,
    ]);
    }
}
