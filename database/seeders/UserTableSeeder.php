<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // intial admin, user
        $admin = User::create([
            'name' => 'JL',
            'email' => 'jl@mandimark.com',
            'password' => bcrypt('password@1')
        ]);

        $user = User::factory(5)->create();
    }
}
