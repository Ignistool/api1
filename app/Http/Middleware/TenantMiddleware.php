<?php

namespace App\Http\Middleware;

use App\Models\v1\Manager\Conta;
use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // verifica se está acessando do gerenciador.ignistool.com
        if( $request->getHost() == env('TENANT_DOMINIO_GERENCIADOR', 'gerenciador.ignistool.com') ){
            return $next($request);
        }

        $conta = Conta::where('dominio', $request->getHost())->first();

        // verifica se existe o inquilino no domínio de requisição
        if( $conta == null ){
            http_response_code(404);
            header('Content-type: application/json');
            echo '{"error": "Não foi possível acessar a aplicação para este domínio"}';
            die();
        }

        if( $conta != null ){
            app(ManagerTenant::class)->setConnection($conta);
            return $next($request);
        }
    }
}
