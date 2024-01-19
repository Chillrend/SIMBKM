<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\Role;
use App\Models\Jurusan;
use App\Models\ProgramMbkm;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(ProgramMBKMSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TahunAjaranSeeder::class);
    }
}
