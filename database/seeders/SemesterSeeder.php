<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('semesters')->insert([
            [
                'nama' => 'Semester 1',
                'aktif' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Semester 2',
                'aktif' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Semester 3',
                'aktif' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Semester 4',
                'aktif' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Semester 5',
                'aktif' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
