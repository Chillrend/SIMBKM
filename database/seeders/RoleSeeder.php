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
            'id' => 1,
            'name' => 'Super Admin',
            'status' => 'Aktif'
        ]);

        Role::create([
            'id' => 2,
            'name' => 'Wadir',
            'status' => 'Aktif'
        ]);

        Role::create([
            'id' => 3,
            'name' => 'KPS',
            'status' => 'Aktif'
        ]);

        Role::create([
            'id' => 4,
            'name' => 'Dosen Pembimbing',
            'status' => 'Aktif'
        ]);

        Role::create([
            'id' => 5,
            'name' => 'Pembimbing Akademik',
            'status' => 'Aktif'
        ]);

        Role::create([
            'id' => 6,
            'name' => 'Pembimbing Industri',
            'status' => 'Aktif'
        ]);

        Role::create([
            'id' => 7,
            'name' => 'Mahasiswa',
            'status' => 'Aktif'
        ]);
    }
}
