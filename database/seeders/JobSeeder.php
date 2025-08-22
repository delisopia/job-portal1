<?php
// database/seeders/JobSeeder.php
namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            $this->command->error('Admin user not found. Please run AdminSeeder first.');
            return;
        }

        $jobs = [
            [
                'title' => 'Web Developer',
                'company' => 'PT Teknologi Maju',
                'description' => 'Kami mencari web developer yang berpengalaman dalam Laravel dan Vue.js untuk bergabung dengan tim kami.',
                'requirements' => "- Minimal 2 tahun pengalaman\n- Menguasai Laravel, PHP, MySQL\n- Familiar dengan Vue.js atau React\n- Kemampuan problem solving yang baik",
                'location' => 'Jakarta',
                'type' => 'full-time',
                'salary_min' => 8000000,
                'salary_max' => 12000000,
                'deadline' => now()->addDays(30),
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Digital Marketing Specialist',
                'company' => 'CV Kreatif Digital',
                'description' => 'Posisi digital marketing untuk mengelola kampanye online dan strategi pemasaran digital.',
                'requirements' => "- Pengalaman minimal 1 tahun di digital marketing\n- Menguasai Google Ads, Facebook Ads\n- Kreatif dan analitis\n- Kemampuan komunikasi yang baik",
                'location' => 'Bandung',
                'type' => 'full-time',
                'salary_min' => 5000000,
                'salary_max' => 8000000,
                'deadline' => now()->addDays(25),
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Graphic Designer',
                'company' => 'Studio Desain Kreatif',
                'description' => 'Mencari graphic designer untuk proyek-proyek kreatif kami.',
                'requirements' => "- Portfolio design yang menarik\n- Menguasai Adobe Creative Suite\n- Kreativitas tinggi\n- Mampu bekerja dalam tim",
                'location' => 'Surabaya',
                'type' => 'part-time',
                'salary_min' => 3000000,
                'salary_max' => 6000000,
                'deadline' => now()->addDays(20),
                'created_by' => $admin->id,
            ],
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}