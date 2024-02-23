<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('123456'),
            'role' => '1',
            'status' => '1'
        ]);

        User::create([
            'name' => 'Mahasiswa AB D3',
            'email' => 'mhsw@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '7',
            'nim' => '2007411044',
            'status' => '1',
            'api_jurusan_id' => '8413e691-e878-4e8a-862a-32d92b51cbad',
            'api_prodi_id' => 'c72e7084-9f08-4d40-b290-02fe22af0463'
        ]);

        User::create([
            'name' => 'Woodie',
            'email' => 'woodiechek@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '1',
            'status' => '1'
        ]);

        User::create([
            'name' => 'Professor Albert Einstein',
            'email' => 'einstein@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '4',
            'status' => '1',
            'api_jurusan_id' => '8413e691-e878-4e8a-862a-32d92b51cbad',
            'api_prodi_id' => 'c72e7084-9f08-4d40-b290-02fe22af0463'
        ]);

        User::create([
            'name' => 'KPS',
            'email' => 'kps@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '3',
            'status' => '1',
            'api_jurusan_id' => '8413e691-e878-4e8a-862a-32d92b51cbad',
            'api_prodi_id' => 'c72e7084-9f08-4d40-b290-02fe22af0463'
        ]);

        User::create([
            'name' => 'Pembimbing Industri',
            'email' => 'pi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '6',
            'status' => '1'
        ]);

        User::create([
            'name' => 'Pembimbing Akademik',
            'email' => 'pa@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '5',
            'status' => '1'
        ]);

        User::create([
            'name' => 'Wadir',
            'email' => 'wadir@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '2',
            'status' => '1'
        ]);
        User::create([
            'name' => 'mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '7',
            'nim' => '2007411045',
            'status' => '1'
        ]);
        User::create([
            'name' => 'dito',
            'email' => 'dito@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '7',
            'nim' => '2007411046',
            'status' => '1'
        ]);
        User::create([
            'name' => 'galih',
            'email' => 'galih@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '7',
            'nim' => '2007411047',
            'status' => '1'
        ]);
        User::create([
            'name' => 'mail',
            'email' => 'mail@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '7',
            'nim' => '2007411048',
            'status' => '1'
        ]);
        User::create([
            'name' => 'radit',
            'email' => 'radit@gmail.com',
            'password' => Hash::make('123456'),
            'role' => '7',
            'nim' => '2007411049',
            'status' => '1'
        ]);
    }
}
