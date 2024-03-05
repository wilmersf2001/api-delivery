<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Wilmer Yoel',
            'email' => 'wilmer@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'client'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Jesus Adrian',
            'email' => 'jesus@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'delivery User',
            'email' => 'delivery@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'delivery',
            'config' => [
                'available' => false
            ],
        ]);
        $this->call(EstablishmentSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
