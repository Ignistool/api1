<?php

namespace App\Console\Commands;

use App\Models\v1\Manager\Conta;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantMigrations extends Command
{

    private $tenant;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migration {id?} {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migration Tenant';

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
        $command = $this->option('refresh')  ? 'migrate:refresh' : 'migrate';

        if( $id = $this->argument('id') ){
            $companies = Conta::where('id', $id)->get();
        }else{
            $companies = Conta::all();
        }

        foreach ($companies as $company){
            $this->tenant->setConnection($company);

            $this->info('Conectando a empresa ' . $company->nome);

            Artisan::call($command, [
                '--force' => true,
                '--path' => '/database/migrations/tenant'
            ]);

            $this->info('Fim da conexão da ' . $company->nome);
            $this->info('-------------------------------------------------------');
        }
    }
}
