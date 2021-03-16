<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Manager\UserSeeder;

class ManagerDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
