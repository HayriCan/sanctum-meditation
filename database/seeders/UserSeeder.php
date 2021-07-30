<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'demo@example.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$QJ7jZEPuKOTWzcyUkJ6wiOtBH4yFuEJ/B3PywNOzZNyq7Rh7ZEi0W',
                'remember_token' => now(),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}