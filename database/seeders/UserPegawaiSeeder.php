<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Users
        DB::table('users')->insert([
            ['id' => 2, 'name' => 'Admin1',     'email' => 'admin1@example.com',  'password' => Hash::make('password'), 'role_id' => 1],
            ['id' => 3, 'name' => 'HRD',        'email' => 'hrd@example.com',     'password' => Hash::make('password'), 'role_id' => 2],
            ['id' => 4, 'name' => 'Keuangan',   'email' => 'keuangan@example.com', 'password' => Hash::make('password'), 'role_id' => 3],
            ['id' => 5, 'name' => 'Manager',    'email' => 'manager@example.com', 'password' => Hash::make('password'), 'role_id' => 4],
            ['id' => 6, 'name' => 'Fani',       'email' => 'fani@example.com',    'password' => Hash::make('password'), 'role_id' => 5],
        ]);

        // Pegawais
        DB::table('pegawais')->insert([
            ['id' => 1, 'user_id' => 2, 'nip' => '001',     'nama' => 'Admin1',   'role_id' => 1, 'jenis_karyawan' => 'tetap', 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'user_id' => 3, 'nip' => '002',     'nama' => 'HRD',      'role_id' => 2, 'jenis_karyawan' => 'tetap', 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'user_id' => 4, 'nip' => '003',     'nama' => 'Keuangan', 'role_id' => 3, 'jenis_karyawan' => 'tetap', 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'user_id' => 5, 'nip' => '004',     'nama' => 'Manager',  'role_id' => 4, 'jenis_karyawan' => 'tetap', 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'user_id' => 6, 'nip' => '052151',  'nama' => 'Fani',     'role_id' => 5, 'jenis_karyawan' => 'tetap', 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
