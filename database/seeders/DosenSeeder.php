<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('dosens')->insert([
            [
                'nip' => '19890101A01',
                'user_id' => 1,
                'alamat' => 'Jl. Merdeka No.1, Jakarta',
                'no_tlp' => '081234567890',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '19890202B02',
                'user_id' => 2,
                'alamat' => 'Jl. Sudirman No.2, Bandung',
                'no_tlp' => '082345678901',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '19890303C03',
                'user_id' => 3,
                'alamat' => 'Jl. Diponegoro No.3, Surabaya',
                'no_tlp' => '083456789012',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '19890404D04',
                'user_id' => 4,
                'alamat' => 'Jl. Gatot Subroto No.4, Yogyakarta',
                'no_tlp' => '084567890123',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '19890505E05',
                'user_id' => 5,
                'alamat' => 'Jl. Thamrin No.5, Semarang',
                'no_tlp' => '085678901234',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '19890606F06',
                'user_id' => 6,
                'alamat' => 'Jl. Pahlawan No.6, Malang',
                'no_tlp' => '086789012345',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
