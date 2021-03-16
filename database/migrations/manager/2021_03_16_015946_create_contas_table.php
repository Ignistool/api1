<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('logo')->nullable();
            $table->string('cep',10);
            $table->string('endereco');
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado',2);
            $table->string('pais');
            $table->string('tipo', 1);
            $table->string('cpf_cnpj',18);
            $table->string('inscricao_estadual',100)->nullable();
            $table->string('razao_social')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('nome_responsavel',100);
            $table->string('sobrenome_responsavel');
            $table->string('telefone_responsavel',15);
            $table->string('email_responsavel',100);
            $table->string('dominio')->unique();
            $table->string('database')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
