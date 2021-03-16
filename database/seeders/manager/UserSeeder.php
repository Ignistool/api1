<?php

namespace Database\Seeders\Manager;

use App\Models\v1\Manager\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Renan',
                'email' => 'renanjoppert@outlook.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Daniel',
                'email' => 'schmitt.contato@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ]);
    }
}
