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
            'name' => 'Teacher Test',
            'email' => 'Teacher@example.com',
            'password' => '123456',
            'is_admin' => '1'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Student Test',
            'email' => 'Student@example.com',
            'password' => '12345678',
            'is_admin' => '0'
        ]);
    }
}
