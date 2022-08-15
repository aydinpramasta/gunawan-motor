<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accountancy;
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
                    'type' => Accountancy::INCOME,
                    'value' => 200000,
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

            Accountancy::insert($accountancies);
        }
    }
}
