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
        User::create([
            'name' => 'Katy Eight',
            'email' => 'katyxeight@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Vinividi1933'),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        User::create([
            'name' => 'Operator',
            'email' => 'operator@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        // Seeding data warga dummy
        Warga::factory(4)->create();

        // Seeding data PBB dummy
        $this->call(PBBSeeder::class);
    }
}
