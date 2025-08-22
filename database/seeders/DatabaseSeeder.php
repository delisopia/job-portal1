<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            JobSeekerSeeder::class,
            CompanySeeder::class,
            JobSeeder::class,
        ]);
    }
}