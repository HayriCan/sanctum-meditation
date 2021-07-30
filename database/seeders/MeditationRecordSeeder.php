<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MeditationRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meditation_records')->insert([
            [
                'user_id' => 1,
                'meditation_id' => 1,
                'created_at' => Carbon::now()->subDays(20)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(20)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 2,
                'created_at' => Carbon::now()->subDays(19)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(19)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 3,
                'created_at' => Carbon::now()->subDays(18)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(18)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 4,
                'created_at' => Carbon::now()->subDays(16)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(16)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 5,
                'created_at' => Carbon::now()->subDays(15)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(15)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 5,
                'created_at' => Carbon::now()->subDays(15)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(15)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 6,
                'created_at' => Carbon::now()->subDays(13)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(13)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 7,
                'created_at' => Carbon::now()->subDays(13)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(13)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 8,
                'created_at' => Carbon::now()->subDays(13)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(13)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 9,
                'created_at' => Carbon::now()->subDays(12)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(12)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 10,
                'created_at' => Carbon::now()->subDays(11)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(11)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 1,
                'created_at' => Carbon::now()->subDays(10)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(10)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 2,
                'created_at' => Carbon::now()->subDays(9)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(9)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 8,
                'created_at' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 7,
                'created_at' => Carbon::now()->subDays(4)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(4)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 5,
                'created_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 2,
                'created_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'meditation_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
