<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Artikel;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Artikel::create([
            'id' => 1,
            'gambar' => 'laravel.jpeg',
            'judul' => 'Laravel 10 ',
            'deskripsi' => 'Laravel adalah framework berbasis bahasa pemrograman PHP yang bisa digunakan untuk mengembangkan sebuah website yang dinamis.'
        ]);
    }
}