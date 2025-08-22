<?php
// database/seeders/JobSeekerSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JobSeekerSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Pelamar',
            'email' => 'pelamar@pelamar.com',
            'password' => Hash::make('12345678'),
            'role' => 'job_seeker',
            'phone' => '08129876543',
            'address' => 'Bandung, Indonesia',
            'cv_path' => null,
        ]);
    }
}
