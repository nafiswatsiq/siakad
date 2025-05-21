<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tahun_ajarans')->insert([
            [
                'nama' => '2023/2024',
                'aktif' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => '2024/2025',
                'aktif' => true, // aktif tahun ajaran sekarang
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
