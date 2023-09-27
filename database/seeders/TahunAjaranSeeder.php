<?php

namespace Database\Seeders;

use App\Models\TahunAjaranMbkm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunAjaranMbkm::create([
            'id' => 1,
            'tahun_ajaran' => '2023-2024/Ganjil'
        ]);
    }
}
