<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Role::create(['name' => 'dosen']);
        Role::create(['name' => 'dosen_wali']);
        Role::create(['name' => 'mahasiswa']);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
        ]);

        // Artisan::call('shield:generate --all --ignore-existing-policies');
        // Artisan::call('shield:super-admin --user=' . $user->id
    }
}
