<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Menu::insert([
            [
                'category_id' => 1,
                'name' => 'Paket Hemat Ayam',
                'slug' => 'paket-hemat-ayam',
                'description' => 'Nasi, ayam crispy, sambal, dan es teh.',
                'price' => 25000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Paket Hemat Burger',
                'slug' => 'paket-hemat-burger',
                'description' => 'Burger beef, kentang goreng, dan soft drink.',
                'price' => 32000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Nasi Goreng Special',
                'slug' => 'nasi-goreng-special',
                'description' => 'Nasi goreng dengan telur dan ayam suwir.',
                'price' => 28000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Chicken Katsu',
                'slug' => 'chicken-katsu',
                'description' => 'Chicken katsu crispy dengan saus khas.',
                'price' => 35000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Es Teh Manis',
                'slug' => 'es-teh-manis',
                'description' => 'Es teh manis segar.',
                'price' => 8000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Air Mineral',
                'slug' => 'air-mineral',
                'description' => 'Air mineral botol 600ml.',
                'price' => 6000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'French Fries',
                'slug' => 'french-fries',
                'description' => 'Kentang goreng renyah.',
                'price' => 18000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Onion Rings',
                'slug' => 'onion-rings',
                'description' => 'Onion rings crispy dengan saus mayo.',
                'price' => 20000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'name' => 'Americano',
                'slug' => 'americano',
                'description' => 'Espresso dengan tambahan air panas.',
                'price' => 22000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'name' => 'Cafe Latte',
                'slug' => 'cafe-latte',
                'description' => 'Espresso dengan susu segar.',
                'price' => 28000,
                'image' => 'menus/huynh-quyet-YgirePmHPZU-unsplash.jpg',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}