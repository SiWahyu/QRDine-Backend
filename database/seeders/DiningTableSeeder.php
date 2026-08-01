<?php

namespace Database\Seeders;

use App\Models\DiningTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DiningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiningTable::insert([
            [
                'restaurant_id' => 1,
                'number' => 'A-01',
                'token' => Str::random(32),
            ],
            [
                'restaurant_id' => 1,
                'number' => 'A-02',
                'token' => Str::random(32),
            ],
            [
                'restaurant_id' => 1,
                'number' => 'A-03',
                'token' => Str::random(32),
            ],
            [
                'restaurant_id' => 1,
                'number' => 'A-04',
                'token' => Str::random(32),
            ],
            [
                'restaurant_id' => 1,
                'number' => 'B-01',
                'token' => Str::random(32),
            ],
            [
                'restaurant_id' => 1,
                'number' => 'B-02',
                'token' => Str::random(32),
            ],
            [
                'restaurant_id' => 1,
                'number' => 'B-03',
                'token' => Str::random(32),
            ],
            [
                'restaurant_id' => 1,
                'number' => 'B-04',
                'token' => Str::random(32),
            ],
        ]);
    }
}
