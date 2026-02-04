<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create main admin user
        User::create([
            'name' => 'System Admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
            'phone' => '0700000000',
            'role' => 'admin',
        ]);


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0773456789',
            'role' => 'user',
        ]);

        // Create more users using factory
        User::factory(7)->create(['role' => 'user']);



        // Create hospital records
        Hospital::create([
            'hospital_id' => 'HOSP004',
            'hospital_reg_number' => 'REG2026004',
            'mobile_number1' => '0456789012',
            'mobile_number2' => '0456789013',
            'address' => '321 Care Center, Negombo',
            'district' => 'Negombo',
            'user_name' => 'negombo hospital',
            'email' => 'admin@negombohospital.com',
            'password' => 'hospital123',
        ]);


    }
}
