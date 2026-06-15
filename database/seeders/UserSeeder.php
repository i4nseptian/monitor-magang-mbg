<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        $admin = User::firstOrCreate([
            'email' => 'admin@interntrack.test',
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('super_admin');

        // 2. Mentor
        $mentor = User::firstOrCreate([
            'email' => 'mentor@interntrack.test',
        ], [
            'name' => 'Ir. H. Andi Mappanyukki, M.T.',
            'password' => Hash::make('password'),
        ]);
        $mentor->assignRole('mentor');

        // 3. Mahasiswa Magang (4 orang)
        $students = [
            [
                'name' => 'Ahmad Fauzan',
                'email' => 'fauzan@interntrack.test',
                'nim' => '220907501001',
                'divisi' => 'Publikasi & Hubungan Masyarakat',
                'no_hp' => '081234567890',
            ],
            [
                'name' => 'Andi Resky',
                'email' => 'resky@interntrack.test',
                'nim' => '220907501002',
                'divisi' => 'Pengolahan Data & Statistik',
                'no_hp' => '081234567891',
            ],
            [
                'name' => 'Nurul Haliza',
                'email' => 'nurul@interntrack.test',
                'nim' => '220907501003',
                'divisi' => 'Desain Kreatif & Multimedia',
                'no_hp' => '081234567892',
            ],
            [
                'name' => 'Muh. Rafli',
                'email' => 'rafli@interntrack.test',
                'nim' => '220907501004',
                'divisi' => 'Infrastruktur & Layanan Digital',
                'no_hp' => '081234567893',
            ],
        ];

        foreach ($students as $studentData) {
            $user = User::firstOrCreate([
                'email' => $studentData['email'],
            ], [
                'name' => $studentData['name'],
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('mahasiswa');

            Member::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'nim' => $studentData['nim'],
                'program_studi' => 'Bisnis Digital',
                'divisi' => $studentData['divisi'],
                'no_hp' => $studentData['no_hp'],
                'tanggal_mulai' => '2026-06-08',
                'tanggal_selesai' => '2026-08-28',
            ]);
        }
    }
}
