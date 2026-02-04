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

        // Create test users
        User::factory()->create([
            'name' => 'John Donor',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0771234567',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Jane Donor',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0772345678',
            'role' => 'user',
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

        // Create hospital admins
        Hospital::create([
            'hospital_id' => 'HOSP001',
            'hospital_reg_number' => 'REG2026001',
            'mobile_number1' => '0112345678',
            'mobile_number2' => '0112345679',
            'address' => '123 Main Street, Colombo',
            'district' => 'Colombo',
            'user_name' => 'colombo hospital',
            'email' => 'admin@colombohospital.com',
            'password' => 'hospital123',
        ]);

        Hospital::create([
            'hospital_id' => 'HOSP002',
            'hospital_reg_number' => 'REG2026002',
            'mobile_number1' => '0234567890',
            'mobile_number2' => '0234567891',
            'address' => '456 Hospital Road, Kandy',
            'district' => 'Kandy',
            'user_name' => 'kandy hospital',
            'email' => 'admin@kandyhospital.com',
            'password' => 'hospital123',
        ]);

        Hospital::create([
            'hospital_id' => 'HOSP003',
            'hospital_reg_number' => 'REG2026003',
            'mobile_number1' => '0345678901',
            'mobile_number2' => '0345678902',
            'address' => '789 Medical Center, Galle',
            'district' => 'Galle',
            'user_name' => 'galle hospital',
            'email' => 'admin@gallehospital.com',
            'password' => 'hospital123',
        ]);

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

        Hospital::create([
            'hospital_id' => 'HOSP005',
            'hospital_reg_number' => 'REG2026005',
            'mobile_number1' => '0567890123',
            'mobile_number2' => '0567890124',
            'address' => '654 Blood Bank, Matara',
            'district' => 'Matara',
            'user_name' => 'matara hospital',
            'email' => 'admin@matarahospital.com',
            'password' => 'hospital123',
        ]);
    }
}