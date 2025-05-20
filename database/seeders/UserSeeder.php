<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'name' => 'Dzaky Arkhan',
                'email' => 'dzaky@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Ratna Winingsih',
                'email' => 'ratna@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Azzahra Putri',
                'email' => 'azzahra@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Ramli Budiman',
                'email' => 'ramli@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Yefta Charrand',
                'email' => 'yefta@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Puput Era',
                'email' => 'puput@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Nafis Pratama',
                'email' => 'nafis@gmal.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Arif Kuniawan',
                'email' => 'arif@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
