<?php

namespace App\Tenant;

use App\Models\v1\Manager\Conta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ManagerTenant
{
    public function setConnection(Conta $conta){
        DB::purge();

        config()->set('database.connections.mysql.database', $conta->database);

        DB::reconnect();

        Schema::connection('mysql')->getConnection()->reconnect();
    }
}
