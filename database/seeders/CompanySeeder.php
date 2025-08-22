<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Perusahaan',
            'email' => 'perusahaan@company.com',
            'password' => Hash::make('12345678'),
            'role' => 'company',
            'phone' => '08123456789',
            'address' => 'Jakarta, Indonesia',
            'cv_path' => null,
        ]);
    }
}
