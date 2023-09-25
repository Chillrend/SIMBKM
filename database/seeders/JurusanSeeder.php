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

        # Administrasi Bisnis
        Jurusan::create([
            'name' => 'Administrasi Bisnis D3',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Administrasi Bisnis D4',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'MICE D4',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'MICE D4 PSDKU Demak',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'BISPRO D4',
            'fakultas_id' => '1',
            'status' => 'Aktif'
        ]);

        # Akuntansi

        Jurusan::create([
            'name' => 'Akuntansi D3',
            'fakultas_id' => '2',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Akuntansi D4',
            'fakultas_id' => '2',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Keuangan dan Perbankan D3',
            'fakultas_id' => '2',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Keuangan dan Perbankan D4',
            'fakultas_id' => '2',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Keuangan dan Perbankan Syariah D4',
            'fakultas_id' => '2',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Manajemen Keuangan D4',
            'fakultas_id' => '2',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Manajemen Pemasaran D3',
            'fakultas_id' => '2',
            'status' => 'Aktif'
        ]);

        # Pasca

        Jurusan::create([
            'name' => 'Magister Terapan Rekayasa Teknologi Manufaktur S2',
            'fakultas_id' => '3',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Magister Terapan Teknik Elektro S2',
            'fakultas_id' => '3',
            'status' => 'Aktif'
        ]);

        # Elektro

        Jurusan::create([
            'name' => 'Broadband Multimmedia D4',
            'fakultas_id' => '4',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Instrumentasi dan Kontrol Industri D4',
            'fakultas_id' => '4',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Elektronika Industri D3',
            'fakultas_id' => '4',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Listrik D3',
            'fakultas_id' => '4',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Otomasi Listrik Industri D4',
            'fakultas_id' => '4',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Telekomunikasi D3',
            'fakultas_id' => '4',
            'status' => 'Aktif'
        ]);

        #TGP

        Jurusan::create([
            'name' => 'Desain Grafis D3',
            'fakultas_id' => '5',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Desain Grafis D4',
            'fakultas_id' => '5',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Penerbitan / Jurnalistik D3',
            'fakultas_id' => '5',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknologi Rekayasa Cetak dan Grafis 3D D4',
            'fakultas_id' => '5',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknologi Industri Cetak Kemasan D4',
            'fakultas_id' => '5',
            'status' => 'Aktif'
        ]);

        # TI

        Jurusan::create([
            'name' => 'Teknik Informatika D4',
            'fakultas_id' => '6',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Komputer Jaringan D1',
            'fakultas_id' => '6',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Multimedia dan Jaringan D4',
            'fakultas_id' => '6',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Multimedia Digital D4',
            'fakultas_id' => '6',
            'status' => 'Aktif'
        ]);

        # Mesin

        Jurusan::create([
            'name' => 'Alat Berat D4',
            'fakultas_id' => '7',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Konversi Energi D4',
            'fakultas_id' => '7',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknologi Rekayasa Manufaktur D4',
            'fakultas_id' => '7',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'TTeknologi Rekayasa Pembangkit Energi D4',
            'fakultas_id' => '7',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Mesin D3',
            'fakultas_id' => '7',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Mesin D3 PSDKU Demak',
            'fakultas_id' => '7',
            'status' => 'Aktif'
        ]);

        # Sipil

        Jurusan::create([
            'name' => 'Konstruksi Gedung D3',
            'fakultas_id' => '8',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Konstruksi Gedung D4',
            'fakultas_id' => '8',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Konstruksi Sipil D3',
            'fakultas_id' => '8',
            'status' => 'Aktif'
        ]);

        Jurusan::create([
            'name' => 'Teknik Perancangan Jalan Dan Jembatan D4',
            'fakultas_id' => '8',
            'status' => 'Aktif'
        ]);
    }
}
