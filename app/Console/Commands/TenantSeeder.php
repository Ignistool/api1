<?php

namespace App\Console\Commands;

use App\Models\v1\Manager\Conta;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantSeeder extends Command
{

    private $tenant;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:seed {id}';

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
    public function __construct(ManagerTenant $tenant)
    {
        parent::__construct();

        $this->tenant = $tenant;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $command = 'db:seed';

        $id = $this->argument('id');

        if ($conta = Conta::where('id', $id)->first()) {
            // estabelece a conexão
            $this->tenant->setConnection($conta);

            $this->info('Populando o banco de dados de ' . $conta->nome);
            // roda o comando
            Artisan::call($command, [
                '--class' => 'TenantDatabaseSeeder'
            ]);
        }else{
            $this->error('Não há nenuma conta com o id informado ' . $conta->nome);
        }
    }
}
