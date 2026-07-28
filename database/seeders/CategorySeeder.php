<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::insert([
            [
                'name' => 'Paket Hemat',
                'slug' => 'paket-hemat',
                'is_active' => 1
            ],
            [
                'name' => 'Makanan',
                'slug' => 'makanan',
                'is_active' => 1
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'is_active' => 1
            ],
            [
                'name' => 'Snack',
                'slug' => 'snack',
                'is_active' => 1
            ],
            [
                'name' => 'Coffee',
                'slug' => 'coffee',
                'is_active' => 1
            ]
        ]);
    }
}