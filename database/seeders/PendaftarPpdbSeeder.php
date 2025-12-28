<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PeriodePpdb;
use App\Models\PendaftarPpdb;
use App\Models\DataDiriPendaftar;
use App\Models\WaliPendaftar;
use App\Models\PembayaranPpdb;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PendaftarPpdbSeeder extends Seeder
{
    public function run()
    {
        $periode = PeriodePpdb::firstOrCreate(
            ['name' => 'Penerimaan Peserta Didik Baru 2025/2026'],
            [
                'startDate' => '2025-12-01',
                'endDate' => '2025-12-31',
            ]
        );

        $faker = \Faker\Factory::create('id_ID');

       for ($i = 0; $i < 30; $i++) {

    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $fullName = $firstName . ' ' . $lastName;
    $email = strtolower($firstName . ($i+1)) . '@gmail.com';

    $user = User::create([
        'name' => $fullName,
        'email' => $email,
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'role' => 'pendaftar',
    ]);

    $userOnly = $faker->boolean(20);

    if ($userOnly) {
        continue;
    }

    $verif_status= $faker->randomElement(['pending', 'verified', 'rejected']);

    $pendaftar = PendaftarPpdb::create([
        'id_periode' => $periode->id_periode,
        'user_id' => $user->id,
        'ready_to_verify' => $faker->boolean(70),
        'verification_status' =>$verif_status,
        'verifier_id' => $verif_status ==='verified' ? 2 :null,
    ]);
    

    $sibling = $faker->numberBetween(1, 5);
    $child_number = $faker->numberBetween(1, $sibling);
    $schools = [
    'SMP Negeri 22 Surabaya' => 'Jl. Gayungsari Bar. X No.38',
    'MP Negeri 55 Surabaya' => 'Jl. Pagesangan 4 Mulia',
    'SMP PGRI 64' => 'Jl. Menanggal III No.14',
];

    $schoolName = $faker->randomElement(array_keys($schools));

    $dataDiri = DataDiriPendaftar::create([
        'user_id' => $user->id,
        'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
        'place_of_birth' => $faker->city,
        'date_of_birth' => $faker->date('Y-m-d', '-16 years'),
        'nisn' => $faker->numerify('##########'),
        'phone' => $faker->phoneNumber,
        'child_number' => $child_number,
        'sibling' => $sibling,
        'previous_school_name' => $schoolName,
'previous_school_address' => $schools[$schoolName],

        'ijazah' => 'download.jpg_1765369315/d48mJoqmD4JK7HX0bsH6NtiAa0ObHKi7L0ZcSvtK.jpg',
        'photo' => 'download.jpg_1765369315/d48mJoqmD4JK7HX0bsH6NtiAa0ObHKi7L0ZcSvtK.jpg',
        'akte_kelahiran' => 'download.jpg_1765369315/d48mJoqmD4JK7HX0bsH6NtiAa0ObHKi7L0ZcSvtK.jpg',
        'kip' => $faker->optional(0.3)->numerify('############'),
    ]);

    // 5. Buat 1–2 wali pendaftar
    $jumlahWali = $faker->numberBetween(1, 2);
    for ($j = 0; $j < $jumlahWali; $j++) {
        WaliPendaftar::create([
            'data_diri_pendaftar_id' => $dataDiri->id,
            'name' => $faker->name,
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'place_of_birth' => $faker->city,
            'date_of_birth' => $faker->date('Y-m-d', '-30 years'),
            'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
            'pekerjaan' => $faker->jobTitle,
            'pendapatan' => $faker->numberBetween(1000000, 10000000),
            'ktp' => 'download.jpg_1765369315/d48mJoqmD4JK7HX0bsH6NtiAa0ObHKi7L0ZcSvtK.jpg',
            'kartu_keluarga' => 'download.jpg_1765369315/d48mJoqmD4JK7HX0bsH6NtiAa0ObHKi7L0ZcSvtK.jpg',
        ]);
    }

    // 6. Buat Data Pembayaran (80%)
    if ($faker->boolean(80)) {
        PembayaranPpdb::create([
            'id_periode' => $periode->id_periode,
            'user_id' => $user->id,
            'verifier_id' => $verif_status ==='verified' ? 3 :null,
            'verification_status' => $verif_status,
            'bukti_pembayaran' => 'download.jpg_1765369315/d48mJoqmD4JK7HX0bsH6NtiAa0ObHKi7L0ZcSvtK.jpg',
            'status_pembayaran' => ('lunas'),
        ]);
    }
}


        $this->command->info('Berhasil membuat 30 pendaftar PPDB dummy!');
    }
}