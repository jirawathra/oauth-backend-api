<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate([
            'id' => 1,
            'name' => 'admin',
        ]);

        Role::updateOrCreate([
            'id' => 2,
            'name' => 'employee'
        ]);
    }
}
