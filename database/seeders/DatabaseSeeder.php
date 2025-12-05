<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo users
        User::firstOrCreate(
            ['email' => 'katyxeight@gmail.com'],
            [
                'name' => 'Katy Eight',
                'password' => \Illuminate\Support\Facades\Hash::make('Vinividi1933'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'akatirthy@gmail.com'],
            [
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('1933admin'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'farid25@gmail.com'],
            [
                'name' => 'Operator',
                'password' => \Illuminate\Support\Facades\Hash::make('1357975'),
                'role' => 'user',
            ]
        );

        // Seeding data warga dummy
        Warga::factory(4)->create();

        // Seeding data PBB dummy
        $this->call(PBBSeeder::class);
    }
}
