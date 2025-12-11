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

class PendaftarPpdbSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada periode PPDB aktif
        $periode = PeriodePpdb::firstOrCreate(
            ['name' => 'Penerimaan Peserta Didik Baru 2025/2026'],
            [
                'startDate' => '2025-12-01',
                'endDate' => '2025-12-31',
            ]
        );

        $faker = \Faker\Factory::create('id_ID');

        // Buat 20 pendaftar dummy
       for ($i = 0; $i < 30; $i++) {

    // 1. Buat User sebagai pendaftar
    $user = User::create([
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'role' => 'pendaftar',
    ]);

    // 2. Tentukan apakah user ini tidak mengisi data (hanya user saja)
    // misal: 20% user kosong
    $userOnly = $faker->boolean(20);

    if ($userOnly) {
        // Tidak membuat PendaftarPpdb, DataDiri, Wali, Pembayaran
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
    $dataDiri = DataDiriPendaftar::create([
        'user_id' => $user->id,
        'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
        'place_of_birth' => $faker->city,
        'date_of_birth' => $faker->date('Y-m-d', '-16 years'),
        'nisn' => $faker->numerify('##########'),
        'phone' => $faker->phoneNumber,
        'child_number' => $child_number,
        'sibling' => $sibling,
        'previous_school_name' => $faker->company . ' School',
        'previous_school_address' => $faker->address,
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
            'verifier_id' => $verif_status ==='verified' ? 4 :null,
            'verification_status' => $verif_status,
            'bukti_pembayaran' => 'download.jpg_1765369315/d48mJoqmD4JK7HX0bsH6NtiAa0ObHKi7L0ZcSvtK.jpg',
            'status_pembayaran' => ('lunas'),
        ]);
    }
}


        $this->command->info('Berhasil membuat 30 pendaftar PPDB dummy!');
    }
}