<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data siswa yang akan di-seed
        $studentsData = [
            [
                'nisn' => '0012345678',
                'date_of_birth' => '2002-11-21',
                'gender' => 'laki-laki',
                'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
            ],
            [
                'nisn' => '0012345679',
                'date_of_birth' => '2005-05-20',
                'gender' => 'perempuan',
                'address' => 'Jl. Asia Afrika No. 45, Bandung',
            ],
            [
                'nisn' => '0012345680',
                'date_of_birth' => '2005-01-10',
                'gender' => 'laki-laki',
                'address' => 'Jl. Pahlawan No. 78, Surabaya',
            ],
            [
                'nisn' => '0012345681',
                'date_of_birth' => '2005-07-25',
                'gender' => 'perempuan',
                'address' => 'Jl. Malioboro No. 234, Yogyakarta',
            ],
            [
                'nisn' => '0012345682',
                'date_of_birth' => '2005-09-12',
                'gender' => 'laki-laki',
                'address' => 'Jl. Pemuda No. 56, Semarang',
            ],
            [
                'nisn' => '0012345683',
                'date_of_birth' => '2005-11-30',
                'gender' => 'perempuan',
                'address' => 'Jl. Gatot Subroto No. 89, Medan',
            ],
            [
                'nisn' => '0012345684',
                'date_of_birth' => '2005-02-18',
                'gender' => 'laki-laki',
                'address' => 'Jl. AP Pettarani No. 12, Makassar',
            ],
            [
                'nisn' => '0012345685',
                'date_of_birth' => '2005-04-22',
                'gender' => 'perempuan',
                'address' => 'Jl. Sudirman No. 67, Palembang',
            ],
            [
                'nisn' => '0012345686',
                'date_of_birth' => '2005-06-08',
                'gender' => 'laki-laki',
                'address' => 'Jl. Sunset Road No. 34, Denpasar',
            ],
            [
                'nisn' => '0012345687',
                'date_of_birth' => '2005-08-14',
                'gender' => 'laki-laki',
                'address' => 'Jl. Slamet Riyadi No. 123, Solo',
            ],
            [
                'nisn' => '0012345688',
                'date_of_birth' => '2005-10-05',
                'gender' => 'perempuan',
                'address' => 'Jl. Diponegoro No. 88, Malang',
            ],
            [
                'nisn' => '0012345689',
                'date_of_birth' => '2005-12-20',
                'gender' => 'laki-laki',
                'address' => 'Jl. Ahmad Yani No. 45, Banjarmasin',
            ],
            [
                'nisn' => '0012345690',
                'date_of_birth' => '2005-03-28',
                'gender' => 'perempuan',
                'address' => 'Jl. Hayam Wuruk No. 67, Surakarta',
            ],
            [
                'nisn' => '0012345691',
                'date_of_birth' => '2005-05-16',
                'gender' => 'laki-laki',
                'address' => 'Jl. Veteran No. 90, Pontianak',
            ],
            [
                'nisn' => '0012345692',
                'date_of_birth' => '2005-07-30',
                'gender' => 'perempuan',
                'address' => 'Jl. Gajah Mada No. 234, Jambi',
            ],
        ];

        // Ambil semua user dengan role student
        $studentUsers = User::role('student')->get();

        // Loop dan buat data student untuk setiap user
        foreach ($studentUsers as $index => $user) {
            if (isset($studentsData[$index])) {
                Student::create([
                    'user_id' => $user->id,
                    'nisn' => $studentsData[$index]['nisn'],
                    'date_of_birth' => $studentsData[$index]['date_of_birth'],
                    'gender' => $studentsData[$index]['gender'],
                    'address' => $studentsData[$index]['address'],
                ]);
            }
        }
    }
}
