<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accountancy;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin')
        ]);

        if (config('app.env') === 'local') {
            $accountancies = [
                [
                    'type' => Accountancy::INCOME,
                    'value' => 150000,
                    'description' => 'Aki',
                    'created_at' => now('Asia/Jakarta'),
                    'updated_at' => now('Asia/Jakarta')
                ],
                [
                    'type' => Accountancy::INCOME,
                    'value' => 200000,
                    'description' => 'Ban',
                    'created_at' => now('Asia/Jakarta')->subDay(),
                    'updated_at' => now('Asia/Jakarta')->subDay()
                ],
                [
                    'type' => Accountancy::INCOME,
                    'value' => 150000,
                    'description' => 'Aki',
                    'created_at' => now('Asia/Jakarta')->subDays(2),
                    'updated_at' => now('Asia/Jakarta')->subDays(2)
                ],
                [
                    'type' => Accountancy::EXPENSE,
                    'value' => 250000,
                    'description' => 'Ban',
                    'created_at' => now('Asia/Jakarta')->subDays(3),
                    'updated_at' => now('Asia/Jakarta')->subDays(3)
                ],
                [
                    'type' => Accountancy::EXPENSE,
                    'value' => 50000,
                    'description' => 'Alat Administrasi',
                    'created_at' => now('Asia/Jakarta'),
                    'updated_at' => now('Asia/Jakarta')
                ],
                [
                    'type' => Accountancy::EXPENSE,
                    'value' => 100000,
                    'description' => 'Perbaikan Alat',
                    'created_at' => now('Asia/Jakarta')->subDay(),
                    'updated_at' => now('Asia/Jakarta')->subDay()
                ],
            ];

            $stocks = [
                [
                    'name' => 'Aki',
                    'slug' => 'aki',
                    'image' => null,
                    'price' => 150000,
                    'quantity' => 50,
                    'created_at' => now('Asia/Jakarta')->subDay(),
                    'updated_at' => now('Asia/Jakarta')->subDay()
                ],
                [
                    'name' => 'Ban Dalam',
                    'slug' => 'ban-dalam',
                    'image' => null,
                    'price' => 25000,
                    'quantity' => 200,
                    'created_at' => now('Asia/Jakarta'),
                    'updated_at' => now('Asia/Jakarta')
                ],
                [
                    'name' => 'Rantai',
                    'slug' => 'rantai',
                    'image' => null,
                    'price' => 100000,
                    'quantity' => 50,
                    'created_at' => now('Asia/Jakarta')->subDays(2),
                    'updated_at' => now('Asia/Jakarta')->subDays(2)
                ],
                [
                    'name' => 'Velg',
                    'slug' => 'velg',
                    'image' => null,
                    'price' => 125000,
                    'quantity' => 75,
                    'created_at' => now('Asia/Jakarta')->subDays(3),
                    'updated_at' => now('Asia/Jakarta')->subDays(3)
                ]
            ];

            Accountancy::insert($accountancies);
            Stock::insert($stocks);
        }
    }
}
