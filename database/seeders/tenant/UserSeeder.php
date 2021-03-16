<?php

namespace Database\Seeders\Tenant;

use App\Models\v1\Tenant\User;
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
                'name' => 'Daniel',
                'email' => 'schmitt.contato@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ]);
    }
}
