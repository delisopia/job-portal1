<?php
// database/seeders/AdminSeeder.php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@jobportal.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'phone' => '08123456789',
            'address' => 'Jakarta, Indonesia',
        ]);
    }
}