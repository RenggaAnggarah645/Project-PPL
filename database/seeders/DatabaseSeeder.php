<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userData = [
            [
                'email' => 'operator@gmail.com',
                'role' => 'operator',
                'password' => bcrypt('operator123')
            ],

        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
        
    }
}
