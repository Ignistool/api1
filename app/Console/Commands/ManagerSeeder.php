<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ManagerSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manager:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed manager database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $command = 'db:seed';

        $this->info('Populando o banco de dados gerenciador');

        Artisan::call($command , [
            '--class' => 'ManagerDatabaseSeeder'
        ]);
    }
}
