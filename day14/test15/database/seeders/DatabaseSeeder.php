<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create a test user if it doesn't exist
        // User::firstOrCreate(
        //     ['email' => 'test@example.com'], // Check if user with this email exists
        //     ['name' => 'Test User', 'password' => bcrypt('password')] // Create with these values
        // );

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        // Create 5 fake articles for the test user
        $user->articles()->createMany(
            \App\Models\Article::factory()->count(5)->make()->toArray()
        );
    }
}
