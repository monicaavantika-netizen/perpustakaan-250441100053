<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@bookavy.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
            ]
        );
        $admin->syncRoles(['admin']);

        $petugas = User::firstOrCreate(
            ['email' => 'petugas@bookavy.com'],
            [
                'name' => 'Petugas Perpustakaan',
                'password' => Hash::make('petugas12345'),
            ]
        );
        $petugas->syncRoles(['petugas']);

        $siswa = User::firstOrCreate(
            ['email' => 'siswa@bookavy.com'],
            [
                'name' => 'Siswa Perpustakaan',
                'password' => Hash::make('siswa12345'),
            ]
        );
        $siswa->syncRoles(['siswa']);
    }
}
