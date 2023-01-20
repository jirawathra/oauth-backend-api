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
            'firstName' => 'J',
            'lastName' => 'L',
            'email' => 'jl@mandimark.com',
            'password' => bcrypt('password@1'),
            'position' => 'Full-Stack Developer',
            'roleId' => 1,
            'avatar' => ''
        ]);

        $user = User::factory(19)->create();
    }
}
