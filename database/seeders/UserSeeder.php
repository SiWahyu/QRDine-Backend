<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'SiWahyu',
            'email' => 'siwahyu@gmail.com',
            'password' => Hash::make('siwahyu')
        ]);

        $admin->assignRole('admin');

        $kitchen = User::create([
            'name' => 'asep',
            'email' => 'asep@gmail.com',
            'password' => Hash::make('asep')
        ]);

        $kitchen->assignRole('kitchen');
    }
}
