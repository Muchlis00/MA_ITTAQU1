<?php

namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'kepsek',
            'email' => 'kepsek@gmail.com',
            'password' => Hash::make('kepsek123'), // Ganti dengan password yang aman
            'role' => 'kepsek',
            'email_verified_at'=> now(),
        ]);
    }
}
