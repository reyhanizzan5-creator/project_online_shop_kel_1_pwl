<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        user::create([
            'name' => 'John Doe',
            'username' => 'admin',
            'password' => Hash::make('123'),
            'role' => 'pelanggan',
        ]);
    }
}