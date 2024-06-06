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
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'birthdate' => null,
            'password' => Hash::make('admin123')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'birthdate' => null,
            'password' => Hash::make('user123')
        ]);
        $user->assignRole('user');
    }
}
