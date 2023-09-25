<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            'name' => 'Prodi Teknik Informatika Reguler (TI-Reg)',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Prodi Teknik Informatika CCIT (TI-CCIT)',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Prodi Teknik Multimedia Digital (TMD)',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Prodi Teknik Multimedia dan Jaringan (TMJ)',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Prodi Teknik Komputer dan Jaringan (TKJ)',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);
    }
}
