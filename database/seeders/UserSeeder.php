<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([[
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => bcrypt('john1234'),
            'token' => Str::random(),
        ], [
            'name' => 'Jane',
            'email' => 'jane@example.com',
            'password' => bcrypt('jane1234'),
            'token' => Str::random(),
        ]]);
    }
}
