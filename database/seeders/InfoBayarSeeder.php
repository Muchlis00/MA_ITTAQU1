<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoBayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
            INSERT INTO `informasi_pembayaran` (`id`, `id_periode`, `created_by`, `detail_pembayaran`, `created_at`, `updated_at`, `biaya_administrasi`, `biaya_atribut`, `potongan_lunas`) VALUES (NULL, '1', '3', '', '2026-07-07 16:18:19', '2026-07-08 10:20:44', '[{\"nama\":\"Masa Ta''aruf Siswa Madrasah (MATSAMA) / MOS\",\"jumlah\":\"100000\"},{\"nama\":\"Pengembangan Madrasah\",\"jumlah\":\"300000\"},{\"nama\":\"Buku LKS semua mapel semester ganjil\",\"jumlah\":\"300000\"},{\"nama\":\"Outbound Siswa\",\"jumlah\":\"300000\"},{\"nama\":\"Kegiatan Siswa 1 tahun\",\"jumlah\":\"100000\"},{\"nama\":\"Infaq bulan Juli 2023\",\"jumlah\":\"100000\"},{\"nama\":\"Sampul Raport\",\"jumlah\":\"60000\"}]', '[{\"nama\":\"Seragam Olahraga\",\"putra\":\"200000\",\"putri\":\"200000\"},{\"nama\":\"Jaz Almamater\",\"putra\":\"200000\",\"putri\":\"200000\"},{\"nama\":\"Dasi 1 buah\",\"putra\":\"25000\",\"putri\":\"25000\"},{\"nama\":\"Jilbab 3 buah (abu-abu, batik, pramuka)\",\"putra\":\"0\",\"putri\":\"150000\"},{\"nama\":\"Bedge dan lokasi 3 buah\",\"putra\":\"25000\",\"putri\":\"25000\"},{\"nama\":\"Kain batik\",\"putra\":\"90000\",\"putri\":\"90000\"}]', '150000')
        ");
    }
}
