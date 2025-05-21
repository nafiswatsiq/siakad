<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('prodis')->insert([
            [
                'kode_prodi' => 'TI01',
                'nama' => 'Teknik Informatika',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_prodi' => 'SI01',
                'nama' => 'Sistem Informasi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_prodi' => 'MI01',
                'nama' => 'Manajemen Informatika',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_prodi' => 'TK01',
                'nama' => 'Teknik Komputer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_prodi' => 'MM01',
                'nama' => 'Multimedial',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
