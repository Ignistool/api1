<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ManagerMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manager:migration {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migrations Manager';

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

        $command = $this->option('refresh')  ? 'migrate:refresh' : 'migrate';

        $this->info('Conectando ao banco de dados gerenciador');

        Artisan::call($command , [
            '--force' => true,
            '--path' => '/database/migrations/manager'
        ]);

        $this->info('Fim da conexão do gerenciador');
        $this->info('-------------------------------------------------------');
    }
}
