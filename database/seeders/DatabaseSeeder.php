<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' =>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'nomor_telepon' => '082133445678'
        ]);
        Book::factory(2000)->create();
        // Borrower::create([
        //     'nama_peminjam' => 'Peminjam 1',
        //     'nik' => '1234567890123456',
        //     'nim' => '211511999',
        //     'nomor_telepon' => '081234567899',
        //     'email' => 'anantadesta.public@gmail.com',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'is_verified' => true
        // ]);
    }
}
