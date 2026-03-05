<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Orientasi;
use Carbon\Carbon;

class orientasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
            'datetime_start' => Carbon::parse('2026-07-06 06:30:00'),
                'datetime_end' => Carbon::parse('2026-07-06 07:00:00'),
                'kegiatan' => 'Persiapan',
                'keterangan' => 'Siswa datang kesekolah',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
    [
            'datetime_start' => Carbon::parse('2026-07-06 07:00:00'),
                'datetime_end' => Carbon::parse('2026-07-06 08:00:00'),
                'kegiatan' => 'Pembukaan Matsama',
                'keterangan' => 'Pembukaan akan dilakukan oleh kepala sekolah yaitu : Ana Zuhriyah, S.Pd.I',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
        [
            'datetime_start' => Carbon::parse('2026-07-07 08:00:00'),
                'datetime_end' => Carbon::parse('2026-07-07 09:00:00'),
                'kegiatan' => 'Pengenalan & Profil Madrasah',
                'keterangan' => 'Pengenalan & Ptofil Madrasah akan di sampaikan oleh Muslimah, S.Pd',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
      [
            'datetime_start' => Carbon::parse('2026-07-06 09:30:00'),
                'datetime_end' => Carbon::parse('2026-07-06 10:00:00'),
                'kegiatan' => 'Istirahat',
                'keterangan' => '',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
        [
            'datetime_start' => Carbon::parse('2026-07-06 10:00:00'),
                'datetime_end' => Carbon::parse('2026-07-06 10:30:00'),
                'kegiatan' => 'Evaluasi',
                'keterangan' => 'kegiatan akan dipimpin oleh Organisasi Siswa Intra Madrasah (OSIM)',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
    [
            'datetime_start' => Carbon::parse('2026-07-07 06:30:00'),
                'datetime_end' => Carbon::parse('2026-07-07 07:00:00'),
                'kegiatan' => 'Istighosah bersama',
                'keterangan' => 'Kegiatan akan dipimpin oleh Organisasi Siswa Intra Madrasah (OSIM)',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
        [
            'datetime_start' => Carbon::parse('2026-07-07 07:00:00'),
                'datetime_end' => Carbon::parse('2026-07-07 08:30:00'),
                'kegiatan' => 'Pendidikan Moral & Karakter',
                'keterangan' => 'Pendidikan Moral & Karakter akan di sampaikan oleh Anita Ardiyani, S.Pd',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
        [
            'datetime_start' => Carbon::parse('2026-07-07 08:30:00'),
                'datetime_end' => Carbon::parse('2026-07-07 09:00:00'),
                'kegiatan' => 'Istirahat',
                'keterangan' => '',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
          [
            'datetime_start' => Carbon::parse('2026-07-07 09:00:00'),
                'datetime_end' => Carbon::parse('2026-07-07 10:00:00'),
                'kegiatan' => 'Moderasi & Nasionalisme',
                'keterangan' => 'Moderasi & Nasionalisme akan di sampaikan oleh Sinta Fitri Ning Tiyas, S.Pd',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
        [
            'datetime_start' => Carbon::parse('2026-07-06 10:00:00'),
                'datetime_end' => Carbon::parse('2026-07-06 10:30:00'),
                'kegiatan' => 'Evaluasi',
                'keterangan' => 'kegiatan akan dipimpin oleh Organisasi Siswa Intra Madrasah (OSIM)',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
         [
            'datetime_start' => Carbon::parse('2026-07-08 06:30:00'),
                'datetime_end' => Carbon::parse('2026-07-08 07:00:00'),
                'kegiatan' => 'Istighosah bersama',
                'keterangan' => 'Kegiatan akan dipimpin oleh Organisasi Siswa Intra Madrasah (OSIM)',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
        [
            'datetime_start' => Carbon::parse('2026-07-08 07:00:00'),
                'datetime_end' => Carbon::parse('2026-07-08 08:30:00'),
                'kegiatan' => 'Belajar Efektif & Tata Krama',
                'keterangan' => 'Belajar Efektif & Tata Krama akan di sampaikan oleh Muslimah, S.Pd',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
         [
            'datetime_start' => Carbon::parse('2026-07-08 08:30:00'),
                'datetime_end' => Carbon::parse('2026-07-08 09:00:00'),
                'kegiatan' => 'Evaluasi',
                'keterangan' => 'kegiatan akan dipimpin oleh Organisasi Siswa Intra Madrasah (OSIM)',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
        [
            'datetime_start' => Carbon::parse('2026-07-08 09:00:00'),
                'datetime_end' => Carbon::parse('2026-07-08 09:30:00'),
                'kegiatan' => 'Istirahat',
                'keterangan' => '',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
          [
            'datetime_start' => Carbon::parse('2026-07-08 09:30:00'),
                'datetime_end' => Carbon::parse('2026-07-08 10:30:00'),
                'kegiatan' => 'Penutupan MATSAMA',
                'keterangan' => 'Penutupan MATSAMA akan dilakukan oleh kepala sekolah yaitu : Ana Zuhriyah, S.Pd.I',
                'created_by' => 2,
                'id_periode' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ],
       
        ];
        foreach ($data as $index => $value) {
            orientasi::create([
                'datetime_start' => $value['datetime_start'],
                'datetime_end' => $value['datetime_end'],
                'kegiatan' => $value['kegiatan'],
                'keterangan' => $value['keterangan'],
                'created_by' => $value['created_by'],
                'id_periode' => $value['id_periode'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
