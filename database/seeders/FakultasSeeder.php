<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fakultas::create([
            'id' => 1,
            'name' => 'Administrasi Bisnis',
            'status' => 'Aktif'
        ]);

        Fakultas::create([
            'id' => 2,
            'name' => 'Akuntansi',
            'status' => 'Aktif'
        ]);

        Fakultas::create([
            'id' => 3,
            'name' => 'Pascasarjana',
            'status' => 'Aktif'
        ]);

        Fakultas::create([
            'id' => 4,
            'name' => 'Teknik Elektro',
            'status' => 'Aktif'
        ]);

        Fakultas::create([
            'id' => 5,
            'name' => 'Teknik Grafika dan Penerbitan',
            'status' => 'Aktif'
        ]);


        Fakultas::create([
            'id' => 6,
            'name' => 'Teknik Informatika dan Komputer',
            'status' => 'Aktif'
        ]);

        Fakultas::create([
            'id' => 7,
            'name' => 'Teknik Mesin',
            'status' => 'Aktif'
        ]);

        Fakultas::create([
            'id' => 8,
            'name' => 'Teknik Sipil',
            'status' => 'Aktif'
        ]);

    }
}
