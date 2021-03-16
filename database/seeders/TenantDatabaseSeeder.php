<?php

namespace Database\Seeders;

use Database\Seeders\Tenant\UserSeeder;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
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
