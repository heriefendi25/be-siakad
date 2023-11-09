<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Heri Efendi',
            'email' => 'heri@siakad.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'roles' => 'mahasiswa',
        ]);

        User::factory(10)->create();
    }
}
