<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    public function definition(): array
    {
        $buku = fake()->randomElement([
            [
                'judul' => 'The Little Prince',
                'penulis' => 'Antoine de Saint-Exupéry',
                'tahun_terbit' => 1943,
            ],
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'tahun_terbit' => 2018,
            ],
            [
                'judul' => 'Bumi',
                'penulis' => 'Tere Liye',
                'tahun_terbit' => 2014,
            ],
            [
                'judul' => 'The Psychology of Money',
                'penulis' => 'Morgan Housel',
                'tahun_terbit' => 2020,
            ],
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'tahun_terbit' => 2005,
            ],
        ]);

        return [
            'kategori_id' => Kategori::inRandomOrder()->first()->id,
            'judul' => $buku['judul'],
            'penulis' => $buku['penulis'],
            'tahun_terbit' => $buku['tahun_terbit'],
        ];
    }
}