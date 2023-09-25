<?php

namespace Database\Seeders;

use App\Models\ProgramMbkm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramMBKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramMbkm::create([
            'name' => 'Kampus Mengajar',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Magang Bersertifikat',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Studi Independen',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Pertukaran Mahasiswa Merdeka (PMM)',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Wirausaha Merdeka',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'IISMA',
            'status' => 'Aktif'
        ]);
    }
}
