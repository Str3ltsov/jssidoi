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

        // Creates a new user with admin:admin credidentials
        User::create([
            'name' => 'admin',
            'email' => 'admin@jssidoi.org',
            'password' => Hash::make('admin'),
        ]);
    }
}