<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ✅ perbaikan di sini

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('ruangans')->insert([
            [
                'kode_ruangan' => 'GTIL',
                'nama' => 'Lab Jaringan Komputer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_ruangan' => 'GTIL',
                'nama' => 'Lab Sistem Informasi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_ruangan' => 'GTIL',
                'nama' => 'Lab Basis Data',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_ruangan' => 'GKB',
                'nama' => 'Ruang 1.1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_ruangan' => 'GKB',
                'nama' => 'Ruang 2.1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
