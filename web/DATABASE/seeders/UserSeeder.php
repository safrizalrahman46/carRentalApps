<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('admin123'), // Pastikan menggunakan bcrypt atau hashing lainnya untuk password
        ]);
        User::create([
            'name' => 'agent',
            'email' => 'agent@gmail.com',
            'password' => Hash::make('agent123'), // Pastikan menggunakan bcrypt atau hashing lainnya untuk password
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'), // Pastikan menggunakan bcrypt atau hashing lainnya untuk password
        ]);
    }
}
