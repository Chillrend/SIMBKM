<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Super Admin',
            'status' => 'Aktif'
        ]);

        Role::create([
            'name' => 'Wadir',
            'status' => 'Aktif'
        ]);

        Role::create([
            'name' => 'KPS',
            'status' => 'Aktif'
        ]);

        Role::create([
            'name' => 'Dosen Pembimbing',
            'status' => 'Aktif'
        ]);

        Role::create([
            'name' => 'Pembimbing Akademik',
            'status' => 'Aktif'
        ]);

        Role::create([
            'name' => 'Pembimbing Industri',
            'status' => 'Aktif'
        ]);

        Role::create([
            'name' => 'Mahasiswa',
            'status' => 'Aktif'
        ]);
    }
}
