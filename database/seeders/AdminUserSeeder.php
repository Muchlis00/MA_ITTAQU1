<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use App\Models\TenagaPendidik;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::create([
            'name' => 'Ana Zuhriyah, S.Pd',
            'email' => 'ana@gmail.com',
            'password' => Hash::make('ana123'), 
            'role' => 'kepsek',
            'email_verified_at'=> now(),
        ]);
        TenagaPendidik::create([
                'id' => $user->id, 
                'nip' => '198007092001011107',
                'nama_guru' => 'Ana Zuhriyah, S.Pd',
                'tempat_guru' => 'Mojokerto',
                'tgl_guru' => '1980-07-09',
                'jk_guru' => 'Perempuan',
                'jabatan' => 'Kepsek',
            ]);
    }
}
