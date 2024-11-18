<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gunakan updateOrInsert untuk menambah atau memperbarui user berdasarkan email
        DB::table('users')->updateOrInsert(
            ['email' => 'iqbalfauzi0897155796@gmail.com'], // Kondisi pencarian
            [
                'name' => 'admin',
                'password' => Hash::make('4dmin_l0mbok') // Password akan diperbarui jika data sudah ada
            ]
        );
    }
}
