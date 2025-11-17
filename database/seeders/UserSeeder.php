<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Main Admin User
        User::factory()->create([
            'name' => 'Prayoga Sungkowo',
            'email' => 'prayogasungkowo12@gmail.com',
            'password' => bcrypt('Brimob12!'),
        ])->assignRole('admin');

        // Create Additional Admin User
        User::create([
            'name' => 'Admin BSTI',
            'email' => 'admin@bsti.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ])->assignRole('admin');

        // Create 10 Student Users
        $students = [
            [
                'name' => 'Ahmad Rizki Pratama',
                'email' => 'ahmad.rizki@student.com',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@student.com',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@student.com',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@student.com',
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@student.com',
            ],
            [
                'name' => 'Fitri Handayani',
                'email' => 'fitri.handayani@student.com',
            ],
            [
                'name' => 'Gilang Ramadhan',
                'email' => 'gilang.ramadhan@student.com',
            ],
            [
                'name' => 'Hana Pertiwi',
                'email' => 'hana.pertiwi@student.com',
            ],
            [
                'name' => 'Indra Gunawan',
                'email' => 'indra.gunawan@student.com',
            ],
            [
                'name' => 'Joko Widodo',
                'email' => 'joko.widodo@student.com',
            ],
            [
                'name' => 'Kartika Sari',
                'email' => 'kartika.sari@student.com',
            ],
            [
                'name' => 'Lukman Hakim',
                'email' => 'lukman.hakim@student.com',
            ],
            [
                'name' => 'Maya Angelina',
                'email' => 'maya.angelina@student.com',
            ],
            [
                'name' => 'Nugroho Wibowo',
                'email' => 'nugroho.wibowo@student.com',
            ],
            [
                'name' => 'Olivia Rahman',
                'email' => 'olivia.rahman@student.com',
            ],
        ];

        foreach ($students as $studentData) {
            User::create([
                'name' => $studentData['name'],
                'email' => $studentData['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ])->assignRole('student');
        }
    }
}
