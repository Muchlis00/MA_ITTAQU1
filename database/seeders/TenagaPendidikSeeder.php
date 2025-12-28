<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TenagaPendidik;
use Illuminate\Support\Facades\Hash;

class TenagaPendidikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataGuru =[
            [
                'nama_guru' => 'Muslimah, S.Pd',
                'nip' => '198403212008061241',
                'tempat_guru' => 'Jombang',
                'tgl_guru' => '1984-03-21',
                'jk_guru' => 'Perempuan',
                'jabatan' => 'Guru',
            ],
            [
                'nama_guru' => 'Rani Fatolah, SE',
                'nip' => '199012142013061208',
                'tempat_guru' => 'Batu',
                'tgl_guru' => '1990-12-14',
                'jk_guru' => 'Perempuan',
                'jabatan' => 'Guru',
            ],
            [
                'nama_guru' => 'Anita Ardiyani, S.Pd',
                'nip' => '198502022008081224',
                'tempat_guru' => '',
                'tgl_guru' => '1985-02-02',
                'jk_guru' => 'Perempuan',
                'jabatan' => 'Guru',
            ],
            [
                'nama_guru' => 'Moh. Hasan, SE',
                'nip' => '198707312009031124',
                'tempat_guru' => 'Gresik',
                'tgl_guru' => '1987-07-31',
                'jk_guru' => 'Laki-Laki',
                'jabatan' => 'Guru',
            ],
            [
                'nama_guru' => 'Fieri Nur Mulidin',
                'nip' => '200205162023071129',
                'tempat_guru' => 'Surabaya',
                'tgl_guru' => '2002-05-16',
                'jk_guru' => 'Laki-Laki',
                'jabatan' => 'Guru',
            ],
            [
                'nama_guru' => 'Sinta Fitri Ning Tyas, S.Pd',
                'nip' => '199907142022041215',
                'tempat_guru' => 'Malang',
                'tgl_guru' => '1999-07-14',
                'jk_guru' => 'Perempuan',
                'jabatan' => 'Guru',
            ],
            [
                'nama_guru' => 'Martini Megawarni, SH',
                'nip' => '196603211991221213',
                'tempat_guru' => 'Lamongan',
                'tgl_guru' => '1966-03-21',
                'jk_guru' => 'Perempuan',
                'jabatan' => 'Guru',
            ]
            ];

        foreach($dataGuru as $index => $data){
             $getFirstWord = explode(' ', $data['nama_guru'])[0];
    $onlyLetters = preg_replace("/[^a-zA-Z]/", "", $getFirstWord);
    $email = strtolower($onlyLetters) . '@gmail.com';
            
            $user = User::create([
                'name' => $data['nama_guru'],
                'email'=> $email,
                'password' => Hash::make('password'),
                'role'=>'guru',
                'email_verified_at' => now(),
            ]);

            TenagaPendidik::create([
                'id' => $user->id,
                'nip' =>$data['nip'],
                'nama_guru'=>$data['nama_guru'],
                'tempat_guru'=>$data['tempat_guru'],
                'tgl_guru'=>$data['tgl_guru'],
                'jk_guru'=>$data['jk_guru'],
                'jabatan'=>$data['jabatan'],
            ]);
        }
    }
}
