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
            ['name' => 'Penerimaan Peserta Didik Baru 2026/2027'],
            [
                'startDate' => '2026-06-01',
                'endDate' => '2026-06-30',
            ]
        );

        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 30; $i++) {

            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $fullName = $firstName . ' ' . $lastName;
            $email = strtolower($firstName . ($i + 1)) . '@gmail.com';

            $user = User::create([
                'name' => $fullName,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'pendaftar',
            ]);

            $statusType = $faker->randomElement([
                'belum_mengisi',
                'menunggu_verifikasi',
                'perlu_perbaikan',
                'selesai'
            ]);

            $formStatus = null;
            $paymentStatus = null;

            switch ($statusType) {

                case 'belum_mengisi':
                    $formStatus = null;
                    $paymentStatus = null;
                    break;

                case 'menunggu_verifikasi':
                    $formStatus = $faker->randomElement(['pending', 'verified']);
                    $paymentStatus = 'pending';
                    break;

                case 'perlu_perbaikan':
                    if ($faker->boolean()) {
                        $formStatus = 'rejected';
                        $paymentStatus = 'pending';
                    } else {
                        $formStatus = 'verified';
                        $paymentStatus = 'rejected';
                    }
                    break;

                case 'selesai':
                    $formStatus = 'verified';
                    $paymentStatus = 'verified';
                    break;
            }

            $pendaftar = PendaftarPpdb::create([
                'id_periode' => $periode->id_periode,
                'user_id' => $user->id,
                'ready_to_verify' => $formStatus ? 1 : 0,
                'verification_status' => $formStatus,
                'verifier_id' => $formStatus === 'verified' ? 2 : null,
            ]);

            if ($formStatus === null) {
                continue;
            }

            /*
            DATA DIRI
            */
            $sibling = $faker->numberBetween(1, 5);
            $child_number = $faker->numberBetween(1, $sibling);

            $schools = [
                'SMP Negeri 22 Surabaya' => 'Jl. Gayungsari Bar. X No.38',
                'SMP Negeri 55 Surabaya' => 'Jl. Pagesangan 4 Mulia',
                'SMP PGRI 64' => 'Jl. Menanggal III No.14',
            ];

            $schoolName = $faker->randomElement(array_keys($schools));

            $domisili = [
                'Surabaya',
                'Sidoarjo',
                'Malang',
            ];

            $nilaiRapor = [
                'bahasa_indonesia' => [
                    'semester_1' => $faker->numberBetween(70, 95),
                    'semester_2' => $faker->numberBetween(70, 95),
                    'semester_3' => $faker->numberBetween(70, 95),
                    'semester_4' => $faker->numberBetween(70, 95),
                    'semester_5' => $faker->numberBetween(70, 95),
                    'semester_6' => $faker->numberBetween(70, 95),
                ],
                'matematika' => [
                    'semester_1' => $faker->numberBetween(65, 95),
                    'semester_2' => $faker->numberBetween(65, 95),
                    'semester_3' => $faker->numberBetween(65, 95),
                    'semester_4' => $faker->numberBetween(65, 95),
                    'semester_5' => $faker->numberBetween(65, 95),
                    'semester_6' => $faker->numberBetween(65, 95),
                ],
                'ipa' => [
                    'semester_1' => $faker->numberBetween(70, 95),
                    'semester_2' => $faker->numberBetween(70, 95),
                    'semester_3' => $faker->numberBetween(70, 95),
                    'semester_4' => $faker->numberBetween(70, 95),
                    'semester_5' => $faker->numberBetween(70, 95),
                    'semester_6' => $faker->numberBetween(70, 95),
                ],
                'ips' => [
                    'semester_1' => $faker->numberBetween(65, 95),
                    'semester_2' => $faker->numberBetween(65, 95),
                    'semester_3' => $faker->numberBetween(65, 95),
                    'semester_4' => $faker->numberBetween(65, 95),
                    'semester_5' => $faker->numberBetween(65, 95),
                    'semester_6' => $faker->numberBetween(65, 95),
                ],
                'bahasa_inggris' => [
                    'semester_1' => $faker->numberBetween(70, 95),
                    'semester_2' => $faker->numberBetween(70, 95),
                    'semester_3' => $faker->numberBetween(70, 95),
                    'semester_4' => $faker->numberBetween(70, 95),
                    'semester_5' => $faker->numberBetween(70, 95),
                    'semester_6' => $faker->numberBetween(70, 95),
                ],
            ];

            $dataDiri = DataDiriPendaftar::create([
                'user_id' => $user->id,
                'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'place_of_birth' => $faker->city,
                'date_of_birth' => $faker->dateTimeBetween('-21 years', '-16 years')->format('Y-m-d'),
                'nisn' => $faker->numerify('##########'),
                'phone' => $faker->phoneNumber,
                'domisili' => $faker->randomElement($domisili),
                'child_number' => $child_number,
                'sibling' => $sibling,
                'previous_school_name' => $schoolName,
                'previous_school_address' => $schools[$schoolName],
                'ijazah' => 'example/ijazah.jpg',
                'photo' => 'example/4x3.jpg',
                'akte_kelahiran' => 'example/akte.jpg',
                'kip' => $faker->randomElement(['example/kip.jpg', '-']),
                'nilai_rapor' => $nilaiRapor,
                'rapor_semester_1' => 'example/rapot.jpg',
                'rapor_semester_2' => 'example/rapot.jpg',
                'rapor_semester_3' => 'example/rapot.jpg',
                'rapor_semester_4' => 'example/rapot.jpg',
                'rapor_semester_5' => 'example/rapot.jpg',
                'rapor_semester_6' => 'example/rapot.jpg',
            ]);

            /*
            WALI
            */
            $jumlahWali = 2; 

$genders = ['Laki-laki', 'Perempuan'];

for ($j = 0; $j < $jumlahWali; $j++) {

    WaliPendaftar::create([
        'data_diri_pendaftar_id' => $dataDiri->id,
        'name' => $faker->name($genders[$j] === 'Laki-laki' ? 'male' : 'female'),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'place_of_birth' => $faker->city,
        'date_of_birth' => $faker->date('Y-m-d', '-30 years'),
        'gender' => $genders[$j],
        'pekerjaan' => $faker->jobTitle,
        'pendapatan' => $faker->numberBetween(1000000, 10000000),
        'ktp' => 'example/ktp-a.jpg',
        'kartu_keluarga' => 'example/kk.jpg',
    ]);
}

            /*
            STATUS PEMBAYARAN 
            */
            $statusPembayaran = match ($paymentStatus) {
                'verified' => $faker->randomElement(['Lunas', '40%']),
                default => 'Belum Lunas',
            };

            PembayaranPpdb::create([
                'id_periode' => $periode->id_periode,
                'user_id' => $user->id,
                'verifier_id' => $paymentStatus === 'verified' ? 3 : null,
                'verification_status' => $paymentStatus,
                'bukti_pembayaran' => 'example/bayar.jpg',
                'status_pembayaran' => $statusPembayaran,
            ]);
        }

        $this->command->info('Berhasil 30 data');
    }
}