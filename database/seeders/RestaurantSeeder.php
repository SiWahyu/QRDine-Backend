<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::create([
            'name' => 'QR Dine Demo',
            'logo' => null,
            'tax_percentage' => 10,
            'service_charge' => 5,
            'phone' => '081234567890',
            'address' => 'Jl. Jalanin No. 123',
        ]);
    }
}
